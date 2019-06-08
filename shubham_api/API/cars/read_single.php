<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/car.php';

$database = new Database();
$db = $database->connect();
$cars = new Cars($db);

$cars->id = isset($_GET['id']) ? $_GET['id'] : die();

$cars->read_single();

$cars_arr = array(
    'id' => $cars->id,
    'name' => $cars->name,
    'color' => $cars->color
);

print_r(json_encode($cars_arr));