<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/college.php';

$database = new Database();
$db = $database->connect();
$college = new College($db);
$result = $college->read();
$num = $result->rowCount();

if($num > 0){
    $college_arr = array();
    $college_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $college_item = array(
            'id' => $id,
            'name' => $name,
            'estd' => $estd
        );

        array_push($college_arr['data'], $college_item);
    }
    echo json_encode($college_arr);
}

else{
    echo json_encode(
        array('inform' => 'No college found')
    );
}
