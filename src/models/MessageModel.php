<?php 

require_once __DIR__ . '/JSONable.php'; 

class MessageModel extends JSONable
{

    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\list.json';
    }

    public function deleteMessage(int $id): void
    {
        $allMessages = $this->getData();
        $allMessages = array_map(function($item) use ($id) {
            if($item['id'] === $id){ 
                $item['status'] = 'deleted';
            }
            return $item;
        }, $allMessages);
        
        $this->saveToFile($allMessages);
    }
}
