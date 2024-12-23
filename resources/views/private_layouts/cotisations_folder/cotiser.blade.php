@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Nouvelle cotisation')
@section('content')
    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('cotisation.save_new_cotisation_account', $cotisation_id) }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_cotisant" class="text-seconndary">Cotisant</label>
                                <input type="text" value="{{ old('cotisant') }}" placeholder="nom du cotisant" name="cotisant" class="form-control" id="id_cotisant">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('cotisant')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_montant" class="text-seconndary">Montant</label>
                                <input type="number" value="{{ old('montant') }}" step="any" class="form-control" id="id_montant" name="montant" placeholder="montant de cotisation">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('montant')"/>
                            </div>
                            <button class="btn btn-primary mt-2 text-light" id="btn_submit">Soumettre</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

