<?php

require_once __DIR__ . '/iJSONable.php';

abstract class JSONable implements iJSONable
{
    private array|null $_data = null;

    public function get(string $key = null, $value = null): array
    {
        //возвращает значения json  файла, которое соответсвует условию.
        $data = $this->getData();
        return $data;
    }

    public function find(string $key = null, $value = null): array |null
    {
        //возвращает первое совпадение с условием 
        $data = $this->getData(); 
        foreach($data as $item){
            if($item[$key] === $value){
                return $item;
            }
        }
        return  null;        
    }

    public function add(array $item): void 
    {
        //добавляет новую запиись в json
        $this->_data[] = $item; 
        $json = json_encode($this->_data);
        file_put_contents($this->getFile(), $json);
    }
 
    protected function getData(): array
    {
        //  возвращает содержимое json файла или массив
        if($this->_data === null){
            // читаем файл и записываем содержимое в переменную
            $jsonContent = file_get_contents($this->getFile());
            $this->_data = json_decode($jsonContent, true);
        }

        return $this->_data ?? [];
    }


}
