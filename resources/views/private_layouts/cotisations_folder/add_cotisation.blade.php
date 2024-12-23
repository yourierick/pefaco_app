@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Nouvelle cotisation')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('cotisation.save_new_cotisation') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_motif">Déscription de la cotisation</label>
                                <input class="form-control" type="text" name="motif" placeholder="déscription" id="id_motif">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('motif')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_debut">Date de début</label>
                                <input class="form-control" name="date_debut" type="date" id="id_date_debut">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_debut')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_fin">Date de fin</label>
                                <input class="form-control" name="date_fin" type="date" id="id_date_fin">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_fin')"/>
                            </div>
                            <button class="btn btn-primary mt-2 text-light">Soumettre</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

