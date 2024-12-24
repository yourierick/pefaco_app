@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('other_content')
    @if(!is_null($autorisation) || !is_null($autorisation_speciale))
        <div class="d-flex" style="gap: 3px; float: right">
            <div class="btn-group dropdown" style="float: right;">
                <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                </button>
                <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                    <li>
                        <p class="text-center">MENU</p>
                        <div class="dropdown-divider"></div>
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                <a href="{{ route('rapportinspection.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                                @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportinspection.list_des_rapports') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> liste des rapports</span></a>
                                @endif
                            @endif
                        @endif
                        @if(!is_null($autorisation_speciale))
                            @if($autorisation_speciale->autorisation_speciale)
                                @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a href="{{ route('rapportinspection.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                                @endif
                            @endif
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    @endif
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('rapportinspection.save_edition_rapport', $rapport->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <h3 class="mb-2">Editer ce rapport</h3>
                            <input class="form-control" type="hidden" name="rapporteur_id" id="id_rapporteur" value="{{ old('rapporteur_id', $rapport->rapporteur_id) }}">
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_mois" style="color: #818183">mois</label>
                                    <input class="form-control" type="month" name="mois" id="id_mois" value="{{ old('mois', $rapport->mois->format("Y-m")) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('mois')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_paroisses_concernees" style="color: #818183">Paroisses concernées</label>
                                    <input class="form-control" type="text" placeholder="paroisses concernées" name="paroisses_concernees" id="id_paroisses_concernees" value="{{ old('paroisses_concernees', $rapport->paroisses_concernees) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('paroisses_concernees')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_contexte">Contexte</label>
                                    <textarea name="contexte" class="form-control" placeholder="contexte" id="id_contexte" rows="3">{{ old('contexte', $rapport->contexte) }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('contexte')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_constats">Constats</label>
                                    <textarea name="constats" class="form-control" placeholder="constats" id="id_constats" rows="3">{{ old('constats', $rapport->constats) }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('constats')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_difficultes_rencontrees">Difficultés rencontrées</label>
                                    <textarea name="difficultes_rencontrees" placeholder="difficultés rencontrées" class="form-control" id="id_difficultes_rencontrees" rows="3">{{ old('difficultes_rencontrees', $rapport->difficultes_rencontrees) }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('difficultes_rencontrees')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_recommandations" style="color: #818183">Récommandations</label>
                                    <textarea class="form-control" rows="3" placeholder="récommandations" name="recommandations" id="id_recommandations">{{ old('recommandations', $rapport->recommandations) }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommandations')"/>
                                </div>
                            </div>
                            <button class="btn btn-primary text-light" type="submit">Enregistrer les modifications</button>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/rapport_de_cultes_scripts/rapport_de_culte.js') }}"></script>
@endsection

