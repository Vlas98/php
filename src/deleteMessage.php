<?php

include_once APP_PATH . "/src/MessageModel.php";

$id = $_GET['id'];
var_dump($id);

$messageModule = new MessageModel;