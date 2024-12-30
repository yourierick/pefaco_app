@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('style')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
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
@endsection
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if (!is_null($autorisations))
            @if($autorisations->autorisation_speciale)
                @if(in_array('peux modifier', json_decode($autorisations->autorisation_speciale, true)))
                    <div style="float:right">
                        <a href="{{ route('membres.edit_membre', $membre->id) }}" class="btn btn-primary mb-2"><span style="color: white"> modifier</span></a>
                    </div>
                @endif
            @endif
        @endif
    </div>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="max-w-xl">
                            <h5 class="text-info" style="font-weight: 400; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 11pt">Membre</span></h5>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row mt-5">
                            <div class="col-12 col-md-2">
                                <div class="mt-4">
                                    <img src="@if ($membre->photo) /storage/{{ $membre->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif" class="img-fluid" alt="" style="box-shadow: 4px 0 0 #457ebe; padding-right: 2px; max-height: 160px; max-width: 150px">
                                </div>
                            </div>
                            <div class="col-12 col-md-8" style="align-content: center">
                                <div style="margin-top: 30px">
                                    <p style="font-size: 11pt; margin: 0">Identification du membre</p>
                                    <hr style="background-color: #457ebe; height: 3px; margin: 0">
                                    <p class="text-warning" style="font-size: 12pt">{{ $membre->nom }}</p>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Sexe: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->sexe }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Nationalité: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->nationalite }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Lieu de naissance: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->lieu_de_naissance }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Date de naissance: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->date_de_naissance->format('d/m/Y') }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Contacts: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->contacts }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Email: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->email }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative d-none d-md-block">
                                <div class="orange-line"></div>
                            </div>
                            
                        </div>
                        <div>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Adresse de résidence actuelle: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize">{{ $membre->adresse_de_residence_actuelle }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Adresse de résidence permanente: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->adresse_de_residence_permanente }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Etat civil: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $membre->etat_civil }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Partenaire: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize">{{ $membre->partenaire }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Nombre d'enfants: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize">{{ $membre->nombre_enfants }} enfants</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Profession: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize">{{ $membre->profession }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Baptisé ?: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-success" style="margin: 0"> <span style="text-transform: capitalize; font-weight: 500; color: rgb(12, 84, 240)">{{ $membre->baptise }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Date de baptême: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize; font-weight: 500">{{ $membre->date_de_bapteme->format('d/m/Y') }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Statut: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize; font-weight: 500">{{ $membre->statut }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Fonction: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize; font-weight: 500">{{ $membre->fonction }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 col-md-4">
                                    <p class="text-muted" style="margin: 0">Responsabilités: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p class="text-muted" style="margin: 0; text-align: justify"> <span style="text-transform: capitalize; font-weight: 400; ">{{ $membre->responsabilites }}</span></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 col-md-4">
                                    <p style="margin: 0">Etat: </p>
                                </div>
                                <div class="col-6 col-md-8">
                                    <p @class(['text-warning' => $membre->etat === 'suspendu', 'text-success' => $membre->etat === 'en service']) style="margin: 0; font-weight: 500">{{ $membre->etat }}</p>
                                </div>
                            </div>
                            @if ($membre->etat === "suspendu")
                                <div class="row mt-2">
                                    <div class="col-6 col-md-4">
                                        <p class="text-muted" style="margin: 0">Motif de suspension: </p>
                                    </div>
                                    <div class="col-6 col-md-8">
                                        <p class="text-muted" style="margin: 0"> <span style="text-transform: capitalize; font-weight: 400">{{ $membre->motif_de_suspension }}</span></p> 
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


