<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("../../config/Database.php");
include_once("../../models/Room.php");

$database = new Database();
$db = $database->connect();
$rooms = new Room($db);

if (!isset($_GET["type"])) {
    echo json_encode(["msg" => "Type not recognized."]);
    return false;
}

$type = trim($_GET["type"]);
$result = $rooms->available_rooms($type);
echo json_encode($result);

?>

