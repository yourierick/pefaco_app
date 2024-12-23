    <!doctype html>
    <html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="Site keywords here">
        <meta name="description" content="">
        <meta name='copyright' content=''>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset('css/nicepage/Accueil.css') }}" media="screen">
        <script class="u-script" type="text/javascript" src="{{ asset('css/nicepage/nicepage.js') }}" defer=""></script

        <!-- Title -->
        <title>Eglise pefaco universelle</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('css/css_vendor_public/img/favicon.png') }}">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
            rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/bootstrap.min.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/nice-select.css') }}">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/font-awesome.min.css') }}">
        <!-- icofont CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/icofont.css') }}">
        <!-- Slicknav -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/slicknav.min.css') }}">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/owl-carousel.css') }}">
        <!-- Datepicker CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/datepicker.css') }}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/animate.min.css') }}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/magnific-popup.css') }}">

        <!-- Medipro CSS -->
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/css_vendor_public/css/responsive.css') }}">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

        <style>
            .carousel-control-prev, .carousel-control-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                z-index:10;
            }
            .single-service .apropos {
                content:"";
                left:0;
                bottom:0;
                height:1px;
                width:0%;
                color: #2b73d5;
            }
            .apropos:hover{
                color: #1818ec;
                text-decoration: underline;
                -webkit-transition:all 0.4s ease;
                -moz-transition:all 0.4s ease;
                transition:all 0.4s ease;
            }
        </style>

    </head>
    <body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->
    <!-- Get Pro Button -->
    <ul class="pro-features">
        <a class="get-pro" href="#">MENU</a>
        <div class="button">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn connexion">Dashboard</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn deconnexion">
                            Déconnextion
                        </button>
                    </form>
                @else
                    <a href='{{ route ('login') }}' class="btn connexion">Connexion</a>
                @endauth
            @endif
        </div>
    </ul>

    <!-- Header Area -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                        <!-- Contact -->
                        <ul class="top-link">
                            <li><a href="#">A propos de nous!</a></li>
                            <li><a href="#">Nous contacter</a></li>
                        </ul>
                        <!-- End Contact -->
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <!-- Top Contact -->
                        <ul class="top-contact">
                            <li><i class="fa fa-phone"></i>+243 892 343 567</li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">eglise.pefaco.universelle@gmail.com</a>
                            </li>
                        </ul>
                        <!-- End Top Contact -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="index.html"><img style="width: 130px; height: 100px;" src="{{ asset('css/images/logo.jpg') }}" alt="#"></a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li class="active"><a href="#">Accueil <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">accueil</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">A propos de nous! </a></li>
                                        <li><a href="#">Communiqués </a></li>
                                        <li><a href="#">Actualités <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="#">Annonces et publicités</a></li>
                                                <li><a href="#">Report</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->

    <!-- Slider Area -->
    <section class="mt-3">
        <div class="slider">
            <div class="single-slider" style="background-image:url('{{ asset('css/images/home_0.jpg') }}')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="verset text">
                                <h1 style="color: #FFFFFF">Jesus Christ<span> est le même</span>, hier, aujourd'hui et éternellement</h1>
                                <p style="color: white; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5)">Elle est venue
                                    chez les siens, et les siens ne l'ont point reçue. Mais à tous ceux qui l'ont
                                    reçue, à ceux qui croient en son nom, elle a donné le pouvoir de devenir enfants
                                    de Dieu, lesquels sont nés, non du sang, ni de la volonté de la chair,
                                    ni de la volonté de l'homme, mais de Dieu" (Jean 1:11-13)</p>
                                <div class="button">
                                    <a href="#" class="btn">Nous contacter</a>
                                    <a href="#" class="btn primary">Faire un don</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--/ End Slider Area -->

    <!-- Start Schedule Area -->
    <section class="schedule">
        <div class="container">
            <div class="schedule-inner">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 ">
                        <!-- single-schedule -->
                        <div class="shadow single-schedule first">
                            <div class="inner">
                                <div class="icon">
                                    <i class="icofont-prescription"></i>
                                </div>
                                <div class="single-content">
                                    <span>Calendrier hebdomadaire des cultes</span>
                                    <h4 style="font-weight: bold;">Nos programmes de culte</h4>
                                    <hr style="border: 1px solid #1A76D1">
                                    <p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis
                                        sodales.</p>
                                    <a href="#">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- single-schedule -->
                        <div class="single-schedule middle">
                            <div class="inner">
                                <div class="icon">
                                    <i class="icofont-prescription"></i>
                                </div>
                                <div class="single-content">
                                    <span>Service Hebdomadaire</span>
                                    <h4 style="font-weight: bold;">Programme de service</h4>
                                    <hr style="border: 1px solid #1A76D1">
                                    <p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis
                                        sodales.</p>
                                    <a href="#">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- single-schedule -->
                        <div class="single-schedule last">
                            <div class="inner">
                                <div class="icon">
                                    <i class="icofont-ui-clock"></i>
                                </div>
                                <div class="single-content">
                                    <span>Voulez-vous consulter le pasteur?</span>
                                    <h4 style="font-weight: bold;">Disponibilité</h4>
                                    <hr style="border: 1px solid #1A76D1">
                                    <ul class="time-sidual">
                                        <li class="day" style="color: black">Monday - Fridayp <span>8.00-20.00</span></li>
                                        <li class="day" style="color: black">Saturday <span>9.00-18.30</span></li>
                                        <li class="day" style="color: black">Monday - Thusday <span>9.00-15.00</span></li>
                                    </ul>
                                    <a href="#">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/End Start schedule Area -->

    <!-- Start Feautes -->
    <section class="why-choose section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Eco de nos activités</h2>
                        <h4><span>A la une!</span></h4>
                        <p>Restez dans l'actualité de ce qui se passe!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Left -->
                    <div class="choose-left">
                        <h3>Culte de louange et adoration qui a eu lieu du 10 au 14 juillet 2024</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                            est lobortis, a commodo magna rhoncus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.In quis nisi non emet quam pharetra commodo.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                            est lobortis, a commodo magna rhoncus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.In quis nisi non emet quam pharetra commodo.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.
                        </p>
                    </div>
                    <!-- End Choose Left -->
                </div>
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Rights -->
                    <div class="choose-right">
                        <div class="video-image">
                            <div id="carouselExample1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExample1" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExample1" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExample1" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('css/images/note_10.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <video class="d-block w-100" controls style="max-height: 350px">
                                            <source src="{{ asset('css/images/actes.mp4') }}">
                                            impossible de lire cette vidéo sur ce navigateur
                                        </video>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('css/images/note_13.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('css/images/photo_4.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="color: #0b0b0b"></span>
                                    <span class="sr-only">précédent</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true" style="color: #0b0b0b"></span>
                                    <span class="sr-only">suivant</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Choose Rights -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Left -->
                    <div class="choose-left">
                        <h3>Culte de louange et adoration qui a eu lieu du 10 au 14 juillet 2024</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                            est lobortis, a commodo magna rhoncus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.In quis nisi non emet quam pharetra commodo.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                            est lobortis, a commodo magna rhoncus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.In quis nisi non emet quam pharetra commodo.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos.
                        </p>
                    </div>
                    <!-- End Choose Left -->
                </div>
                <div class="col-lg-6 col-12">
                    <!-- Start Choose Rights -->
                    <div class="choose-right">
                        <div class="video-image">
                            <div id="carouselExample2" class="carousel slide" data-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExample2" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExample2" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExample2" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('css/images/note_10.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <video class="d-block w-100" controls style="max-height: 350px">
                                            <source src="{{ asset('css/images/actes.mp4') }}">
                                            impossible de lire cette vidéo sur ce navigateur
                                        </video>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('css/images/note_13.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('css/images/photo_4.jpg') }}" style="max-height: 350px"
                                             class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample2" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="color: #0b0b0b"></span>
                                    <span class="sr-only">précédent</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample2" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true" style="color: #0b0b0b"></span>
                                    <span class="sr-only">suivant</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Choose Rights -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Feautes -->

    <!-- Start Fun-facts -->
    <div id="fun-facts" class="fun-facts section overlay">
        <div style="text-align: center" class="p-2">
            <h1 style="margin-bottom: 50px; color: #fff; position: relative; z-index: 2">Communiqués</h1>
            <p style="margin-bottom: 70px; color: #fff; text-align: justify; position: relative; z-index: 2">Class aptent
                taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                est lobortis, a commodo magna rhoncus.
                Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                per inceptos himenaeos.In quis nisi non emet quam pharetra commodo.
                Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                per inceptos himenaeos.</p>
        </div>
    </div>
    <!--/ End Fun-facts -->

    <!-- Start Why choose -->
    <section class="why-choose section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Annonces et publicités</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                    </div>
                </div>
            </div>
            <div id="carouselAnnonceIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselAnnonceIndicators" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselAnnonceIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselAnnonceIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner p-3" style="background-color: #cdd6f6">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Left -->
                                <div class="choose-left">
                                    <h3>Culte de louange et d'adoration prévu ce dim 15 septembre 2024</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                                        est lobortis, a commodo magna rhoncus. In quis nisi non emet quam pharetra
                                        commodo. </p>
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                        himenaeos. </p>
                                </div>
                                <!-- End Choose Left -->
                            </div>
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Rights -->
                                <div class="choose-right">
                                    <div class="video-image">
                                        <img class="w-100" src="{{ asset('css/images/affiche.png') }}"
                                             style="max-height: 400px">
                                    </div>
                                </div>
                                <!-- End Choose Rights -->
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Left -->
                                <div class="choose-left">
                                    <h3>Culte de louange et d'adoration prévu ce dim 15 septembre 2024</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                                        est lobortis, a commodo magna rhoncus. In quis nisi non emet quam pharetra
                                        commodo. </p>
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                        himenaeos. </p>
                                </div>
                                <!-- End Choose Left -->
                            </div>
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Rights -->
                                <div class="choose-right">
                                    <div class="video-image">
                                        <img class="w-100" src="{{ asset('css/images/affiche.png') }}"
                                             style="max-height: 400px">
                                    </div>
                                </div>
                                <!-- End Choose Rights -->
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Left -->
                                <div class="choose-left">
                                    <h3>Culte de louange et d'adoration prévu ce dim 15 septembre 2024</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pharetra antege vel
                                        est lobortis, a commodo magna rhoncus. In quis nisi non emet quam pharetra
                                        commodo. </p>
                                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                        himenaeos. </p>
                                </div>
                                <!-- End Choose Left -->
                            </div>
                            <div class="col-lg-6 col-12">
                                <!-- Start Choose Rights -->
                                <div class="choose-right">
                                    <div class="video-image">
                                        <img class="w-100" src="{{ asset('css/images/affiche.png') }}"
                                             style="max-height: 400px">
                                    </div>
                                </div>
                                <!-- End Choose Rights -->
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselAnnonceIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselAnnonceIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!--/ End Why choose -->

    <!-- Start service -->
    <section class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>A propos de nous!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus dictum eros ut imperdiet. adipiscing elit. Donec luctus dictum eros ut imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-prescription"></i>
                        <h4><a href="service-details.html">Historique</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bx-bible'></i>
                        <h4><a href="service-details.html">Notre mission</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-eye-alt"></i>
                        <h4><a href="service-details.html">Notre vision</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bxs-church'></i>
                        <h4><a href="service-details.html">Notre communauté</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bx-landscape'></i>
                        <h4><a href="service-details.html">Localisation</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">..EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bxs-user'></i>
                        <h4><a href="service-details.html">Pasteur responsable</a></h4>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. DonecLorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Donec luctus dictum eros ut Donec Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            <a href="#" class="apropos">EN SAVOIR PLUS</a></p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End service -->

    <!-- Start portfolio -->
    <section class="portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Les serviteurs au sein de l'église en leurs titres et qualités</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="owl-carousel portfolio-slider">
                        <div class="single-pf shadow">
                            <div class="d-block">
                                <img src="{{ asset('css/images/photo_3.jpg') }}" alt="#">
                                <div class="details">
                                    <p style="font-weight: bold; color: #0a58ca">#FARAJA AHADI</p><br>
                                    <p>Voici les détails de l'image. Vous pouvez ajouter plus d'informations ici.</p>
                                    <p class="small text-muted">Contacts: 099349292/0893728473</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-pf shadow">
                            <div class="d-block">
                                <img src="{{ asset('css/images/note_5.jpg') }}" alt="#">
                                <div class="details">
                                    <p style="font-weight: bold; color: #0a58ca">#WABINGWA RAMESH</p><br>
                                    <p>Voici les détails de l'image. Vous pouvez ajouter plus d'informations ici.</p>
                                    <p class="small text-muted">Contacts: 099349292/0893728473</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-pf shadow">
                            <div class="d-block">
                                <img src="{{ asset('css/images/note_7.jpg') }}" alt="#">
                                <div class="details">
                                    <p style="font-weight: bold; color: #0a58ca">#WABINGWA RAMESH</p><br>
                                    <p>Voici les détails de l'image. Vous pouvez ajouter plus d'informations ici.</p>
                                    <p class="small text-muted">Contacts: 099349292/0893728473</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-pf shadow">
                            <div class="d-block">
                                <img src="{{ asset('css/images/note_5.jpg') }}" alt="#">
                                <div class="details">
                                    <p style="font-weight: bold; color: #0a58ca">#WABINGWA RAMESH</p><br>
                                    <p>Voici les détails de l'image. Vous pouvez ajouter plus d'informations ici.</p>
                                    <p class="small text-muted">Contacts: 099349292/0893728473</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End portfolio -->

    <section class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Enseignements et prédications</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                    </div>
                </div>
            </div>
            <div>
                <!-- Single Table -->
                <div class="col-12">
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="icon">
                                <i class='bx bxs-bible' ></i>
                            </div>
                            <h4 class="title">Thème: "La gloire de la dernière maison"</h4>
                            <div class="price">
                                <p class="amount"><span>Agée 2:9</span></p>
                            </div>
                        </div>
                        <div>
                            <p>
                            « La gloire de cette dernière maison sera plus grande que celle de la première, dit l’Éternel des armées; Et c’est dans ce lieu que je donnerai la paix, dit l’Éternel des armées. » Agée 2 :9
                            Ce thème tourne autour de 3 points :
                            Qui est le temple ou c’est quoi le temple ?
                            Dans 1 Corinthiens 3 :16 la Bible déclare : « Ne savez-vous pas que vous êtes le temple de Dieu, et que l’Esprit de Dieu habite en vous? » Et 2 Corinthiens 6 :16 dit : « Quel rapport y a-t-il entre le temple de Dieu et les idoles? Car nous sommes le temple du Dieu vivant, comme Dieu l’a dit: J’habiterai et je marcherai au milieu d’eux; je serai leur Dieu, et ils seront mon peuple. » Le temple dont il est question ici est toute personne ayant reçu Christ comme Seigneur et Sauveur personnel de sa vie. Dieu dans toute Sa sainteté demeure dans un temple saint et lorsque nous donnons nos vies à Christ, nous devenons des nouvelles créatures (2 Corinthiens 5 :17) ;  une propriété privée de Dieu dans toute sa plénitude. Les tares de l’ancienne maison doivent passer afin de vivre la gloire de la seconde maison.
                            La plénitude pour accomplir la mission
                            Dieu savait que pour accomplir Sa mission dans ce monde, nous aurons besoin du Saint-Esprit. C’est pourquoi, dès la nouvelle naissance, il nous scelle de Son Esprit. L’Esprit de Dieu habite en nous dès que nous recevons Christ dans nos vies selon Ephésiens 1 :13-14 qui dit : « en qui vous aussi, ayant entendu la parole de la vérité, l’Evangile de votre salut, et ayant cru en lui, vous avez été scellés du Saint-Esprit de la promesse, lequel est les arrhes de notre héritage, jusqu’à la rédemption de ceux qu’il s’est acquis, à la louange de sa gloire. »
                            Nous avons une tâche à accomplir en considérant les 4 évangiles et les livres des Actes. A savoir  Matthieu 28 : 19-20, Marc 16 :15 ; Luc 24 : 47 ; Jean 20 :21 et Actes 1 :8.
                            Nous sommes défaitistes dans la mission parce que nous ne donnons pas au Saint-Esprit la place qu’il Lui faut.
                            Le Saint-Esprit nous aide à accomplir la mission sous l’onction afin de vaincre.
                            Selon 1 Corinthiens 3 :9, nous sommes co-ouvriers dans l’œuvre mais souvent nous l’oublions et négligeons notre travail dans la mission. Pour que la seconde maison jouisse de la gloire, elle doit se rendre disponible.
                            La manifestation de la gloir
                            Dieu a un seul désir, que Sa gloire se manifeste dans nos vies. Dans Lévitique 9 :6 Moïse dit: « Vous ferez ce que l’Éternel a ordonné; et la gloire de l’Éternel vous apparaîtra. »
                            2 Chroniques 5 :13-14 déclare : « et lorsque ceux qui sonnaient des trompettes et ceux qui chantaient, s’unissant d’un même accord pour célébrer et pour louer l’Éternel, firent retentir les trompettes, les cymbales et les autres instruments, et célébrèrent l’Éternel par ces paroles : Car il est bon, car sa miséricorde dure à toujours ! en ce moment, la maison de l’Éternel fut remplie d’une nuée. Les sacrificateurs ne purent pas y rester pour faire le service, à cause de la nuée ; car la gloire de l’Éternel remplissait la maison de Dieu. »
                            La gloire de Dieu est sur le point d’éclater sur nous à cause de notre communion avec Dieu.
                            Quelles sont les exigences pour jouir de la manifestation de la gloire de Dieu  ?
                            L’obéissance (1 Samuel 15 :22)
                            La manifestation de la gloire de Dieu exige que nous puissions vivre dans l’obéissance ;
                            La mise en pratique et l’exécution (Romains 2 :13 et Galates 3 :10-12) ;
                            Vivre dans la louange, l’adoration et la confiance en Dieu.
                            Psaumes 143 :10 dit : « Enseigne-moi à faire Ta volonté, car tu es mon Dieu. Que ton bon Esprit me conduise sur une voie unie. »</p>
                        </div>
                        <!-- Table List -->
                        <div class="table-bottom">
                            <a class="btn btn-primary" href="#">Voir plus</a>
                        </div>
                        <!-- Table Bottom -->
                    </div>
                </div>
                <!-- End Single Table-->
            </div>
        </div>
    </section>

    <!-- Start Appointment -->
    <section class="appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Nous écrire!</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit praesent aliquet. pretiumts</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <form class="form" action="#">
                        <div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="nom" type="text" placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="telephone" type="text" placeholder="téléphone">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" placeholder="Ecrivez votre message ici....."></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="button">
                                        <button type="submit" class="btn btn-primary"><span><i class='bx bx-send' ></i> Envoyer</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Appointment -->

    <!-- Start Newsletter Area -->
    <section class="newsletter section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6  col-12">
                    <!-- Start Newsletter Form -->
                    <div class="subscribe-text ">
                        <h6>Vous inscrire au bulletin d'information</h6>
                        <p class="">Inscrivez-vous à notre bulletin d'information pour recevoir <br>toutes nos actualités dans votre boîte mail</p>
                    </div>
                    <!-- End Newsletter Form -->
                </div>
                <div class="col-lg-6  col-12">
                    <!-- Start Newsletter Form -->
                    <div class="subscribe-form ">
                        <form action="#" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Votre adresse mail" class="common-input"
                                   onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Votre adresse mail'" required type="email">
                            <button class="btn">Souscrire</button>
                        </form>
                    </div>
                    <!-- End Newsletter Form -->
                </div>
            </div>
        </div>
    </section>
    <!-- /End Newsletter Area -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Localisation</h2>
                            <p>On est situé sur avenue la voix; quartier muhungu; commune de Kadutu; dans la ville de
                                Bukavu; province du Sud-Kivu; en République Démocratique du Congo; tout juste en face de
                                l'entrée EDAP/ISP</p>
                            <!-- Social -->
                            <ul class="social">
                                <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                                <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                <li><a href="#"><i class="icofont-vimeo"></i></a></li>
                                <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                            </ul>
                            <!-- End Social -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h2>Liens rapides</h2>
                            <div>
                                <div class="col-12">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Accueil</a></li>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>A propos de nous</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Nous contacter</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Communiqués</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Actualités</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Horaire de disponibilité</h2>
                            <p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
                            <ul class="time-sidual">
                                <li class="day">Lundi- Vendredi <span>16.00-20.00</span></li>
                                <li class="day">Samedi <span>8.00-10.00</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Bulletin d'information</h2>
                            <p>Inscrivez-vous à notre newsletter pour recevoir toutes nos actualités dans votre boîte mail</p>
                            <form action="#" method="get" target="_blank" class="newsletter-inner">
                                <input name="email" placeholder="Adresse mail" class="common-input"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Adresse mail'" required type="email">
                                <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>© Copyright 2024 | Tous droits reservés par <a href="#"
                                                                            target="_blank">yourierick00@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Copyright -->
    </footer>
    <!--/ End Footer Area -->

    <!-- jquery Min JS -->
    <script src="{{ asset('js/js/jquery.min.js') }}"></script>
    <!-- jquery Migrate JS -->
    <script src="{{ asset('js/js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- jquery Ui JS -->
    <script src="{{ asset('js/js/jquery-ui.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('js/js/easing.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('js/js/colors.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('js/js/popper.min.js') }}"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="j{{ asset('js/js/bootstrap-datepicker.js') }}"></script>
    <!-- Jquery Nav JS -->
    <script src="{{ asset('js/js/jquery.nav.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('js/js/slicknav.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('js/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Niceselect JS -->
    <script src="{{ asset('js/js/niceselect.js') }}"></script>
    <!-- Tilt Jquery JS -->
    <script src="{{ asset('js/js/tilt.jquery.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('js/js/owl-carousel.js') }}"></script>
    <!-- counterup JS -->
    <script src="{{ asset('js/js/jquery.counterup.min.js') }}"></script>
    <!-- Steller JS -->
    <script src="{{ asset('js/js/steller.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('js/js/wow.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('js/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/js/bootstrap.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('js/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script>
        function afficher_detail() {
            const details = this.nextElementSibling;
            if (details.style.display === 'block') {
                details.style.display = 'none';
            } else {
                details.style.display = 'block';
            }
        }
    </script>

    </body>
    </html>
