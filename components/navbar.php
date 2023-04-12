<nav>
    <div class="nav-item logo">
        <a href="#" rel="noopener noreferrer">
            <img src="assets/imgs/cafe-lupe.webp" alt="Cafe Lupe">
        </a>
    </div>
    <ul class="auth">
        <?php
        echo isset($_SESSION["id"]) ? <<<CONTENT
        <li class="auth-item ml-auto">
            <a href="php/functions/auth/logout.php">Logout</a>
        </li>
        CONTENT : <<<CONTENT
        <li class="auth-item ml-auto">
            <a href="auth/login">Login</a>
        </li>
        <li class="auth-item">
            <a href="auth/register">Register</a>
        </li>
        CONTENT;
        ?>
    </ul>
    <ul class="main">
        <li class="nav-item <?php is_active('home')?>" style="margin-left:auto">
            <a href="home" rel="noopener noreferrer">
                Home
            </a>
        </li>
        <li class="nav-item <?php is_active('reservation')?>">
            <a href="reservation">Reservation</a>
        </li>
        <li class="nav-item <?php is_active('services')?>">
            <a href="services">Services</a>
        </li>
        <li class="nav-item <?php is_active('promos')?>">
            <a href="promos">Promos</a>
        </li>
        <li class="nav-item <?php is_active('about-us')?>">
            <a href="about-us">About us</a>
        </li>
    </ul>
</nav>