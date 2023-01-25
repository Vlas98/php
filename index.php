<?php    
date_default_timezone_set('Europe/Moscow');

$name = $_POST['name'] ?? '';
$author = $_POST['author'] ?? '';

$nameListPath = 'list.json';
$json = file_get_contents($nameListPath);

if(!empty($json)){
$nameList = json_decode($json, true);
}else{
$nameList= [];
}

if(!empty($name) && !empty($author) )
{
$data = date('jS F Y h:i:s');
$nameList[] = ["data" => $data,"author" =>$author, "name" => $name];
file_put_contents('list.json',json_encode($nameList));
}


$newComments = array_filter($nameList, function($item){
    $dataComment = $item['data'];
    $dataComment = strtotime($dataComment);
    $now = strtotime(date('jS F Y h:i:s'));

    $different = ($now - $dataComment);
    $division = intdiv($different, 300);

    return $division <= 5;
});


include "./Templates/template.phtml";