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

$firstname = null;
$lastname = null;
$contact_number = null;
$email = null;
$password = null;

// START OF VALIDATION BLOCK
if (!isset($_POST['customer_id'])) {
    $valid[0] = false;
    array_push($errors, "Customer ID is empty. Please select a customer.");
} else {
    $valid[0] = true;
    $customer_id = $_POST['customer_id'];
}

if (!isset($_POST['room_id'])) {
    $valid[1] = false;
    array_push($errors, "Room ID is empty. Please select a room.");
} else {
    $room_id = $_POST['room_id'];
    $valid[1] = true;
}

if (!isset($_POST['start_date'])) {
    $valid[2] = false;
    array_push($errors, "Select an appropriate Start Date");
} else {
    $start_date = $_POST['start_date'];
    $valid[2] = true;
}

if (!isset($_POST['end_date'])) {
    $valid[3] = false;
    array_push($errors, "Select an appropriate End Date");
} else {
    $end_date = $_POST['end_date'];
    $valid[3] = true;
}

if (!isset($_POST['num_of_guests'])) {
    $valid[4] = false;
    array_push($errors, "Input an appropriate number of guests");
} else {
    $num_of_guests = $_POST['num_of_guests'];
    $valid[4] = true;
}

if (!isset($_POST['total_price'])) {
    $valid[5] = false;
    array_push($errors, "Input the appropriate total price");
} else {
    $total_price = $_POST['total_price'];
    $valid[5] = true;
}

if (!isset($_POST['status'])) {
    $valid[6] = false;
    array_push($errors, "Please select the appropriate status.");
} else {
    $status = $_POST['status'];
    $valid[6] = true;
}


if (!$userObj->get($_POST['customer_id'])) {
    array_push($errors, "Selected User does not exist. Please reload the page and try again.");
    $valid[7] = false;
} else $valid[7] = true;

if (!$roomObj->get($_POST['room_id'], false)->rowCount()) {
    array_push($errors, "Selected Room does not exist. Please reload the page and try again.");
    $valid[8] = false;
} else $valid[8] = true;

// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array(["status" => 0, "errors" => $errors]);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

if (in_array(false, $valid)) {
    http_response_code(422);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$user->setFirst_name($fname);
$user->setLast_name($lname);
$user->setEmail($email);
$user->setContact_number($contact_number);
$user->setPass(password_hash($pass, PASSWORD_DEFAULT));

$result = $user->save();

if ($result) {
    http_response_code(200);
    header('Location: ' . '../../../auth/login');
    exit();
}
?>