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


if (!isset($_POST['firstname'])) {
    $valid[1] = false;
    array_push($errors, "First name is empty. Please select input a first name.");
} else {
    $firstname = $_POST['firstname'];
    $valid[1] = true;
}

if (!isset($_POST['lastname'])) {
    $valid[2] = false;
    array_push($errors, "Last name is empty. Please select input a first name.");
} else {
    $lastname = $_POST['lastname'];
    $valid[2] = true;
}

if (!isset($_POST['contact_number'])) {
    $valid[3] = false;
    array_push($errors, "Contact Number is empty. Please select input a first name.");
} else {
    $contact_number = $_POST['contact_number'];
    $valid[3] = true;
}

if (!isset($_POST['email'])) {
    $valid[4] = false;
    array_push($errors, "Email is empty. Please select input a first name.");
} else {
    $email = $_POST['email'];
    $valid[4] = true;
}

if (!isset($_POST['password'])) {
    $valid[5] = false;
    array_push($errors, "Password is empty. Please select input a first name.");
} else {
    $password = $_POST['password'];
    $valid[5] = true;
}

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

$userObj->setFirstname($firstname);
$userObj->setLastname($lastname);
$userObj->setEmail($email);
$userObj->setContact_number($contact_number);
$userObj->setPassword(password_hash($password, PASSWORD_DEFAULT));

$result = $userObj->save();

if ($result) {
    http_response_code(200);
    header('Location: ' . '../../../auth/login');
    exit();
}

?>