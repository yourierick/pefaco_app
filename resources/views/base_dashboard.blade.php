<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('page_title')</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Administration Dashboard">
    <meta name="author" content="Ir. ERICK BITANGALO">
    <link id="u-theme-google-font" rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|PT+Sans:400,400i,700,700i">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/css_bootstrap/vendor/bootstrap/css/bootstrap.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/css_bootstrap/bootstrap-icons/bootstrap-icons.css") }}"/>
    <script defer src="{{ asset("assets/plugins/fontawesome/js/all.min.js") }}"></script>
    {{--<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>--}}

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset("assets/css/portal.css") }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/plugins.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("new_styles_and_scripts/css/kaiadmin.css") }}"/>
    @yield('style')
</head>
<style>
    .submenu-link{
        text-decoration: none!important;
    }
</style>
<body class="app">
@php
    $routename = request()->route()->getName();
@endphp
@php
    $autorisation_caisse = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'caisses')->first();
    $autorisation_cotisation = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'cotisations')->first();
    $autorisation_don = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'don_specials')->first();
    $autorisation_depenses = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'depenses')->first();
    $autorisation_rapport_de_culte = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'rapport_de_cultes')->first();
    $autorisation_inventaire = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'inventaires')->first();
    $autorisation_annonces = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'annonces')->first();
    $autorisation_articles = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'articles')->first();
    $autorisation_enseignement = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'enseignements')->first();
    $autorisationspeciales_communiques = \App\Models\AutorisationSpeciale::where('table_name', 'communiques')->where('user_id', $current_user->id)->first();
    $autorisation_horaire = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'horaire_hebdos')->first();
    $autorisation_rapport_mensuel = \App\Models\Autorisations::where('groupe_id', $current_user->groupe_utilisateur_id)->where('table_name', 'rapport_mensuels')->first();
@endphp
<header class="app-header fixed-top">
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 role="img"><title>Menu</title>
                                <path stroke="currentColor" stroke-linecap="round" style="color: black" stroke-miterlimit="10"
                                      stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                            </svg>
                        </a>
                    </div><!--//col-->
                    <div class="app-utilities col-auto">
                        <div class="app-utility-item app-notifications-dropdown dropdown">
                            <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle"
                               data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"
                               title="Notifications">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
                                    <path fill-rule="evenodd"
                                          d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                </svg>
                                <span class="icon-badge">3</span>
                            </a><!--//dropdown-toggle-->
                            <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                                <div class="dropdown-menu-header p-3">
                                    <h5 class="dropdown-menu-title mb-0">Notifications</h5>
                                </div><!--//dropdown-menu-title-->
                                <div class="dropdown-menu-content">
                                    <div class="item p-3">
                                        <div class="row gx-2 justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <img class="profile-image" src=""
                                                     alt="">
                                            </div><!--//col-->
                                            <div class="col">
                                                <div class="info">
                                                    <div class="desc">Amy shared a file with you. Lorem ipsum dolor sit
                                                        amet, consectetur adipiscing elit.
                                                    </div>
                                                    <div class="meta"> 2 hrs ago</div>
                                                </div>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="link-mask" href="#"></a>
                                    </div><!--//item-->
                                    <div class="item p-3">
                                        <div class="row gx-2 justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="app-icon-holder">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                         class="bi bi-receipt" fill="currentColor"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                              d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                                                        <path fill-rule="evenodd"
                                                              d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                                    </svg>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col">
                                                <div class="info">
                                                    <div class="desc">You have a new invoice. Proin venenatis interdum
                                                        est.
                                                    </div>
                                                    <div class="meta"> 1 day ago</div>
                                                </div>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="link-mask" href="#"></a>
                                    </div><!--//item-->
                                    <div class="item p-3">
                                        <div class="row gx-2 justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="app-icon-holder icon-holder-mono">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                         class="bi bi-bar-chart-line" fill="currentColor"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                              d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
                                                    </svg>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col">
                                                <div class="info">
                                                    <div class="desc">Your report is ready. Proin venenatis interdum
                                                        est.
                                                    </div>
                                                    <div class="meta"> 3 days ago</div>
                                                </div>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="link-mask" href="#"></a>
                                    </div><!--//item-->
                                    <div class="item p-3">
                                        <div class="row gx-2 justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <img class="profile-image" src=""
                                                     alt="">
                                            </div><!--//col-->
                                            <div class="col">
                                                <div class="info">
                                                    <div class="desc">James sent you a new message.</div>
                                                    <div class="meta"> 7 days ago</div>
                                                </div>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="link-mask" href="#"></a>
                                    </div><!--//item-->
                                </div><!--//dropdown-menu-content-->

                                <div class="dropdown-menu-footer p-2 text-center">
                                    <a href="#">View all</a>
                                </div>

                            </div><!--//dropdown-menu-->
                        </div><!--//app-utility-item-->
                        @php
                            $group = \App\Models\GroupesUtilisateurs::find($current_user->groupe_utilisateur_id);
                        @endphp
                        @if ($group)
                            @if($group->groupe == 'A0')
                                <div class="app-utility-item">
                                    <a href="{{ route('settings') }}">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear icon"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                            <path fill-rule="evenodd"
                                                  d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                        </svg>
                                    </a>
                                </div><!--//app-utility-item-->
                            @endif
                        @endif

                        <div class="app-utility-item app-user-dropdown dropdown">
                            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown"
                               href="#" role="button" aria-expanded="false">
                                <img src="@if($current_user->photo) {{ $current_user -> imageUrl() }}
                                    @else {{ asset('css\images\businessman.png') }} @endif" alt=""
                                     class="rounded-circle">
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mon compte</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div><!--//app-user-dropdown-->
                    </div><!--//app-utilities-->
                </div><!--//row-->
            </div><!--//app-header-content-->
        </div><!--//container-fluid-->
    </div><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel sidepanel-hidden">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding" style="background-color: #1579c9">
                <div class="d-flex">
                    <a class="app-logo" href="{{ route('home') }}"><img class="logo-icon me-2" style="width: 100px; height: 50px" src="{{ asset('css/images/logo.jpg') }}" alt="logo"></a>
                    <div>
                        <h5 style="color: #fff; font-family: 'Poppins', sans-serif">DASHBOARD</h5>
                        <hr style="border: 2px solid yellow">
                    </div>
                </div>
            </div><!--//app-branding-->
            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'dashboard')]) href="{{ route('dashboard') }}">
                                    <span class="nav-icon">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                                            <path fill-rule="evenodd"
                                                  d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                        </svg>
                                    </span>
                            <span class="nav-link-text">Accueil</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'rapport')]) class="submenu-toggle" href="#" data-bs-toggle="collapse"
                           data-bs-target="#submenu-4" aria-expanded="false" aria-controls="submenu-4">
                                <span class="nav-icon">
                                    <i class='bx bx-archive-in' style="font-size: 17pt"></i>
                                </span>
                            <span class="nav-link-text">Rapports</span>
                            <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div @class(['collapse', 'submenu', 'submenu-1', 'show'=>str_starts_with($routename, 'rapport')]) id="submenu-4" class="collapse submenu submenu-4" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                @if(!is_null($autorisation_rapport_de_culte))
                                    @if($autorisation_rapport_de_culte->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'rapportculte.')]) href="{{ route('rapportculte.list_des_rapports') }}">Rapport de culte</a>
                                        </li>
                                    @endif
                                @endif
                                @if(!is_null($autorisation_rapport_mensuel))
                                    @if($autorisation_rapport_mensuel->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'rapportmensuel.')]) class="submenu-link" href="{{ route('rapportmensuel.list_des_rapports') }}">Rapport mensuel</a>
                                        </li>
                                    @endif
                                @else
                                    <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'rapportmensuel.')]) class="submenu-link" href="{{ route('rapportmensuel.list_des_rapports') }}">Rapport mensuel</a>
                                @endif
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'communique.') || str_starts_with($routename, 'enseignement.')]) class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
                           data-bs-target="#submenu-5" aria-expanded="false" aria-controls="submenu-5">
                                <span class="nav-icon">
                                    <i class='bx bx-notepad' style="font-size: 17pt"></i>
                                </span>
                            <span class="nav-link-text">Communiqués et enseignements</span>
                            <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div @class(['collapse', 'submenu', 'submenu-1', 'show'=>str_starts_with($routename, 'communique.') || str_starts_with($routename, 'enseignement.')]) id="submenu-5" class="collapse submenu submenu-5" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                @if(!is_null($autorisationspeciales_communiques))
                                    @if($autorisationspeciales_communiques->autorisation_speciale)
                                        @if(in_array('peux lire', json_decode($autorisationspeciales_communiques->autorisation_speciale, true)))
                                            <li class="submenu-item">
                                                <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'communique.')]) href="{{ route('communique.list_des_communiques') }}">Communiqués</a>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                                @if(!is_null($autorisation_enseignement))
                                    @if($autorisation_enseignement->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'enseignement.')]) href="{{ route('enseignement.list_des_enseignements') }}">Enseignements</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    @if(!is_null($autorisation_inventaire))
                        @if($autorisation_inventaire->lecture === 1)
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a @class(['nav-link', 'active'=>str_starts_with($routename, 'inventaire.')]) href="{{ route('inventaire.list_des_biens') }}">
                                <span class="nav-icon">
                                    <i class='bx bx-book-open' style="font-size: 17pt"></i>
                                </span>
                                    <span class="nav-link-text">Inventaire</span>
                                </a><!--//nav-link-->
                            </li><!--//nav-item-->
                        @endif
                    @endif
                    @php
                        $group = \App\Models\GroupesUtilisateurs::find($current_user->groupe_utilisateur_id);
                    @endphp
                    @if ($group)
                        @if($group->groupe == 'A0')
                            <li class="nav-item has-submenu">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a @class(['nav-link', 'submenu-toggle', 'active'=>str_starts_with($routename, "profile.") || str_starts_with($routename, "manageprofile.")]) href="#"
                                   data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="true"
                                   aria-controls="submenu-1">
                                    <span class="nav-icon">
                                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
                                            <path
                                                d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
                                        </svg>
                                    </span>
                                        <span class="nav-link-text">Utilisateurs</span>
                                        <span class="submenu-arrow">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </span><!--//submenu-arrow-->
                                </a><!--//nav-link-->
                                <div
                                    @class(['collapse', 'submenu', 'submenu-1', 'show'=>str_starts_with($routename, 'profile.') || str_starts_with($routename, 'manageprofile.') || str_starts_with($routename, 'register')])  id="submenu-1"
                                    data-bs-parent="#menu-accordion">
                                    <ul class="submenu-list list-unstyled">
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'manageprofile.')]) href="{{ route('manageprofile.list_users') }}">Gestion
                                                des utilisateurs</a>
                                        </li>
                                    </ul>
                                </div>
                            </li><!--//nav-item-->
                        @endif
                    @endif
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'annonce.') || str_starts_with($routename, 'article.') || str_starts_with($routename, 'horairehebdo.')]) class="submenu-toggle" href="#" data-bs-toggle="collapse"
                           data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <i class='bx bx-slideshow' style="font-size: 17pt"></i>
                                </span>
                            <span class="nav-link-text">Publications</span>
                            <span class="submenu-arrow">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div @class(['collapse', 'submenu', 'submenu-1', 'show'=>str_starts_with($routename, 'annonce.') || str_starts_with($routename, 'article.') || str_starts_with($routename, 'horairehebdo.')]) id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                @if(!is_null($autorisation_annonces))
                                    @if($autorisation_annonces->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'annonce.')]) href="{{ route('annonce.list_des_annonces') }}">Annonces</a>
                                        </li>
                                    @endif
                                @endif
                                @if (!is_null($autorisation_articles))
                                    @if ($autorisation_articles->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'article.')]) href="{{ route('article.list_des_articles') }}">Articles</a>
                                        </li>
                                    @endif
                                @endif
                                @if (!is_null($autorisation_horaire))
                                    @if ($autorisation_horaire->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'horairehebdo.')]) href="{{ route('horairehebdo.list_des_horaires') }}">Programme Hebdomadaire</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'caisses.') || str_starts_with($routename, 'cotisation.') || str_starts_with($routename, 'don.')]) class="submenu-toggle" href="#" data-bs-toggle="collapse"
                           data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-3">
                                <span class="nav-icon">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
                                    </svg>
                                </span>
                            <span class="nav-link-text">Caisses, Cotisations, Dons</span>
                            <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div @class(['collapse', 'submenu', 'submenu-1', 'show'=>str_starts_with($routename, 'caisses.') || str_starts_with($routename, 'cotisation.') || str_starts_with($routename, 'don.')]) id="submenu-3" class="collapse submenu submenu-3" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                @if(!is_null($autorisation_caisse))
                                    @if($autorisation_caisse->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'caisses.')]) href="{{ route('caisses.list') }}">Caisses</a>
                                        </li>
                                    @endif
                                @endif
                                @if(!is_null($autorisation_cotisation))
                                    @if($autorisation_cotisation->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'cotisation.')]) href="{{ route('cotisation.list') }}">Cotisations</a>
                                        </li>
                                    @endif
                                @endif
                                @if(!is_null($autorisation_don))
                                    @if($autorisation_don->lecture === 1)
                                        <li class="submenu-item">
                                            <a @class(['submenu-link', 'active'=>str_starts_with($routename, 'don.')]) href="{{ route('don.list') }}">Dons spéciaux</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </li><!--//nav-item-->
                    @if(!is_null($autorisation_depenses))
                        @if($autorisation_depenses->lecture === 1)
                            <li class="nav-item">
                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                <a @class(['nav-link', 'active'=>str_starts_with($routename, 'depense.')]) class="nav-link" href="{{ route('depense.list') }}">
                                <span class="nav-icon">
                                    <i class='bx bx-objects-horizontal-right' style="font-size: 24px"></i>
                                </span>
                                    <span class="nav-link-text">Dépenses</span>
                                </a><!--//nav-link-->
                            </li><!--//nav-item-->
                        @endif
                    @endif
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a @class(['nav-link', 'active'=>str_starts_with($routename, 'aide.')]) href="#">
                                <span class="nav-icon">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path
                                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                    </svg>
                                </span>
                            <span class="nav-link-text">Aide</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                    <ul class="app-menu footer-menu list-unstyled">
                        @if($group)
                            @if($group->groupe === 'A0')
                                <li class="nav-item">
                                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                                    <a class="nav-link" href="{{ route('settings') }}">
                                    <span class="nav-icon">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                            <path fill-rule="evenodd"
                                                  d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                        </svg>
                                    </span>
                                        <span class="nav-link-text">Paramètres</span>
                                    </a><!--//nav-link-->
                                </li><!--//nav-item-->
                            @endif
                        @endif
                    </ul><!--//footer-menu-->
                </nav>
            </div><!--//app-sidepanel-footer-->
        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span>@yield('titre')</span>
                </div>
                <div class="col-xs-12 col-sm-6">
                    @yield('other_content')
                </div>
            </div>
            @yield('content')
        </div><!--//container-fluid-->
    </div><!--//app-content-->
    <footer class="app-footer">
        <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Crée avec <span class="sr-only">love</span><i class="fas fa-heart"
                                                                                   style="color: #fb866a;"></i> par
                <a class="app-link" href="#" target="_blank">yourierick00@gmail.com</a> pour pefaco universelle</small>
        </div>
    </footer><!--//app-footer-->
</div><!--//app-wrapper-->

<script src="{{ asset("new_styles_and_scripts/js/core/jquery-3.7.1.min.js") }}"></script>
<script src="{{ asset("new_styles_and_scripts/js/core/popper.min.js") }}"></script>
<script src="{{ asset("new_styles_and_scripts/js/core/bootstrap.min.js") }}"></script>
<script src="{{ asset("new_styles_and_scripts/js/plugin/bootstrap-notify/bootstrap-notify.min.js") }}"></script>
<script src="{{ asset("new_styles_and_scripts/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") }}"></script>

<!-- Page Specific JS -->
<script src="{{ asset("assets/js/app.js") }}"></script>
<script src="{{ asset("new_styles_and_scripts/js/plugin/datatables/datatables.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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

    $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
            this.api()
            .columns()
            .every(function () {
                var column = this;
                var select = $(
                    '<select class="form-select"><option value=""></option></select>'
                )
                    .appendTo($(column.footer()).empty())
                    .on("change", function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column
                            .search(val ? "^" + val + "$" : "", true, false)
                            .draw();
                    });

                column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                    select.append(
                        '<option value="' + d + '">' + d + "</option>"
                    );
                });
            });
        },
    });
</script>
@yield('scripts')
</body>
</html>
