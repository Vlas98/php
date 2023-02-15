<?php


$userModel = new UserModel;
$authGateway = new AuthGateway($_COOKIE);


$login = $_SERVER['QUERY_STRING'];
$user = $userModel->find('login', $login);



include_once APP_PATH . '/Templates/profile.phtml';
