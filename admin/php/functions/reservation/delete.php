<?php
session_start();
include("../../models/Room.php");
include("../../models/Reservation.php");
include("../../models/User.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

if(!isset($_POST["reservation_id"])){
    // Error
    exit;
}

$reservationObj->get($_POST["reservation_id"], true);
$result = $reservationObj->delete(null);
echo $result;
exit;

?>