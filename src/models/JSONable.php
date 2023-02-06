<?php

require_once __DIR__ . '/iJSONable.php'; //подключаем единажды класс интерфейса

abstract class JSONable implements iJSONable //создаем абстрактный класс, унаследующий iJSONable(можем обращаться только через userModel)
{
        /**
         методо получает строки или условие
        */
    public function get(string|Closure $key = null, $value = null): array //  key - ключ по которому ищется информация, value-значение, которое должен содержать key
    {
        //возвращает значения json  файла, которое соответсвует условию.
        $data = $this->getData(); 
        if(is_callable($key)){  //если метод  получил "условие"
            return $key($data); //возвращаем "условие", в которое мы отправляем $data
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
