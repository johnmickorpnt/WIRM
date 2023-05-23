<?php
session_start();
$title = "Offline Payment";
$errors = "";

if (isset($_SESSION["errors"])) {
    $errors .= "<ul style='padding:1rem'>";
    foreach ($_SESSION["errors"] as $error) {
        $errors .= "<li class='error'>{$error}</li>";
    }
    $errors .= "</ul>";
    unset($_SESSION["errors"]);
}

$reservationId = $_GET["id"];
$content = <<<CONTENT
    <a href="home">
        <img src="assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Offline Payment</h1>
    <p>Please enter the payment details below for offline payment.</p>
    {$errors}
    <form action="php/functions/payment/create.php" method="POST" enctype="multipart/form-data">
        <input name="reservation_id" type="hidden" value={$reservationId}>
        <div id="bank_transfer_fields">
            <div class="form-group">
                <label>
                    Amount
                </label>
                <input type="number" placeholder="Enter payment amount" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label>
                    Bank Name
                </label>
                <input type="text" placeholder="Enter bank name" id="bank_name" name="bank_name" required>
            </div>
            <div class="form-group">
                <label>
                    Bank Location
                </label>
                <input type="text" placeholder="Enter bank location" id="bank_location" name="bank_location" required>
            </div>
            <div class="form-group">
                <label>
                    Proof of Payment
                </label>
                <input type="file" id="proof_of_payment" name="proof_of_payment" required>
            </div>
        </div>
        <div class="d-flex flex-direction-column align-items-center gap-1">
            <button class="btn w-100">Submit</button>
            <a href="home" onclick="return confirm('Are you sure you want to cancel?')">Cancel</a>
        </div>
    </form>

    <script>
        var bankTransferFields = document.getElementById("bank_transfer_fields");

        bankTransferFields.style.display = "block";
    </script>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/new-template.php'; ?>