<?php
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', rtrim($url, '/'));
$lastPart = end($parts);
?>

<div class="nav-wrapper">
    <nav>
        <ul>
            <li>
                <a href="">
                    <img src="" alt="" logo>
                </a>
            </li>
            <li <?= $lastPart == "dashboard" ? "class='active'" : ""?>>
                <a href="dashboard">
                    <i class="fa-solid fa-list-ul"></i>
                    Dashboard
                </a>
            </li>
            <li class="separator">
                <span>
                    Manage Records
                </span>
            </li>
            <li <?= $lastPart == "reservations" ? "class='active'" : ""?>>
                <a href="reservations">
                    <i class="fa-solid fa-check"></i>
                    Reservations
                </a>
            </li>
            <li <?= $lastPart == "rooms" ? "class='active'" : ""?>>
                <a href="rooms">
                    <i class="fa-solid fa-door-open"></i>
                    Rooms
                </a>
            </li>
            <li class="separator">
                <span>
                    Manage Users
                </span>
            </li>
            <li <?= $lastPart === "users" ? "class='active'" : ""?>>
                <a href="users">
                    <i class="fa-sharp fa-solid fa-users"></i>
                    Users
                </a>
            </li>
            <li class="separator">
                <span>
                    Your Account
                </span>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>