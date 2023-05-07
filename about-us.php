<?php
$title = "About us - Cafe Lupe";
$extraCss = <<<EXTRACSS
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
EXTRACSS;
$extraJs = <<<EXTRAJS
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" 
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
EXTRAJS;
$containerStyles = "padding: 0 10rem 0 10rem; margin-top:10rem; margin-bottom:5rem";
$script = <<<SCRIPT
    <script>
            document.addEventListener("DOMContentLoaded", () => {
                var map = L.map('map').setView([14.61772, 121.14026], 18);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        });
    </script>
SCRIPT;
$content = <<<CONTENT
    <div class="hr-container">
        <hr>
        <h1>CONTACT US</h1>
    </div>
    <section style="text-align:center">
        <div>
            Ready to book with us? Have a question about our rooms or services? We'll be happy to help!
        </div>
        <div style="margin-top:3rem; display:flex; flex-direction: column">
            <h4>
                Cafe Lupe Antipolo - Restaurant, Events, KTV, Hote
            </h4>
            <p style="margin-top:2rem">
                Sumulong Highway, Antipolo, Rizal, Philippines
            </p>
            <span style="margin-top:2rem">
                Call us
            </span>
            <a rel href="+63 927 466 5514">+63 927 466 5514</a>
            <a rel href="470-3201">470-3201</a>
            <span>
                cafelupecarranz@gmail.com
            </span>
            <h5 style="margin-top:3rem">
                Front Desk Hours
            </h5>
            <div class="select-wrapper">
                <select id="select" name="select">
                    <option value="" disabled selected>Select an option</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
            <span style="margin-top:2rem">
                6:00am - 12:00nn
            </span>
            <a href="reservation" class="btn" style="margin-top:2rem">
                Book a reservation now
            </a>
        </div>
        <div id="map" style="height:200px">
        </div>
    </section>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>