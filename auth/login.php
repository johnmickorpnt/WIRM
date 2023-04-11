<?php
$title = "Login";
$content = <<<CONTENT
    <a href="home">
        <img src="../assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Welcome to back to Cafe Lupe!</h1>
    <p>Please enter your email and password to login.</p>
    <div class="form-group">
        <label>
            Email
        </label>
        <input type="password" placeholder="johndoe@gmail.com">
    </div>
    <div class="form-group">
        <label>
            Password
        </label>
        <input type="password" placeholder="Password...">
    </div>
    <div class="d-flex flex-direction-column align-items-center gap-1">
        <button class="btn w-100">Login</button>
        <a href="#">Forgot password?</a>
        <a href="register">Don't have an account? Click here</a>
    </div>
CONTENT;
?>

<!-- Include the template file -->
<?php include '../templates/auth-template.php'; ?>