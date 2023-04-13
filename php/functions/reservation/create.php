<?php

session_start();
require_once "../../config/Database.php";
require_once "../../models/Reservation.php";

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$reservation = new Reservation($db);

$_SESSION["msg"] = array();

$room_id = $_POST['room_id'] ?? "";
$customer_id = $_POST['customer_id'] ?? "";
$start_date = $_POST['start_date'] ?? "";
$end_date = $_POST['end_date'] ?? "";
$total = $_POST["total"];

if (empty($room_id)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Your Room ID is Required.");
} else $valid[0] = true;

if (empty($customer_id)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Customer ID is Required.");
} else $valid[1] = true;

if (empty($start_date)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Start Date is Required.");
} else $valid[2] = true;

if (empty($end_date)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "End Date is required.");
} else $valid[3] = true;


if (in_array(false, $valid)) {
    http_response_code(422);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$reservation->setRoom_id($room_id);
$reservation->setCustomer_id($customer_id);
$reservation->setStart_date($start_date);
$reservation->setEnd_date($end_date);
$reservation->setTotal_price($total);
$result = $reservation->save();

if ($result) {
    http_response_code(200);
    header('Location: ' . '../../../index');
    exit();
}


?>