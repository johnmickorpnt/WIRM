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
$content = <<<CONTENT
    <a href="home">
        <img src="assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Offline Payment</h1>
    <p>Please enter the payment details below for offline payment.</p>
    {$errors}
    <form action="php/functions/payments/process_offline_payment.php" method="POST">
        <div class="form-group">
            <label>
                Payment Method
            </label>
            <select id="payment_method" name="payment_method" required>
                <option value="">Select Payment Method</option>
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>
        <div class="form-group">
            <label>
                Amount
            </label>
            <input type="text" placeholder="Enter payment amount" id="amount" name="amount" required>
        </div>
        <div id="cheque_fields" style="display: none;">
            <div class="form-group">
                <label>
                    Cheque Number
                </label>
                <input type="text" placeholder="Enter cheque number" id="cheque_number" name="cheque_number">
            </div>
            <div class="form-group">
                <label>
                    Bank Name
                </label>
                <input type="text" placeholder="Enter bank name" id="bank_name" name="bank_name">
            </div>
            <div class="form-group">
                <label>
                    Branch
                </label>
                <input type="text" placeholder="Enter branch" id="branch" name="branch">
            </div>
            <div class="form-group">
                <label>
                    Date Issued
                </label>
                <input type="date" id="date_issued" name="date_issued">
            </div>
        </div>
        <div id="bank_transfer_fields" style="display: none;">
            <div class="form-group">
                <label>
                    Bank Name
                </label>
                <input type="text" placeholder="Enter bank name" id="bank_name" name="bank_name">
            </div>
            <div class="form-group">
                <label>
                    Bank Location
                </label>
                <input type="text" placeholder="Enter bank location" id="bank_location" name="bank_location">
            </div>
            <div class="form-group">
                <label>
                    Proof of Payment
                </label>
                <input type="file" id="proof_of_payment" name="proof_of_payment">
            </div>
        </div>
        <div class="d-flex flex-direction-column align-items-center gap-1">
            <button class="btn w-100">Submit</button>
            <a href="home">Cancel</a>
        </div>
    </form>

    <script>
        var paymentMethodSelect = document.getElementById("payment_method");
        var chequeFields = document.getElementById("cheque_fields");
        var bankTransferFields = document.getElementById("bank_transfer_fields");

        paymentMethodSelect.addEventListener("change", function() {
            var selectedOption = this.value;
            
            // Reset fields
            chequeFields.style.display = "none";
            bankTransferFields.style.display = "none";

            if (selectedOption === "cheque") {
                chequeFields.style.display = "block";
            } else if (selectedOption === "bank_transfer") {
                bankTransferFields.style.display = "block";
            }
        });
    </script>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/new-template.php'; ?>
