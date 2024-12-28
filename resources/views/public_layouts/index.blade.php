@extends('base_public')
@section('container')
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
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- single-schedule -->
                            <div class="single-schedule middle">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icofont-prescription"></i>
                                    </div>
                                    <div class="single-content">
                                        <span class="fa fa-map-location-dot"></span>
                                        <span>Localisation de l'église</span>
                                        <h4 style="font-weight: bold;">Position géographique</h4>
                                        <hr style="border: 1px solid #1A76D1">
                                        <p>Notre église est située à : {{ $parametres->localisation }}</p>
                                        <a href="#">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 ">
                            <!-- single-schedule -->
                            <div class="shadow single-schedule first">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icofont-prescription"></i>
                                    </div>
                                    <div class="single-content">
                                        <span class="fa fa-calendar-check"></span>
                                        <span>Calendrier hebdomadaire des cultes</span>
                                        <h4 style="font-weight: bold;">Nos programmes de culte</h4>
                                        <hr style="border: 1px solid #1A76D1">
                                        <p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et
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
                                        <span class="fa fa-clock-four"></span>
                                        <span>Voulez-vous consulter le pasteur?</span>
                                        <h4 style="font-weight: bold;">Disponibilité</h4>
                                        <hr style="border: 1px solid #1A76D1">
                                        <ul class="time-sidual">
                                            <li class="day" style="color: black">Monday - Fridayp <span>8.00-20.00</span></li>
                                            <li class="day" style="color: black">Saturday <span>9.00-18.30</span></li>
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
                        <form class="form" action="{{ route('public.messageEtCommentaire') }}" method="post">
                            @csrf
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
                            <form action="{{ route('public.subscribeToNewsLetter') }}" method="post" class="newsletter-inner">
                                @csrf
                                <input name="email" placeholder="Votre adresse mail" class="common-input"
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Votre adresse mail'" required type="email">
                                <button class="btn btn-primary" type="submit">Souscrire</button>
                            </form>
                        </div>
                        <!-- End Newsletter Form -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /End Newsletter Area -->
@endsection