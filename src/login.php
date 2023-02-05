<?php

$userModel = new UserModel;

if( !empty($_POST['user'])){
    $userName = $_POST['user'];
    $password = $_POST['password'];
    
    $foundedUser = $userModel->find('login', $userName);
    
    if($foundedUser === null){
        $newUser = ["login" =>$_POST['user'], "password" => $_POST['password'], "role" =>'user'];
        $userModel->add($newUser);
        $authGateway->auth($userName);
    }else{
        if($foundedUser['password'] === $password ){
            $authGateway->auth($userName);
        }
    }

}

include APP_PATH . '\Templates\login.phtml';