<?php
session_start();
$title = "Register";
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
        <img src="../assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Welcome to to Cafe Lupe!</h1>
    <p>Please enter the necessary information to register.</p>
    {$errors}
    <form action="../php/functions/auth/register.php" method="POST">
        <div class="d-flex">
            <div class="form-group">
                <label>
                    First Name
                </label>
                <input type="text" placeholder="First name..." id="fname" name="fname" required>
            </div>
            <div class="form-group">
                <label>
                    Last Name
                </label>
                <input type="text" placeholder="Last name..." id="lname" name="lname" required>
            </div>
        </div>
        <div class="form-group">
            <label>
                Email
            </label>
            <input type="text" placeholder="johndoe@gmail.com" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label>
                Contact Number
            </label>
            <input type="text" placeholder="Enter your Mobile number" id="contact_number" name="contact_number" required>
        </div>
        <div class="form-group">
            <label>
                Password
            </label>
            <input type="password" placeholder="Password..." id="pass" name="pass" required>
        </div>
        <div class="form-group">
            <label>
                Confirm Password
            </label>
            <input type="password" placeholder="" id="conpass" name="conpass" required>
        </div>
        <div class="d-flex flex-direction-column align-items-center gap-1">
            <button class="btn w-100">Register</button>
            <a href="login">Already have an account? Click here</a>
        </div>
    </form>
CONTENT;
?>

<!-- Include the template file -->
<?php include '../templates/auth-template.php'; ?>