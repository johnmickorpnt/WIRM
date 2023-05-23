<?php
include("php/config/Database.php");
include("php/models/Reservation.php");
include("components/Table.php");
include("components/Modal.php");
include("components/Form.php");

$title = "Reservation MIS - Reservations";

$database = new Database();
$db = $database->connect();

$reservationObj = new Reservation($db);
$reservations = $reservationObj->read();

$reservationTable = new Table($reservations);
$reservationTable->setForm("reservation");
$reservationTable->setTblTitle("reservations");
$reservationTable->setHasActions(true);

$reservationObj = new Reservation($db);

init_modals();


$content = <<<CONTENT
	{$newModal->build_modal()}
	{$updateModal->build_modal()}
	{$viewModal->build_modal()}
	{$deleteModal->build_modal()}

	<section class="dashboard-section">
		<h4>Reservations</h4>
		<div class="row-actions">
			<div class="search-bar">
				<input type="text" id="search-input" placeholder="Search...">
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</div>
			<button class="action-button add-button" method="add" target-modal="new_reservation_modal"
				data-function="fetch_user_rooms" target-form="newForm" style="margin-left:auto">
				<i class="fa-solid fa-plus"></i> Add
			</button>
		</div>
		{$reservationTable->build_table()}
	</section>

CONTENT;
$scripts = <<<SCRIPTS
<script>
	// Target form is the form to be filled up
	// [CAN BE NULL] Target Reservation ID
	// [CAN BE NULL] Data is the variable to compare to

	async function fetch_user_rooms(target_form, target_id) {
		var users, rooms, reservation;

		try {
			users = await fetch_users();
			rooms = await fetch_rooms();
			reservation = target_id !== null ? await fetch_reservation(target_id) : null;
			
			// reservation.customer_id;
			let userSelect = document.querySelector("form#" + target_form + " #customer_id");
			let roomSelect = document.querySelector("form#" + target_form + " #room_id");
			console.log("form#" + target_form + " #room_id");
			userSelect.innerHTML = "";
			roomSelect.innerHTML = "";

			users.forEach(user => {
				const option = document.createElement('option');
				option.selected = target_id && reservation.customer_id == user.id ? true : false;

				option.value = user.id;
				option.textContent = user.id + " - " + user.firstname + " " + user.lastname;
				userSelect.appendChild(option);
			});

			rooms.forEach(room => {
				const option = document.createElement('option');
				option.value = room.id;
				option.selected = target_id && reservation.room_id == room.id ? true : false;
				option.textContent = "Room Number: " + room.room_number + " - " + room.type;
				roomSelect.appendChild(option);
			});

			console.log(reservation);
			if(target_id === null) return false;
			document.querySelector("form#" + target_form + " #reservation_id").value = target_id;
			document.querySelector("form#" + target_form + " #start_date").value = reservation.start_date;
			document.querySelector("form#" + target_form + " #end_date").value = reservation.end_date;
			document.querySelector("form#" + target_form + " #num_of_guests").value = reservation.num_of_guests;
			document.querySelector("form#" + target_form + " #total_price").value = reservation.total_price;
			document.querySelector("form#" + target_form + " #status").value = reservation.status;


		} catch (error) {
			// Handle any errors that occurred during the request
			console.error('Error:', error);
		}
	}
</script>

SCRIPTS;
function init_modals()
{
	global $newModal, $updateModal, $viewModal, $deleteModal;
	$newModal = new Modal("new_reservation_modal");
	$newModal->setContent(<<<FORM
		<form method="POST" id="newForm" action="php/functions/reservation/create.php">
			<div class="form-container">
				<div class="form-two-col">
					<div class="select-wrapper">
						<select class="modern-select" id="customer_id" name="customer_id" required>
							<option value="" selected disabled>Customer ID...</option>
						</select>
						<span class="select-arrow"></span>
					</div>
					<div class="select-wrapper">
						<select class="modern-select" id="room_id" name="room_id" required>
							<option value="" selected disabled>Pick Room...</option>
						</select>
						<span class="select-arrow"></span>
					</div>
				</div>
				<div class="form-two-col">
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="start_date" name="start_date" required>
						<label class="input-label" for="">Start Date</label>
					</div>
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="end_date" name="end_date" required>
						<label class="input-label" for="">End Date</label>
					</div>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="num_of_guests" name="num_of_guests" required>
					<label class="input-label" for="">Number of Guests</label>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="total_price" name="total_price" required>
					<label class="input-label" for="">Total Price</label>
				</div>
				<div class="select-wrapper">
					<select class="modern-select" id="status" name="status" required>
						<option value="" selected disabled>Status...</option>
						<option value="pending">Pending</option>
						<option value="confirmed">Confirmed</option>
						<option value="checked_in">Checked-in</option>
						<option value="checked_out">Checked-out</option>
						<option value="no_show">No Show</option>
						<option value="cancelled">Cancelled</option>
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

	$newModal->setClass(["test", "test2"]);
	$newModal->setHeader("Add New Reservation");
	$updateModal = new Modal("update_reservation_modal");
	$updateModal->setContent(<<<FORM
	<form method="POST" id="reservationUpdateForm" action="php/functions/reservation/update.php">
			<input id="reservation_id" name="reservation_id" type="hidden" value="">
			<div class="form-container">
				<div class="form-two-col">
					<div class="select-wrapper">
						<select class="modern-select" id="customer_id" name="customer_id" required>
						</select>
						<span class="select-arrow"></span>
					</div>
					<div class="select-wrapper">
						<select class="modern-select" id="room_id" name="room_id" required>
						</select>
						<span class="select-arrow"></span>
					</div>
				</div>
				<div class="form-two-col">
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="start_date" name="start_date">
						<label class="input-label" for="">Start Date</label>
					</div>
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="end_date" name="end_date">
						<label class="input-label" for="">End Date</label>
					</div>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="num_of_guests" name="num_of_guests" required>
					<label class="input-label" for="">Number of Guests</label>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="total_price" name="total_price" required>
					<label class="input-label" for="">Total Price</label>
				</div>
				<div class="select-wrapper">
					<select class="modern-select" id="status" name="status" required>
						<option value="" selected disabled>Status...</option>
						<option value="pending">Pending</option>
						<option value="confirmed">Confirmed</option>
						<option value="checked_in">Checked-in</option>
						<option value="checked_out">Checked-out</option>
						<option value="no_show">No Show</option>
						<option value="cancelled">Cancelled</option>
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
	<form id="reservationViewForm">
			<input id="reservation_id" name="reservation_id" type="hidden" value="">
			<div class="form-container">
				<div class="form-two-col">
					<div class="select-wrapper">
						<select class="modern-select" id="customer_id" disabled>
						</select>
						<span class="select-arrow"></span>
					</div>
					<div class="select-wrapper">
						<select class="modern-select" id="room_id" disabled>							
						</select>
						<span class="select-arrow"></span>
					</div>
				</div>
				<div class="form-two-col">
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="start_date" name="start_date" readonly>
						<label class="input-label" for=""></label>
					</div>
					<div class="input-wrapper">
						<input type="text" class="modern-input datetime" id="end_date" name="end_date" readonly>
						<label class="input-label" for=""></label>
					</div>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="num_of_guests" name="num_of_guests" readonly>
					<label class="input-label" for=""></label>
				</div>
				<div class="input-wrapper">
					<input type="number" class="modern-input" id="total_price" name="total_price" readonly>
					<label class="input-label" for=""></label>
				</div>
				<div class="select-wrapper">
					<select class="modern-select" id="status" name="status" disabled>
						<option value="" selected disabled>Status...</option>
						<option value="pending">Pending</option>
						<option value="confirmed">Confirmed</option>
						<option value="checked_in">Checked-in</option>
						<option value="checked_out">Checked-out</option>
						<option value="no_show">No Show</option>
						<option value="cancelled">Cancelled</option>
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

	$deleteModal = new Modal("delete_confirmation_modal");
	$deleteModal->setStyles(["height:30%!important", "width:30%!important"]);
	$deleteModal->setContentCss([
		"padding:1rem",
	]);
	$deleteModal->setContent(<<<CONTENT
		<h2 style="width:100%">
			Are you sure to delete this reservation?
		</h2>
		<div class="confirmation-btn-group">
			<button class="confirm-btn confirm">
				Delete
			</button>
			<button class="confirm-btn cancel">
				Cancel
			</button>
		</div>
	CONTENT);
	// $deleteModal->setHeader("Delete Reservation");
}


?>
<?php include 'templates/default.php'; ?>
