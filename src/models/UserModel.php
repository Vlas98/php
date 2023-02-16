<?php

require_once __DIR__ . '/JSONable.php';// единажды подключаем класс работы с json  файлами 

class UserModel extends JSONable // копируем атрибуты  класса JSONable
{
    
    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\users.json';
    }

    public function ban()
    {
        $allUsers = $this->getData();
        $login = $_SERVER['QUERY_STRING'];

        $allUsers = array_map(function($item) use ($login) {
            if($item['login'] === $login){ 
                $item['role'] = 'banned';
            }
            return $item;
        }, $allUsers);
        $this->saveToFile($allUsers);
        header('location: /user=?' . $login);
    }

    public function editInfo($editInfo, $login)
    {
        $allUsers = $this->getData();

        $allUsers = array_map(function($item) use ($editInfo, $login){
            if($item['login']=== $login){
                $item['about'] = $editInfo;
            }
            return $item;
        }, $allUsers);
        $this->saveToFile($allUsers);
        header('location: /user=?' . $login);

    }

}