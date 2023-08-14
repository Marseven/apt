<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title> Dispatch </title>

     <!--Favicon-->
     <link rel="icon" href="{{ asset('front/img/favicon.png') }}" type="image/jpg" />
     <!-- Bootstrap CSS -->
     <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
     <!-- Font Awesome CSS-->
     <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet">
     <!-- Line Awesome CSS -->
     <link href="{{ asset('front/css/line-awesome.min.css') }}" rel="stylesheet">
     <!-- Animate CSS-->
     <link href="{{ asset('front/css/animate.css') }}" rel="stylesheet">
     <!-- Flaticon CSS -->
     <link href="{{ asset('front/css/flaticon.css') }}" rel="stylesheet">
     <!-- Owl Carousel CSS -->
     <link href="{{ asset('front/css/owl.carousel.css') }}" rel="stylesheet">
     <!-- Nice Select CSS -->
     <link href="{{ asset('front/css/nice-select.css') }}" rel="stylesheet">
     <!-- Style CSS -->
     <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
     <!-- Responsive CSS -->
     <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">

     <!-- jquery -->
     <script src="{{ asset('front/js/jquery-2.2.4.min.js') }}"></script>


 </head>

 <body>

     <!-- Pre-Loader -->
     <div id="loader">
         <div class="loading">
             <div class="spinner">
                 <div class="double-bounce1"></div>
                 <div class="double-bounce2"></div>
             </div>
         </div>
     </div>


     <!-- Header Area -->

     <header id="header-3" class="header-area absolute-header">
        <div class="header-top-area">
            <br><br><br>
         </div>
         <div class="sticky-area">
             <div class="navigation">
                 <div class="container">
                     <div class="row">
                         <div class="col-xl-3 col-lg-3">
                             <div class="logo">
                                 <a class="navbar-brand" href="index-2.html"><img src="{{ asset('front/img/logo-white.png') }}" alt=""></a>
                             </div>
                         </div>

                         <div class="col-xl-6 col-lg-6">
                            <div class="main-menu">
                                <nav class="navbar navbar-expand-lg">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                      <span class="navbar-toggler-icon"></span>
                                      <span class="navbar-toggler-icon"></span>
                                      <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                      <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('home')}}">Accueil</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/about')}}">À Propos</a>
                                        </li>

                                        <li class="nav-item">
                                          <a class="nav-link" href="{{ url('/contact')}}">Contact</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login')}}">Se Connecter</a>
                                        </li>

                                      </ul>
                                    </div>
                                </nav>
                            </div>
                         </div>
                         <div class="col-xl-3 col-lg-3">
                             <div class="header-info-right">
                                 <div class="header-button-list">
                                     <button class="btn search-trigger"><i class="las la-search"></i></button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Search Dropdown Area -->

         <div class="search-popup">
             <span class="search-back-drop"></span>

             <div class="search-inner">
                 <div class="auto-container">
                     <div class="upper-text">
                         <div class="text">Search for anything.</div>
                         <button class="close-search"><span class="la la-times"></span></button>
                     </div>

                     <form method="post" action="https://capricorn-theme.net/exelsior/index.html">
                         <div class="form-group">
                             <input type="search" name="search-field" value="" placeholder="Search..." required="">
                             <button type="submit"><i class="la la-search"></i></button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </header>

     <!-- Hero Area -->

     <div id="home-3" class="homepage-slides owl-carousel">
         <div class="single-slide-item">
             <div class="image-layer" style="background-image: url(front/img/slider/slide-5.jpg);">
                 <div class="overlay-2"></div>
             </div>
             <div class="hero-area-content">
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-lg-10 text-center wow fadeInUp animated" data-wow-delay=".2s">
                             <div class="section-title">
                                 <h1>First Class<br> <b>Freight Services</b></h1>
                                 <p> Logistics Revolution, in modern history, the process of change from an agrarian <br>and handicraft economy to one dominated by industry and machine manufacturing.</p>
                             </div>
                             <a href="services.html" data-animation="fadeInUp" data-delay=".7s" class="main-btn transparent yellow mr-20" style="animation-delay: 0.7s;">Our Services</a>

                             <a href="contact.html" data-animation="fadeInUp" data-delay=".9s" class="main-btn white" style="animation-delay: 0.9s;">Appointment</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="single-slide-item hero-area-bg-2">
             <div class="image-layer" style="background-image: url(front/img/slider/slide-6.jpg);">
                 <div class="overlay-2"></div>
             </div>
             <div class="hero-area-content">
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-lg-10 text-center wow fadeInUp animated" data-wow-delay=".2s">
                             <div class="section-title">
                                 <h1><b>Delivery Packages</b><br>in any Way</h1>
                                 <p> Logistics Revolution, in modern history, the process of change from an agrarian <br>and handicraft economy to one dominated by industry and machine manufacturing.</p>
                             </div>
                             <a href="service.html" data-animation="fadeInUp" data-delay=".7s" class="main-btn transparent yellow mr-20" style="animation-delay: 0.7s;">Our Services</a>

                             <a href="contact.html" data-animation="fadeInUp" data-delay=".9s" class="main-btn white" style="animation-delay: 0.9s;">Appointment</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- About Section -->

     <div class="about-section section-padding">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6 wow fadeInLeft" data-wow-delay=".2s">
                     <div class="about-thumb">
                         <img src="{{ asset('front/img/about/about-3.jpg') }}" alt="">
                     </div>
                 </div>
                 <div class="col-xl-6 wow fadeInRight" data-wow-delay=".2s">
                     <div class="section-title">
                         <h5>About Us</h5>
                         <h2>Deliver Your Product <br> with Safe & Secured</h2>
                     </div>

                     <div class="section-content">
                         <p>Local operations team on-call 24 hours a day, available to work at a moment’s notice.</p>
                     </div>

                     <p class="mt-30">We provide janitorial and specialized courier services for all types and sizes of complexes – from small to large offices and commercial centers to industrial, warehouse, and retail locations. Our client base is comprised of both privately-owned companies and public organizations.</p>

                     <a href="about.html" class="main-btn yellow mt-30">Read More</a>

                 </div>
             </div>
         </div>
     </div>

     <!-- Counter Section -->
     <div class="counter-area bg-cover pb-120" style="background-image: url(front/img/big-empty-ship.jpg);">
         <div class="overlay-2"></div>

         <div class="pop-up-video">
             <a href="https://www.youtube.com/watch?v=SZEflIVnhH8" class="video-play-btn mfp-iframe">
                 <i class="fa fa-play"></i>
             </a>
         </div>

         <div class="container-fluid">
             <div class="row no-gutters justify-content-end wow fadeInRight" data-wow-delay=".3s">

                 <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                     <div class="single-counter-box yellow">
                         <div class="counter-icon">
                             <img src="{{ asset('front/img/icon/counter-icon-1.png') }}" alt="">
                         </div>

                         <div class="conter-content mt-40">
                             <div class="counter-content-top mb-30">
                                 <h2 class="conter-title"><span class="counter big">10</span><span class="big">K</span>+</h2>

                                 <p><b>Active Workers <br>
                                         &amp; Transports</b></p>

                             </div>
                             <p>We provide domestic and world wide logistics services for all types and sizes of complexes – from small to large.</p>
                         </div>
                     </div>
                 </div>

                 <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                     <div class="single-counter-box">
                         <div class="counter-icon">
                             <img src="{{ asset('front/img/icon/counter-icon-2.png" alt="">
                         </div>
                         <div class="conter-content mt-40">
                             <div class="counter-content-top mb-30">
                                 <h2 class="conter-title"><span class="counter big') }}">72</span>+</h2>
                                 <p><b>World Wide <br>
                                         Coverage</b></p>
                             </div>
                             <p>We provide domestic and world wide courier services for all types and sizes of complexes – from small to large.</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Logistics Section -->

     <div id="logistics" class="logistics-area section-padding pb-50">
         <div class="container">
             <div class="row">
                 <div class="offset-lg-2 col-lg-8 text-center">
                     <div class="section-title">
                         <h5>Services</h5>
                         <h2>Reliable Logistics Services</h2>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area wow fadeInLeft" data-wow-delay=".2s">
                         <div class="service-icon">
                             <i class="flaticon-air-freight"></i>
                         </div>
                         <h4>Air Freight</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="air-freight.html" class="read-more">Read More</a>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area sea wow fadeInLeft" data-wow-delay=".4s">
                         <div class="service-icon">
                             <i class="flaticon-sea"></i>
                         </div>
                         <h4>Sea Freight</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="sea-freight.html" class="read-more">Read More</a>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area road wow fadeInLeft" data-wow-delay=".6s">
                         <div class="service-icon">
                             <i class="flaticon-truck"></i>
                         </div>
                         <h4>Ground Freight</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="ground-freight.html" class="read-more">Read More</a>
                     </div>
                 </div>

                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area rail wow fadeInLeft" data-wow-delay=".2s">
                         <div class="service-icon">
                             <i class="flaticon-freight-wagon"></i>
                         </div>
                         <h4>Rail Freight</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="rail-freight.html" class="read-more">Read More</a>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area store wow fadeInLeft" data-wow-delay=".4s">
                         <div class="service-icon">
                             <i class="flaticon-wholesale"></i>
                         </div>
                         <h4>Logistics Storage</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="single-service.html" class="read-more">Read More</a>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-6 col-sm-12">
                     <div class="logistic-service-area ware wow fadeInLeft" data-wow-delay=".6s">
                         <div class="service-icon">
                             <i class="flaticon-pallet"></i>
                         </div>
                         <h4>Warehousing</h4>
                         <p>We provide janitorial and specialized courier services for all types and sizes of complexes from small to large.</p>
                         <a href="single-service.html" class="read-more">Read More</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Newsletter Section -->

     <div class="newsletter-area blue-bg section-padding">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6 col-lg-5">
                     <div class="section-heading white">
                         <div class="section-title">
                             <h5>Newsletter</h5>
                             <h2>Get Newsletter</h2>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-6 col-lg-7">
                     <div class="newsletter-form">
                         <form action="https://capricorn-theme.net/exelsior/index.html">
                             <input type="email" placeholder="Enter email address....">
                             <a href="index-4.html" type="submit" class="main-btn boxed">Subscribe Now</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Feature Section -->

     <div class="about-area sky-bg section-padding">
         <div class="container">
             <div class="row no-gutters">
                 <div class="col-lg-5">
                     <div class="mt-10"></div>
                     <div class="about-bg-wrapper wow fadeInUp" data-wow-delay=".2s">
                         <div class="about-bg-innner bg-cover"></div>
                     </div>
                 </div>
                 <div class="col-lg-7">
                     <div class="about-content-wrapper wow fadeInUp" data-wow-delay=".4s">
                         <div class="section-title">
                             <h5>Feature</h5>
                             <h2>Great Experience in
                                 Cargo Service</h2>
                         </div>
                         <p>Logistics ennovation for freight plan Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos natus ipsam ea vero placeat? Quia consequuntur odio nemo incidunt, perferendis. </p>
                         <div class="row">
                             <div class="col-lg-6 col-md-6 col-12">
                                 <div class="key-feature">
                                     <div class="row no-gutters">
                                         <div class="col-lg-4">
                                             <div class="about-icon">
                                                 <img src="{{ asset('front/img/icon/speed.png') }}" alt="">
                                             </div>
                                         </div>
                                         <div class="col-lg-12">
                                             <h4>Fast Delivery</h4>
                                             <p>Quick Delivery is first priorities in cousumer goods.</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-6 col-md-6 col-12">
                                 <div class="key-feature">
                                     <div class="row no-gutters">
                                         <div class="col-lg-4">
                                             <div class="about-icon">
                                                 <img src="{{ asset('front/img/icon/shipping.png') }}" alt="">
                                             </div>
                                         </div>
                                         <div class="col-lg-12">
                                             <h4>Secured Services</h4>
                                             <p>Your package all time secured in any situation. </p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Quotation Section -->

     <div class="quotation-area section-padding">
         <div class="overlay-3"></div>
         <div class="container">
             <div class="row">
                 <div class="col-xl-12">
                     <div class="section-heading white">
                         <div class="section-title">
                             <h5>Quote</h5>
                             <h2>Get Free Quotation</h2>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-xl-12">
                     <div class="quotation-form">
                         <form action="https://capricorn-theme.net/exelsior/index.html">
                             <div class="row mt-none-30">
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="name"><i class="las la-user"></i></label>
                                         <input type="text" id="name" placeholder="Enter your name">
                                     </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="email"><i class="las la-envelope"></i></label>
                                         <input type="email" id="email" placeholder="Enter your email">
                                     </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="tel"><i class="las la-phone"></i></label>
                                         <input type="tel" id="tel" placeholder="Enter your phone">
                                     </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="address"><i class="las la-map-marker"></i></label>
                                         <input type="text" id="address" placeholder="Destination/Location">
                                     </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="cat"><i class="las la-arrow-down"></i></label>
                                         <input type="text" id="cat" placeholder="Select Courier Type">
                                     </div>
                                 </div>
                                 <div class="col-xl-4 col-lg-6 mt-30">
                                     <div class="form-group">
                                         <label for="date"><i class="las la-calendar"></i></label>
                                         <input type="date" id="date">
                                     </div>
                                 </div>
                             </div>
                             <div class="row justify-content-center">
                                 <div class="col-xl-4 col-lg-6 mt-50 text-center">
                                     <a href="quote.html" type="submit" class="main-btn white">Confirm Order<span class="icon yellow"><i class="las la-window-minimize"></i></span></a>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Team Section -->

     <div class="team-area section-padding">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-xl-6">
                     <div class="section-title text-center mb-50">
                         <h5>Team</h5>
                         <h2>Our Experts</h2>
                     </div>
                 </div>
             </div>
             <div class="row text-center">
                 <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay=".2s">
                     <div class="singel-team-box mt-30">
                         <div class="team-thumb mb-40">
                             <img src="{{ asset('front/img/team/1.jpg') }}" alt="">
                         </div>

                         <div class="team-content">
                             <h4 class="name mt-20">Mich Thomson</h4>
                             <span class="designation">Manager</span>
                             <div class="social-links mt-20">
                                 <a href="#0"><i class="lab la-facebook-f"></i></a>
                                 <a href="#0"><i class="lab la-twitter"></i></a>
                                 <a href="#0"><i class="lab la-behance"></i></a>
                                 <a href="#0"><i class="lab la-youtube"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay=".4s">
                     <div class="singel-team-box mt-30">
                         <div class="team-thumb mb-40">
                             <img src="{{ asset('front/img/team/2.jpg') }}" alt="">
                         </div>

                         <div class="team-content">
                             <h4 class="name">James Cameron</h4>
                             <span class="designation">Supervisor</span>
                             <div class="social-links mt-20">
                                 <a href="#0"><i class="lab la-facebook-f"></i></a>
                                 <a href="#0"><i class="lab la-twitter"></i></a>
                                 <a href="#0"><i class="lab la-behance"></i></a>
                                 <a href="#0"><i class="lab la-youtube"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay=".6s">
                     <div class="singel-team-box mt-30">
                         <div class="team-thumb mb-40">
                             <img src="{{ asset('front/img/team/3.jpg') }}" alt="">
                         </div>

                         <div class="team-content">
                             <h4 class="name">Josh Batlar</h4>
                             <span class="designation">Sr. Executive</span>
                             <div class="social-links mt-20">
                                 <a href="#0"><i class="lab la-facebook-f"></i></a>
                                 <a href="#0"><i class="lab la-twitter"></i></a>
                                 <a href="#0"><i class="lab la-behance"></i></a>
                                 <a href="#0"><i class="lab la-youtube"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay=".8s">
                     <div class="singel-team-box mt-30">
                         <div class="team-thumb mb-40">
                             <img src="{{ asset('front/img/team/4.jpg') }}" alt="">
                         </div>

                         <div class="team-content">
                             <h4 class="name">Albert Gill</h4>
                             <span class="designation">Relation Officer</span>
                             <div class="social-links mt-20">
                                 <a href="#0"><i class="lab la-facebook-f"></i></a>
                                 <a href="#0"><i class="lab la-twitter"></i></a>
                                 <a href="#0"><i class="lab la-behance"></i></a>
                                 <a href="#0"><i class="lab la-youtube"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Testimonial Area -->

     <div class="testimonial-area-2 blue-bg section-padding') }}">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-xl-10 text-center">
                     <div class="section-heading white">
                         <div class="section-title">
                             <h5>Testimonials</h5>
                             <h2>What Our Customers Say</h2>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-xl-12 wow fadeInUp" data-wow-delay=".2s">
                     <div class="testimonial-carousel owl-carousel">
                         <div class="single-testimonial">
                             <div class="thumb">
                                 <img src="{{ asset('front/img/testimonial/2.jpg') }}" alt="">
                                 <span class="icon"><i class="las la-check"></i></span>
                             </div>
                             <div class="content">
                                 <p>“ Exelsior has performed exceptionally well. Management staff makes frequent site visits to
                                     check the veracity of their performance. When additional services (they do much more than
                                     just deliver, they do maintenance, too) or adjustments to courier regimens were needed they
                                     were quick to tackle or amend changes with success ”</p>
                                 <div class="testimonial-meta mt-20">
                                     <h2 class="name">Robert D. William <span class="designation">Founder, Delta Logistics Co.</span></h2>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Blog Section -->
     <div class="news-area news-area-2 news-area-3 section-padding pb-0">
         <div class="container">
             <div class="row">
                 <div class="col-xl-4 col-lg-6 wow fadeInLeft" data-wow-delay=".2s">
                     <article class="postbox post format-image mt-50">
                         <div class="postbox-text">
                             <div class="postbox-thumb">
                                 <div class="overlay-2"></div>
                                 <a href="single-blog.html">
                                     <img src="{{ asset('front/img/blog/01.jpg') }}" alt="blog image">
                                 </a>
                             </div>
                             <span class="post-cat">Cargo</span>
                             <div class="postbox-content">
                                 <div class="post-meta mb-10">
                                     <a href="#0"><i class="las la-user"></i> By Admin </a>
                                     <a href="#0"><i class="las la-calendar-alt"></i> 24th March 2020</a>
                                 </div>
                                 <h4 class="blog-title">
                                     <a href="single-blog.html">Delivery package through our trained
                                         staff.</a>
                                 </h4>
                                 <a href="single-blog.html" class="inline-btn"><i class="las la-arrow-right"></i></a>
                             </div>
                         </div>
                     </article>
                 </div>

                 <div class="col-xl-4 col-lg-6 wow fadeInLeft" data-wow-delay=".4s">
                     <article class="postbox post format-image mt-50">
                         <div class="postbox-text">
                             <div class="postbox-thumb">
                                 <div class="overlay-2"></div>
                                 <a href="single-blog.html">
                                     <img src="{{ asset('front/img/blog/02.jpg') }}" alt="blog image">
                                 </a>
                             </div>
                             <span class="post-cat">Freight</span>
                             <div class="postbox-content">
                                 <div class="post-meta mb-10">
                                     <a href="#0"><i class="las la-user"></i> By Admin </a>
                                     <a href="#0"><i class="las la-calendar-alt"></i> 24th March 2020</a>
                                 </div>
                                 <h4 class="blog-title">
                                     <a href="single-blog.html">Domestic Courier useful lockdown situation</a>
                                 </h4>
                                 <a href="single-blog.html" class="inline-btn"><i class="las la-arrow-right"></i></a>
                             </div>
                         </div>
                     </article>
                 </div>

                 <div class="col-xl-4 col-lg-6 wow fadeInLeft" data-wow-delay=".6s">
                     <article class="postbox post format-image mt-50">
                         <div class="postbox-text">
                             <div class="postbox-thumb">
                                 <div class="overlay-2"></div>
                                 <a href="single-blog.html">
                                     <img src="{{ asset('front/img/blog/03.jpg') }}" alt="blog image">
                                 </a>
                             </div>
                             <span class="post-cat">Shipping</span>
                             <div class="postbox-content">
                                 <div class="post-meta mb-10">
                                     <a href="#0"><i class="las la-user"></i> By Admin </a>
                                     <a href="#0"><i class="las la-calendar-alt"></i> 24th March 2020</a>
                                 </div>
                                 <h4 class="blog-title">
                                     <a href="single-blog.html">Freight Cost increase day by day
                                         in crisis moment</a>
                                 </h4>
                                 <a href="single-blog.html" class="inline-btn"><i class="las la-arrow-right"></i></a>
                             </div>
                         </div>
                     </article>
                 </div>
             </div>
         </div>
     </div>

     <!-- Footer Up Area -->

     <div class="ftu-area">
         <div class="container">
             <div class="row">
                 <div class="col-xl-12 col-lg-12 col-md-12">
                     <div class="ftu-box pt-80 pb-80 pl-100 pr-100">
                         <div class="row align-items-center">
                             <div class="col-xl-6 col-lg-7">
                                 <h2 class="ftu-title"> <span>Want to Get quick delivery</span>
                                     Save Time &amp; Money</h2>
                             </div>
                             <div class="col-xl-6 col-lg-5 col-md-12">
                                 <div class="ftu-btns">
                                     <a href="quote.html" class="main-btn white">Get A Quote <span class="icon yellow"><i class="las la-globe"></i></span></a>
                                     <a href="contact.html" class="main-btn transparent blue">Appointment <span class="icon yellow"><i class="las la-calendar-alt"></i></span></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Footer Area -->
     <footer class="footer-area site-footer-2 sky-bg-2 pt-200 pb-0">
         <div class="container">
             <div class="row">
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                     <div class="footer-widget">
                         <h4 class="title">Our Services</h4>
                         <ul>
                             <li><a href="single-service.html"><i class="las la-angle-right "></i> Standard Courier</a></li>
                             <li><a href="single-service.html"><i class="las la-angle-right "></i> Express Courier</a></li>
                             <li><a href="single-service.html"><i class="las la-angle-right "></i> Door to Door Courier</a></li>
                             <li><a href="single-service.html"><i class="las la-angle-right "></i> International Courier</a></li>
                             <li><a href="single-service.html"><i class="las la-angle-right "></i> Pallet Courier</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
                     <div class="footer-widget service-menu">
                         <h4 class="title">Explore</h4>
                         <ul>
                             <li><a href="about.html"><i class="las la-angle-right "></i> About Company</a></li>
                             <li><a href="services.html"><i class="las la-angle-right "></i> Services</a></li>
                             <li><a href="price.html"><i class="las la-angle-right "></i> Pricing</a></li>
                             <li><a href="quote.html"><i class="las la-angle-right "></i> Quotation</a></li>
                             <li><a href="blog.html"><i class="las la-angle-right "></i> Our Blog</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-6 offset-xl-1 col-lg-6">
                     <div class="footer-widget footer-contact-widget">
                         <h4 class="title">Contact Us</h4>
                         <div class="footer-contact-info">
                             <div class="content">
                                 <p>16/A, Broklyn, New York, United States.</p>
                                 <a href="#0"><i class="las la-angle-right"></i> Get Direction</a>
                             </div>
                             <div class="box">
                                 <h2><span>Get Free Estimate</span>
                                     800-567-8990</h2>
                                 <span class="icon"><i class="las la-phone"></i></span>
                             </div>
                         </div>
                         <div class="footer-social-info">
                             <div class="content">
                                 <a class="mb-10" href="tel:800-567-8990"><span>T:</span> 800-567-8990</a>

                                 <a href="mailto:office@example.com"><span>E:</span> office@example.com</a>
                             </div>
                             <div class="social-links">
                                 <a href="#0"><i class="lab la-facebook-f"></i></a>
                                 <a href="#0"><i class="lab la-twitter"></i></a>
                                 <a href="#0"><i class="lab la-behance"></i></a>
                                 <a href="#0"><i class="lab la-linkedin"></i></a>
                                 <a href="#0"><i class="lab la-youtube"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-xl-12">
                     <div class="copyright mt-100 pt-30 pb-30 text-center">
                         <p>© 2022 Exelsior. All rights reserved.</p>
                     </div>
                 </div>
             </div>
         </div>
     </footer>

     <!-- Off-canvas Area-->

     <div class="extra-info">
         <div class="close-icon menu-close">
             <button>
                 <i class="las la-window-close"></i>
             </button>
         </div>
         <div class="logo-side mb-30">
             <a href="index-2.html" class="site-logo-2">
                 <img src="{{ asset('front/img/logo-white.png') }}" alt="">
             </a>
         </div>
         <div class="side-info">
             <div class="contact-list mb-40">
                 <h4>About Us</h4>
                 <p>We must explain to you how all seds this mistakens idea off denouncing pleasures and praising pain
                     was born and I will give you a completed accounts of
                     the system and expound.</p>
                 <div class="mt-30 mb-30">
                     <a href="contact.html" class="main-btn white">CONTACT US <span class="icon"><i class="las la-calendar-alt"></i></span></a>
                 </div>
             </div>
             <div class="contact-list mb-40">
                 <h4>Contact Info</h4>
                 <p><i class="las la-rocket"></i> <span>123/A, Miranda City Likaoli Prikano, Dope United States </span>
                 </p>
                 <p><i class="las la-phone"></i> <span>+0989 7876 9865 9</span> </p>
                 <p><i class="las la-envelope-open"></i><span>info@example.com</span></p>
             </div>
         </div>
     </div>

     <div class="offcanvas-overly"></div>

     <!-- Scroll Top Area -->
     <a href="#top" class="go-top"><i class="las la-angle-up"></i></a>


     <!-- Popper JS -->
     <script src="{{ asset('front/js/popper.min.js') }}"></script>
     <!-- Bootstrap JS -->
     <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
     <!-- Wow JS -->
     <script src="{{ asset('front/js/wow.min.js') }}"></script>
     <!-- Counter Up JS -->
     <script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
     <!-- Owl Carousel JS -->
     <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
     <!-- Magnific Popup JS -->
     <script src="{{ asset('front/js/magnific-popup.min.js') }}"></script>
     <!-- Sticky JS -->
     <script src="{{ asset('front/js/jquery.sticky.js') }}"></script>
     <!-- Nice Select JS -->
     <script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>
     <!-- Main JS -->
     <script src="{{ asset('front/js/main.js') }}"></script>

 </body>

</html>
