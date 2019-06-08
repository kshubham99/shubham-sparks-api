<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/car.php';

$database = new Database();
$db = $database->connect();
$cars = new Cars($db);
$result = $cars->read();
$num = $result->rowCount();

if($num > 0){
    $cars_arr = array();
    $cars_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $cars_item = array(
            'id' => $id,
            'name' => $name,
            'color' => $color
        );

        array_push($cars_arr['data'], $cars_item);
    }
    echo json_encode($cars_arr);
}

else{
    echo json_encode(
        array('inform' => 'No Cars found')
    );
}
