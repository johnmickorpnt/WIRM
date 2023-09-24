<?php

session_start();
require_once "../../config/Database.php";
require_once "../../models/Reservation.php";
require_once "../../models/Room.php";
require_once "../../models/User.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';


$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$reservation = new Reservation($db);
$roomObj = new Room($db);
$userObj = new User($db);

$_SESSION["msg"] = array();

$room_id = $_POST['room_id'] ?? "";
$customer_id = $_POST['customer_id'] ?? "";
$start_date = $_POST['start_date'] ?? "";
$end_date = $_POST['end_date'] ?? "";
$total = $_POST["total"];
$getRoom = $roomObj->read($room_id)->fetch(PDO::FETCH_ASSOC);


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

$room_type = $getRoom["type"];
$room_number = $getRoom["room_number"];
$email = $_SESSION["email"];
$user = $userObj->read($customer_id)->fetch(PDO::FETCH_ASSOC);
$fname = $user['firstname'];
$lname = $user['lastname'];
$name = "$fname $lname";
$new_total = number_format($total, 2, ".", ",");
$id = $reservation->getId();
if ($result) {
    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication


    $mail->Username = 'cafe.lupe.online@gmail.com';
    $mail->Password = 'bdpvfqjhdopqttke';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('cafe.lupe.online@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Hubz Bistro Booking Reservation";


    $mail->Body = <<<MSG
    <div>
        <h1>
            Hi $fname, 
        </h1>
        <p style="font-size:18px">
            We are pleased to received your booking reservation request. Please see the details below:
        </p>
        <table style="width: 50%; border-collapse: collapse; margin:auto">
            <tbody>
                <tr style="padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                text-transform: capitalize;">
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        Bed Type
                    </td>
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        $room_type
                    </td>
                </tr>
                <tr style="padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                text-transform: capitalize;">
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        Room Number
                    </td>
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        $room_number
                    </td>
                </tr>
                <tr style="padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                text-transform: capitalize;">
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        Start Date
                    </td>
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        $start_date
                    </td>
                </tr>
                <tr style="padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                text-transform: capitalize;">
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        End Date
                    </td>
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        $end_date
                    </td>
                </tr>
                <tr style="padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
                text-transform: capitalize;">
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        Total
                    </td>
                    <td style="padding: 10px;text-align: left;border-bottom: 1px solid #ddd;text-transform: capitalize;">
                        ₱$new_total
                    </td>
                </tr>
            </tbody>
        </table>
        <h1>
            What's next?
        </h1>
        <p style="font-size:18px">
            Kindly settle the payment for this booking reservation to confirm your reservation. Go to <b>My account</b>, and find the this reservation and click pay or click the button below.
        </p>
        <a target="_blank" href="http://localhost/wirm_prod/payments.php?id=$id"
            style="box-shadow:inset 0px 1px 0px 0px #54a3f7;
            background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
            background-color:#007dc1;
            border-radius:3px;
            border:1px solid #124d77;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:13px;
            padding:6px 24px;
            text-decoration:none;
            text-shadow:0px 1px 0px #154682;">
            Proceed to Payment
        </a>
    </div>
    MSG;
    try {
        $mail->send();
        echo json_encode(["response" => "Registration Successful.", ["status" => true]]);
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    http_response_code(200);
    if ($result) {
        http_response_code(200);
        header('Location: ' . '../../../success');
        exit();
    }
}
