<?php

$userModel = new UserModel;

if( !empty($_POST['user'])){
    $userName = $_POST['user'];
    $password = $_POST['password'];
    $hashPassword = hash('md5',$password, false);
    
    $foundedUser = $userModel->find('login', $userName);
    
    if($foundedUser === null){
        $newUser = ["login" =>$_POST['user'], "password" => $_POST['password'], "role" =>'user'];
        $userModel->add($newUser);
        $authGateway->auth($userName);
    }else{
        if(hash('md5', $foundedUser['password'], false) ===  $hashPassword){
            $authGateway->auth($userName);
        }
    }

}

include APP_PATH . '\Templates\login.phtml';