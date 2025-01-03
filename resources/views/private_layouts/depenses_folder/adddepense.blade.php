@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <h3 class="mb-4">Engager une Dépense</h3>
                        <button class="btn btn-secondary mt-1 mb-2" id="btn_generate_code">Générer un code pour cette dépense</button>
                        <form method="post" action="{{ route('depense.save_new_depense') }}" class="mt-6 space-y-6" >
                            @csrf
                            <div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="text_code_depense">Code de la dépense</label>
                                    <input id="text_code_depense" type="text" value="{{ old('code_de_depense') }}" name="code_de_depense" class="form-control mb-2" readonly>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('code_de_depense')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Contexte</label>
                                    <textarea name="context" class="form-control">{{ old('context') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('context')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Motif</label>
                                    <textarea name="motif" class="form-control mt-2">{{ old('motif') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('motif')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Montant (en {{ $parametre_devise }})</label>
                                    <input name="montant" type="number" value="{{ old('montant') }}" placeholder="montant" step="any" class="form-control mt-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('montant')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Source à imputer</label>
                                    <select name="source_a_imputer_id" class="form-control mt-2 p-2">
                                        <option selected disabled>--------------</option>
                                        <option value="{{ $caisse->id }}" @if($caisse->id == (old('source_a_imputer_id'))) selected @endif>caisse du {{ $caisse->departement->designation }}</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('source_a_imputer_id')"/>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary mt-2 text-light" type="submit">Soumettre</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/depense_scripts/depense.js') }}"></script>
@endsection

