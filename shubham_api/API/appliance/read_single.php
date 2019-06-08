<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/appliance.php';

$database = new Database();
$db = $database->connect();
$appliance = new Appliance($db);

$appliance->id = isset($_GET['id']) ? $_GET['id'] : die();

$appliance->read_single();

$appliance_arr = array(
    'id' => $appliance->id,
    'type' => $appliance->type,
    'rating' => $appliance->rating
);

print_r(json_encode($appliance_arr));