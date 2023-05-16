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
$reservationObj = new Reservation($db);

$room_is_available = $roomObj->read();

$valid = array();
$errors = array();
$result = array();

$reservation_id;
$customer_id = null;
$room_id = null;
$start_date = null;
$end_date = null;
$num_of_guests = null;
$total_price = null;
$status = null;

if (!isset($_POST['reservation_id'])) {
    $valid[0] = false;
    array_push($errors, "Reservation ID is empty. Please select a reservation.");
} else {
    $valid[0] = true;
    $reservation_id = $_POST['reservation_id'];
}

$reservationObj->get($reservation_id, false);

// START OF VALIDATION BLOCK
if (!$userObj->get($_POST['customer_id'])) {
    array_push($errors, "Selected User does not exist. Please reload the page and try again.");
    $valid[7] = false;
} else $valid[7] = true;

if (!$roomObj->get($_POST['room_id'], false)) {
    array_push($errors, "Selected Room does not exist. Please reload the page and try again.");
    $valid[8] = false;
} else $valid[8] = true;


// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array(["status" => 0, "errors" => $errors]);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

// END OF VALIDATION BLOCK

// Save Info
if (isset($_POST['customer_id']))
    $reservationObj->setCustomer_id($_POST['customer_id']);

if (isset($_POST['room_id']))
    $reservationObj->setRoom_id($_POST['room_id']);

if (isset($_POST['start_date']))
    $reservationObj->setStart_date($_POST['start_date']);

if (isset($_POST['end_date']))
    $reservationObj->setEnd_date($_POST['end_date']);

if (isset($_POST['num_of_guests']))
    $reservationObj->setNum_of_guests($_POST['num_of_guests']);

if (isset($_POST['total_price']))
    $reservationObj->setTotal_price($_POST['total_price']);

if (isset($_POST['status']))
    $reservationObj->setStatus($_POST['status']);


$saveRes = $reservationObj->save();

$result = array(["status" => 1, "msg" => "Updated reservation"]);
// echo json_encode($result, JSON_PRETTY_PRINT);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
