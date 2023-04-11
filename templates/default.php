<?php
require_once("php/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <?php include("components/links.php"); ?>
</head>

<body>
    <?php include("components/navbar.php"); ?>
    <main class="container <?php echo isset($containerClass) ? $containerClass : ""; ?>" 
        <?php echo isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?php echo $content; ?>
    </main>
</body>

</html>