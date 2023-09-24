<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$_SESSION["errors"] = array();
$serrios;
if (!isset($_SESSION["id"])) {
    array_push($_SESSION["errors"], "Please make sure you are logged in to make a reservation!");
    header('Location: ' . 'auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://kit.fontawesome.com/fbc9e418a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <?php include("components/links.php"); ?>
</head>

<body>
    <main class="card-container" <?php echo isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?php echo isset($content) ? $content : ""; ?>
    </main>
</body>

</html>