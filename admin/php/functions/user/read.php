<?php
include("../../models/User.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$userObj = new User($db);
$users = $userObj->read();

echo json_encode($users, JSON_PRETTY_PRINT);
?>