<?php
session_start();
$title = "Reservation - Cafe Lupe";
$content = <<<CONTENT
    <a href="home">
        <img src="assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Welcome to to Cafe Lupe!</h1>
    <p>We are excited to serve you! Please enter the necessary information to add your booking.</p>
    <form action="">
        <div class="form-group select-wrapper">
            <label>Select Bed Type</label>
            <select name="bed_type" id="bed_type" style="width:100%" required>
                <option value="2 Single Beds">2 Single Beds</option>
                <option value="1 King Sized Bed">1 King Sized Bed</option>
                <option value="1 Queen Sized Bedion2">1 Queen Sized Bed</option>
                <option value="Suite Room">Suite Room</option>
            </select>
        </div>
        
        <div class="form-group select-wrapper">
            <label>Available Rooms for Room Type</label>
            <select name="rooms" id="rooms" style="width:100%" required>
                
            </select>
        </div>
        <div class="form-group select-wrapper">
            <label>Duration of stay in days</label>
            <input type="number" placeholder="Number of days to be stayed:" value=1 style="width:100%" id="days" name="days" required>
        </div>
        <div class="form-group">
            <label>
                Remarks
            </label>
            <textarea type="text" placeholder="Your remarks and notes..." style="width:100%" required></textarea>
        </div>
        <input type="hidden" value="{$_SESSION["id"]}">
        <div class="form-group select-wrapper">
            <label>Total</label>
            <input type="number" placeholder="Number of days to be stayed:" style="width:100%" id="total" name="total" disabled>
        </div>
    </form>
CONTENT;
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let bedType = document.getElementById("bed_type");
        let rooms = document.getElementById("rooms")
        let days = document.getElementById("days");
        let total = document.getElementById("total")
        mainFetch()
        bedType.addEventListener("change", (e) => mainFetch(event.target.value))

        function setOptions(data) {
            rooms.innerHTML = "";
            data.forEach(function(item) {
                const option = document.createElement('option');
                option.value = item.room_number;
                option.text = `Room #${item.room_number}`;
                rooms.appendChild(option);
            });
            compute(data);
        }

        function mainFetch(param) {
            const selectedIndex = bedType.selectedIndex;
            const selectedOption = bedType.options[selectedIndex];

            const data = {
                type: typeof param !== 'undefined' ? param : selectedOption.innerHTML
            };
            const queryString = new URLSearchParams(data).toString();
            fetch(`php/functions/api/rooms.php?${queryString}`)
                .then(response => response.json())
                .then(data => setOptions(data))
                .catch(error => console.error(error));
        }

        function compute(data) {
            let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let today = new Date();
            let dayOfWeek = daysOfWeek[today.getDay()];

            console.log(dayOfWeek);
            total.value = dayOfWeek === "Friday" || dayOfWeek === "Saturday" ? days.value * data.

        }
    });
</script>
<!-- Include the template file -->
<?php include 'templates/reservation-template.php'; ?>