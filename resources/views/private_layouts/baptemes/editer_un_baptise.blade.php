@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('baptemes.save_edition_baptise', $baptise->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <h3 class="mb-3">Edition du Baptisé</h4>
                            
                            <div>
                                <img id="imagePreview"
                                    src="@if($baptise->photo) /storage/{{ $baptise->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif"
                                    alt=""
                                    style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
                            </div>
                            <div class="mb-3">
                                <input id="id_photo" name="photo" value="{{ $baptise->photo }}" type="file"
                                        class="form-control"/>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom" style="color: #818183">Nom</label>
                                <input class="form-control" type="text" name="nom" id="id_nom" value="{{ old('nom', $baptise->nom) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_sexe" style="color: #818183">Sexe</label>
                                <select name="sexe" id="id_sexe" class="form-control">
                                    <option @if($baptise->sexe === "homme") @endif value="homme">homme</option>
                                    <option @if($baptise->sexe === "femme") @endif value="femme">femme</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('sexe')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_adresse_de_residence" style="color: #818183">Adresse de résidence</label>
                                <input class="form-control" type="text" name="adresse_de_residence" id="id_adresse_de_residence" value="{{ old('adresse_de_residence', $baptise->adresse_de_residence) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse_de_residence')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_naissance" style="color: #818183">Date de naissance</label>
                                <input class="form-control" type="date" name="date_de_naissance" id="id_date_de_naissance" value="{{ old('date_de_naissance', $baptise->date_de_naissance->format('Y-m-d')) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_naissance')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_bapteme" style="color: #818183">Date de baptême</label>
                                <input class="form-control" type="date" name="date_de_bapteme" id="id_date_de_bapteme" value="{{ old('date_de_bapteme', $baptise->date_de_bapteme->format('Y-m-d')) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_bapteme')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom_de_bapteme" style="color: #818183">Nom de baptême</label>
                                <input class="form-control" type="text" name="nom_de_bapteme" id="id_nom_de_bapteme" value="{{ old('nom_de_bapteme', $baptise->nom_de_bapteme) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom_de_bapteme')"/>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer les modifications</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/communiques_scripts/editer_script.js') }}"></script>
@endsection

