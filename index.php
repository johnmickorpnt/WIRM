<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$title = "Home - Cafe Lupe";
$content = <<<CONTENT
    <section style="position:relative">
        <img src="assets/imgs/cover.jpg" alt="" class="img-cover p-relative" style="z-index: 0;">
        <section class="circle center">
            <p>EXPERIENCE COMFORT AND HAPPINESS</p>
        </section>
    </section>
    <section style="padding: 0 10rem 0 10rem; margin-top:10rem">
        <div class="hr-container">
            <hr>
            <h1 style="font-size:xxx-large">HOT NEWS</h1>
        </div>
        <div class="flex-container">
            <div class="flex-item">
                <iframe data-ux="Embed" allowfullscreen="" type="text/html" frameborder="0" src="//player.vimeo.com/video/812707482?h=a325b4b70f&amp;autoplay=0&amp;title=0&amp;portrait=0&amp;byline=0&amp;badge=0" data-aid="VIDEO_IFRAME_RENDERED" class="iframe"></iframe>
                <h1>
                URBANDUB CONCERT ON APRIL 1!!!
                GET YOUR TICKETS NOW!
                </h1>
            </div>
            <div class="flex-item">
                <iframe data-ux="Embed" allowfullscreen="" type="text/html" frameborder="0" src="//player.vimeo.com/video/720921998?h=c64d300c99&amp;autoplay=0&amp;title=0&amp;portrait=0&amp;byline=0&amp;badge=0" data-aid="VIDEO_IFRAME_RENDERED" class="iframe"></iframe>
                <h3>
                Cafe Lupe offers hotel and restaurant services as well as functional rooms catering events and receptions, and arts and design studios for artists and producers to provide you the best experiences and flexibility around the place while on an overlooking place in Antipolo.
                </h3>
            </div>
        </div>
    </section>
    <section style="padding: 0 10rem 0 10rem; margin-top:10rem">
        <div class="hr-container">
            <hr>
            <h1 style="font-size:xxx-large">About Us</h1>
        </div>
        <div style="display:flex; gap:1rem">
            <div class="about-us-list">
                <h1>
                    DINING
                </h1>
                <p>
                    Enjoy Spanish-Mexican cuisine and beverages served with a very mesmerizing environment. Drink some beers with your friends and family and enjoy the best service we can offer.
                </p>
            </div>
            <div class="about-us-list">
                <h1>
                    SERVICES
                </h1>
                <p>
                    Bar/Family Restaurant Overlooking Karaoke/KTV Hotel and Bed & Breakfast Music/Chill Launching Meetings/Private Parties/Weddings/Debuts Acoustic-Bands-DJ
                </p>
            </div>
            <div class="about-us-list">
                <h1>
                    100% SATISFACTION GUARANTEED
                </h1>
                <p>
                    Whether this is your first visit, or you have been a guest many times, we want your experience to be excellent. Our staff is always available to help with any questions or concerns you may have. 
                </p>
            </div>
        </div>
    </section>   
CONTENT;
?>

<!-- Include the template file -->
<?php include 'templates/default.php'; ?>