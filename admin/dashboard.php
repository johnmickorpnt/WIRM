<?php
include("php/config/Database.php");
include("php/models/Reservation.php");
include("components/Table.php");


$title = "Reservation MIS - Dashboard";

$database = new Database();
$db = $database->connect();

$reservationObj = new Reservation($db);
$reservations = $reservationObj->read();

$reservationTable = new Table($reservations);

$content = <<<CONTENT
    <h2>
        Dashboard
    </h2>
	<section class="dashboard-section">
		<h4>Latest Settlements</h4>
		{$reservationTable->build_table()}
	</section>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
