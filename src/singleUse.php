<?php

$jsonPath =  "data/list.json";
$json = file_get_contents($jsonPath);
$json = json_decode($json, true);

$i=0;
function addID($item):array
{
    if(isset($item['id']) === false){
        // array_push($item, 'id:'$i);
         
        //array_pop($item['id'], $i);
         $i++;
         $item['id'] = "$i";
         return $item;
         }
}

$json = array_map('addID', $json);


$json = json_encode($json);
file_put_contents($jsonPath, $json);