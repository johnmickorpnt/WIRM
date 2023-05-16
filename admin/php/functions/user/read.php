<?php
include("../../models/User.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$userObj = new User($db);

$users = isset($_POST["user_id"]) ?
    $userObj->get($_POST["user_id"], true) :
    $userObj->read();

echo json_encode($users, JSON_PRETTY_PRINT);

?>