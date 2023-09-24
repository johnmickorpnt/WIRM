<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("../../config/Database.php");
include_once("../../models/Room.php");
include_once("../../models/Reservation.php");

$database = new Database();
$db = $database->connect();
$rooms = new Room($db);
$reservations = new Reservation($db);


if (!isset($_GET["type"])) {
    echo json_encode(["msg" => "Type not recognized."]);
    return false;
}

if (!isset($_GET["checkIn"])) {
    echo json_encode(["msg" => "Check in time missing"]);
    return false;
}

if (!isset($_GET["checkOut"])) {
    echo json_encode(["msg" => "Check out time missing"]);
    return false;
}


$type = trim($_GET["type"]);
$checkIn = trim($_GET["checkIn"]);
$checkOut = trim($_GET["checkOut"]);
$checkInDateObj = date_create($checkIn);
$checkOutDateObj = date_create($checkOut);

$newCheckIn = date_format($checkInDateObj,"Y-m-d H:i:s");
$newCheckOut = date_format($checkOutDateObj,"Y-m-d H:i:s");

$result = $reservations->available_rooms($type, $newCheckIn, $newCheckOut);

echo json_encode($result);

?>

