@extends('base_public')
@section('style')
    <style>
        #historique, #mission, #vision, #communaute, #aproposdenous {
            overflow: hidden;
            max-height: 200px;
            transition: max-height 0.1s ease;
        }

        #historique.expanded, #mission.expanded, #vision.expanded, #communaute.expanded, #aproposdenous.expanded {
            max-height: 100%; /* Ajustez cette valeur selon la longueur de votre texte */
        }

        .annonce_description {
            overflow: hidden;
            max-height: 200px;
            transition: max-height 0.1s ease;
        }

        .annonce_description.expanded {
            max-height: 100%;
        }
    </style>
@endsection
@section('container')
    <!-- Slider Area -->
    <section class="mt-3" id="accueil">
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
                                    <a href="#section_nous_ecrire" class="btn">Nous contacter</a>
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
                                    <span class="fa fa-phone"></span>
                                    <span>Numéros de téléphone</span>
                                    <h4 style="font-weight: bold;">Nos contacts</h4>
                                    <hr style="border: 1px solid #1A76D1">
                                    <p>{{ $parametres->contacts }}</p>
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
                                        @for ($i = 0 ; $i < $programmedupasteur->count() ; $i++)
                                            @php
                                                $programme = $programmedupasteur->get($i);
                                            @endphp
                                            <li class="day" style="color: black">{{ $programme->jour }}<span>{{ $programme->interval_de_temps }}</span></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/End Start schedule Area -->
    <hr>
    @if (!empty($articles))
        <!-- Start Feautes -->
        <section class="why-choose section" id="articles">
            <div class="container">
                <div class="section-title">
                    <h2 class="mb-0">Articles</h2>
                    <p class="mt-0">Restez dans l'actualité de ce qui se passe!</p>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- Start Choose Rights -->
                        <div class="choose-right m-0">
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
                                        @php
                                            $bibliotheque = json_decode($latestarticle->bibliotheque)
                                        @endphp
                                        <div class="carousel-item active">
                                            <img src="/storage/{{ $bibliotheque[0] }}" style="max-height: 350px"
                                                class="d-block w-100" alt="...">
                                        </div>
                                        @foreach($bibliotheque as $image)
                                            <div class="carousel-item">
                                                <img src="/storage/{{ $image }}" style="max-height: 350px"
                                                    class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach
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
                    <div class="col-lg-6 col-12">
                        <!-- Start Choose Left -->
                        <div class="choose-left m-0">
                            <h5>{{ $latestarticle->titre }}</h4>
                            <p style="font-style: italic"> Ce {{ Carbon\Carbon::parse($latestarticle->date)->isoFormat('dddd') }}, {{ $latestarticle->date->format('d/m/Y') }}</p>
                            <p style="text-align: justify"> {{ Str::limit($latestarticle->description, 600) }}</p>
                        </div>
                        <a href="#" class="apropos" style="text-decoration: none"><span class="fa fa-arrow-circle-right"></span> EN SAVOIR PLUS</a>
                        <!-- End Choose Left -->
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <h5 class="mb-2 ml-5">Related</h5>
        <div class="articles p-3">
            @foreach($articles as $article)
                <article>
                    <div class="article-wrapper">
                        <figure>
                            @php
                                $bibliotheque = json_decode($article->bibliotheque);
                            @endphp
                            <img src="/storage/{{ $bibliotheque[0] }}" alt="" />
                        </figure>
                        <div class="article-body">
                            <h2>{{ $article->titre }}</h2>
                            <p class="mb-2" style="text-align: justify">
                                {{ Str::limit($article->description, 200) }}
                            </p>
                            <span class="mb-2" style="font-style: italic; color: black">{{ $article->created_at->diffForHumans() }}</span><br>
                            <a href="#" class="read-more">
                            En savoir plus <span class="sr-only">à propos de cet article</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-3 ml-5">
            <a href="#" class="apropos" style="text-decoration: none"><span class="fa fa-arrow-circle-right"></span> VOIR PLUS D'ARTICLES</a></p>
        </div>
        <hr>
        <!--/ End Feautes -->
    @endif

    <!-- Start Fun-facts -->
    <div id="section_communique" class="fun-facts section overlay">
        <div style="section-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 style="color: #fff; position: relative; z-index: 2" class="mt-5">Communiqués</h2>
                            @foreach($communiques as $communique)
                                <div class="mt-2" style="align-items: center; text-align: center; align-content: center">
                                    <i class="bx bxs-quote-alt-left quote-icon-left fs-3" style="position: relative; z-index: 2;"></i>
                                    <h6 style="color: #fff; text-align: justify; position: relative; z-index: 2;">Communiqué N° 00{{ $loop->iteration }} : {{ $communique->titre }}</h5>
                                    <div>
                                        @foreach(json_decode($communique->contenu, true) as $value)
                                            <p style="color: #fff; text-align: justify; position: relative; z-index: 2; margin-bottom: 2px"><span style="font-weight: 600">{{ $loop->iteration }}.</span>  {{ $value }}</p>
                                        @endforeach
                                    </div>
                                    <p style="margin-bottom: 10px; color: #afafaf; font-style: italic; position: relative; z-index: 2">Signé par {{ $communique->communiquant->nom }} {{ $communique->communiquant->postnom }} {{ $communique->communiquant->prenom }} le {{ $communique->created_at->format('d/m/Y') }}</p>
                                    <i class="bx bxs-quote-alt-right quote-icon-right fs-3" style="position: relative; z-index: 2;"></i>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Fun-facts -->

    @if (!$annonces->isEmpty())
        <!-- Start Why choose -->
        <section class="why-choose section" id="annonces_et_publicites">
            <div class="container">
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h1>Annonces et publicités</h2>
                            <p>Découvrez ce qui se prépare</p>
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
                    <div class="carousel-inner p-5 shadow">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <!-- Start Choose Left -->
                                    <div class="choose-left">
                                        <h3>{{ $annonces[0]->titre }}</h3>
                                        <span style="font-style: italic; color: black">{{ $annonces[0]->date->isoFormat('dddd') }} {{ $annonces[0]->date->format('d/m/Y') }}</span>
                                        <p id="annonce_description_0" class="annonce_description" style="text-align: justify">{{ $annonces[0]->description }}</p>
                                        <a id="0" onclick="expandededparagraph(this)" class="apropos" style="text-decoration: none; cursor: pointer">voir plus</a>
                                    </div>
                                    <!-- End Choose Left -->
                                </div>
                                <div class="col-lg-6 col-12">
                                    <!-- Start Choose Rights -->
                                    <div class="choose-right">
                                        <div class="video-image">
                                            <img class="w-100" src="/storage/{{ $annonces[0]->photo_descriptive }}"
                                                style="max-height: 400px">
                                        </div>
                                    </div>
                                    <!-- End Choose Rights -->
                                </div>
                            </div>
                        </div>
                        @for ($i = 1; $i < $annonces->count(); $i++)
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <!-- Start Choose Left -->
                                        <div class="choose-left">
                                            <h3>{{ $annonces[$i]->titre }}</h3>
                                            <span style="font-style: italic; color: black">{{ $annonces[$i]->date->isoFormat('dddd') }} {{ $annonces[$i]->date->format('d/m/Y') }}</span>
                                            <p id="annonce_description_{{ $i }}" class="annonce_description">{{ $annonces[$i]->description }}</p>
                                            <a id="{{ $i }}" onclick="expandededparagraph(this)" class="apropos" style="text-decoration: none; cursor: pointer">voir plus</a>
                                        </div>
                                        <!-- End Choose Left -->
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <!-- Start Choose Rights -->
                                        <div class="choose-right">
                                            <div class="video-image">
                                                <img class="w-100" src="/storage/{{ $annonces[$i]->photo_descriptive }}"
                                                    style="max-height: 400px">
                                            </div>
                                        </div>
                                        <!-- End Choose Rights -->
                                    </div>
                                </div>
                            </div>
                        @endfor
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
    @endif

    <!-- Start service -->
    <section class="services section mt-5 p-3" id="section_apropos">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>A propos de nous!</h2>
                        <p id="aproposdenous" style="text-align: justify">{{ $parametres->a_propos_de_nous }}</p>
                        <a id="toggleButtonApropos" class="apropos mt-2 text-primary" style="text-decoration: none; cursor: pointer">voir plus</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-prescription fs-3"></i>
                        <h4><a href="#">Historique</a></h4>
                        <p id="historique" style="text-align: justify">{{ $parametres->historique }}</p>
                        <a id="toggleButtonHistorique" class="apropos mt-2 text-primary" style="text-decoration: none; cursor: pointer">voir plus</a>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bx-bible fs-3'></i>
                        <h4><a href="#">Notre mission</a></h4>
                        <p id="mission" style="text-align: justify">{{ $parametres->notre_mission }}</p>
                        <a id="toggleButtonMission" class="apropos mt-2 text-primary" style="text-decoration: none; cursor: pointer">voir plus</a>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="icofont icofont-eye-alt fs-3"></i>
                        <h4><a href="#">Notre vision</a></h4>
                        <p id="vision" style="text-align: justify">{{ $parametres->notre_vision }}</p>
                        <a id="toggleButtonVision" class="apropos mt-2 text-primary" style="text-decoration: none; cursor: pointer">voir plus</a>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class='bx bxs-church fs-3'></i>
                        <h4><a href="#">Notre communauté</a></h4>
                        <p id="communaute" style="text-align: justify">{{ $parametres->notre_communaute }}</p>
                        <a id="toggleButtonCommunaute" class="apropos mt-2 text-primary" style="text-decoration: none; cursor: pointer">voir plus</a>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="mb-4">Pasteur Responsable</h2>
                            <img style="border-radius: 50%; height: 250px; width: 250px" class="shadow" src="/storage/{{ $parametres->photo_du_pasteur_responsable }}" alt="..."><br>
                            <i class="bx bxs-quote-alt-left quote-icon-left fs-2 mt-2"></i>
                            <p class="mb-2" style="font-weight: 500; text-transform:capitalize; font-size: 13pt">Révérend pasteur {{ $parametres->nom_du_pasteur }}</p>
                            <p style="text-align: justify">{{ $parametres->pasteur_responsable }}</p>
                            <i class="bx bxs-quote-alt-right quote-icon-right fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End service -->

    <!-- Start portfolio -->
    <section class="portfolio section mb-3">
        <hr>
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
                        @foreach($serviteurs as $serviteur)
                            <div class="single-pf shadow">
                                <div class="d-block">
                                    <img style="border-radius: 100%" class="shadow-sm" src="/storage/{{ $serviteur->photo }}" alt="...">
                                    <div class="details">
                                        <hr>
                                        <p style="font-weight: normal; color: black">{{ $serviteur->nom }}</p>
                                        <p>{{ $serviteur->fonction }}</p>
                                        <p class="text-muted" style="font-style: italic">{{ $serviteur->contacts }}</p>
                                        <p class="text-muted" style="font-style: italic">{{ $serviteur->email }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <!--/ End portfolio -->

    @if (!empty($enseignements))
        <section class="pricing-table section mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Enseignements et prédications</h2>
                            <p class="small" style="font-style: italic">
                                <i class="bx bxs-quote-alt-left quote-icon-left fs-2 mt-2"></i>
                                Que ce livre de la loi ne s'éloigne point de ta bouche; médite-le 
                                jour et nuit, pour agir fidèlement selon tout ce qui y est écrit; 
                                car c'est alors que tu auras du succès dans tes entreprises, 
                                c'est alors que tu réussiras. Josué 1:8
                                <i class="bx bxs-quote-alt-right quote-icon-right fs-2 mt-2"></i>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <section class="articles">
                        @foreach($enseignements as $enseignement)
                            <article>
                                <div class="article-wrapper">
                                    <figure>
                                        <img src="/storage/{{ $enseignement->affiche_photo }}" alt="" />
                                    </figure>
                                    <div class="article-body">
                                        <h2>{{ $enseignement->titre }}</h2>
                                        <p class="mb-2" style="text-align: justify">
                                            {{ Str::limit($enseignement->enseignement, 200) }}
                                        </p>
                                        <span class="mb-2 text-dark" style="font-style: italic">{{ $enseignement->reference }}</span><br>
                                        <br><span class="mb-2">Publié par {{ $enseignement->auteur->nom }} {{ $enseignement->auteur->postnom }} {{ $enseignement->auteur->prenom }}</span><br>
                                        <span class="mb-2" style="font-style: italic; color: black">{{ $enseignement->created_at->diffForHumans() }}</span><br>
                                        <a href="#" class="read-more">
                                        En savoir plus <span class="sr-only">à propos de cet article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </section>
                    <br>
                    <a href="#" class="apropos" style="text-decoration: none"><span class="fa fa-arrow-circle-right"></span> VOIR PLUS D'ENSEIGNEMENTS</a></p>
                </div>
            </div>
        </section>
    @endif

    <!-- Start Appointment -->
    <section class="appointment p-0" id="section_nous_ecrire">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mt-5">
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
@section('scripts')
    <script src="{{ asset('new_styles_and_scripts/js/home.js') }}"></script>
@endsection