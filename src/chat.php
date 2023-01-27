<?php    
date_default_timezone_set('Europe/Moscow');

$name = $_POST['name'] ?? '';

$nameListPath = APP_PATH. '/src/data/list.json';
$json = file_get_contents($nameListPath);

if(!empty($json)){
    $nameList = json_decode($json, true);
}else{
    $nameList= [];  
}

if(!empty($name))
{
    $author = $authGateway->getUser();
    $data = date('jS F Y h:i:s');
    $nameList[] = ["data" => $data,"author" =>$author, "name" => $name];
    file_put_contents($nameListPath,json_encode($nameList));
}


$newComments = array_filter($nameList, function($item){
    $dataComment = $item['data'];
    $dataComment = strtotime($dataComment);
    $now = strtotime(date('jS F Y h:i:s'));

    $different = ($now - $dataComment);
    $division = intdiv($different, 300);

    return $division <= 5;
});

if(!empty($_COOKIE['user']) ){

    include APP_PATH . "\src\logout.php";
    
    }else{echo 'Log In, pls';}


include APP_PATH . "/Templates/template.phtml"; 
//include APP_PATH . "/src/logout.php";
