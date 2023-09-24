<?php
if (session_status() === PHP_SESSION_NONE) session_start();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <?php echo isset($extraCss) ? $extraCss : "" ?>
    <?php echo isset($extraJs) ? $extraJs : "" ?>

</head>

<body>
    <?php include("components/navbar.php"); ?>
    <main class="container <?php echo isset($containerClass) ? $containerClass : ""; ?>" <?php echo isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?php echo $content; ?>
    </main>
    <?php include("components/footer.php"); ?>
</body>
<?php
echo isset($script) ? $script : "";
?>

</html>