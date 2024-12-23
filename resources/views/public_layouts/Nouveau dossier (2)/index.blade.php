<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Car Clean</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif"/>
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesoeet" href="{{ asset('css/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body>
<style>
    #text_description {
        display: -webkit-box;
        -webkit-line-clamp: 10;
        -webkit-box-orient: vertical;
        overflow: hidden;
    "
    }
</style>
<!--header section start -->
<div class="header_section">
    <div class="container-fluid">
        <div class="costum_header">
            <div class="logo"><a href="index.html"><img style="max-width: 170px; max-height: 180px"
                                                        src="{{ asset('css/images/logo.png') }}"></a></div>
            <div class="contact_menu">
            </div>
            <div class="menu_text">
                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="overlay-content">
                        <a href="index.html">Accueil</a>
                        <a href="services.blade.php">A propos de nous</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <a href='{{ route ('login') }}'>Se connecter?</a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="d-flex gap-4 mt-3">
                    <a href="index.html" class="main_menu">Accueil</a>
                    <a href="services.blade.php" class="main_menu">A propos de nous</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="main_menu">Dashboard</a>
                        @else
                            <a href='{{ route ('login') }}' class="main_menu">Se connecter?</a>
                        @endauth
                    @endif
                </div>
                <span class="toggle_icon"><img src="{{ asset('css/images/toggle-icon.png') }}"
                                               class="toggle_menu"></span>
            </div>
        </div>
    </div>
</div>

<div class="banner_section layout_padding p-4 mt-3">
    <div class="row">
        <div class="col-md-6">
            <div><img src="{{ asset('css/images/home_0.jpg') }}" class="banner_img"></div>
        </div>
        <div class="col-md-6">
            <div class="banner_taital">
                <h1 id="title_church" style="margin-bottom: 0; font-family: 'Poppins', sans-serif; font-weight: bold">
                    EGLISE PEFACO UNIVERSELLE</h1>
                <p class="text-muted small"
                   style="font-family: 'Poppins', sans-serif; margin-top: 0; font-size: 10px; line-height: 12px">Sise dans
                    l'avenue
                    ISP/BUKAVU, quartier Muhungu, commune d'Ibanda,
                    Ville de Bukavu, dans la province du Sud-Kivu/République Démocratique du Congo</p>
                <div style="text-align: justify">
                    <p style="font-family: 'Poppins', sans-serif">Etenim si attendere diligenter, existimare vere de
                        omni hac causa
                        volueritis, sic
                        constituetis, iudices, nec descensurum quemquam ad hanc accusationem fuisse, cui,
                        utrum vellet, liceret, nec</p>
                </div>
            </div>
            <div class="btn_main"><a class="btn btn-success">A propos de nous!</a></div>
        </div>
    </div>
</div>

<div class="services_section layout_padding">
    <div class="container" style="text-align: justify">
        <h1 class="services_taital">Notre<span style="color: #0c426e"> vision</span></h1>
        <p style="font-family: 'Poppins', sans-serif">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest... <a href="#">En savoir plus</a></p>

        <h1 class="services_taital">Notre<span style="color: #0c426e"> histoire</span></h1>
        <p class="services_text">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest... <a href="#">En savoir plus</a></p>

        <h1 class="services_taital">Notre<span style="color: #0c426e"> communauté</span></h1>
        <p class="services_text">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest... <a href="#">En savoir plus</a></p>

        <h1 class="services_taital">Notre<span style="color: #0c426e"> Organigramme</span></h1>
        <p class="services_text">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest... <a href="#">En savoir plus</a></p>

        <h1 class="services_taital">Notre<span style="color: #0c426e"> pasteur</span></h1>
        <p class="services_text">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest... <a href="#">En savoir plus</a></p>

        <div class="services_section_2 layout_padding">
            <div class="row">
                <div class="col-md-4 padding_right_0">
                    <div class="services_box">
                        <h4 class="express_text">Express Exterior</h4>
                        <p class="lorem_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                            that it has a more-or-less normal distribution of letters, as opposed </p>
                        <div class="seemore_bt"><a href="#">See More</a></div>
                        <div><img src="{{ asset('css/images/img-2.png') }}" class="image_1"></div>
                    </div>
                </div>
                <div class="col-md-4 padding_0">
                    <div class="services_box">
                        <div><img src="{{ asset('css/images/img-1.png') }}" class="image_1"></div>
                        <h4 class="express_text">Auto Detailing</h4>
                        <p class="lorem_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                            that it has a more-or-less normal distribution of letters, as opposed </p>
                        <div class="seemore_bt"><a href="#">See More</a></div>
                    </div>
                </div>
                <div class="col-md-4 padding_left_0">
                    <div class="services_box">
                        <h4 class="express_text">Full Service Car Wash</h4>
                        <p class="lorem_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum is
                            that it has a more-or-less normal distribution of letters, as opposed </p>
                        <div class="seemore_bt"><a href="#">See More</a></div>
                        <div><img src="{{ asset('css/images/img-3.png') }}" class="image_1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- header section end -->
<div class="banner_section layout_padding p-2 mb-3">
    <div><h2 style="font-family: 'Poppins', sans-serif; line-height: 20px">Annonces| <span
                color="green">A la une!</span></h2></div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('css/images/note_8.jpg') }}" class="d-block w-100 img_caroussel_ann">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('css/images/note_5.jpg') }}" class="d-block w-100 img_caroussel_ann"
                             alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('css/images/note_2.jpg') }}" class="d-block w-100 img_caroussel_ann">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="banner_taital">
                <h6 style="font-family: 'Poppins', sans-serif" class="w-100 text-success">Culte de louange et adoration
                    de 4 jours</h6>
                <div style="text-align: justify"><p id="text_description" style="font-family: 'Poppins', sans-serif">
                        Etenim si attendere diligenter,
                        existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum
                        quemquam ad
                        hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum
                        spei
                        fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino,
                        humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel
                        pietatis
                        vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si
                        speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est
                        resistendum.</p></div>
            </div>
        </div>
    </div>
</div>
<!-- banner section start -->
<div class="banner_section layout_padding p-2">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="banner_taital">
                <h2 style="font-family: 'Poppins', sans-serif" class="w-100 text-success">Culte de louange et adoration
                    de 4 jours</h2>
                <hr>
                <p id="text_description" style="font-family: 'Poppins', sans-serif">Etenim si attendere diligenter,
                    existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum quemquam ad
                    hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum spei
                    fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino,
                    humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel pietatis
                    vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si
                    speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est
                    resistendum.</p>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('css/images/note_8.jpg') }}" class="d-block w-100"
                             style="min-height: 300px; min-height: 300px">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('css/images/note_5.jpg') }}" class="d-block w-100" alt="..."
                             style="min-height: 300px; min-height: 300px">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('css/images/note_2.jpg') }}" class="d-block w-100"
                             style="min-height: 300px; min-height: 300px">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- services section end -->
<!-- providing section start -->
<div class="providing_section layout_padding">
    <div class="container">
        <h1 class="services_taital">We’re Providing Best <span style="color: #0c426e">Quality Service</span></h1>
    </div>
</div>
<div class="providing_section_2 layout_padding">
    <div class="container">
        <h2 class="clean_text">Notre vision</h2>
        <p class="ipsum_text">Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione
            magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem
            quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab
            eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate
            quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus
            exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen
            aliquod probitatis et virtutis perspicere videamur.</p>
        <div class="quote_bt_1"><a href="#">Get A Quote</a></div>
    </div>
</div>
<!-- providing section end -->
<!-- choose section start -->
<div class="choose_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Why <span style="color: #0c426e">Choose Us?</span></h1>
        <div class="choose_section_2 layout_padding">
            <div class="row">
                <div class="col-md-4">
                    <div class="choose_box">
                        <div class="number_1">
                            <h4 class="number_text">01</h4>
                            <h4 class="trusted_text">Trusted Services</h4>
                        </div>
                        <p class="dummy_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose_box">
                        <div class="number_1">
                            <h4 class="number_text">02</h4>
                            <h4 class="trusted_text">Talented Workers</h4>
                        </div>
                        <p class="dummy_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="choose_box">
                        <div class="number_1">
                            <h4 class="number_text">03</h4>
                            <h4 class="trusted_text">Organic Products</h4>
                        </div>
                        <p class="dummy_text">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- choose section end -->
<!-- testimonial section start -->
<div class="testimonial_section layout_padding">
    <div class="container">
        <h1 class="testimonial_taital">Testimonial</h1>
        <div class="testimonial_section_2">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial_box">
                            <div class="tectimonial_mail">
                                <div class="client_image_section">
                                    <img src="{{ asset('css/images/client-img.png') }}" class="client_img">
                                </div>
                                <div class="client_text_section">
                                    <p class="testimonial_text">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout. The
                                        point of using Lorem Ipsum is that</p>
                                    <h4 class="joech_text">Joech</h4>
                                    <p class="customer_text">Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial_box">
                            <div class="tectimonial_mail">
                                <div class="client_image_section">
                                    <img src="{{ asset('css/images/client-img.png') }}" class="client_img">
                                </div>
                                <div class="client_text_section">
                                    <p class="testimonial_text">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout. The
                                        point of using Lorem Ipsum is that</p>
                                    <h4 class="joech_text">Joech</h4>
                                    <p class="customer_text">Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="testimonial_box">
                            <div class="tectimonial_mail">
                                <div class="client_image_section">
                                    <img src="{{ asset('css/images/client-img.png') }}" class="client_img">
                                </div>
                                <div class="client_text_section">
                                    <p class="testimonial_text">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout. The
                                        point of using Lorem Ipsum is that</p>
                                    <h4 class="joech_text">Joech</h4>
                                    <p class="customer_text">Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- testimonial section end -->
<!-- footer section start -->
<div class="footer_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">Contact Us</h2>
                <div class="location_text"><img src="{{ asset('css/images/map-icon1.png') }}"><a href="#"><span
                            class="padding_left_15">Location</span></a></div>
                <div class="location_text"><img src="{{ asset('css/images/call-icon1.png') }}"><a href="#"><span
                            class="padding_left_15">(+71) 8522369417</span></a></div>
                <div class="location_text"><img src="{{ asset('css/images/mail-icon1.png') }}"><a href="#"><span
                            class="padding_left_15">demo@gmail.com</span></a></div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">Useful link </h2>
                <div class="footer_menu">
                    <ul>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="service.html">Service</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <h2 class="useful_text">Opening Time</h2>
                <p class="footer_text">Mon : 07;00am to 09:00 pm</p>
                <p class="footer_text">Mon : 07;00am to 09:00 pm</p>
                <p class="footer_text">Mon : 07;00am to 09:00 pm</p>
            </div>
            <div class="col-sm-6 col-lg-3">
                <h1 class="useful_text">Newsletter</h1>
                <input type="text" class="Enter_text" placeholder="Enter Your Email" name="Enter Your Email">
                <div class="subscribe_bt"><a href="#">Subscribe</a></div>
            </div>
        </div>
        <div class="social_icon">
            <div id="social">
                <a class="facebookBtn smGlobalBtn" href="#"></a>
                <a class="twitterBtn smGlobalBtn" href="#"></a>
                <a class="instagramBtn smGlobalBtn" href="#"></a>
                <a class="linkedinBtn smGlobalBtn" href="#"></a>
            </div>
        </div>
    </div>
</div>
<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
    <div class="container">
        <p class="copyright_text">Copyright 2020 All Rights Reserved. Design by<a href="https://html.design"> Free html
                Templates</a></p>
    </div>
</div>
<!-- copyright section end -->
<!-- Javascript files-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>
<!-- sidebar -->
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- javascript -->
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function () {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $(".zoom").hover(function () {

            $(this).addClass('transition');
        }, function () {

            $(this).removeClass('transition');
        });
    });

</script>
<script>
    const toggleBtn = document.querySelector('.toggle_icon');
    const nav = document.getElementById('myNav');
    toggleBtn.addEventListener('click', function (event) {
        if (nav.style.width == "250px") {
            nav.style.width = "0%";
        } else {
            nav.style.width = "250px";
        }
        event.stopPropagation();
    });

    document.addEventListener('click', function (event) {
        if (!nav.contains(event.target) && !toggleBtn.contains(event.target)) {
            nav.style.width = "0%";
        }
    });

    function closeNav() {
        nav.style.width = "0%";
    }
</script>
</body>
</html>
