<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/appliance.php';

$database = new Database();
$db = $database->connect();
$appliance = new Appliance($db);

$data = json_decode(file_get_contents("php://input"));

$appliance->id = $data->id;

if($appliance->delete()){
    echo json_encode(array('inform' => 'Appliance Deleted'));
}
else{
    echo json_encode(array('inform' => 'Appliance Not Deleted'));
}