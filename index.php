<?php    

define('APP_PATH',__DIR__);

include_once APP_PATH . '/src/AuthGateway.php';

$authGateway = new AuthGateway($_COOKIE);

if($authGateway->isAuth()){
    include APP_PATH . '/src/chat.php';
}else{
    include APP_PATH . '/src/login.php';
}