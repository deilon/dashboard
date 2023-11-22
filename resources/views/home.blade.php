<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home | PoundForPound Fitness Gym </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/frontend_assets/img/icon/favicon.ico') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend_assets/css/style.css') }}">
</head>
<body class="black-bg">

<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{ asset('storage/frontend_assets/img/logo/loader_logo.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader End -->

<!-- Header Start -->
<header>
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('storage/frontend_assets/img/logo/logo.svg') }}" alt="company logo"></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu f-right d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href="{{ url('/#home') }}">Home</a></li>
                                <li><a href="{{ url('/#about') }}">About</a></li>
                                <li><a href="{{ url('/#pricing') }}">Pricing</a></li>
                                <li><a href="{{ url('/#gallery') }}">Gallery</a></li>
                                <li><a href="{{ url('announcements') }}">Announcements</a></li>
                                {{-- <li><a href="{{ url('contact') }}">Contact</a></li> --}}
                            </ul>
                        </nav>
                    </div>          
                    <!-- Header-btn -->
                    <div class="header-btns d-none d-lg-block f-right">
                        <a href="{{ url('register') }}" class="btn">Create Account</a>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<main>

<!-- slider Area Start -->
<div id="home" class="slider-area position-relative bg-success">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-10">
                        <div class="hero__caption">
                            <span data-animation="fadeInLeft" data-delay="0.1s">Unlock Your Potential,</span>
                            <h1 data-animation="fadeInLeft" data-delay="0.4s">One Pound at a time</h1>
                            <a href="{{ url('register') }}" class="border-btn hero-btn" data-animation="fadeInLeft" data-delay="0.8s">Create account and Login</a>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>
</div>
<!-- slider Area End -->

<!-- About Start -->
<section id="about" class="about-area2 fix pb-padding pt-50 pb-80">
    <div class="support-wrapper align-items-center">
        <div class="right-content2">
            <!-- img -->
            <div class="right-img wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                <img src="{{ asset('storage/frontend_assets/img/gallery/our-story.png') }}" alt="">
            </div>
        </div>
        <div class="left-content2">
            <!-- section tittle -->
            <div class="section-tittle2 mb-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="front-text">
                    <h2 class="">About US</h2>
                    <p>Pound for Pound Fitness was founded with a simple yet powerful vision: to
                        empower individuals to lead healthier, more fulfilling lives. Our journey
                        began in the heart of the Philippines, and today, we proudly stand as a
                        beacon of fitness excellence with multiple branches across the country.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End -->

<!-- Services -->
<section class="team-area fix pt-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-55 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                    <h2>What we Offer</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-cat text-center mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" >
                    <div class="cat-icon">
                        <img src="{{ asset('storage/frontend_assets/img/gallery/atheltic_training.png') }}" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Athletic Training</a></h5>
                        <p>Elevate your performance with specialized workouts designed to enhance agility, speed, and overall athletic prowess.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-cat text-center mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                    <div class="cat-icon">
                        <img src="{{ asset('storage/frontend_assets/img/gallery/cross_training.png') }}" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Cross Training</a></h5>
                        <p>Experience a dynamic fusion of varied exercises, promoting versatility and balanced fitness for a well-rounded physique.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-cat text-center mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                    <div class="cat-icon">
                        <img src="{{ asset('storage/frontend_assets/img/gallery/strength_and_conditioning.png') }}" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Strength and Conditioning</a></h5>
                        <p>Unlock your full potential through tailored programs that optimize strength, endurance, and flexibility for peak physical fitness.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-cat text-center mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                    <div class="cat-icon">
                        <img src="{{ asset('storage/frontend_assets/img/gallery/weight_loss.png') }}" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Weight Loss</a></h5>
                        <p>Embark on a transformative journey with personalized routines and expert guidance, sculpting a healthier, fitter you through effective weight loss strategies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services End -->

<!-- Gallery Area Start -->
<div id="gallery" class="gallery-area section-padding30 ">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-55 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                    <h2>Gallery</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery1.jpg') }});"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery2.jpg') }});"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery3.jpg') }});"></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery4.jpg') }});"></div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery5.jpg') }});"></div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <div class="box snake mb-30">
                    <div class="gallery-img big-img" style="background-image: url({{ asset('storage/frontend_assets/img/gallery/gallery6.jpg') }});"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gallery Area End -->

<!-- Pricing area start -->
<section id="pricing" class="pricing-area section-padding40 fix">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-55 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s">
                    <h2>Pricing</h2>
                </div>
                @if($activeArrangement->countdown === 'active')
                    <!-- Display the countdown timer -->
                    <div id="countdown" class="alert alert-dark text-center" style="font-size: 40px !important;" role="alert"></div>
                @endif
            </div>
        </div>
        <div class="row">
            @foreach($activeArrangement->subscriptionTiers as $tier)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="properties mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="properties__card">
                        <div class="about-icon">
                            <img src="{{ asset('storage/frontend_assets/img/icon/price.svg') }}" alt="">
                        </div>
                        <div class="properties__caption">
                            <div class="text-center">
                                <span class="month">{{ $tier->duration }}</span>
                                @if($activeArrangement->promo == 'yes')
                                    @php
                                    $basedArrangement = App\Models\SubscriptionArrangement::find(1);
                                    $regularTier = App\Models\SubscriptionTier::where('subscription_arrangement_id', $basedArrangement->id)->where('duration', $tier->duration)->first();
                                    @endphp
                                    <s class="text-white"><p class="mb-25 text-white">₱{{ ceil($regularTier->price) }}</p></s>
                                @endif
                                <p class="mb-25">₱{{ $tier->price }} <span>({{ strToUpper($tier->tier_name) }})</span></p>
                            </div>
                            <div class="single-features">
                                <div class="features-icon">
                                    <img src="{{ asset('storage/frontend_assets/img/icon/check.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <p>Unlimited Sessions </p>
                                </div>
                            </div>
                            <div class="single-features">
                                <div class="features-icon">
                                    <img src="{{ asset('storage/frontend_assets/img/icon/check.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <p>Trainer Included</p>
                                </div>
                            </div>
                            <div class="single-features">
                                <div class="features-icon">
                                    <img src="{{ asset('storage/frontend_assets/img/icon/check.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <p>No Hidden Charges</p>
                                </div>
                            </div>
                            <div class="single-features">
                                <div class="features-icon">
                                    <img src="{{ asset('storage/frontend_assets/img/icon/check.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <p>All Access to Utilities</p>
                                </div>
                            </div>
                            <div class="single-features mb-20">
                                <div class="features-icon">
                                    <img src="{{ asset('storage/frontend_assets/img/icon/check.svg') }}" alt="">
                                </div>
                                <div class="features-caption">
                                    <p>All Access to Gym Equipments</p>
                                </div>
                            </div>
                            <a href="{{ url('register') }}" class="border-btn border-btn2">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Pricing area End -->

<!-- Promotion/Announcement Start -->
<section id="announcements" class="home-blog-area pt-10 pb-50">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row text-center">
            <div class="col">
                <div class="section-tittle text-center mb-100 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".2s">
                    <h2>Announcements</h2>
                </div>
            </div>
        </div>
        @if($aps)
            <div class="row">
                @foreach($aps as $ap)
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    @if($ap->photo)
                                        <img src="{{ asset('storage/assets/img/layouts/'.$ap->photo) }}" alt="">
                                    @else
                                        <img src="{{ asset('storage/assets/img/layouts/default_announcement.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="blog-cap">
                                    <div>
                                        <span>{{ $ap->ap_tag }}</span>
                                        <span class="float-right">{{ $ap->created_at->format('F j, Y') }}</span>
                                    </div>
                                    <h3><a href="#">{{ $ap->ap_title }}</a></h3>
                                    @if($ap->ap_description)
                                        <p class="text-white">{{ ucfirst($ap->ap_description) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- Promotion/Announcement End -->


<!-- services-area -->
<section class="services-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-40 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                    <div class="features-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="m9 6.882-7-3.5v13.236l7 3.5 6-3 7 3.5V7.382l-7-3.5-6 3zM15 15l-6 3V9l6-3v9z"></path></svg>
                    </div>
                    <div class="features-caption">
                        <h3>Location</h3>
                        <p>320 alabang-zapote road 1700 Las Piñas, Philippines</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-40 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="features-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z"></path></svg>
                    </div>
                    <div class="features-caption">
                        <h3>Phone</h3>
                        <p>(+63) 915 408 0808</p>
                        <p>(+63) 915 408 0808</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                <div class="single-services mb-40 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".4s">
                    <div class="features-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="m18.73 5.41-1.28 1L12 10.46 6.55 6.37l-1.28-1A2 2 0 0 0 2 7.05v11.59A1.36 1.36 0 0 0 3.36 20h3.19v-7.72L12 16.37l5.45-4.09V20h3.19A1.36 1.36 0 0 0 22 18.64V7.05a2 2 0 0 0-3.27-1.64z"></path></svg>
                    </div>
                    <div class="features-caption">
                        <h3>Email</h3>
                        <p>poundforpoundbgcfort@gmail.com</p>
                        <p>p4pmendiola@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<!-- Footer Start-->
<footer> 
    <div class="footer-area black-bg">
        <div class="container">
            <div class="footer-top footer-padding">
                <!-- Footer Menu -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-footer-caption mb-50 text-center">
                            <!-- logo -->
                            <div class="footer-logo wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                <a href="index.html"><img src="{{ asset('storage/frontend_assets/img/logo/footer_logo.png') }}" alt=""></a>
                            </div>
                            <!-- Menu -->
                            <!-- Header Start -->
                            <div class="header-area main-header2 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".4s">
                                <div class="main-header main-header2">
                                    <div class="menu-wrapper menu-wrapper2">
                                        <!-- Main-menu -->
                                        <div class="main-menu main-menu2 text-center">
                                            <nav>
                                                <ul>
                                                    <li><a href="index.html">Home</a></li>
                                                    <li><a href="about.html">About</a></li>
                                                    <li><a href="pricing.html">Pricing</a></li>
                                                    <li><a href="gallery.html">Gallery</a></li>
                                                    <li><a href="gallery.html">Announcements</a></li>
                                                </ul>
                                            </nav>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <!-- Header End -->
                            <!-- social -->
                            <div class="footer-social mt-30 wow fadeInUp" data-wow-duration="3s" data-wow-delay=".8s">
                                <a href="https://www.x.com"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/poundforpoundfitnessph"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/poundforpoundfitness/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-12">
                        <div class="footer-copy-right text-center">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved - Created By Group 8</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End-->

<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-arrow-up"></i></a>
</div>

<!-- JS here -->

<script src="{{ asset('storage/frontend_assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('storage/frontend_assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/bootstrap.min.js') }}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ asset('storage/frontend_assets/js/jquery.slicknav.min.js') }}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('storage/frontend_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/slick.min.js') }}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{ asset('storage/frontend_assets/js/wow.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/animated.headline.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.magnific-popup.js') }}"></script>

<!-- Date Picker -->
<script src="{{ asset('storage/frontend_assets/js/gijgo.min.js') }}"></script>
<!-- Nice-select, sticky -->
<script src="{{ asset('storage/frontend_assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.sticky.js') }}"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="{{ asset('storage/frontend_assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.countdown.min.js') }}"></script>
<script src="./assets/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="{{ asset('storage/frontend_assets/js/contact.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/mail-script.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="{{ asset('storage/frontend_assets/js/plugins.js') }}"></script>
<script src="{{ asset('storage/frontend_assets/js/main.js') }}"></script>

@if ($activeArrangement->countdown === 'active')
  <script>
    // Get the start and end dates from Blade (replace with your actual Blade variables)
    var startDate = new Date("{{ $activeArrangement->start_date }}");
    var endDate = new Date("{{ $activeArrangement->end_date }}");

    // Function to update the countdown display
    function updateCountdown() {
        // Get the current date and time
        var now = new Date();

        // Calculate the time difference between now and the end date
        var timeDifference = endDate - now;

        // Check if the countdown has reached zero or is negative
        if (timeDifference <= 0) {
            // Stop the countdown and update the display
            clearInterval(countdownInterval);
            $("#countdown").html("Countdown expired!");
        } else {
            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Update the countdown display
            $("#countdown").html("<span style='font-weight: 700 !important;'>{{ ucwords($activeArrangement->arrangement_name) }}</span> Ends in " + days + "d " + hours + "h " + minutes + "m " + seconds + "s");
        }
    }

    // Update the countdown every second
    var countdownInterval = setInterval(updateCountdown, 1000);
  </script>
@endif

</body>
</html>