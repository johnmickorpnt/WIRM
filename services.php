<?php
$title = "Services - Cafe Lupe";
$containerStyles = "padding: 0 10rem 0 10rem; margin-top:10rem";
$content = <<<CONTENT
    <div class="hr-container">
        <hr>
        <h1>Our Menu</h1>
    </div>
    <section class="gallery-container">
        <div class="gallery-slide">
            <img src="assets/imgs/menu/beverages1.webp" class="img-fluid">
            <img src="assets/imgs/menu/beverages2.webp" class="img-fluid">
            <img src="assets/imgs/menu/all-day-breakfast.webp" class="img-fluid">
            <img src="assets/imgs/menu/cover.webp" class="img-fluid">
            <img src="assets/imgs/menu/party-celeb.webp" class="img-fluid">
            <img src="assets/imgs/menu/1.webp" class="img-fluid">
            <img src="assets/imgs/menu/mexican.webp" class="img-fluid">
        </div>
        <div class="arrow-btn left-arrow">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="arrow-btn right-arrow">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </section>
    <div class="hr-container">
        <hr>
        <h1>CASA ALEGRIA HOSTEL ROOMS</h1>
    </div>
    <section class="gallery-container">
        <div class="gallery-slide">
            <img src="assets/imgs/menu/beverages1.webp" class="img-fluid">
            <img src="assets/imgs/menu/beverages2.webp" class="img-fluid">
            <img src="assets/imgs/menu/all-day-breakfast.webp" class="img-fluid">
            <img src="assets/imgs/menu/cover.webp" class="img-fluid">
            <img src="assets/imgs/menu/party-celeb.webp" class="img-fluid">
            <img src="assets/imgs/menu/1.webp" class="img-fluid">
            <img src="assets/imgs/menu/mexican.webp" class="img-fluid">
        </div>
        <div class="arrow-btn left-arrow">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="arrow-btn right-arrow">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </section>
    <section class="room-section">
        <div class="room-item">
            <h2>2 Single Beds</h2>
            <img src="assets/imgs/rooms/2-single-beds.webp" class="img-fluid" alt="">
            <span class="room-price">Php 2,200</span>
            <span class="schedule">Sunday to Thursday</span>
            <span class="room-price">Php 3,410</span>
            <span class="schedule">Friday to Saturday</span>
            <p>2 Person Capacity</p>
            <a href="2-single-beds-360.php" class="btn btn-sm select-room">View in 360</a>
        </div>
        <div class="room-item">
            <h2>1 King Sized Bed</h2>
            <img src="assets/imgs/rooms/1-king-sized-bed.webp" class="img-fluid" alt="">
            <span class="room-price">Php4,620</span>
            <span class="schedule">Sunday to Thursday</span>
            <span class="room-price">Php5,830</span>
            <span class="schedule">Friday to Saturday</span>
            <p>2 Person Capacity</p>
            <a href="1-king-size-360.php" class="btn btn-sm select-room">View in 360</a>
        </div>
        <div class="room-item">
            <h2>1 Queen Sized Bed</h2>
            <img src="assets/imgs/rooms/1-queen-sized-bed.webp" class="img-fluid" alt="">
            <span class="room-price">Php4,620</span>
            <span class="schedule">Sunday to Thursday</span>
            <span class="room-price">Php5,830</span>
            <span class="schedule">Friday to Saturday</span>
            <p>2 Person Capacity</p>
            <a href="1-queen-size-360.php" class="btn btn-sm select-room">View in 360</a>
        </div>
        <div class="room-item">
            <h2>Suite Room</h2>
            <img src="assets/imgs/rooms/suite-room.webp" class="img-fluid" alt="">
            <span class="room-price">Php8,000</span>
            <span class="schedule">Sunday to Thursday</span>
            <span class="room-price">Php10,000</span>
            <span class="schedule">Friday to Saturday</span>
            <p>2 Person Capacity</p>
            <a href="suite-360.php" class="btn btn-sm select-room">View in 360</a>
        </div>
        <div id="mapid" style="height: 500px;"></div>
    </section>
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>