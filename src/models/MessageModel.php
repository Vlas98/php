<?php 

require_once __DIR__ . '/JSONable.php'; 

class MessageModel extends JSONable
{

    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\list.json';
    }
    
}
