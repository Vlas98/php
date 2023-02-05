<?php    

include APP_PATH . '/src/models/MessageModel.php';
date_default_timezone_set('Europe/Moscow');
// перенести работу с даными( json) в messageModule.php
$text = $_POST['text'] ?? '';

$nameListPath = APP_PATH. '/src/data/list.json';//
$json = file_get_contents($nameListPath);//

if(!empty($json)){
    $nameList = json_decode($json, true);
}else{
    $nameList= [];  
}

if(!empty($text))
{
    $author = $authGateway->getUser()['login'];
    $data = date('jS F Y h:i:s');
    $messageModel->add($data, $author, $text);
}


$newComments = array_filter($nameList, function($item){
    $dataComment = $item['data'];
    $dataComment = strtotime($dataComment);
    $now = strtotime(date('jS F Y h:i:s'));

    $different = ($now - $dataComment);
    $division = intdiv($different, 3600);

    return $division <= 5;
});

//$newComments = [['25.02.2202 04:33:22', 'log', 'afalkjfk']];
$newComments = array_filter($newComments, function(array $item) use ($authGateway) :bool
{
    
    if($item['author'] === $authGateway->getUser()['login']){
        return true;
    }

    if(preg_match('/^@[^,]+,.+/', $item['text']) === 0){
        return true;
    }

    $needle = '@'. $authGateway->getUser()['login']. ',';
    return str_starts_with($item['text'], $needle);
});

include APP_PATH . "/Templates/template.phtml"; 
