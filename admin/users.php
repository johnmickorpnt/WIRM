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
$usersTable->setForm("user");

global $newModal, $updateModal, $viewModal, $deleteModal;
$newModal = new Modal("new_user_modal");
$newModal->setStyles(["height:80%!important"]);
$newModal->setContent(<<<FORM
		<form method="POST" id="newForm" action="php/functions/user/create.php">
			<div class="form-container">
				<div class="input-wrapper">
					<input type="text" class="modern-input" id="firstname" name="firstname" required>
					<label class="input-label" for="">First Name</label>
				</div>
				<div class="input-wrapper">
					<input type="text" class="modern-input" id="lastname" name="lastname" required>
					<label class="input-label" for="">Last Name</label>
				</div>
				<div class="input-wrapper">
					<input class="modern-input" id="contact_number" name="contact_number" required>
					<label class="input-label" for="">Contact Number</label>
				</div>
				<div class="input-wrapper">
					<input type="email" class="modern-input" id="email" name="email" required>
					<label class="input-label" for="">Email Address</label>
				</div>
				<div class="input-wrapper">
					<input type="password" class="modern-input" id="password" name="password" required>
					<label class="input-label" for="">Password</label>
				</div>
				<div class="submit-btn-group">
					<button class="submit-button">Submit</button>
					<button class="cancel-button">Cancel</button>
				</div>
			</div>
		</form>
	FORM);

$updateModal = new Modal("update_user_modal");
$updateModal->setContent(<<<FORM
<form method="POST" id="newForm" action="php/functions/user/create.php">
    <div class="form-container">
        <div class="input-wrapper">
            <input type="text" class="modern-input" id="firstname" name="firstname" required>
            <label class="input-label" for="">First Name</label>
        </div>
        <div class="input-wrapper">
            <input type="text" class="modern-input" id="lastname" name="lastname" required>
            <label class="input-label" for="">Last Name</label>
        </div>
        <div class="input-wrapper">
            <input class="modern-input" id="contact_number" name="contact_number" required>
            <label class="input-label" for="">Contact Number</label>
        </div>
        <div class="input-wrapper">
            <input type="email" class="modern-input" id="email" name="email" required>
            <label class="input-label" for="">Email Address</label>
        </div>
        <div class="input-wrapper">
            <input type="password" class="modern-input" id="password" name="password" required>
            <label class="input-label" for="">Password</label>
        </div>
        <div class="submit-btn-group">
            <button class="submit-button">Submit</button>
            <button class="cancel-button">Cancel</button>
        </div>
    </div>
</form>
FORM);
$updateModal->setHeader("Update User");

$viewModal = new Modal("view_reservation_modal");
$viewModal->setContent(<<<VIEW
	<form id="userViewForm">
		<input id="user_id" name="user_id" type="hidden">
		<div class="form-container">
            <div class="input-wrapper">
                <input type="text" class="modern-input" id="firstname" name="firstname" readonly>
                <label class="input-label" for="">First Name</label>
            </div>
            <div class="input-wrapper">
                <input type="text" class="modern-input" id="lastname" name="lastname" readonly>
                <label class="input-label" for="">Last Name</label>
            </div>
            <div class="input-wrapper">
                <input class="modern-input" id="contact_number" name="contact_number" readonly>
                <label class="input-label" for="">Contact Number</label>
            </div>
            <div class="input-wrapper">
                <input type="email" class="modern-input" id="email" name="email" readonly>
                <label class="input-label" for="">Email Address</label>
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
		<h4>Manage Your Current Users</h4>
		<div class="row-actions">
			<div class="search-bar">
				<input type="text" id="search-input" placeholder="Search...">
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</div>
			<button class="action-button add-button" method="add" target-modal="new_user_modal"
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
			let user = target_id !== null ? await fetch_user(target_id) : null;
			
			console.log("form#" + target_form + " #user_id");
			if(target_id === null) return false;
			document.querySelector("form#" + target_form + " #user_id").value = target_id;
			document.querySelector("form#" + target_form + " #firstname").value = user.firstname;
			document.querySelector("form#" + target_form + " #lastname").value = user.lastname;
			document.querySelector("form#" + target_form + " #contact_number").value = user.contact_number;
			document.querySelector("form#" + target_form + " #email").value = user.email;

		} catch (error) {
			// Handle any errors that occurred during the request
			console.error('Error:', error);
		}
	}
</script>
SCRIPT;
?>
<?php include 'templates/default.php'; ?>
