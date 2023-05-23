<?php
session_start();
require_once "../../config/Database.php";
require_once "../../models/Reservation.php";
require_once "../../models/Payment.php";

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$payment = new Payment($db);
$reservation = new Reservation($db);

$_SESSION["msg"] = array();

$reservation_id = $_POST['reservation_id'] ?? "";
$amount = $_POST['amount'] ?? "";
$bank_name = $_POST['bank_name'] ?? "";
$bank_location = $_POST['bank_location'] ?? "";
$proof_of_payment = $_FILES['proof_of_payment'] ?? "";

// Validate required fields
if (empty($reservation_id)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Reservation ID is required.");
} else {
    $valid[0] = true;
}

if (empty($amount)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Amount is required.");
} else {
    $valid[1] = true;
}

if (empty($bank_name)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Bank Name is required.");
} else {
    $valid[2] = true;
}

if (empty($bank_location)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Bank Location is required.");
} else {
    $valid[3] = true;
}

// Validate file upload
if (empty($proof_of_payment) || !is_uploaded_file($proof_of_payment['tmp_name'])) {
    $valid[4] = false;
    array_push($_SESSION["errors"], "Proof of Payment is required.");
} else {
    $valid[4] = true;
}

// Check if any validation errors occurred
if (in_array(false, $valid)) {
    http_response_code(422);
    redirectBackWithError();
}

// Move the uploaded file to a desired directory
$targetDir = "../../../assets/uploads/";
$proof_of_payment_name = basename($proof_of_payment["name"]);
$imageFileType = strtolower(pathinfo($proof_of_payment_name, PATHINFO_EXTENSION));

// Generate a unique filename for the uploaded file
$uniqueFilename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $imageFileType;
$targetFile = $targetDir . $uniqueFilename;

// Check if the file is an image
$check = getimagesize($proof_of_payment["tmp_name"]);
if ($check === false) {
    array_push($_SESSION["errors"], "Invalid image file.");
    http_response_code(422);
    redirectBackWithError();
}

// Check file size
if ($proof_of_payment["size"] > 500000) {
    array_push($_SESSION["errors"], "Sorry, your file is too large.");
    http_response_code(422);
    redirectBackWithError();
}

// Allow only specific file formats
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
    array_push($_SESSION["errors"], "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");
    http_response_code(422);
    redirectBackWithError();
}

// Move the file to the desired directory with the unique filename
if (move_uploaded_file($proof_of_payment["tmp_name"], $targetFile)) {
    $proof_of_payment_path = $targetFile;

    // Check if reservation exists and update status to paid
    $reservationExists = $reservation->is_exists($reservation_id);
    if (!$reservationExists) {
        array_push($_SESSION["errors"], "Reservation does not exist.");
        http_response_code(404);
        redirectBackWithError();
    }

    // Set payment attributes
    $payment->setReservationId($reservation_id);
    $payment->setAmount($amount);
    $payment->setBankName($bank_name);
    $payment->setBankLocation($bank_location);
    $payment->setProofOfPayment($proof_of_payment_path);

    // Save the payment
    if ($payment->save()) {
        // Update reservation status to paid
        $reservation->setId($reservation_id);
        $reservation->setStatus('confirmed');
        $reservation->updateStatus();

        array_push($_SESSION["msg"], "Payment has been created successfully.");
        http_response_code(201);
        redirectBackWithSuccess();
    } else {
        array_push($_SESSION["errors"], "Unable to create payment. Please try again.");
        http_response_code(500);
        redirectBackWithError();
    }
} else {
    array_push($_SESSION["errors"], "Sorry, there was an error uploading your file.");
    http_response_code(500);
    redirectBackWithError();
}

// Function to redirect back with success message
function redirectBackWithSuccess()
{
    echo '
    <script>
        window.onload = function() {
            alert("Payment has been created successfully.");
            window.location.href = document.referrer;
        };
    </script>
    ';
}

// Function to redirect back with error message
function redirectBackWithError()
{
    echo '
    <script>
        window.onload = function() {
            alert("There was an error. Please try again.");
            window.location.href = document.referrer;
        };
    </script>
    ';
}
