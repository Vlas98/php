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
    $division = intdiv($different, 3600);

    return $division <= 5;
});

//$newComments = [['25.02.2202 04:33:22', 'log', 'afalkjfk']];
$newComments = array_filter($newComments, function(array $item) use ($authGateway) :bool
{
    
    if($item['author'] === $authGateway->getUser()){
        return true;
    }

    if(preg_match('/^@[^,]+,.+/', $item['name']) === 0){
        return true;
    }

    $needle = '@'. $authGateway->getUser(). ',';
    return str_starts_with($item['name'], $needle);
});

include APP_PATH . "/Templates/template.phtml"; 
