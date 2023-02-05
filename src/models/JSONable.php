<?php

require_once __DIR__ . '/iJSONable.php';

abstract class JSONable implements iJSONable
{

    public function get(string|Closure $key = null, $value = null): array
    {
        //возвращает значения json  файла, которое соответсвует условию.
        $data = $this->getData();
        if(is_string($key) === false){
            return $key($data);
        }
        
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
        $data = $this->getData();
        $data[] = $item; 
        $json = json_encode($data);
        file_put_contents($this->getFile(), $json);
    }
 
    protected function getData(): array
    {
        //  возвращает содержимое json файла или массив
        // читаем файл и записываем содержимое в переменную
        $jsonContent = file_get_contents($this->getFile());
        return json_decode($jsonContent, true);
    }

}
