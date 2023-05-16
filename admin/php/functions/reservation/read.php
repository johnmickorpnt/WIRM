<?php
include("../../models/Reservation.php");
include("../../config/Database.php");
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$reservationObj = new Reservation($db);

$reservation = isset($_POST["reservation_id"]) ?
    $reservationObj->get($_POST["reservation_id"], true) :
    $reservationObj->read();



echo json_encode($reservation, JSON_PRETTY_PRINT);
