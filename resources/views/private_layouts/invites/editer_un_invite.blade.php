@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('invites.save_edition_invite', $invite->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <h3 class="mb-3">Edition de l'invité</h4>
                            
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom" style="color: #818183">Nom</label>
                                <input class="form-control" type="text" name="nom" id="id_nom" value="{{ old('nom', $invite->nom) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_sexe" style="color: #818183">Sexe</label>
                                <select name="sexe" id="id_sexe" class="form-control">
                                    <option @if ($invite->sexe === "homme") selected @endif value="homme">homme</option>
                                    <option @if ($invite->sexe === "femme") selected @endif value="femme">femme</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('sexe')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_telephone" style="color: #818183">Téléphone</label>
                                <input class="form-control" type="text" name="telephone" id="id_telephone" value="{{ old('telephone', $invite->telephone) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('telephone')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_adresse_de_residence" style="color: #818183">Adresse de résidence</label>
                                <input class="form-control" type="text" name="adresse_de_residence" id="id_adresse_de_residence" value="{{ old('adresse_de_residence', $invite->adresse_de_residence) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse_de_residence')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_eglise_de_provenance" style="color: #818183">Eglise de provenance</label>
                                <input class="form-control" type="text" name="eglise_de_provenance" id="id_eglise_de_provenance" value="{{ old('eglise_de_provenance', $invite->eglise_de_provenance) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('eglise_de_provenance')"/>
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

