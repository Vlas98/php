<?php

if( !empty($_POST['user'])){
    $userName = $_POST['user'];

    // [ {login: string, password: string, role: string}, ...]
    $login = array_filter($users, function(array $creds) use ($userName): bool
    {
        return $creds['login'] == $userName;
    });

    if(empty($login)){
        $users[] = ["login" =>$_POST['user'], "password" => $_POST['password'], "role" =>'user'];
        file_put_contents($userPath, json_encode($users)); 
      
        $authGateway->auth($userName);
    }else{
        $login = array_pop($login);
        $pass = $_POST['password'];

        if($login['password'] === $pass ){
            $role = $login['role'];
            if($role === 'admin'){
                $authGateway->isAdmin($userName, $role);
            }
            else{
                $authGateway->auth($userName, $role);
            }

        }
    }

}



include APP_PATH . '\Templates\login.phtml';