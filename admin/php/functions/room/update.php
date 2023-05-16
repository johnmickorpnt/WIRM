<?php
session_start();
include("../../models/Room.php");
include("../../models/Reservation.php");
include("../../models/User.php");
include("../../config/Database.php");
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$roomObj = new Room($db);
$userObj = new User($db);

$room_is_available = $roomObj->read();

$valid = array();
$errors = array();
$result = array();

if (!isset($_POST['room_id'])) {
    $valid[0] = false;
    array_push($errors, "Room is empty. Please select a reservation.");
} else {
    $valid[0] = true;
    $reservation_id = $_POST['room_id'];
}

$roomObj->get($reservation_id, false);

// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array(["status" => 0, "errors" => $errors]);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

// END OF VALIDATION BLOCK

// Save Info
if (isset($_POST['room_number']))
    $roomObj->setRoom_number($_POST['room_number']);

if (isset($_POST['type']))
    $roomObj->setType($_POST['type']);

if (isset($_POST['occupancy']))
    $roomObj->setOccupancy($_POST['occupancy']);

if (isset($_POST['rate_fri_sat']))
    $roomObj->setRate_fri_sat($_POST['rate_fri_sat']);

if (isset($_POST['rate_sun_thurs']))
    $roomObj->setRate_sun_thurs($_POST['rate_sun_thurs']);

if (isset($_POST['description']))
    $roomObj->setDescription($_POST['description']);

if (isset($_POST['availability']))
    $roomObj->setAvailability($_POST['availability']);


$saveRes = $roomObj->save();

$result = array(["status" => 1, "msg" => "Updated Room."]);
// echo json_encode($result, JSON_PRETTY_PRINT);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
