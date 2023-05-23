<?php
include("../config/Database.php");
include("../models/User.php");
include("../models/Room.php");
include("../models/Reservation.php");




$database = new Database();
$db = $database->connect();

if(!isset($_POST["id"])){
    echo "no id";
    exit;
}

if(!isset($_POST["table"])){
    echo "no tbl";
    exit;
}

$tbl = $_POST["table"];
$id = $_POST["id"];
$obj;

if($tbl == "reservations") $obj = new Reservation($db);
else if($tbl == "rooms") $obj = new Room($db);
else if($tbl == "users") $obj = new User($db);


if(!$obj->is_exists($id)) exit;

$obj->delete($id);
echo json_encode(["msg"=>"Row deleted"]);
