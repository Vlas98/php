<?php    

define('APP_PATH',__DIR__);// глобальная константа пути к корню директории

include_once APP_PATH . '/src/AuthGateway.php'; // подключаем авторизацию

$authGateway = new AuthGateway($_COOKIE); //  создаем новый экземпляр клааса авторизации

if($authGateway->isAuth()){// проверяем на авторизацию
    include APP_PATH . '/src/chat.php'; // если авторизовани - подключаем чат
}else{
    include APP_PATH . '/src/login.php';// иначе( если не авторизован) подключаем форму авторизации
}

