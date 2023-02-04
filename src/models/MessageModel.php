<?php 

include './JSONable.php';

class MessageModel extends JSONanable
{

    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\list.json';
    }
    
}
