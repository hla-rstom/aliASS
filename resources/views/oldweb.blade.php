<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- Meta setup -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="">
        <meta name="decription" content="">
        <meta name="designer" content="">
        
        <!-- Title -->
        <title>Fulhive Platforms </title>
        
        <!-- Fav Icon -->
        <link rel="icon" href="assets/images/logo_icon.png" />   

        <!-- All css here -->
        <link rel="stylesheet" href="assets/css/animate.css">      
        <link rel="stylesheet" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/style.css" />  
        <link rel="stylesheet" href="assets/css/responsive.css" /> 
        
    </head>
    <body>
        <!--[if lte IE 9]> <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p><![endif]-->

        <!-- header-area start -->
        <header class="header_area">
            <div class="header_main">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        <img src="assets/images/logo.jpg" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto align-items-center">
                            <li><a href="#" data-scroll="about">About us</a></li>
                            <li><a href="#" data-scroll="service">Services</a></li>
                            <li><a href="#" data-scroll="seller">Seller</a></li>
                        </ul>
                        <ul class="navbar-nav nav-btn align-items-center">            
                             @auth
                            <li><a class="active" href="{{route('home')}}">View Dashboard</a></li>                             
                            @else
                            <li><a class="active" href="{{route('login')}}">Login</a></li> 
                            <li><a href="{{route('register')}}">Join</a></li> 
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- header-area end -->
        
        <!-- side-bar start -->
        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    <a href="#">
                        <img src="assets/images/logo.jpg" alt="">
                    </a>
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li><a href="#" data-scroll="about">About us</a></li>
                    <li><a href="#" data-scroll="service">Services</a></li>
                    <li><a href="#" data-scroll="seller">Seller</a></li>
                </ul>
                <ul class="navbar-nav nav-btn">            
                     @auth
                            <li><a class="active" href="{{route('home')}}">View Dashboard</a></li>                             
                            @else
                            <li><a class="active" href="{{route('login')}}">Login</a></li> 
                            <li><a href="{{route('register')}}">Join</a></li> 
                            @endauth
                </ul>
            </div>
        </div>
        <!-- side-bar end -->

        <!-- hero_area start -->
        <section class="hero_area">
            <div class="row g-0 wow fadeInUp">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="hero_left wow fadeInUp">
                        <h1 class="wow fadeInUp">Your product <br> everywhere in Malaysia</h1>
                        <p class="wow fadeInUp">Focus on growing your company; We’ll take care <br> of the rest.</p>
                        <h2 class="wow fadeInUp">How <span>FULHIVE</span> goes from your online store to your customer’s door</h2>
                        <div class="hero_btn text-center wow fadeInUp">
                            <a href="#" class="wow fadeInUp">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="hero_right wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/hero.png" alt="hero images">
                    </div>
                </div>
            </div>
        </section>
        <!-- hero_area end -->

        <!-- service_area start -->
        <section class="service_area" id="about">
            <div class="row g-0">
                <div class="col-lg-4 col-md-6">
                    <div class="service_item wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/connect.png" alt="connect">
                        <p class="wow fadeInUp">Connect your store, <br>import your products</p>
                        <a class="wow fadeInUp" href="#">Connect</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service_item wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/store.png" alt="store">
                        <p class="wow fadeInUp">Pick any fulfillment center <br>you prefer</p>
                        <a class="wow fadeInUp" href="#">Store</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service_item wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/ship.png" alt="ship">
                        <p class="wow fadeInUp">As soon as a customer places an order, we ship it from the fulfillment center</p>
                        <a class="wow fadeInUp" href="#">Ship</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- service_area end -->

        <!-- about_area start -->
        <section class="about_area">
            <div class="row g-0">
                <div class="col-lg-3">
                    <div class="about_left wow fadeInUp">
                        <div class="about_lftbox wow fadeInUp">
                            <h3>Why <img src="assets/images/logo.jpg" alt=""></h3>
                            <p>We understand what you need most to grow your business</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="about_right wow fadeInUp">
                        <div class="about_item wow fadeInUp">
                            <img src="assets/images/icon-1.png" alt="">
                            <h4>Most Affordable</h4>
                            <p>Our unique business model reduce fulfillment costs to be much more affordable and mutually beneficial</p>
                        </div>
                        <div class="about_item wow fadeInUp">
                            <img src="assets/images/icon-2.png" alt="">
                            <h4>Most Flexible</h4>
                            <p>Services that can be tailored to every need from e-commerce sellers to corporate businesses</p>
                        </div>
                        <div class="about_item wow fadeInUp">
                            <img src="assets/images/icon-3.png" alt="">
                            <h4>Best Service Quality</h4>
                            <p>The combination of advanced technology & professional workers is ready to produce the best quality service</p>
                        </div>
                        <div class="about_item wow fadeInUp">
                            <img src="assets/images/icon-4.png" alt="">
                            <h4>Increase Sales</h4>
                            <p>Focus more on <br> developing product <br> quality & marketing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about_area end -->

        <!-- nationwide_area start -->
        <section class="nationwide_area overflow-hidden" id="service">
            <div class="row g-0">
                <div class="col-lg-8">
                    <div class="nation_left wow fadeInLeft">
                        <img class="wow fadeInLeft" src="assets/images/Nationwide Fulfillment.png" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="nation_right">
                        <div class="nation_cnt">
                            <h3 class="wow fadeInUp">Nationwide <br>Fulfillment</h3>
                            <p class="wow fadeInUp">With our innovative Fulhive platform, we've simplified the journey from your online store to your customer’s nationwide easily.</p>
                            <img class="wow fadeInRight" src="assets/images/delivery.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- nationwide_area end -->

        <!-- selling_area start -->
        <section class="selling_area overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="selling_left">
                        <div class="nation_cnt">
                            <h3 class="wow fadeInUp">Cross-Selling <br>Network</h3>
                            <p class="wow fadeInUp">Increase the number of SKU’s in your store without spending more. Our system allow you to cross-sell your neighbor’s product within the same furfillment center.</p>
                            <img class="wow fadeInLeft" src="assets/images/selling.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-1 order-lg-2">
                    <div class="selling_right wow fadeInRight">
                        <img class="wow fadeInRight" src="assets/images/Cross Selling Network.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- selling_area end -->

        <!-- marketing_area start -->
        <section class="marketing_area overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-8">
                    <div class="nation_left wow fadeInLeft">
                        <img class="wow fadeInLeft" src="assets/images/Marketing Solution.png" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="nation_right">
                        <div class="nation_cnt">
                            <h3 class="wow fadeInUp">Marketing <br>Solution</h3>
                            <p class="wow fadeInUp">Looking for localisation marketing services for your brand? Our marketing team handles everything from e-commerce brand management to onsite product activation launch events.</p>
                            <img class="wow fadeInRight" src="assets/images/marketing.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- marketing_area end -->

        <!-- category_area start -->
        <section class="category_area" id="seller">
            <div class="category_title text-center">
                <h3>Industry Category</h3>
            </div>
            <div class="category_main">
                <div class="row wow fadeInUp">
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/Fashion.webp" alt="">
                            <p class="wow fadeInUp">Fashion & <br>Accessories</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/FMCG.webp" alt="">
                            <p class="wow fadeInUp">FMCG</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/beauty&health.webp" alt="">
                            <p class="wow fadeInUp">Beauty <br> & Health</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/baby&toys.webp" alt="">
                            <p class="wow fadeInUp">Baby <br>& Toys</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/mobile & accessories.webp" alt="">
                            <p class="wow fadeInUp">Mobile & Accessories, <br>Computer & Accessories</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/home & living.webp" alt="">
                            <p class="wow fadeInUp">Home <br>& Living</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/womens bag.webp" alt="">
                            <p class="wow fadeInUp">Women’s <br>& Men’s Bag</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="category_item wow fadeInUp">
                            <img class="wow fadeInUp" src="assets/images/automotive.webp" alt="">
                            <p class="wow fadeInUp">Automotive  <br> & Accessories</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- category_area end -->

        <!-- solution_area start -->
        <section class="solution_area">
            <div class="category_title text-center">
                <h3>Solution For Everyone</h3>
            </div>
            <div class="category_main solution_main">
                <div class="solution_item wow fadeInUp">
                    <div class="solution_inner wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/seller.webp" alt="">
                    </div>
                    <a class="wow fadeInUp" href="#">Seller</a>
                </div>
                <div class="solution_item wow fadeInUp">
                    <div class="solution_inner wow fadeInUp">
                        <img class="wow fadeInUp" src="assets/images/warehouse.webp" alt="">
                    </div>
                    <a class="wow fadeInUp" href="#">Warehouse</a>
                </div>
            </div>
        </section>
        <!-- solution_area end -->

        <!-- coin_area start -->
        <section class="coin_area overflow-hidden">
            <div class="coin_main">
                <div class="row g-0 align-items-end">
                    <div class="col-lg-8">
                        <div class="coin_left wow fadeInLeft">
                            <img class="wow fadeInLeft" src="assets/images/portrait-business-woman-turning-look-camera-with-her-hands-typing-keyboard-office-desk.webp" alt="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="coin_right text-center wow fadeInUp">
                            <h6 class="wow fadeInUp">EXTRA SPACE <strong>AT HOME?</strong></h6>
                            <p class="wow fadeInUp">TURN SPACE INTO</p>
                            <h3 class="wow fadeInUp">CASH</h3>
                            <a class="wow fadeInUp" href="#">Sign up</a>
                        </div>
                    </div>
                </div>
                <div class="coin_icon wow fadeInRight">
                    <img class="wow fadeInRight" src="assets/images/coin.svg" alt="">
                </div>
            </div>
        </section>
        <!-- coin_area end -->

        <!-- footer_area start -->
        <footer class="footer_area">
            <div class="footer_upper">
                <p class="wow fadeInUp">Join Fulhive as our Fulfilment Center Partner! Our ecosystem create business opportunities by aiding SMEs in storing, packing and delivering their inventory to logistics agencies. Make use of your empty space and generate income in your spare time.</p>
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
