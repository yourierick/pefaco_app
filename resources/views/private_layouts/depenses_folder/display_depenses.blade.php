@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Afficher la dépense')
@section('other_content')
    <div class="d-flex" style="float: right; gap: 5px">
        <div class="btn-group dropdown" style="float: right;">
            <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>
            <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                <li>
                    <p class="text-center">MENU</p>
                    <div class="dropdown-divider"></div>
                    @if($autorisation)
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture)))
                                <a href="{{ route('depense.ajouter') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-primary"></span> Engager une dépense</a>
                            @endif
                            @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                @if($depense->statut === 'draft')
                                    <a href="{{ route('depense.edit_depense', $depense->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square"></span> Modifier</a>
                                @elseif($depense->statut === "en attente de validation")
                                    @if(!is_null($autorisations_speciales))
                                        @if ($autorisations_speciales->autorisation_speciale)
                                            @if(in_array('peux valider une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                <a href="{{ route('depense.edit_depense', $depense->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square"></span> Modifier</a>
                                            @endif
                                        @endif
                                    @endif
                                @elseif($depense->statut === "en attente de confirmation")
                                    @if(!is_null($autorisations_speciales))
                                        @if ($autorisations_speciales->autorisation_speciale)
                                            @if(in_array('peux confirmer une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                <a href="{{ route('depense.edit_depense', $depense->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square"></span> Modifier</a>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    @switch($depense->statut)
                        @case('en attente de validation')
                            <div>
                                <div class="d-flex mt-3 gap-3">
                                    @if($autorisations_speciales)
                                        @if ($autorisations_speciales->autorisation_speciale)
                                            @if(in_array('peux rejeter une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                <button class="dropdown-item btn btn-outline-secondary perso" data-bs-toggle="modal"  data-bs-target='#modal'><span class='bi-arrow-bar-down text-secondary'></span> Rejeter</button>
                                            @endif
                                        @endif
                                    @endif
                                    <form method="post" action="{{ route('depense.traitement_depense', $depense->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="d-flex gap-2">
                                            @if($autorisations_speciales)
                                                @if ($autorisations_speciales->autorisation_speciale)
                                                    @if(in_array('peux valider une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                        <button name="action" value="valider" type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class=' bi-check-square'></span> Valider</button>
                                                    @endif
                                                    @if(in_array('peux mettre en attente une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                        <button name="action" value="mettre en attente" type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pause-circle-fill text-primary"></span> Mettre en attente</button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @break;
                        @case('en attente de confirmation')
                            <div class="d-flex mt-3 gap-3">
                                @if($autorisations_speciales)
                                    @if ($autorisations_speciales->autorisation_speciale)
                                        @if(in_array('peux rejeter une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                            <button class="dropdown-item btn btn-outline-secondary perso" data-bs-toggle="modal"  data-bs-target='#modal'><span class='bi-arrow-bar-down text-secondary'></span> Rejeter</button>
                                        @endif
                                    @endif
                                @endif
                                <form method="post" action="{{ route('depense.traitement_depense', $depense->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="d-flex">
                                        @if($autorisations_speciales)
                                            @if ($autorisations_speciales->autorisation_speciale)
                                                @if(in_array('peux confirmer une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                    <button name="action" value="confirmer" type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class='bi-check-square text-secondary'></span> Confirmer</button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </form>
                            </div>
                            @break;
                        @case('en attente')
                            <div>
                                <div class="d-flex mt-3 gap-3">
                                    @if($autorisations_speciales)
                                        @if ($autorisations_speciales->autorisation_speciale)
                                            @if(in_array('peux rejeter une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                <button class="dropdown-item btn btn-outline-secondary perso" data-bs-toggle="modal"  data-bs-target='#modal'><span class='bi-arrow-bar-down text-secondary'></span> Rejeter</button>
                                            @endif
                                        @endif
                                    @endif
                                    <form method="post" action="{{ route('depense.traitement_depense', $depense->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="d-flex gap-2">
                                            @if($autorisations_speciales)
                                                @if ($autorisations_speciales->autorisation_speciale)
                                                    @if(in_array('peux valider une dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                        <button name="action" value="valider" type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class='bi-check-square text-secondary'></span> Valider</button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @break;
                        @case('validé')
                            @php
                                $diff = null;
                                if ($depense->date_de_traitement !== null){
                                    $date_de_traitement = $depense->date_de_traitement;
                                    $date_de_traitement = \Carbon\Carbon::parse($date_de_traitement);
                                    $now = \Carbon\Carbon::now();
                                    $diff = $date_de_traitement->diffInHours($now);
                                }
                            @endphp
                            @if ($diff !== null)
                                @if($diff < 24 and $diff >= 0)
                                    <div>
                                        <div class="d-flex mt-3 gap-3">
                                            @if($autorisations_speciales)
                                                @if($autorisations_speciales->autorisation_speciale)
                                                    @if(in_array('peux annuler une action sur la dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                        <form method="post" action="{{ route('depense.annuler_action', $depense->id) }}">
                                                            @csrf
                                                            @method('put')
                                                            <button class="dropdown-item btn btn-outline-secondary perso"><span class='bi-arrow-bar-down text-secondary'></span> Annuler l'action</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @break;
                        @case('rejeté')
                            @php
                                $diff = null;
                                if ($depense->date_de_traitement !== null){
                                    $date_de_traitement = $depense->date_de_traitement;
                                    $date_de_traitement = \Carbon\Carbon::parse($date_de_traitement);
                                    $now = \Carbon\Carbon::now();
                                    $diff = $date_de_traitement->diffInHours($now);
                                }
                            @endphp
                            @if ($diff !== null)
                                @if($diff < 24 and $diff >= 0)
                                    <div>
                                        <div class="d-flex mt-3 gap-3">
                                            @if($autorisations_speciales)
                                                @if($autorisations_speciales->autorisation_speciale)
                                                    @if(in_array('peux annuler une action sur la dépense', json_decode($autorisations_speciales->autorisation_speciale, true)))
                                                        <form method="post" action="{{ route('depense.annuler_action', $depense->id) }}">
                                                            @csrf
                                                            @method('put')
                                                            <button class="dropdown-item btn btn-outline-secondary perso"><span class='bi-arrow-bar-down text-secondary'></span> Annuler l'action</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @break;
                        @case('draft')
                            <div>
                                <div class="d-flex mt-3 gap-3">
                                    <form method="post" action="{{ route('depense.traitement_depense', $depense->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="d-flex gap-2">
                                            <button name="action" value="soumettre" type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class='bi-check-square text-secondary'></span> Soumettre</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @break;
                        @default
                            <div></div>
                    @endswitch
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
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
                        <p>Voulez-vous vraiment rejeter cette dépense ?</p>
                    </div>
                    <form method="post" action="{{ route('depense.traitement_depense', $depense->id) }}">
                        @csrf
                        @method('put')
                        <div class="modal-footer">
                            <button name="action" value="rejeter" type="submit" class="btn btn-danger text-light" style="font-weight: normal">oui</button>
                            <button name="action" value="rejeter" type="button" class="btn btn-primary text-light" style="font-weight: normal" data-bs-dismiss="modal">non</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="shadow p-4 mt-4" style="background-color: #FFFFFF">
        <div class="max-w-xl">
            <h5 class="text-primary" style="font-weight: bold; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 11pt; font-weight: 500; color: black">Code de la Dépense: {{ $depense->code_de_depense }}</span></h5>
            <p style="margin: 0">Département: {{ $depense->departement->designation }}</p>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row mt-5">
            <div class="col-12 col-md-2">
                <div class="mt-4">
                    <div class="shadow p-2" style="box-shadow: 4px 0 0 orangered; padding-right: 10px; max-height: 160px; max-width: 150px; min-height: 120px" class="p-2 text-light"><span style="font-weight: 600; color: rgb(0, 0, 0)">CODE DE LA DEPENSE:</span> {{ $depense->code_de_depense }}</div>
                </div>
            </div>
            <div class="col-12 col-md-8" style="align-content: center">
                <div style="margin-top: 30px">
                    <p style="font-size: 12pt; margin: 0">Requérant</p>
                    <hr style="background-color: orangered; height: 4px; margin: 0">
                    <p class="text-primary" style="font-size: 14pt"> {{ $depense->requerant }}</p>
                    <p class="mb-0">Date de création de la dépense: {{ $depense->created_at->format("d-m-Y") }}</p>
                    <p>Source à imputer: caisse du {{ $depense->caisse->departement->designation }}</p>
                    <p><span class="fw-bold">Statut de la dépense : </span><span style="color: red; font-weight: 500">{{ $depense->statut }}</span></p>
                </div>
            </div>
            <div class="col-12 col-md-2 position-relative d-none d-md-block">
                <div class="orange-line"></div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <label class="fw-bold">1. Context</label>
            <p class="ml-3">{{ $depense->context }}</p>
            <label class="fw-bold">2. Motif</label>
            <p class="ml-3">{{ $depense->motif }}</p>
            <hr>
            <label class="fw-bold">3. Montant démandé</label>
            <p class="ml-3">{{ $depense->montant }} {{ $parametre_devise }}</p>
        </div>
    </div><!--//table-responsive-->
@endsection

