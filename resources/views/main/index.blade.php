<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Skill Training</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="backend/assets/img1/favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/progressbar_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css1/style.css') }}">


</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('backend/assets/img1/logo/loder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="">
                                    <h1 class="text-white">LOGO</h1>
                                    <!-- <a href="{{ route('home') }}"><img
                                            src=" {{ asset('backend/assets/img1/logo/logo.png') }} " alt=""></a> -->
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                                <li><a href="{{ route('course') }}">Courses</a></li>
                                                <li><a href="{{ route('about') }}">About</a></li>
                                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                                <!-- Button -->
                                                <li class="button-header margin-left "><a href="{{ route('login') }}"
                                                        class="btn">Log in</a></li>
                                                <li class="button-header"><a href="/register"
                                                        class="btn btn3">Register</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!--? slider Area Start-->
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                                    <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses and exams
                                    </p>
                                    <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Join
                                        for Free</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ? services-area -->
        <div class="services-area">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="backend/assets/img1/icon/icon1.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>10+ courses</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="backend/assets/img1/icon/icon2.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Expert instructors</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="backend/assets/img1/icon/icon3.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Life time access</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our courses</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    @foreach($courses as $course)
                        <!-- Single Course -->
                        <div class="properties pb-20">
                            <div class="properties__card">
                                <div class="properties__caption">
                                    <h3><a href="#">{{ $course->name }}</a></h3>
                                    <p>{{ $course->description }}</p>
                                    <div class="properties__footer d-flex justify-content-between align-items-center">
                                        <!-- Add any additional information here -->
                                    </div>
                                    <a href="/register" class="border-btn border-btn2">Register</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Courses area End -->
         
        <!--? About Area-1 Start -->
        <section class="about-area1 fix pt-10 mb-5">
            <div class="support-wrapper align-items-center">
                <div class="left-content1">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-55">
                        <div class="front-text">
                            <h2 class="">Learn new skills online with top educators</h2>
                            <p>The automated process all your website tasks. Discover tools and
                                techniques to engage effectively with vulnerable children and young
                                people.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="backend/assets/img1/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Techniques to engage effectively with vulnerable children and young people.</p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="backend/assets/img1/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Join millions of people from around the world learning together.</p>
                        </div>
                    </div>

                    <div class="single-features">
                        <div class="features-icon">
                            <img src="backend/assets/img1/icon/right-icon.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <p>Join millions of people from around the world learning together. Online learning is as
                                easy and natural.</p>
                        </div>
                    </div>
                </div>
                <div class="right-content1">
                    <!-- img -->
                    <div class="right-img">
                        <img src="backend/assets/img1/gallery/about.png" alt="">

                        <div class="video-icon">
                            <a class="popup-video btn-icon"
                                href="https://youtu.be/0FFLFcB9xfQ"
                                target="_blank">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- top subjects End -->

        <!--? Team -->
        <!-- Team area start -->
        <section class="team-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Community experts</h2>
                        </div>
                    </div>
                </div>
                <div class="team-active">
                    @foreach($courses as $course)
                        @foreach($course->questioncreators as $questioncreator)
                            <div class="single-cat text-center">
                                <div class="cat-icon">
                                    <img src="{{ asset('backend/assets/img1/gallery/team.jpg') }}" alt="Teacher Image">
                                </div>
                                <div class="cat-cap">
                                    <h5><a href="services.html">{{ $questioncreator->name }}</a></h5>
                                    <p>{{ $questioncreator->email }}</p>
                                    <!-- Add any additional information here -->
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Services End -->
        <!--? About Area-2 Start -->
        <section class="about-area2 fix pb-padding">
            <div class="support-wrapper align-items-center">
                <div class="right-content2">
                    <!-- img -->
                    <div class="right-img">
                        <img src="backend/assets/img1/gallery/about2.png" alt="">
                    </div>
                </div>
                <div class="left-content2">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">Take the next step
                                toward your personal
                                and professional goals
                                with us.</h2>
                            <p>The automated process all your website tasks. Discover tools and techniques to engage
                                effectively with vulnerable children and young people.</p>
                            <a href="#" class="btn">Join now for Free</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
    </main>
    <footer>
        <div class="footer-wrappper footer-bg">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="mb-25">
                                        <h1 class="text-white">LOGO</h1>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>The automated process starts as soon as your clothes go into the machine.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Our Pages</h4>
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Courses</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Log in</h4>
                                    <ul>
                                        <li><a href="#">Admin</a></li>
                                        <li><a href="#">Teacher</a></li>
                                        <li><a href="#">Student</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Registration</h4>
                                    <ul>
                                        <li><a href="#">Teacher</a></li>
                                        <li><a href="#">Student</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                        Copyright &copy;
                                        <script>document.write(new Date().getFullYear());</script> All rights reserved |
                                        This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                            href="https://colorlib.com" target="_blank">Farjanur Rahman Fahim</a>
                                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS Files -->
    <script src="{{ asset('backend/assets/js1/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/slick.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/wow.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/animated.headline.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/gijgo.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.sticky.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.barfiller.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/hover-direction-snake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/contact.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.form.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/mail-script.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/plugins.js') }}"></script>
    <script src="{{ asset('backend/assets/js1/main.js') }}"></script>


</body>

</html>