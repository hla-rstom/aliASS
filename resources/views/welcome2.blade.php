<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta setup -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Title -->
        <title>Fulhive - Space for All</title>
        
        <!-- Fav Icon -->
        <link rel="icon" href="assets/images/logo_icon.png" />

        <!-- All CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
    </head>
    <body>

        <!-- Header Section -->
        <header class="header_area">
            <div class="header_main">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        <img src="assets/images/logo.jpg" alt="Fulhive Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="#how-it-works">How it Works</a></li>
                            <li class="nav-item"><a class="nav-link" href="#spaces">Spaces</a></li>
                            <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                        </ul>
                        <ul class="navbar-nav nav-btn align-items-center">
                            @auth
                                <li class="nav-item"><a class="nav-link active" href="{{route('home')}}">View Dashboard</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link active" href="{{route('login')}}">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Join</a></li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <section style="height: 75vh; background: url('https://images.unsplash.com/photo-1502622796232-e88458466c33?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');background-position: center center;" class="hero_area bg-light text-center d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column align-items-center justify-content-center">
                        <h1 class="text-white">There's Space for All</h1>
                        <p class="text-white">We connect people with spare space to those who need it.</p>
                        <form class="d-flex justify-content-center mt-4">
                            <input class="form-control me-2" type="search" placeholder="Enter postcode or location" aria-label="Search">
                            <button class="btn btn-primary" type="submit">Find Storage</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

<!-- How It Works Section -->
<section style="height: 75vh;" id="how-it-works" class="d-flex align-items-center justify-content-center text-center">
    <div class="container">
        <h2>How it Works</h2>
        <div class="row mt-4">
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <h3>Search</h3>
                <p>Find a space that's just the right size, in just the right place. Simply enter your location or postcode, and our platform will match you with the nearest available storage or parking options tailored to your needs. Whether it's short-term or long-term, Fulhive makes the process seamless and easy.</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <h3>Book</h3>
                <p>Once you've found the perfect space, confirm your booking through our secure system. Fulhive ensures that all transactions are transparent and hassle-free. Choose your preferred date and time, and our ID-verified hosts will be ready to assist you with access to the space.</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <h3>Woohoo!</h3>
                <p>Start using the space as soon as your booking is confirmed! Whether you're parking your vehicle or storing your items, enjoy the convenience of a fully-managed and secure service that meets your needs. Fulhive is designed to give you peace of mind every step of the way.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Spaces Section -->
<section style="height: 75vh;" id="spaces" class="features text-center py-5 bg-light d-flex align-items-center justify-content-center">
    <div class="container">
        <h2>Featured Spaces</h2>
        <div class="row mt-4">
            <div class="col-md-4 p-3 card d-flex flex-column justify-content-center align-items-center">
                <h4>Horizon's Parking Space</h4>
                <p>This spacious and secure parking spot is located in a quiet neighborhood, perfect for daily or long-term parking. It is easily accessible and comes with full CCTV surveillance to ensure the safety of your vehicle.</p>
            </div>
            <div class="col-md-4 p-3 card d-flex flex-column justify-content-center align-items-center">
                <h4>Q-Park's Parking Space</h4>
                <p>Situated in the heart of the city, this premium parking space is ideal for both business and leisure trips. It offers 24/7 access with high-level security, ensuring your vehicle remains safe while you enjoy the convenience of city living.</p>
            </div>
            <div class="col-md-4 p-3 card d-flex flex-column justify-content-center align-items-center">
                <h4>Horizon's Parking Space</h4>
                <p>Located near major transportation hubs, this parking space is perfect for commuters who need a reliable place to park their vehicle. With easy access to public transport, it's a great choice for those looking to simplify their daily routine.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section style="height: 75vh;" id="testimonials" class="testimonial text-center py-5 d-flex align-items-center justify-content-center">
    <div class="container">
        <h2>What Fulhive Users Say</h2>
        <div class="row mt-4">
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <p>“Convenient and secure space. I’ve been using Fulhive for over a month now, and the experience has been nothing short of fantastic. The booking process was smooth, and the host was very accommodating.” - Nikko</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <p>“Great space. Very helpful host. I was pleasantly surprised by how easy it was to find a space and how responsive the host was throughout the entire process. Highly recommend this platform!” - Freddie</p>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <p>“Very efficient and clean. I found exactly what I was looking for through Fulhive. The space was exactly as advertised, and the booking system made everything super easy!” - Barry</p>
            </div>
        </div>
    </div>
</section>



                <!-- footer_area start -->
        <footer class="footer_area">
            <div class="footer_upper">
                <p class="wow fadeInUp">Join Fulhive to start hosting and making the extra money out of the unused space at home. It is only a few clicks away.</p>
            </div>
            <div class="footer_main">
                <div class="row align-items-end">
                    <div class="col-lg-4">
                        <div class="footer_left wow fadeInUp">
                            <a class="wow fadeInUp" href="#">
                                <img src="assets/images/footer-logo.png" alt="">
                            </a>
                            <p class="wow fadeInUp"><span>Fulhive Sdn. Bhd.</span> SA-10-03, Pan'gaea, Persiaran Bestari, 63000 Cyberjaya, Selangor.</p>
                            <ul class="wow fadeInUp">
                                <li class="wow fadeInUp"><a href="tel: +6012 691 6386">+6012 691 6386</a></li>
                                <li class="wow fadeInUp"><a href="mailto: enquiry@fulhive.com">enquiry@fulhive.com</a></li>
                            </ul>
                            <h4 class="wow fadeInUp">Powered by Fulhive Sdn. Bhd. All Rights Reserved.</h4>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="footer_right">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="footer_item wow fadeInUp">
                                        <h4 class="wow fadeInUp">Marketing Partner:</h4>
                                        <a class="tradehub" class="wow fadeInUp" href="#">
                                            <img class="wow fadeInUp" src="https://smarttradehubsolutions.com/wp-content/uploads/2023/05/Artboard-3-1.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="footer_item footer_item2 wow fadeInUp">
                                        <h4 class="wow fadeInUp">Investor Partner:</h4>
                                        <a class="wow fadeInUp" href="#">
                                            <img class="wow fadeInUp" src="assets/images/cradle-logo-white.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="footer_item">
                                        <div class="social_icon wow fadeInUp">
                                            <ul class="wow fadeInUp">
                                                <li><a href="#"><img src="assets/images/facebook.png" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/instagram.png" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/youtube.png" alt=""></a></li>
                                            </ul>
                                        </div>
                                        <p class="wow fadeInUp"><a href="#">Privacy Policy</a> <a href="#">Our Integrity</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer_area end -->

        <!-- Scroll-Top button -->
        <a href="#" class="scrollto-top"> &#916; </a>

        <!-- All js here -->
        <script src="assets/js/jquery-3.4.1.min.js"></script>    
        <script src="assets/js/wow.min.js"></script>   
        <script src="assets/js/bootstrap.bundle.js"></script>
        <script src="assets/js/smartScroll.js"></script>
        <script src="assets/js/scripts.js"></script>

        <script>
            (function ($) {
                "use strict";
                // all parameters are optional
                smartScroll.init({
                    speed: 700, // default 500
                    addActive: false, // default true
                    activeClass: "active", // default active
                    offset: 80 // default 100
                }, function () {
                    console.log("callback");
                });
            })(jQuery);
        </script>

    </body>
</html>
