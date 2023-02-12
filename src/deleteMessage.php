<?php

include_once APP_PATH . "\src\models\MessageModel.php";


$messageModel = new MessageModel;
$id = $_GET['id'];

if($authGateway->isAdmin())
{
    $messageModel->deleteMessage($id);
    header('Location: /');
}else{
    echo 'Ты не админ';
}



