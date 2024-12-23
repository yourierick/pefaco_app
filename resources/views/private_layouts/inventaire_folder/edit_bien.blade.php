@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Editer un don')
@section('content')
    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('inventaire.save_edition_bien', $bien->id) }}" class="mt-6 space-y-6" >
                            @csrf
                            @method('put')
                            <div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Désignation</label>
                                    <input name="designation" placeholder="désignation" value="{{ $bien->designation }}" type="text" class="form-control">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('designation')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date">Date d'acquisition</label>
                                    <input id="id_date" type="date" value="{{ $bien->date_acquisition->format('Y-m-d') }}" name="date_acquisition" class="form-control mb-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_acquisition')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Prix unitaire</label>
                                    <input name="prix_unitaire" placeholder="prix unitaire" value="{{ $bien->prix_unitaire }}" type="number" step="any" class="form-control mt-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('prix_unitaire')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Quantité</label>
                                    <input name="quantite" placeholder="quantité" value="{{ $bien->quantite }}" type="number" class="form-control mt-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('quantite')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Lieu d'affectation</label>
                                    <input name="affectation" placeholder="lieu d'affectation" value="{{ $bien->affectation }}" type="text" class="form-control mt-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('affectation')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Etat</label>
                                    <select class="form-control" name="etat">
                                        <option value="très bon" @if ($bien->etat === 'très bon') selected @endif>Très bon</option>
                                        <option value="bon" @if ($bien->etat === 'bon') selected @endif>Bon</option>
                                        <option value="mauvais" @if ($bien->etat === 'mauvais') selected @endif>Mauvais</option>
                                        <option value="très mauvais" @if ($bien->etat === 'très mauvais') selected @endif>Très mauvais</option>
                                        <option value="à déclasser" @if ($bien->etat === 'déclasser') selected @endif>A déclasser</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('etat')"/>
                                </div>
                                <button class="btn btn-primary mt-2 text-light">Soumettre</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

