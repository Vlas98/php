<?php 

require_once __DIR__ . '/JSONable.php'; 

class MessageModel extends JSONable
{

    public function getFile(): string 
    {
        // возвращает путь к json файлу 
        return APP_PATH . '\src\data\list.json';
    }

    public function JSONFile(): array
    {
        $listJSON = file_get_contents($this->getFile()); //json файл, но не массив
        return json_decode($listJSON, true); // массив информации о пользователях
    }

    public function add(string $data, $author, $text):void// получает три стринга или массив?
    {
        $listJSON[] = ['data'=> $data, 'author'=>$author, 'text'=>$text, 'status' => 'active'];// добавляем сообщение в массив
        file_put_contents($this->getFile(), json_encode($listJSON)); //сохраняем в json 
    }
    
}
