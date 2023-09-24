<?php
$title = "Promos - Cafe Lupe";
$containerStyles = "padding: 0 10rem 0 10rem; margin-top:7rem";
$content = <<<CONTENT
<div class="hr-container">
    <hr>
    <h1>TERMS & CONDITIONS</h1>
</div>
<section style="padding-left:6rem; padding-right: 6rem; text-align:justify">
    Your Terms and Conditions section is like a contract between you and your customers. You make information and services available to your customers, and your customers must follow your rules.
    Common items in a terms and conditions agreement allow you to:
    <ul class="terms-list" style="list-style:none">
        <li style="margin-bottom:1rem">
            <h3>Booking a Hotel Room</h3>
            A customer's visits a hotel's website or uses a hotel booking app to make a reservation for a room.
            They select their check-in and check-out dates, room type, and any additional services or preferences.
        </li>
        <li style="margin-bottom:1rem">
            <h3Reviewing Terms and Conditions:</h3>
            Before finalizing the reservation, the user is presented with the hotel's terms and conditions. These may include policies related to cancellation, payment, check-in/check-out times, pet policies, and more.
        </li>
        <li style="margin-bottom:1rem">
            <h3>User Acceptance</h3>
            To proceed with the reservation, the user is typically required to explicitly accept the terms and conditions.
            This can be done by clicking an "I Agree" button, checking a box that says "I have read and agree to the terms and conditions," or taking a similar action.
            By accepting, the user acknowledges that they have read and understood the hotel's policies and agree to abide by them.
        </li>
        <li style="margin-bottom:1rem">
            <h3>Confirmation</h3>
            After user acceptance, the hotel reservation system generates a confirmation that includes details of the reservation, such as the booking dates, room type, total cost, and any special requests.
        </li>
        <li style="margin-bottom:1rem">
            <h3>Payment</h3>
            Depending on the hotel's policies, the user may need to provide payment information to secure the reservation. Payment terms and conditions are often included in the initial terms and conditions.
        </li>
        <li style="margin-bottom:1rem">
            <h3>Stay at the Hotel</h3>
            When the user arrives at the hotel, they are expected to follow the terms and conditions during their stay. This may include adhering to check-in/check-out times, paying any additional fees, and complying with the hotel's rules and regulations.
        </li>
        <li style="margin-bottom:1rem">
            <h3>Check-Out</h3>
            Upon check-out, the hotel may review the stay to ensure that the user has followed the agreed-upon terms and conditions, and any incidental charges may be settled at this time.
        </li>
    </ul>
</section>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>