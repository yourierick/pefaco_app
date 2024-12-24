@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Vue du rapport de culte')
@section('other_content')
    <div class="d-flex" style="gap: 3px; float: right">
        <div class="btn-group dropdown" style="float: right;">
            <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>
            <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                <li>
                    <p class="text-center">MENU</p>
                    @if(!is_null($autorisation))
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                <a href="{{ route('rapportinspection.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                                <a href="{{ route('rapportinspection.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> faire un rapport</span></a>
                            @endif
                        @endif
                    @endif
                    @if(!is_null($autorisation_speciale))
                        @if($autorisation_speciale->autorisation_speciale)
                            @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a href="{{ route('rapportinspection.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                            @endif
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    <p class="text-center mb-1">ACTION SUR LE DOCUMENT</p>
                    @if($rapport->statut !== "validé")
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                @if(in_array('peux modifier un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportinspection.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-primary"></span> {{ $rapport->statut === "en attente de complétion" && !is_null($autorisation_speciale) && $autorisation_speciale->autorisation_speciale && in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)) ? "compléter le rapport": "modifier" }}</a>
                                @endif
                            @endif
                        @endif
                    @endif
                    <form action="{{ route('rapportinspection.traitement_du_rapport', $rapport->id) }}" method="post">
                        @csrf
                        @method('put')
                        @if($rapport->statut === 'draft')
                            @if($autorisation_speciale)
                                <button name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre pour validation</button>
                            @endif
                        @endif
                        @if($rapport->statut === 'en attente de validation')
                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <button name="action" value="validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"> valider</span></button>
                                    @endif
                                @endif
                            @endif
                        @endif
                    </form>
                </li>
            </ul>
        </div>

    </div>
@endsection
@section('style')
    <style>
        .orange-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            height: 40px;
            background-color: orangered;
            transform: translateY(-50%);
        }
    </style>
    <link href="{{ asset("new_styles_and_scripts/css/afficher_rapport_mensuel_styles.css") }}" rel="stylesheet">
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <h5 style="font-weight: bold; margin: 0; color: dodgerblue"> Eglise pefaco universelle|  <span style="color: gray; font-size: 13pt">Rapport d'Inspection</span></h5>
                    <p style="margin: 0">Département: {{ $rapport->rapporteur->departement->designation }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="/storage/{{ $rapport->rapporteur->photo }}" class="img-fluid" alt="" style="box-shadow: 4px 0 0 orangered; padding-right: 10px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Rapporteur</p>
                            <hr style="background-color: orangered; height: 4px; margin: 0">
                            <p style="font-size: 12pt; color: dodgerblue"> {{ $rapport->rapporteur->nom }} {{ $rapport->rapporteur->postnom }} {{ $rapport->rapporteur->prenom }}</p>
                            <h6 class="text-muted" style="margin: 0">Qualité: <span style="text-transform: capitalize">{{ $rapport->rapporteur->qualite->designation }}</span></h6>
                            <p>Date de rapportage: <span style="text-transform: capitalize">{{ \Carbon\Carbon::parse($rapport->created_at)->isoFormat('dddd') }}</span>, {{ $rapport->created_at->format("d-m-Y") }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 position-relative d-none d-md-block">
                        <div class="orange-line"></div>
                    </div>
                </div>
                <hr style="height: 1px;">
                <div class="mt-5">
                    <h6 class="text-muted">0. SOMMAIRE</h6>
                    <div class="row ml-5">
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">1. PAROISSES CONCERNEES</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">2. CONTEXTE</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">3. CONSTATS</span></p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">4. DIFFICULTES RENCONTREES</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">5. RECOMMANDATIONS</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container my-5">
                    <div class="row">
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-church text-warning fs-3"></i>
                            </div>
                            <div style="background: #457ebe;" class="card-content">
                                <h5 class="text-white">1. PAROISSES CONCERNEES</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">{{ $rapport->paroisses_concernees }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-person-burst text-secondary fs-3"></i>
                            </div>
                            <div class="card-content bg-secondary">
                                <h5 class="text-white">2. CONTEXTE</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">{{ $rapport->contexte }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-bible text-secondary fs-3"></i>
                            </div>
                            <div class="card-content bg-secondary">
                                <h5 class="text-white">3. CONSTATS</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">{{ $rapport->constats }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-file-archive text-warning fs-3"></i>
                            </div>
                            <div style="background: #457ebe;" class="card-content">
                                <h5 class="text-white">4.DIFFICULTES RENCONTREES</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">{{ $rapport->difficultes_rencontrees }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-lightbulb text-warning fs-3"></i>
                            </div>
                            <div style="background: #457ebe;" class="card-content">
                                <h5 class="text-white">5. RECOMMANDATIONS</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">{{ $rapport->recommandations }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

