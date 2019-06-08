<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/college.php';

$database = new Database();
$db = $database->connect();
$college = new College($db);

$college->id = isset($_GET['id']) ? $_GET['id'] : die();

$college->read_single();

$college_arr = array(
    'id' => $college->id,
    'name' => $college->name,
    'estd' => $college->estd
);

print_r(json_encode($college_arr));