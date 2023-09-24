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
$containerStyles = "width:80%";
$content = <<<CONTENT
    <a href="home">
        <img src="assets/imgs/cafe-lupe.webp" class="logo" alt="Cafe Lupe">
    </a>    
    <h1>Cafe Lupe Reservation!</h1>
    <p>
        We are excited to serve you! <br>
        Please enter the necessary information to add your booking.
    </p>
    {$errors}
    <form action="php/functions/reservation/create" method="POST" id="mainForm" style="position:relative">
        <input id="room_id" name="room_id" type="hidden">
        <input type="hidden" value="{$_SESSION["id"]}" name="customer_id">
        <input type="hidden" id="total" name="total">

        <h3 id="title" style="margin-bottom:1rem">
            Pick your preffered room type
        </h3> 
        <h4 id="selection">
            
        </h4>
        <section id="step1" style="display:grid;grid-template-columns: repeat(4, 1fr);gap: 0.75rem;">
            <div style="display:flex;flex-direction:column;gap:0.5rem">
                <h2>2 Single Beds</h2>
                <img src="assets/imgs/rooms/2-single-beds.webp" class="img-fluid" alt="">
                <span class="room-price">Php 2,200</span>
                <span class="schedule">Sunday to Thursday</span>
                <span class="room-price">Php 3,410</span>
                <span class="schedule">Friday to Saturday</span>
                <p>2 Person Capacity</p>
                <a href="javascript:void(0)" class="btn btn-sm select-room" room_type="2 Single Beds">Select</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.5rem">
                <h2>1 King Sized Bed</h2>
                <img src="assets/imgs/rooms/1-king-sized-bed.webp" class="img-fluid" alt="">
                <span class="room-price">Php4,620</span>
                <span class="schedule">Sunday to Thursday</span>
                <span class="room-price">Php 5,830</span>
                <span class="schedule">Friday to Saturday</span>
                <p>2 Person Capacity</p>
                <a href="javascript:void(0)" class="btn btn-sm select-room" room_type="1 King Sized Bed">Select</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.5rem">
                <h2>1 Queen Sized Bed</h2>
                <img src="assets/imgs/rooms/1-queen-sized-bed.webp" class="img-fluid" alt="">
                <span class="room-price">Php4,620</span>
                <span class="schedule">Sunday to Thursday</span>
                <span class="room-price">Php5,830</span>
                <span class="schedule">Friday to Saturday</span>
                <p>2 Person Capacity</p>
                <a href="javascript:void(0)" class="btn btn-sm select-room" room_type="1 Queen Sized Bed">Select</a>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.5rem">
                <h2>Suite Room</h2>
                <img src="assets/imgs/rooms/suite-room.webp" class="img-fluid" alt="">
                <span class="room-price">Php8,000</span>
                <span class="schedule">Sunday to Thursday</span>
                <span class="room-price">Php10,000</span>
                <span class="schedule">Friday to Saturday</span>
                <p>2 Person Capacity</p>
                <a href="javascript:void(0)" class="btn btn-sm select-room" room_type="Suite Room">Select</a>
            </div>
        </section>
        <section id="step2" style="display:none">
            
            <div class="form-group">
                <label>
                    Check-in Date
                </label>
                <input type="date" style="width:100%" id="start_date" name="start_date">
            </div>
            
            <div class="form-group select-wrapper" id="duration-block">
                <label>How long will you stay?</label>
                <select name="duration" id="duration" style="width:100%" required>
                    <option value="0">
                        ...
                    </option>
                    <option value="3">
                        3 Hours
                    </option>
                    <option value="4">
                        4 Hours
                    </option>
                    <option value="5">
                        5 Hours
                    </option>
                    <option value="6">
                        6 Hours
                    </option>
                    <option value="7">
                        7 Hours
                    </option>
                    <option value="8">
                        8 Hours
                    </option>
                    <option value="more">
                        9 Hours+...
                    </option>
                </select>
            </div>

            <div class="form-group" id="end_date_block">
                <label>
                    Check-out Date
                </label>
                <input type="date" class="date-disabled" style="width:100%" id="end_date" name="end_date">
            </div>

            <div style="display:flex; flex-direction:column;gap:0.5rem">
                <a href="javascript:void(0)" onclick="goToStep1()" class="btn" style="width:100%; background-color:orange; color:white!important">
                    <i class="fa-solid fa-arrow-left"></i>
                    Pick A Different Bed Type
                </a>
                <a href="javascript:void(0)" class="btn" id="findRoomsBtn" style="width:100%">Find Available Rooms <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>
        <section id="step3" style="display:none">
            <section id="successBlock">
                <h5>We have found room/s available for your chosen room type and schedule!</h5>
                <div class="form-group select-wrapper">
                    <label>Available Rooms</label>
                    <select name="rooms" id="rooms" style="width:100%" required>
                    </select>
                </div> 
                <div style="display:flex; flex-direction:column;gap:0.5rem">
                    <a href="javascript:void(0)" onclick="goToStep2()" class="btn" style="width:100%; background-color:orange; color:white!important">
                        <i class="fa-solid fa-arrow-left"></i>
                        Go Back
                    </a>
                    <a href="javascript:void(0)" onclick="goToStep4()" class="btn" id="book" style="width:100%">Book this room<i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </section>
            <section id="failedBlock">
                <div style="display:flex; flex-direction:column;gap:0.5rem">
                    <a href="javascript:void(0)" onclick="goToStep2()" class="btn" style="width:100%; background-color:orange; color:white!important">
                        <i class="fa-solid fa-arrow-left"></i>
                        Pick a different room
                    </a>
                    <a href="javascript:void(0)" onclick="goToStep2()" class="btn" style="width:100%; background-color:orange; color:white!important">
                        <i class="fa-solid fa-arrow-left"></i>
                        Pick a different schedule
                    </a>
                </div>
            </section>
        </section>

        <section id="step4" style="display:none">
            <table>
                <tbody>
                    <tr>
                        <td>
                            Room Type
                        </td>
                        <td id="roomTypeIinfo">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Check In Time
                        </td>
                        <td id="checkInInfo">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Check Out Time
                        </td>
                        <td id="checkOutInfo">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Total
                        </td>
                        <td id="totalInfo">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="display:flex; flex-direction:column;gap:0.5rem;margin-top:0.5rem">
                <a href="javascript:void(0)" onclick="goToStep3()" class="btn" style="width:100%; background-color:orange; color:white!important">
                            <i class="fa-solid fa-arrow-left"></i>
                            Pick a different room
                </a>
                <a href="javascript:void(0)" onclick="book()" class="btn" id="book" style="width:100%">Place Booking<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>
    </form>
CONTENT;
?>
<!-- <div class="form-group select-wrapper">
    <label>Available Rooms for Room Type</label>
    <select name="rooms" id="rooms" style="width:100%" required>
    </select>
</div> -->
<!-- <div class="form-group w-50">
    <label>
        Check-out Date
    </label>
    <input type="date" style="width:100%" min="{$nomorrow}" value={$nomorrow} id="end_date" name="end_date">
</div> -->
<!-- <div class="form-group select-wrapper">
            <label>Duration of stay in days</label>
            <input type="number" placeholder="Number of days to be stayed:" value=1 style="width:100%" id="days" name="days" required>
        </div> -->
<script>
    let room_type = null

    function goToStep1() {}

    function goToStep2() {}

    function goToStep3() {}

    function goToStep4() {}

    function book(){}

    document.addEventListener("DOMContentLoaded", function() {
        let mainForm = document.getElementById("mainForm")
        let selectBtns = document.querySelectorAll(".select-room");
        let rooms = document.getElementById("rooms")
        let title = document.getElementById("title")
        var step1 = document.getElementById("step1")
        var step2 = document.getElementById("step2")
        var step3 = document.getElementById("step3")
        var step4 = document.getElementById("step4")
        let total = document.getElementById("total")
        var goToStep2Btn = document.getElementById("goToStep2Btn");
        var duration = document.getElementById("duration");
        let durationBlock = document.getElementById("duration-block");
        let startDate = document.getElementById("start_date")
        let endDate = document.getElementById("end_date");
        let findRoomsBtn = document.getElementById("findRoomsBtn")
        let successBlock = document.getElementById("successBlock")
        let failedlock = document.getElementById("failedBlock")
        let step3BackBtn = document.getElementById("step3BackBtn")

        let roomTypeInfo = document.getElementById("roomTypeInfo")
        let checkInInfo = document.getElementById("checkInInfo")
        let checkOutInfo = document.getElementById("checkOutInfo")
        // let durationInfo = document.getElementById("durationInfo")
        let totalInfo = document.getElementById("totalInfo")

        let roomId = document.getElementById("room_id")
        endDate.readOnly = true

        var endPicker = flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d h:i K",
            minDate: new Date().fp_incr(1),
        });


        var startPicker = flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d h:i K",
            minDate: new Date().fp_incr(1),
            defaultDate: new Date().fp_incr(1),
            onClose: function(selectedDates, dateStr, instance) {
                let val = duration.options[duration.selectedIndex].value
                let endVal
                if (val === "0") {
                    endVal = new Date(selectedDates).addHours(3)
                    endPicker.setDate(endVal)
                    endPicker.set("minDate", endVal)
                    return
                }
                endVal = new Date(startDate.value).addHours(parseInt(val))
                endPicker.setDate(endVal)
            },
        });

        findRoomsBtn.addEventListener("click", () => {
            checkAvailability(room_type, startDate.value, endDate.value)
        })

        function setEnd() {
            let val = duration.options[duration.selectedIndex].value
            let endVal = new Date(startDate.value).addHours(parseInt(val))
            endPicker.setDate(endVal)
        }

        duration.addEventListener("change", (e) => {
            let val = duration.options[duration.selectedIndex].value
            if (val === "more") {
                endDate.classList.remove("date-disabled");
                endDate.readOnly = false
                endVal = new Date(startDate.value).addHours(9)
                console.log(endVal)
                endPicker.set("minDate", endVal)
                return
            }

            endDate.readOnly = true
            endDate.classList.add("date-disabled");
            setEnd()
        });


        selectBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                goToStep2()
                room_type = btn.getAttribute("room_type");
                title.innerHTML = `You Have Selected:<br> ${room_type}`
            });
        });

        function checkAvailability(type, checkIn, checkOut) {
            const data = {
                type: type,
                checkIn: checkIn,
                checkOut: checkOut
            };
            const queryString = new URLSearchParams(data).toString();
            fetch(`php/functions/api/reservations.php?${queryString}`)
                .then(response => response.json())
                .then(data => goToStep3(data))
                .catch(error => console.error(error));
        }

        function mainFetch(type) {
            const data = {
                type: type,
            };
            const queryString = new URLSearchParams(data).toString();
            fetch(`php/functions/api/rooms.php?${queryString}`)
                .then(response => response.json())
                .then(data => setOptions(data))
                .catch(error => console.error(error));
        }

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
            // compute()
        }

        goToStep1 = function() {
            step1.style.display = "grid";
            step2.style.display = "none";
            step3.style.display = "none";
            step4.style.display = "none";

            title.innerHTML = "Please select your preffered room type";
        }
        goToStep2 = function() {
            step1.style.display = "none";
            step2.style.display = "block";
            step3.style.display = "none";
            step4.style.display = "none";
            title.innerHTML = "How long will you stay?"
        }

        goToStep3 = function(data) {
            step1.style.display = "none";
            step2.style.display = "none";
            step3.style.display = "block";
            step4.style.display = "none";

            console.log(data)
            if (data >= 1) {
                noRooms()
                return
            }
            fetchRooms()
        }

        goToStep4 = function() {
            step1.style.display = "none";
            step2.style.display = "none";
            step3.style.display = "none";
            step4.style.display = "block";

            title.innerHTML = "You're almost there! <br>Review your booking details to place your booking!"
            compute()

        }

        book = function(){
            let conf = confirm("I have read the terms and conditions and reviewed the details of my booking.")
            if(conf) mainForm.submit()
        }

        function fetchRooms() {
            successBlock.style.display = "block";
            failedlock.style.display = "none";
            mainFetch(room_type)
        }

        function noRooms() {
            successBlock.style.display = "none";
            failedlock.style.display = "block";
            title.innerHTML = "Sorry! No available rooms for selected room and schedule."
        }

        function compute(e) {
            let daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let today = new Date();
            let dayOfWeek = daysOfWeek[today.getDay()];
            const selectedIndex = rooms.selectedIndex;
            const d = rooms.options[selectedIndex];
            roomId.value = d.getAttribute("room_id");
            const diffInDays = dateDiffInDays(startDate.value, endDate.value);

            roomTypeInfo = room_type
            checkInInfo.innerHTML = startDate.value;
            checkOutInfo.innerHTML = endDate.value;
            duration.innerHTML = Math.abs(startDate.value - endDate.value) / 36e5;
            let totalVal = dayOfWeek === "Friday" || dayOfWeek === "Saturday" ?
                parseInt(diffInDays) * parseInt(d.getAttribute("rate_fri_sat")) :
                parseInt(diffInDays) * parseInt(d.getAttribute("rate_sun_thurs"))
            totalInfo.innerHTML = "₱" + totalVal
            total.value = totalVal
        }

        Date.prototype.addHours = function(h) {
            this.setHours(this.getHours() + h);
            return this;
        }
    });

    function dateDiffInDays(date1Str, date2Str) {
        const date1 = new Date(date1Str);
        const date2 = new Date(date2Str);
        const diffInMs = Math.abs(date2 - date1);
        const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));
        return diffInDays === 0 ? 1 : diffInDays;
    }
</script>


<!-- Include the template file -->
<?php include 'templates/reservation-template.php'; ?>