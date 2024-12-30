@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('communique.save_communique') }}" class="mt-6 space-y-6">
                            @csrf
                            <h3 class="mb-3">Nouveau Communiqué</h4>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ old('date') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" placeholder="titre" type="text" name="titre" id="id_titre" value="{{ old('titre') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <br>
                            <div id="container">

                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('communique')"/>
                            <button type="button" class="btn" id="btn_communique"><i class='bx bx-plus-circle' style="font-size: 12pt"></i></button>
                            <hr>

                            <button type="submit" class="btn btn-primary mt-2 text-light">Partager</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/communiques_scripts/ajouter_script.js') }}"></script>
@endsection

