@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Nouveau programme')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('horairehebdo.save_programmation', $horaire->id) }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_dept" style="color: #818183">département</label>
                                <select name="departement" class="form-control" required>
                                    @foreach($departements as $departement)
                                        <option @if(old('departement') === $departement->designation) selected @endif value="{{ $departement->designation }}">{{ $departement->designation }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_jour" style="color: #818183">jour</label>
                                <select name="jour" class="form-control" required>
                                    <option @if(old('jour') === "lundi") selected @endif value="lundi">lundi</option>
                                    <option @if(old('jour') === "mardi") selected @endif value="mardi">mardi</option>
                                    <option @if(old('jour') === "mercredi") selected @endif value="mercredi">mercredi</option>
                                    <option @if(old('jour') === "jeudi") selected @endif value="jeudi">jeudi</option>
                                    <option @if(old('jour') === "vendredi") selected @endif value="vendredi">vendredi</option>
                                    <option @if(old('jour') === "samedi") selected @endif value="samedi">samedi</option>
                                    <option @if(old('jour') === "dimanche") selected @endif value="dimanche">dimanche</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('jour')"/>
                            </div>
                            <br>
                            <p>programmes</p>
                            <div id="container">

                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('programme')"/>
                            <button type="button" class="btn" id="btn_programme"><i class='bx bx-plus-circle' style="font-size: 12pt"></i></button>
                            <hr>

                            <button type="submit" name="action" value="soumission"  class="btn btn-primary mt-2 text-light">enregistrer</button>
                            <button type="submit" name="action" value="nouvel_enregistrement" class="btn btn-primary mt-2 text-light">enregistrer à nouveau</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/horairehebdo_scripts/programmation.js') }}"></script>
@endsection

