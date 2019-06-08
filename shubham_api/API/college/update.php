<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/college.php';

$database = new Database();
$db = $database->connect();
$college = new College($db);

$data = json_decode(file_get_contents("php://input"));

$college->id = $data->id;
$college->name = $data->name;
$college->estd = $data->estd;

if($college->update()){
    echo json_encode(array('inform' => 'College Updated'));
}
else{
    echo json_encode(array('inform' => 'College Not Updated'));
}