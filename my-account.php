<?php
session_start();
require_once("php/functions.php");

$title = "My Account - Cafe Lupe";

// Include the necessary PHP files
require_once "php/config/Database.php";
require_once "php/models/Reservation.php";
require_once "php/models/Payment.php";

// Create instances of the necessary classes
$database = new Database();
$db = $database->connect();
$reservation = new Reservation($db);
$payment = new Payment($db);
// Get the user's reservations
$customer_id = $_SESSION['id'] ?? null;
$reservations = $reservation->getReservationsByCustomerId($customer_id);

// Prepare the table content
$table = '';
if (count($reservations) > 0) {
    $table .= '<table>
        <tr>
            <th>Reservation ID</th>
            <th>Room ID</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>';

    foreach ($reservations as $reservation) {
        $cancelBtn = $reservation["status"] == "pending"  ? <<<TD
            <button class="cancel-btn" onclick="confirmCancel('{$reservation['id']}')">Cancel</button>
        TD : "None"; 
        $table .= '<tr>
            <td>' . $reservation['id'] . '</td>
            <td>' . $reservation['room_id'] . '</td>
            <td>' . $reservation['status'] . '</td>
            <td>' . $reservation['start_date'] . '</td>
            <td>' . $reservation['end_date'] . '</td>
            <td>' . $cancelBtn . '</td>
        </tr>';
    }

    $table .= '</table>';
} else {
    $table = '<p>No reservations found.</p>';
}
$containerStyles = "padding: 0 5rem 0 5rem; margin-top:5rem";

// Prepare the content
$content = <<<CONTENT
    <h1>My Account - Booked Reservations</h1>
    <div id="cancel-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to cancel this reservation?</p>
            <div class="modal-buttons">
                <button class="modal-btn" onclick="cancelReservation()">Yes</button>
                <button class="modal-btn" onclick="closeModal()">No</button>
            </div>
        </div>
    </div>
    $table
    <script>
        function confirmCancel(reservationId) {
            document.getElementById('cancel-modal').style.display = 'block';
            // Pass the reservation ID to the cancelReservation function
            document.getElementById('cancel-modal').dataset.reservationId = reservationId;
        }

        function closeModal() {
            document.getElementById('cancel-modal').style.display = 'none';
        }

        function cancelReservation() {
            const reservationId = document.getElementById('cancel-modal').dataset.reservationId;
            // Redirect to the cancel.php page with the reservation ID
            window.location.href = 'php/functions/reservation/cancel.php?id=' + reservationId;
        }
    </script>
CONTENT;
?>

<?php
// Include the template file
include 'templates/default.php';
?>
