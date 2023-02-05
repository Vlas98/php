<?php    

include APP_PATH . '/src/models/MessageModel.php';

date_default_timezone_set('Europe/Moscow');
// перенести работу с даными( json) в messageModule.php

$messageModel = new MessageModel;

$text = $_POST['text'] ?? '';
if(!empty($text))
{
    $author = $authGateway->getUser()['login'];
    $data = date('jS F Y h:i:s');
    $newMessage = ['data'=>$data, 'author'=>$author,'text'=>$text]; 
    $messageModel->add($newMessage);
}

$allMessage = $messageModel->get(function($messages){
    return $messages;
});

$newComments = array_filter($allMessage, function($item){
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
