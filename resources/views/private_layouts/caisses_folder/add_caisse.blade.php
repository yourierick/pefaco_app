@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('caisses.add_new') }}" class="mt-6 space-y-6">
                            @csrf
                            <h3 class="mb-3">Nouvelle Caisse</h3>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_departement" class="text-muted">Sélectionner le département pour lequel vous voulez créer la caisse</label>
                                    <select class="form-control p-2" name="departement_id" id="id_departement">
                                        <option selected disabled> --------- </option>
                                        @foreach($departements as $departement)
                                            <option value="{{ $departement->id }}" @if(old('departement_id') === $departement->id) selected @endif>{{ $departement->designation }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_departement" class="text-muted">Sélectionner le caissier</label>
                                    <select class="form-control p-2" name="caissier_id" id="id_caissier">
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('caissier_id')"/>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-2 text-light">Soumettre</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/caisse_scripts/add_caisse.js') }}"></script>
@endsection

