<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/college.php';

$database = new Database();
$db = $database->connect();
$college = new College($db);

$data = json_decode(file_get_contents("php://input"));

$college->id = $data->id;

if($college->delete()){
    echo json_encode(array('inform' => 'College Deleted'));
}
else{
    echo json_encode(array('inform' => 'College Not Deleted'));
}