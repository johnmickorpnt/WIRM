<?php
include("../../models/Room.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$roomObj = new Room($db);
$rooms = $roomObj->read_available();


$rooms = isset($_POST["room_id"]) ?
    $roomObj->get($_POST["room_id"], true) :
    $roomObj->read();

echo json_encode($rooms, JSON_PRETTY_PRINT);

?>