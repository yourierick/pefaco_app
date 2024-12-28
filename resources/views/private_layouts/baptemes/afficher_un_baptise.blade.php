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
                        <a href="{{ route('baptemes.edit_baptise', $baptise->id) }}" class="btn btn-primary mb-2"><span style="color: white"> modifier</span></a>
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
                            <h5 class="text-info" style="font-weight: 400; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 11pt">Baptisé</span></h5>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row mt-5">
                            <div class="col-12 col-md-2">
                                <div class="mt-4">
                                    <img src="@if ($baptise->photo) /storage/{{ $baptise->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif" class="img-fluid" alt="" style="box-shadow: 4px 0 0 #457ebe; padding-right: 2px; max-height: 160px; max-width: 150px">
                                </div>
                            </div>
                            <div class="col-12 col-md-8" style="align-content: center">
                                <div style="margin-top: 30px">
                                    <p style="font-size: 11pt; margin: 0">Identification du baptisé</p>
                                    <hr style="background-color: #457ebe; height: 3px; margin: 0">
                                    <p class="text-warning" style="font-size: 12pt">{{ $baptise->nom }}</p>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Sexe: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $baptise->sexe }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Adresse de résidence: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $baptise->adresse_de_residence }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Date de naissance: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $baptise->date_de_naissance->format('d/m/Y') }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Date de baptême: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $baptise->date_de_bapteme->format('d/m/Y') }}</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <p class="text-muted" style="margin: 0">Nom de baptême: </p>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <p class="text-muted" style="margin: 0"><span style="text-transform: capitalize">{{ $baptise->nom_de_bapteme }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative d-none d-md-block">
                                <div class="orange-line"></div>
                            </div>
                        </div>   
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


