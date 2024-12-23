@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('communique.save_edition_communique', $communique->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <h3>Editer un Communiqué</h3>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ $communique->date->format('Y-m-d') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ $communique->titre }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <br>
                            <div id="container">
                                @php
                                    $count = 0;
                                    foreach (json_decode($communique->contenu, true) as $value) {
                                        $count = $count + 1;
                                    }
                                @endphp
                                <label id="lbl_count" style="display: none">{{ $count }}</label>
                                @foreach(json_decode($communique->contenu, true) as $value)
                                    <div class="d-flex" id="div_{{ $loop->iteration }}" style="gap: 5px">
                                        <textarea name="communique[]" class="form-control mb-2" required style="width: 80%;">{{ $value }}</textarea>
                                        <button type="button" onclick="deletecommunique(this)" class="btn btn-danger" id="btn_remove_div_{{ $loop->iteration }}" style="height: 80%; color: white">supprimer</button>
                                    </div>
                                @endforeach
                            </div>

                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('communique')"/>
                            <button type="button" class="btn" id="btn_communique"><i class='bx bx-plus-circle' style="font-size: 12pt"></i></button>
                            <hr>

                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer</button>
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

