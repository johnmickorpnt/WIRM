<?php
session_start();

$title = "Reservation - Cafe Lupe";
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$nomorrow = date('Y-m-d', strtotime('+2 day'));
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
        <img src="assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Welcome to to Cafe Lupe!</h1>
    <p>We are excited to serve you! Please enter the necessary information to add your booking.</p>
    {$errors}
    <form action="php/functions/reservation/create" method="POST">
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
        <div class="d-flex">
            <div class="form-group w-50">
            <label>
                Start Date
            </label>
            <input type="date" style="width:100%" min={$tomorrow} value={$tomorrow} id="start_date" name="start_date">
        </div>
        <div class="form-group w-50">
            <label>
                End Date
            </label>
            <input type="date" style="width:100%" min="{$nomorrow}" value={$nomorrow} id="end_date" name="end_date">
        </div>
        </div>
        <div class="form-group">
            <label>
                Remarks
            </label>
            <textarea type="text" placeholder="Your remarks and notes..." style="width:100%" name="remarks"></textarea>
        </div>
        <input type="hidden" value="{$_SESSION["id"]}" name="customer_id">
        <input type="hidden" value="" name="room_id" id="room_id">
        <div class="form-group select-wrapper">
            <label>Total</label>
            <input type="number" placeholder="Total to be payed..." style="width:100%" id="total" name="total" readonly>
        </div>
        <input type="submit" class="btn" value="Submit">
    </form>
    <small>
        Please note that we have different night ratings from Friday to Saturday.
    </small>
CONTENT;
?>
<!-- <div class="form-group select-wrapper">
            <label>Duration of stay in days</label>
            <input type="number" placeholder="Number of days to be stayed:" value=1 style="width:100%" id="days" name="days" required>
        </div> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let bedType = document.getElementById("bed_type");
        let rooms = document.getElementById("rooms")
        // let days = document.getElementById("days");
        let total = document.getElementById("total")
        let roomId = document.getElementById("room_id");
        let startDate = document.getElementById("start_date")
        let endDate = document.getElementById("end_date");
        mainFetch()
        bedType.addEventListener("change", (e) => mainFetch(event.target.value))
        rooms.addEventListener("change", (e) => compute())
        startDate.addEventListener("change", (e) => compute())
        endDate.addEventListener("change", (e) => compute())

        function setOptions(data) {
            rooms.innerHTML = "";
            data.forEach(function(item) {
                const option = document.createElement('option');
                option.value = item.room_number;
                option.text = `Room #${item.room_number}`;
                option.setAttribute("rate_sun_thurs", item.rate_sun_thurs)
                option.setAttribute("rate_fri_sat", item.rate_fri_sat)
                option.setAttribute("room_id", item.id)
                rooms.appendChild(option);
            });
            compute()
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

        function compute(e) {
            let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let today = new Date();
            let dayOfWeek = daysOfWeek[today.getDay()];
            const selectedIndex = rooms.selectedIndex;
            const d = rooms.options[selectedIndex];
            roomId.value = d.getAttribute("room_id");
            const diffInDays = dateDiffInDays(startDate.value, endDate.value);

            total.value = dayOfWeek === "Friday" || dayOfWeek === "Saturday" ?
                parseInt(diffInDays) * parseInt(d.getAttribute("rate_fri_sat")) :
                parseInt(diffInDays) * parseInt(d.getAttribute("rate_sun_thurs"))
        }
    });

    function dateDiffInDays(date1Str, date2Str) {
        const date1 = new Date(date1Str);
        const date2 = new Date(date2Str);
        const diffInMs = Math.abs(date2 - date1);
        const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
        return diffInDays;
    }
</script>
<!-- Include the template file -->
<?php include 'templates/reservation-template.php'; ?>