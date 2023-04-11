<?php
$title = "Register";
$content = <<<CONTENT
    <a href="home">
        <img src="../assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Welcome to to Cafe Lupe!</h1>
    <p>Please enter the necessary information to register.</p>
    <div class="d-flex">
        <div class="form-group">
            <label>
                First Name
            </label>
            <input type="text" placeholder="First name...">
        </div>
        <div class="form-group">
            <label>
                Last Name
            </label>
            <input type="text" placeholder="Last name...">
        </div>
    </div>
    <div class="form-group">
        <label>
            Email
        </label>
        <input type="text" placeholder="johndoe@gmail.com">
    </div>
    <div class="form-group">
        <label>
            Password
        </label>
        <input type="password" placeholder="Password...">
    </div>
    <div class="form-group">
        <label>
            Confirm Password
        </label>
        <input type="password" placeholder="">
    </div>
    <div class="d-flex flex-direction-column align-items-center gap-1">
        <button class="btn w-100">Register</button>
        <a href="login">Already have an account? Click here</a>
    </div>
CONTENT;
?>

<!-- Include the template file -->
<?php include '../templates/auth-template.php'; ?>