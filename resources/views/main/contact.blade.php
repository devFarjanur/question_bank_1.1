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
    <!-- Header End -->


    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Contact us</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Contact</a></li>
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--?  Contact Area start  -->
        <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">

                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="contact_process.php" method="post"
                            id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30"
                                            rows="9" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Message'"
                                            placeholder=" Enter Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                            placeholder="Enter Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Buttonwood, California.</h3>
                                <p>Rosemead, CA 91770</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+1 253 565 2365</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>support@colorlib.com</h3>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End -->
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
                                        This Website is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
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