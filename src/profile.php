<?php


$userModel = new UserModel;
$authGateway = new AuthGateway($_COOKIE );


$login = $_SERVER['QUERY_STRING'];
$user = $userModel->find('login', $login);
$editInfo = $_POST['about']??null;
$login = $authGateway->getUser()['login'];


if(isset($editInfo)){

    $userModel->editInfo($editInfo, $login);
}



include_once APP_PATH . '/Templates/profile.phtml';
