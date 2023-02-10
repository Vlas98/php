<?php    

include APP_PATH . '/src/models/MessageModel.php'; // подключаем файл класса модели сообщения

date_default_timezone_set('Europe/Moscow'); //  задаем дату на сервере

$messageModel = new MessageModel; // создаем новый экземпляр класса модели сообщения

$text = $_POST['text'] ?? '';
if(!empty($text)) // Добавляем новое сообщение в файл (проверяем пришло ли сообщение вместе с запросом)
{
    $author = $authGateway->getUser()['login'];
    $date = date('jS F Y h:i:s');
    $newMessage = ['date'=>$date, 'author'=>$author,'text'=>$text, 'status'=>'active']; 
    $messageModel->add($newMessage);
}

$allMessage = $messageModel->get();
 
$newComments = array_filter($allMessage, function($item){ //выводим сообщение (фильтруем по дате, а не выводим)
    $dataComment = $item['date'];
    $dataStatus  = $item['status'];
    $dataComment = strtotime($dataComment);
    $now = strtotime(date('jS F Y h:i:s'));

    $different = ($now - $dataComment);
    $division = intdiv($different, 3600);

    return $division <=5; 
});

//$newComments = [['25.02.2202 04:33:22', 'log', 'afalkjfk']];
$newComments = array_filter($newComments, function(array $item) use ($authGateway) :bool
{
    if($item['status'] === 'deleted')
    {
        $item['text'] = 'Deleted';
    }

    if($item['author'] === $authGateway->getUser()['login']){
        return true;
    }

    if(preg_match('/^@[^,]+,.+/', $item['text']) === 0){
        return true;
    }
    

    $needle = '@'. $authGateway->getUser()['login']. ',';
    return str_starts_with($item['text'], $needle);
});

$newComments = array_map(function($item){
    $item['text'] = $item['status'] === 'deleted' ? 'Deleted' : $item['text']; 
    return $item;
}, $newComments);

if($authGateway->isAdmin()){
    $newComments = array_map(function($item){
        $item['text']; // .= "'<input type=\"submit\" id = \"  $item['id'], \" value= \"X\" method = \"POST\">";
        return $item;
    }, $newComments);
}

include APP_PATH . "/Templates/template.phtml"; 
