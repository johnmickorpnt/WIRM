<?php
$title = "Services - Cafe Lupe";
$containerStyles = "padding: 0 10rem 0 10rem; margin-top:10rem";
$content = <<<CONTENT
    <div class="hr-container">
        <hr>
        <h1>2 Single Beds</h1>
    </div>
    
    <div id="panorama" style="width: 50rem;
    height: 30rem; margin:auto"></div>
    <script>
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "assets/rooms/2-single-bed.jpg"
        });
    </script>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>