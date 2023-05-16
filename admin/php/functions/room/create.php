<?php
session_start();
include("../../models/Room.php");
include("../../models/Reservation.php");
include("../../models/User.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$roomObj = new Room($db);
$userObj = new User($db);

$room_is_available = $roomObj->read();

$valid = array();
$errors = array();
$result = array();

$room_number = null;
$type = null;
$occupancy = null;
$rate_sun_thurs = null;
$rate_fri_sat = null;
$description = null;
$availability = null;

// START OF VALIDATION BLOCK
if (!isset($_POST['room_number'])) {
    $valid[0] = false;
    array_push($errors, "Room Number is empty. Please select a customer.");
} else {
    $valid[0] = true;
    $customer_id = $_POST['room_number'];
}

if (!isset($_POST['type'])) {
    $valid[1] = false;
    array_push($errors, "Type is empty. Please select a Bed Type.");
} else {
    $room_id = $_POST['type'];
    $valid[1] = true;
}

if (!isset($_POST['occupancy'])) {
    $valid[2] = false;
    array_push($errors, "Select an appropriate Start Date");
} else {
    $start_date = $_POST['occupancy'];
    $valid[2] = true;
}

if (!isset($_POST['rate_sun_thurs'])) {
    $valid[3] = false;
    array_push($errors, "Select an appropriate End Date");
} else {
    $end_date = $_POST['rate_sun_thurs'];
    $valid[3] = true;
}

if (!isset($_POST['rate_fri_sat'])) {
    $valid[4] = false;
    array_push($errors, "Input an appropriate number of guests");
} else {
    $num_of_guests = $_POST['rate_fri_sat'];
    $valid[4] = true;
}

if (!isset($_POST['description'])) {
    $valid[5] = false;
    array_push($errors, "Input the appropriate total price");
} else {
    $total_price = $_POST['description'];
    $valid[5] = true;
}

if (!isset($_POST['availability'])) {
    $valid[6] = false;
    array_push($errors, "Please select the appropriate status.");
} else {
    $status = $_POST['availability'];
    $valid[6] = true;
}

// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array(["status" => 0, "errors" => $errors]);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

// END OF VALIDATION BLOCK

$room = new Room($db);
$room->setRoom_number($customer_id);
$room->setType($room_id);
$room->setOccupancy($start_date);
$room->setRate_sun_thurs($end_date);
$room->setRate_fri_sat($num_of_guests);
$room->setDescription($total_price);
$room->setAvailability($status);

$saveRes = $room->save();

$result = array(["status" => 1, "msg" => "Created new Room"]);
// echo json_encode($result, JSON_PRETTY_PRINT);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
