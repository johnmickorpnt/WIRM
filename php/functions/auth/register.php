<?php
session_start();
require_once "../../config/Database.php";
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
$user = new User($db);

$_SESSION["msg"] = array();

$fname = $_POST['fname'] ?? "";
$lname = $_POST['lname'] ?? "";
$pass = $_POST['pass'] ?? "";
$conpass = $_POST['conpass'] ?? "";
$email = $_POST['email'] ?? "";
$contact_number = $_POST['contact_number'] ?? "";

if (empty($fname)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Your First name is Required.");
} else $valid[0] = true;

if (empty($lname)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Your Last name is Required.");
} else $valid[1] = true;

if (empty($email)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Your Email is Required.");
} else $valid[2] = true;

if (empty($pass)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Password is required.");
} else $valid[3] = true;

if (empty($conpass)) {
    array_push($_SESSION["errors"], "Password Confirmation is required.");
    $valid[4] = false;
} else $valid[4] = true;

if ($pass != $conpass) {
    $valid[5] = false;
    array_push($_SESSION["errors"], "Your password and Password Confirmation does not match.");
} else $valid[5] = true;


if (empty($contact_number)) {
    $valid[6] = false;
    array_push($_SESSION["errors"], "Contact number is missing.");
} else $valid[6] = true;

if ($user->is_email_unique($email)) {
    $valid[7] = false;
    array_push($_SESSION["errors"], "Email already exist.");
} else $valid[7] = true;

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
    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication


    $mail->Username = 'jacobmartindummy@gmail.com';
    $mail->Password = 'topldwzedgeifuge';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('jacobmartindummy@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Hubz Bistro Account Creation";


    $mail->Body = <<<MSG
				<h1>Hello and Welcome to Cafe.</h1>
				<h3>
					You are now able to book a reservation to Cafe Lupe!
				</h3>
			MSG;
    try {
        $mail->send();
        echo json_encode(["response" => "Registration Successful.", ["status" => true]]);
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    http_response_code(200);
    header('Location: ' . '../../../auth/login');
    exit();
}
