<?php    

define('APP_PATH', __DIR__);// глобальная константа пути к корню директории (Для чего)


include_once APP_PATH . '/src/AuthGateway.php'; // подключаем авторизацию (не авторизацию, а файл с классом для работы с авторизацией)

$authGateway = new AuthGateway($_COOKIE); //  создаем новый экземпляр клааса авторизации


// routing
if($_SERVER['REQUEST_URI'] === '/logout')
{
    include APP_PATH . '/logout.php';    
}else{
    if($authGateway->isAuth()){// проверяем на авторизацию
        include APP_PATH . '/src/chat.php'; // если авторизовани - подключаем чат
    }else{
        include APP_PATH . '/src/login.php';// иначе( если не авторизован) подключаем форму авторизации
    }
}
