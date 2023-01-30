<?php

$userPath  = APP_PATH . '\src\data\users.json';
$all_users = file_get_contents($userPath);
$users = json_decode($all_users, true);


if( !empty($_POST['user'])){
    $userName = $_POST['user'];

    // [ {login: string, password: string}, ...]
        $login = array_filter($users, function(array $creds) use ($userName): bool
        {
            return $creds['login'] == $userName;
        });
    if(empty($login)){
        $users[] = ["login" =>$_POST['user'], "password" => $_POST['password']];
        file_put_contents($userPath, json_encode($users)); 
        $authGateway->auth($userName);
    }else{
        $login= $login[0];
        $pass = $_POST['password'];
        if($login['password'] === $pass ){
            $authGateway->auth($userName);
        }
    }

}

include APP_PATH . '\Templates\login.phtml';