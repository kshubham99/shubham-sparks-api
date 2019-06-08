<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/car.php';

$database = new Database();
$db = $database->connect();
$cars = new Cars($db);

$data = json_decode(file_get_contents("php://input"));

$cars->name = $data->name;
$cars->color = $data->color;

if($cars->create()){
    echo json_encode(array('inform' => 'Cars Created'));
}
else{
    echo json_encode(array('inform' => 'Cars Not Created'));
}