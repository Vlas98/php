<?php

require_once __DIR__ . '/JSONable.php';// единажды подключаем класс работы с json  файлами 

class UserModel extends JSONable // копируем атрибуты  класса JSONable
{
    
    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\users.json';
    }

}