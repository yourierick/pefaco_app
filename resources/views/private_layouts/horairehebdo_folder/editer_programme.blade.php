@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Editer un programme")
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('horairehebdo.save_edition_programme', $programme->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_dept" style="color: #818183">département</label>
                                <select name="departement" class="form-control" required>
                                    @foreach($departements as $departement)
                                        <option @if(old('departement', $departement->designation) === $departement->designation) selected @endif value="{{ $departement->designation }}">{{ $departement->designation }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_jour" style="color: #818183">jour</label>
                                <select name="jour" class="form-control">
                                    <option @if($programme->jour === "lundi") selected @endif value="lundi">lundi</option>
                                    <option @if($programme->jour === "mardi") selected @endif value="mardi">mardi</option>
                                    <option @if($programme->jour === "mercredi") selected @endif value="mercredi">mercredi</option>
                                    <option @if($programme->jour === "jeudi") selected @endif value="jeudi">jeudi</option>
                                    <option @if($programme->jour === "vendredi") selected @endif value="vendredi">vendredi</option>
                                    <option @if($programme->jour === "samedi") selected @endif value="samedi">samedi</option>
                                    <option @if($programme->jour === "dimanche") selected @endif value="dimanche">dimanche</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('jour')"/>
                            </div>
                            <br>
                            <p>programmes</p>
                            <div id="container">
                                @php
                                    $count = 0;
                                    foreach (json_decode($programme->programme, true) as $value) {
                                        $count = $count + 1;
                                    }
                                @endphp
                                <label id="lbl_count" style="display: none">{{ $count }}</label>
                                @foreach(json_decode($programme->programme, true) as $value)
                                    <div class="d-flex" id="div_{{ $loop->iteration }}" style="gap: 5px">
                                        <textarea name="programme[]" class="form-control mb-2" required style="width: 80%;">{{ $value }}</textarea>
                                        <button type="button" onclick="deleteexistprogramme(this)" class="btn btn-danger" id="btn_remove_div_{{ $loop->iteration }}" style="height: 80%; color: white">supprimer</button>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('programme')"/>
                            <button type="button" class="btn" id="btn_programme"><i class='bx bx-plus-circle' style="font-size: 12pt"></i></button>
                            <hr>

                            <button type="submit" class="btn btn-primary mt-2 text-light">enregistrer</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/horairehebdo_scripts/editer_script.js') }}"></script>
@endsection

