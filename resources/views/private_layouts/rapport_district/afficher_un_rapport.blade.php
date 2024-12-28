@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('other_content')
    <div class="modal fade" id='modal'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100 fw-normal">
                        <span class="text-danger fs-4 fa fa-warning"></span><span class="bx-flashing fs-4"> Attention! vous ne devez valider ce rapport que si vous avez déjà réceptionné l'argent dont on fait référence sur celui-ci</span>
                        <hr>
                        <form action="{{ route('rapportdistrict.traitement_du_rapport', $rapport->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button style="font-weight: normal" name="action" value="soumettre_pour_confirmation" class="btn btn-primary" type="submit"><span class="bi-check-circle-fill text-light"> valider</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex" style="gap: 3px; float: right">
        <div class="btn-group dropdown" style="float: right;">
            <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>
            <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                <li>
                    <p class="text-center">MENU</p>
                    <div class="dropdown-divider"></div>
                    <a style="font-weight: normal" href="{{ route('rapportdistrict.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"></span> voir mes drafts</a>
                    @if(!is_null($autorisation))
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                <a style="font-weight: normal" href="{{ route('rapportdistrict.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"></span> faire un rapport</a>
                            @endif
                        @endif
                    @endif
                    @if(!is_null($autorisation_speciale))
                        @if($autorisation_speciale->autorisation_speciale)
                            @if(in_array('peux approuver un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_approbation') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-info"> </span> rapports en attente d'approbation</a>
                            @endif
                            @if(in_array('peux valider un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill text-secondary"></span> rapports en attente de validation</a>
                            @endif
                            @if(in_array('peux confirmer un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_confirmation') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"></span> rapports en attente de confirmation</a>
                            @endif
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    <p class="text-center mb-1">ACTION SUR LE DOCUMENT</p>
                    @if(!is_null($autorisation))
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux modifier un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                @if($rapport->statut === "draft" || $rapport->statut === "en attente d'approbation" && $rapport->rapporteur_id == $current_user->id)
                                    <a style="font-weight: normal" href="{{ route('rapportdistrict.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-info"></span> modifier</a>
                                @else
                                    @if(!is_null($autorisation_speciale))
                                        @if ($rapport->statut === "en attente d'approbation" && in_array('peux approuver un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)) || $rapport->statut === "en attente de validation" && in_array('peux valider un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)) || $rapport->statut === "en attente de confirmation" && in_array('peux confirmer un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                            <a style="font-weight: normal" href="{{ route('rapportdistrict.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-info"></span> modifier</a>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif

                    <form action="{{ route('rapportdistrict.traitement_du_rapport', $rapport->id) }}" method="post">
                        @csrf
                        @method('put')
                        @if($rapport->statut === 'draft')
                            <button style="font-weight: normal" name="action" value="soumettre_pour_approbation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span>soumettre pour approbation</button>
                        @endif
                        @if(!is_null($autorisation_speciale))
                            @if($rapport->statut === "en attente d'approbation")
                                @if(in_array('peux approuver un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <button style="font-weight: normal" name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre pour validation</button>
                                @endif
                            @endif
                            @if($rapport->statut === 'en attente de validation')
                                @if(in_array('peux valider un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))    
                                    <button style="font-weight: normal" data-bs-toggle="modal" data-bs-target='#modal' class="dropdown-item btn btn-outline-secondary perso" type="button"><span class="bi-check-circle-fill text-success"></span> soumettre pour confirmation</button>
                                @endif
                            @endif
                            @if($rapport->statut === 'en attente de confirmation')
                                @if(in_array('peux confirmer un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))    
                                    <button style="font-weight: normal" name="action" value="valider" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> valider</button>
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
            background-color: #457ebe;
            transform: translateY(-50%);
        }
    </style>
    <link href="{{ asset("new_styles_and_scripts/css/afficher_rapport_mensuel_styles.css") }}" rel="stylesheet">
@endsection
@section('content')
    <div class="py-12 mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <h5 class="text-info" style="font-weight: 400; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 11pt">Rapport de District</span></h5>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="@if ($rapport->rapporteur->photo) /storage/{{ $rapport->rapporteur->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif" class="img-fluid" alt="" style="box-shadow: 4px 0 0 #457ebe; padding-right: 2px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Rapporteur</p>
                            <hr style="background-color: #457ebe; height: 4px; margin: 0">
                            <p class="text-primary" style="font-size: 14pt"> {{ $rapport->rapporteur->nom }} {{ $rapport->rapporteur->postnom }} {{ $rapport->rapporteur->prenom }}</p>
                            <h6 class="text-muted" style="margin: 0">Qualité: <span style="text-transform: capitalize">{{ $rapport->rapporteur->qualite->designation }}</span></h6>
                            <p>Mois de rapportage: {{ $rapport->mois->translatedFormat("F Y") }}</p>
                            <p>Date de rapportage: {{ $rapport->created_at->format("d-m-Y") }}</p>
                            <p style="margin: 0"><span style="color: black">Zone concernée:</span> {{ $rapport->zone }}</p>
                            <p style="margin: 0"><span style="color: black">Paroisses concernées:</span> {{ $rapport->paroisses_concernees }}</p>
                            <p style="margin: 0; color: red">Statut du rapport: {{ $rapport->statut }}</p>
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
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">1. CONTEXTE</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">2. STATISTIQUES</span></p>
                                    <ul>
                                        <li>Nombre cumulés des cultes tenus dans toutes les paroisses</li>
                                        <li>Moyenne cumulées de participation dans les cultes dans toutes les paroisses</li>
                                        <li>Nombre cumulés des personnes baptisées dans toutes les paroisses</li>
                                    </ul>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">3. FINANCES</span></p>
                                    <ul>
                                        <li>Dime des dimes</li>
                                        <li>Total offrande</li>
                                        <li>Autres contributions à renseigner</li>
                                    </ul>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">4. AUTRES FAITS A RAPPORTER</span></p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">5. CONCLUSIONS</span></p>
                                    <ul>
                                        <li>Observations</li>
                                        <li>Difficultés et défis</li>
                                        <li>Récommandations</li>
                                        <li>Prévisions pour le mois prochain</li>
                                        <li>Besoins à signaler</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container my-5">
                        <div>
                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-church text-warning fs-3"></i>
                                </div>
                                <div style="background: #457ebe;" class="card-content">
                                    <h5 class="text-white">1. CONTEXTE</h5>
                                </div>
                            </div>
                            <div style="padding: 0" class="p-3">
                                <div class="custom-card-text mt-2 p-2">
                                    <p class="ml-2" style="text-align: justify">
                                        {{ $rapport->contexte }}
                                    </p>
                                </div>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-person-burst text-secondary fs-3"></i>
                                </div>
                                <div class="card-content bg-secondary">
                                    <h5 class="text-white">2. STATISTIQUES</h5>
                                </div>
                            </div>
                            <div style="padding: 0" class="p-3">
                                <div class="custom-card-text mt-2 p-2">
                                    <table class="table table-striped w-100">
                                        <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                            <tr>
                                                <th style="font-weight: 500">Nombre cumulé des cultes tenus</th>
                                                <th style="font-weight: 500">Moyenne cumulée de participation</th>
                                                <th style="font-weight: 500">Nombre des personnes baptisées</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell"> {{ $rapport->nombre_des_cultes_tenus }} cultes</td>
                                                <td class="cell"> {{ $rapport->moyenne_de_frequentation }} personnes</td>
                                                <td class="cell"> {{ $rapport->nombre_des_personnes_baptises }} personnes</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-bible text-secondary fs-3"></i>
                                </div>
                                <div class="card-content bg-secondary">
                                    <h5 class="text-white">3. FINANCES</h5>
                                </div>
                            </div>
                            <div style="padding: 0" class="p-3">
                                <div class="custom-card-text mt-2 p-2">
                                    <table class="table table-striped w-100">
                                        <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                            <tr>
                                                <th style="font-weight: 500">Dime des dimes</th>
                                                <th style="font-weight: 500">Total offrande</th>
                                                <th style="font-weight: 500">Autres contributions à renseigner</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($current_user->id == $rapport->rapporteur_id)
                                                <tr>
                                                    <td class="cell"> {{ $rapport->dime_des_dimes }} FC</td>
                                                    <td class="cell"> {{ $rapport->total_offrande }} FC</td>
                                                    <td class="cell"> {{ $rapport->autres_contributions_a_renseigner }} personnes</td>
                                                </tr>
                                            @elseif(!is_null($autorisation_speciale))
                                                @if(in_array('peux voir la partie financière du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                                    <tr>
                                                        <td class="cell"> {{ $rapport->dime_des_dimes }} FC</td>
                                                        <td class="cell"> {{ $rapport->total_offrande }} FC</td>
                                                        <td class="cell"> {{ $rapport->autres_contributions_a_renseigner }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="cell"> 0 FC</td>
                                                        <td class="cell"> 0 FC</td>
                                                        <td class="cell"> RAS</td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr>
                                                    <td class="cell"> 0 FC</td>
                                                    <td class="cell"> 0 FC</td>
                                                    <td class="cell"> RAS</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
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
                                    <p class="ml-2" style="text-align: justify">
                                        {{ $rapport->autres_evenements_a_rapporter }}
                                    </p>
                                </div>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-lightbulb text-warning fs-3"></i>
                                </div>
                                <div style="background: #457ebe;" class="card-content">
                                    <h5 class="text-white">5. CONCLUSION</h5>
                                </div>
                            </div>
                            <div style="padding: 0" class="p-3">
                                <div class="custom-card-text mt-2 p-2">
                                    <ul><li style="font-weight: bold">Observation</li></ul>
                                    <p class="ml-2 mr-2" style="text-align: justify">{{ $rapport->observation ? : "Rien à signaler" }}</p>
                                    <br>
                                    <ul><li style="font-weight: bold">Récommandations</li></ul>
                                    <p class="ml-2 mr-2" style="text-align: justify">{{ $rapport->recommandations ? : 'Rien à signaler' }}</p>
                                    <br>
                                    <ul><li style="font-weight: bold">Difficultés et défis</li></ul>
                                    <p class="ml-2 mr-2" style="text-align: justify">{{ $rapport->difficultes_defis ? : 'Rien à signaler' }}</p>
                                    <br>
                                    <ul><li style="font-weight: bold">Prévisions pour le mois prochain</li></ul>
                                    <p class="ml-2 mr-2" style="text-align: justify">{{ $rapport->previsions_mois_prochain ? : 'Rien à signaler' }}</p>
                                    <br>
                                    <ul><li style="font-weight: bold">Besoins à signaler</li></ul>
                                    <p class="ml-2 mr-2" style="text-align: justify">{{ $rapport->besoins_a_signaler ? : 'Rien à signaler' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

