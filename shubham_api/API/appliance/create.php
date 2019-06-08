<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/appliance.php';

$database = new Database();
$db = $database->connect();
$appliance = new Appliance($db);

$data = json_decode(file_get_contents("php://input"));

$appliance->type = $data->type;
$appliance->rating = $data->rating;

if($appliance->create()){
    echo json_encode(array('inform' => 'Appliance Created'));
}
else{
    echo json_encode(array('inform' => 'Appliance Not Created'));
}