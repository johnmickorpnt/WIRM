<?php
session_start();
$title = "Login";
$errors = "";

if (isset($_SESSION["errors"])) {
    $errors .= "<ul>";
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
    <h1>Welcome to back to Cafe Lupe!</h1>
    <p>Please enter your email and password to login.</p>
    {$errors}
    <form action="../php/functions/auth/login.php" METHOD="POST">
        <div class="form-group">
            <label>
                Email
            </label>
            <input type="email" placeholder="johndoe@gmail.com" id="email" name="email">
        </div>
        <div class="form-group">
            <label>
                Password
            </label>
            <input type="password" placeholder="Password..." id="pass" name="pass">
        </div>
        <div class="d-flex flex-direction-column align-items-center gap-1">
            <button class="btn w-100">Login</button>
            <a href="#">Forgot password?</a>
            <a href="register">Don't have an account? Click here</a>
        </div>
    </form>
CONTENT;
?>

<!-- Include the template file -->
<?php include '../templates/auth-template.php'; ?>