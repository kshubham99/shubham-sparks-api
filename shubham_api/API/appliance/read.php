<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/appliance.php';

$database = new Database();
$db = $database->connect();
$appliance = new Appliance($db);
$result = $appliance->read();
$num = $result->rowCount();

if($num > 0){
    $appliance_arr = array();
    $appliance_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $appliance_item = array(
            'id' => $id,
            'type' => $type,
            'rating' => $rating
        );

        array_push($appliance_arr['data'], $appliance_item);
    }
    echo json_encode($appliance_arr);
}

else{
    echo json_encode(
        array('inform' => 'No Appliance found')
    );
}
