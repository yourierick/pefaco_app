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
                    <a href="{{ route('rapportculte.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                    @if(!is_null($autorisation))
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                <a href="{{ route('rapportculte.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> faire un rapport</span></a>
                            @endif
                        @endif
                    @endif
                    @if(!is_null($autorisation_speciale))
                        @if($autorisation_speciale->autorisation_speciale)
                            @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a href="{{ route('rapportculte.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                            @endif
                            @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a href="{{ route('rapportculte.les_attentes_en_completion') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"> rapports en attente de complétion</span></a>
                            @endif
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    <p class="text-center mb-1">ACTION SUR LE DOCUMENT</p>
                    @if($rapport->statut === "validé")
                        @if($autorisation_speciale)
                            @if($autorisation_speciale->autorisation_speciale)
                                @if(in_array("peux changer l'audience", json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    @if($rapport->audience === "privé")
                                        <form method="post" action="{{ route('rapportculte.audience_rapport', $rapport->id) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" name="action" value="public" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-check-circle-fill text-primary"></span> publier</button>
                                        </form>
                                    @elseif($rapport->audience === "public")
                                        <form method="post" action="{{ route('rapportculte.audience_rapport', $rapport->id) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" name="action" value="privé" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-check-circle-fill text-primary"></span> privé</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('rapportculte.audience_rapport', $rapport->id) }}">
                                            @csrf
                                            @method('put')
                                            <button type="submit" name="action" value="public" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-check-circle-fill text-primary"></span> publier</button>
                                            <button type="submit" name="action" value="privé" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-check-circle-fill text-primary"></span> privé</button>
                                        </form>
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif
                    @if ($rapport->statut !== "draft" || $rapport->statut !== "validé")
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                @if(in_array('peux modifier un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportculte.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-primary"></span> {{ $rapport->statut === "en attente de complétion" && !is_null($autorisation_speciale) && $autorisation_speciale->autorisation_speciale && in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)) ? "compléter le rapport": "modifier" }}</a>
                                @endif
                            @endif
                        @endif
                    @elseif($rapport->statut === "draft")
                        <a href="{{ route('rapportculte.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-primary"></span> {{ $rapport->statut === "en attente de complétion" && !is_null($autorisation_speciale) && $autorisation_speciale->autorisation_speciale && in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)) ? "compléter le rapport": "modifier" }}</a>
                    @endif
                    <form action="{{ route('rapportculte.traitement_du_rapport', $rapport->id) }}" method="post">
                        @csrf
                        @method('put')
                        @if($rapport->statut === 'draft')
                            @if($autorisation_speciale)
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <button name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre pour validation</button>
                                    @else
                                        <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                                    @endif
                                @else
                                    <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                                @endif
                            @else
                                <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                            @endif
                        @endif
                        @if($rapport->statut === 'en attente de validation')
                            <button name="action" value="validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"> valider</span></button>
                        @endif
                        @if($rapport->statut === 'en attente de complétion')
                            <button name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"> soumettre pour validation</span></button>
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
                    <h5 style="font-weight: bold; margin: 0; color: dodgerblue"> Eglise pefaco universelle|  <span style="color: gray; font-size: 13pt">Rapport de culte</span></h5>
                    <p style="margin: 0">Département: {{ $rapport->departement->designation }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="/storage/{{ $rapport->user_rapporteur->photo }}" class="img-fluid" alt="" style="box-shadow: 4px 0 0 orangered; padding-right: 10px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Rapporteur</p>
                            <hr style="background-color: orangered; height: 4px; margin: 0">
                            <p style="font-size: 12pt; color: dodgerblue"> {{ $rapport->user_rapporteur->nom }} {{ $rapport->user_rapporteur->postnom }} {{ $rapport->user_rapporteur->prenom }}</p>
                            <h6 class="text-muted" style="margin: 0">Qualité: <span style="text-transform: capitalize">{{ $rapport->user_rapporteur->qualite->designation }}</span></h6>
                            <p>Date de rapportage: <span style="text-transform: capitalize">{{ \Carbon\Carbon::parse($rapport->date)->isoFormat('dddd') }}</span>, {{ $rapport->date->format("d-m-Y") }}</p>
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
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">1. SERVICE DU JOUR</span></p>
                                    <ul>
                                        <li>Officient du jour</li>
                                        <li>Orateur du jour</li>
                                    </ul>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">2. PREDICATION/ENSEIGNEMENT DU JOUR</span></p>
                                    <ul>
                                        <li>Références</li>
                                        <li>Synthèse de la prédication</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">3. STATISTIQUES DU JOUR</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">4. AUTRES FAITS A RAPPORTER</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">5. OFFRANDES DU JOUR</span></p>
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
                                <h5 class="text-white">1. SERVICE DU JOUR</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <p class="ml-2" style="text-align: justify">En ce jour du <span style="text-transform: capitalize">{{ \Carbon\Carbon::parse($rapport->date)->isoFormat('dddd') }}</span>, {{ $rapport->date->format("d-m-Y") }}
                                s'est tenu notre assemblée sous l'officience de notre cher(e) bien-aimé(e), Serviteur {{ $rapport->moderateur }}. l'oration a été assuré
                                par notre cher(e) bien-aimé(e), Serviteur {{ $rapport->orateur }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-person-burst text-secondary fs-3"></i>
                            </div>
                            <div class="card-content bg-secondary">
                                <h5 class="text-white">3. STATISTIQUES DU JOUR</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                - <span>Nombre total des personnes présentes dans le culte :</span> {{ $rapport->total_pers_dans_le_culte }} personnes<br>
                                <hr style="width: 100%">
                                <div style="margin-left: 15px">
                                    <p style="font-weight: bold">Désagrégation par catégorie</p>
                                    - <span>Nombre total des papas présents dans le culte :</span> <span style="font-weight: 500">{{ $rapport->total_papas }} papas</span><br>
                                    - <span>Nombre total des mamans présentes dans le culte :</span> <span style="font-weight: 500">{{ $rapport->total_mamans }} mamans</span><br>
                                    - <span>Nombre total des jeunes présents dans le culte :</span> <span style="font-weight: 500">{{ $rapport->total_jeunes }} jeunes</span><br>
                                    - <span>Nombre total d'enfants présents dans le culte :</span> <span style="font-weight: 500">{{ $rapport->total_enfants }} enfants</span><br>
                                </div>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-bible text-secondary fs-3"></i>
                            </div>
                            <div class="card-content bg-secondary">
                                <h5 class="text-white">2. PREDICATION/ENSEIGNEMENT DU JOUR</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                <div>
                                    <span class="ml-2" style="font-weight: 600">Référence:</span>
                                    @foreach(json_decode($rapport->reference, true) as $value)
                                        <span>{{ $value }}</span><br>
                                    @endforeach
                                </div>
                                <hr>
                                <p class="ml-2" style="text-align: justify">{{ $rapport->synthese }}</p>
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-file-archive text-warning fs-3"></i>
                            </div>
                            <div style="background: #457ebe;" class="card-content">
                                <h5 class="text-white">4. AUTRES FAITS A RAPPORTER</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                @foreach(json_decode($rapport->autres_faits_a_renseigner, true) as $value)
                                    - <p class="ml-2" style="text-align: justify">{{ $value }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="custom-card d-flex align-items-center">
                            <div class="icon-circle text-white">
                                <i class="fa fa-lightbulb text-warning fs-3"></i>
                            </div>
                            <div style="background: #457ebe;" class="card-content">
                                <h5 class="text-white">5. OFFRANDES DU JOUR</h5>
                            </div>
                        </div>
                        <div style="padding: 0" class="p-3">
                            <div class="custom-card-text mt-2 p-2">
                                @if($autorisation_speciale)
                                    @if($autorisation_speciale->autorisation_speciale)
                                        @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                            <ul><li><span>Offrandes totales :</span> <span style="font-weight: 500">{{ $rapport->total_offrande }} FC</span><br></li></ul>
                                        @endif
                                    @endif
                                @endif
                                <span style="font-weight: 600; font-style: italic" class="ml-4">OFFRANDES SPECIALES :</span>
                                <div class="ml-1">
                                    <ul>
                                        @foreach(json_decode($rapport->don_special, true) as $value)
                                            <li><span>{{ $value }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

