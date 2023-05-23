<?php

session_start();
require_once "../../config/Database.php";
require_once "../../models/Reservation.php";
require_once "../../models/Payment.php";

$database = new Database();
$db = $database->connect();

$reservation = new Reservation($db);
$payment = new Payment($db);

$reservationId = $_GET['id'] ?? "";

if (empty($reservationId)) {
    $_SESSION["msg"] = "Reservation ID is required.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Check if the reservation exists
if (!$reservation->is_exists($reservationId)) {
    $_SESSION["msg"] = "Reservation not found.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Retrieve the payment ID associated with the reservation
$paymentId = $payment->getPaymentIdByReservationId($reservationId);

// Cancel the reservation and delete the payment record
if ($reservation->cancelReservation($reservationId)) {
    if (!empty($paymentId)) {
        $payment->setId($paymentId);
    }
    $_SESSION["msg"] = "Reservation canceled successfully.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $_SESSION["msg"] = "Failed to cancel reservation.";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
