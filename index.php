<?php    
  
$name = $_POST['name'] ?? '';
$author = $_POST['author'] ?? '';

$nameListPath = 'list.json';
$json = file_get_contents($nameListPath);

if(!empty($json)){
$nameList = json_decode($json, true);
}else{
$nameList= [];
}

if(!empty($name) /*&& !empty($author) */)
{
$nameList[] = ["author" =>$author, "name" => $name];
file_put_contents('list.json',json_encode($nameList));
}

include "./Templates/template.phtml";