<?php
include("php/config/Database.php");
include("components/Table.php");
include("components/Modal.php");
include("php/models/User.php");

$title = "Reservation MIS - Users";

$database = new Database();
$db = $database->connect();

$userObj = new User($db);
$users = $userObj->read();

$usersTable = new Table($users);
$usersTable->setColumns(["firstname", "lastname"]);
$usersTable->setForm("room");

global $newModal, $updateModal, $viewModal, $deleteModal;
$newModal = new Modal("new_room_modal");
$newModal->setStyles(["height:80%!important"]);
$newModal->setContent(<<<FORM
		<form method="POST" id="newForm" action="php/functions/user/create.php">
			<div class="form-container">
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="room_number" name="room_number" required>
					<label class="input-label" for="">Room Number</label>
				</div>
				<div class="select-wrapper">
					<select class="modern-select" id="type" name="type" required>
						<option value="2 Single Beds">2 Single Beds</option>
						<option value="1 King Sized Bed">1 King Sized Bed</option>
						<option value="1 Queen Sized Bed">1 Queen Sized Bed</option>
						<option value="Suite Room">Suite Room</option>
						<option value="2 Single Beds">2 Single Beds</option>
					</select>
					<span class="select-arrow"></span>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="occupancy" name="occupancy" required>
					<label class="input-label" for="">Occupancy</label>
				</div>
				<div class="input-wrapper">
					<textarea class="modern-input" id="description" name="description" required></textarea>
					<label class="input-label" for="">Description</label>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="rate_sun_thurs" name="rate_sun_thurs" required>
					<label class="input-label" for="">Rate from Sunday to Thursday</label>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="rate_fri_sat" name="rate_fri_sat" required>
					<label class="input-label" for="">Rate from Friday to Saturday</label>
				</div>
				<div class="select-wrapper">
					<select class="modern-select" id="availability" name="availability" required>
						<option value="" selected disabled>Availability...</option>
						<option value="1">Available</option>
						<option value="0">Unavailable</option>
					</select>
					<span class="select-arrow"></span>
				</div>
				<div class="submit-btn-group">
					<button class="submit-button">Submit</button>
					<button class="cancel-button">Cancel</button>
				</div>
			</div>
		</form>
	FORM);

$updateModal = new Modal("update_reservation_modal");
$updateModal->setContent(<<<FORM
	<form method="POST" id="roomUpdateForm" action="php/functions/room/update.php">
		<input id="room_id" name="room_id" type="hidden">
		<div class="form-container">
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="room_number" name="room_number" required>
				<label class="input-label" for="">Room Number</label>
			</div>
			<div class="select-wrapper">
				<select class="modern-select" id="type" name="type" required>
					<option value="2 Single Beds">2 Single Beds</option>
					<option value="1 King Sized Bed">1 King Sized Bed</option>
					<option value="1 Queen Sized Bed">1 Queen Sized Bed</option>
					<option value="Suite Room">Suite Room</option>
					<option value="2 Single Beds">2 Single Beds</option>
				</select>
				<span class="select-arrow"></span>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="occupancy" name="occupancy" required>
				<label class="input-label" for="">Occupancy</label>
			</div>
			<div class="input-wrapper">
				<textarea class="modern-input" id="description" name="description" required></textarea>
				<label class="input-label" for="">Description</label>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="rate_sun_thurs" name="rate_sun_thurs" required>
				<label class="input-label" for="">Rate from Sunday to Thursday</label>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="rate_fri_sat" name="rate_fri_sat" required>
				<label class="input-label" for="">Rate from Friday to Saturday</label>
			</div>
			<div class="select-wrapper">
				<select class="modern-select" id="availability" name="availability" required>
					<option value="" selected disabled>Availability...</option>
					<option value="1">Available</option>
					<option value="0">Unavailable</option>
				</select>
				<span class="select-arrow"></span>
			</div>
			<div class="submit-btn-group">
				<button class="submit-button">Submit</button>
				<button class="cancel-button">Cancel</button>
			</div>
		</div>
	</form>
	FORM);
$updateModal->setHeader("Update Reservation");

$viewModal = new Modal("view_reservation_modal");
$viewModal->setContent(<<<VIEW
	<form id="roomViewForm">
		<input id="room_id" name="room_id" type="hidden">
		<div class="form-container">
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="room_number" name="room_number" readonly>
				<label class="input-label" for="">Room Number</label>
			</div>
			<div class="select-wrapper">
				<select class="modern-select" id="type" name="type" disabled>
					<option value="2 Single Beds">2 Single Beds</option>
					<option value="1 King Sized Bed">1 King Sized Bed</option>
					<option value="1 Queen Sized Bed">1 Queen Sized Bed</option>
					<option value="Suite Room">Suite Room</option>
					<option value="2 Single Beds">2 Single Beds</option>
				</select>
				<span class="select-arrow"></span>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="occupancy" name="occupancy" readonly>
				<label class="input-label" for="">Occupancy</label>
			</div>
			<div class="input-wrapper">
				<textarea class="modern-input" id="description" name="description" readonly></textarea>
				<label class="input-label" for="">Description</label>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="rate_sun_thurs" name="rate_sun_thurs" readonly>
				<label class="input-label" for="">Rate from Sunday to Thursday</label>
			</div>
			<div class="input-wrapper">
				<input type="number" class="modern-input" id="rate_fri_sat" name="rate_fri_sat" readonly>
				<label class="input-label" for="">Rate from Friday to Saturday</label>
			</div>
			<div class="select-wrapper">
				<select class="modern-select" id="availability" name="availability" disabled>
					<option value="" selected disabled>Availability...</option>
					<option value="1">Available</option>
					<option value="0">Unavailable</option>
				</select>
				<span class="select-arrow"></span>
			</div>
			<div class="submit-btn-group">
				<button class="cancel-button">Close</button>
			</div>
		</div>
	</form>
	VIEW);

$viewModal->setHeader("View Reservation");

$content = <<<CONTENT
	{$newModal->build_modal()}
	{$updateModal->build_modal()}
	{$viewModal->build_modal()}

	<section class="dashboard-section">
		<h4>Manage Your Hotel Rooms</h4>
		<div class="row-actions">
			<div class="search-bar">
				<input type="text" id="search-input" placeholder="Search...">
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</div>
			<button class="action-button add-button" method="add" target-modal="new_room_modal"
				data-function="fetch_user_rooms" target-form="newForm" style="margin-left:auto">
				<i class="fa-solid fa-plus"></i> Add
			</button>
		</div>
		{$usersTable->build_table()}
	</section>
CONTENT;
$scripts = <<<SCRIPT
<script>
	// Target form is the form to be filled up
	// [CAN BE NULL] Target Reservation ID
	// [CAN BE NULL] Data is the variable to compare to

	async function fetch_user_rooms(target_form, target_id) {
		try {
			let room = target_id !== null ? await fetch_room(target_id) : null;
			
			console.log("form#" + target_form + " #bed_type");
			if(target_id === null) return false;
			document.querySelector("form#" + target_form + " #room_id").value = target_id;
			document.querySelector("form#" + target_form + " #room_number").value = room.room_number;
			document.querySelector("form#" + target_form + " #type").value = room.type;
			document.querySelector("form#" + target_form + " #occupancy").value = room.occupancy;
			document.querySelector("form#" + target_form + " #description").value = room.description;
			document.querySelector("form#" + target_form + " #rate_sun_thurs").value = room.rate_sun_thurs;
			document.querySelector("form#" + target_form + " #rate_fri_sat").value = room.rate_fri_sat;
			document.querySelector("form#" + target_form + " #availability").value = room.availability;
		} catch (error) {
			// Handle any errors that occurred during the request
			console.error('Error:', error);
		}
	}
</script>
SCRIPT;
?>
<?php include 'templates/default.php'; ?>
