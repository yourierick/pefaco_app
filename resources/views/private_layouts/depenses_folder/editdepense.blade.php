@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('depense.save_edit_depense', $depense->id) }}" class="mt-6 space-y-6" >
                            @csrf
                            @method('put')
                            <h3>Editer une dépense</h3>
                            <div>
                                <input id="text_code_depense" type="hidden" value="{{ $depense->code_de_depense }}" name="code_de_depense" class="form-control mb-2" readonly>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('code_de_depense')"/>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Contexte</label>
                                    <textarea name="context" class="form-control">{{ $depense->context }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('context')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Motif</label>
                                    <textarea name="motif" class="form-control mt-2">{{ $depense->motif }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('motif')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Montant (en {{ $parametre_devise }})</label>
                                    <input name="montant" type="number" value="{{ $depense->montant }}" placeholder="montant" step="any" class="form-control mt-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('montant')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Source à imputer</label>
                                    <select name="source_a_imputer_id" class="form-control mt-2 p-2">
                                        <option selected disabled>--------------</option>
                                        <option value="{{ $caisse->id }}" @if($caisse->id === $depense->source_a_imputer_id) selected @endif>caisse du {{ $caisse->departement->designation }}</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('source_a_imputer_id')"/>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary mt-2 text-light" type="submit">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

