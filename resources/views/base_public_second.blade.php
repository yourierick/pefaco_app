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
    <title>Eglise Pefaco Universelle</title>

    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/css_bootstrap/bootstrap-icons/bootstrap-icons.css") }}"/>
    <script defer src="{{ asset("assets/plugins/fontawesome/js/all.min.js") }}"></script>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/plugins.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/kaiadmin.css") }}"/>
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/card-articles.css") }}"/>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" href="/storage/{{ $parametre_logo }}">

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
        a {
            text-decoration: none!important;
        }
    </style>
    @yield('style')
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
    <a class="get-pro" style="cursor: pointer">MENU</a>
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
                        <li><a href="{{ route('home') }}#section_apropos">A propos de nous!</a></li>
                        <li><a href="{{ route('home') }}#section_nous_ecrire">Nous contacter</a></li>
                    </ul>
                    <!-- End Contact -->
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <!-- Top Contact -->
                    <ul class="top-contact">
                        <li><i class="fa fa-phone mr-1"></i>{{ $parametres->contacts }}</li>
                        <li><i class="fa fa-envelope mr-1"></i><a href="mailto:{{ $parametres->email }}"> {{ $parametres->email }}</a>
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
                            <a href="{{ route('home') }}"><img style="width: 130px; height: 100px;" src="/storage/{{ $parametre_logo }}" alt="#"></a>
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
                                    <li class="active"><a>Accueil <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('home') }}#accueil">accueil</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('home') }}#section_apropos">A propos de nous! </a></li>
                                    <li><a href="{{ route('home') }}#section_communique">Communiqués </a></li>
                                    <li><a style="cursor: pointer">Actualités <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="{{ route('home') }}#annonces_et_publicites">Annonces et publicités</a></li>
                                            <li><a href="{{ route('home') }}#articles">Articles</a></li>
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

@yield('container')

<!-- Footer Area -->
<footer id="footer" class="footer ">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Localisation</h2>
                        <p>{{ $parametres->localisation }}</p>
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
                                    <li><a href="{{ route('home') }}#accueil"><i class="fa fa-caret-right" aria-hidden="true"></i>Accueil</a></li>
                                    <li><a href="{{ route('home') }}#section_apropos"><i class="fa fa-caret-right" aria-hidden="true"></i>A propos de nous</a>
                                    </li>
                                    <li><a href="{{ route('home') }}#section_nous_ecrire"><i class="fa fa-caret-right" aria-hidden="true"></i>Nous contacter</a>
                                    </li>
                                    <li><a href="{{ route('home') }}#section_communique"><i class="fa fa-caret-right" aria-hidden="true"></i>Communiqués</a>
                                    </li>
                                    <li><a href="{{ route('home') }}#articles"><i class="fa fa-caret-right" aria-hidden="true"></i>Actualités</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Programme de culte</h2>
                        <p>Calendrier hebdomadaire des cultes</p>
                        <ul class="time-sidual">
                            @for ($i = 0 ; $i < $programmedeculte->count(); $i++)
                                @php
                                    $programme = $programmedeculte->get($i);
                                @endphp
                                <div>
                                    <li style="color: whitesmoke">
                                        - {{ $programme->programme }}
                                        <p class="ml-2">{{ $programme->jour }} : {{ $programme->interval_de_temps }}</p>
                                    </li>
                                </div>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer">
                        <h2>Bulletin d'information</h2>
                        <p>Inscrivez-vous à notre newsletter pour recevoir toutes nos actualités dans votre boîte mail</p>
                        <form action="{{ route('public.subscribeToNewsLetter') }}" method="post" class="newsletter-inner">
                            @csrf
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
<script src="{{ asset('js/js/bootstrap-datepicker.js') }}"></script>
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

        <script src="{{ asset("new_styles_and_scripts/js/plugin/bootstrap-notify/bootstrap-notify.min.js") }}"></script>

<script>
    function afficher_detail() {
        const details = this.nextElementSibling;
        if (details.style.display === 'block') {
            details.style.display = 'none';
        } else {
            details.style.display = 'block';
        }
    }

    @if(session('success'))
        $(document).ready(function () {
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: '{{ session('success') }}',
            }, {
                type: 'primary',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
        });
        @elseif(session('error'))
        $(document).ready(function () {
            $.notify({
                icon: 'bi-bell',
                title: 'Pefaco APP',
                message: '{{ session('error') }}',
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                time: 1000,
            });
        });
    @endif
</script>
@yield('scripts')
</body>
</html>
