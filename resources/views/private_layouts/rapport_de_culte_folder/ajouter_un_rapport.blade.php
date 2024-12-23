@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Nouveau rapport')
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
                                @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportculte.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                                    <a href="{{ route('rapportculte.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> faire un rapport</span></a>
                                @endif
                            @endif
                        @endif
                        @if(!is_null($autorisation_speciale))
                            @if($autorisation_speciale->autorisation_speciale)
                                @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a href="{{ route('rapportculte.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                                @endif
                                @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a href="{{ route('rapportculte.les_attentes_en_completion') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"> rapports en attente de complétion</span></a>
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
                        <form method="post" action="{{ route('rapportculte.sauvegarder_le_rapport') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label>Département</label>
                                    <select name="departement_id" class="form-control p-2">
                                        <option value="{{ $current_user->departement->id }}" @if(old('departement_id') === $current_user->departement->id) selected @endif>{{ $current_user->departement->designation }}</option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('departement_id')" class="mt-2 text-danger"/>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_date" style="color: #818183">Date</label>
                                    <input class="form-control" type="date" name="date" id="id_date" value="{{ old('date') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_moderateur" style="color: #818183">Modérateur</label>
                                    <input class="form-control" type="text" name="moderateur" id="id_moderateur" value="{{ old('moderateur') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('moderateur')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_orateur" style="color: #818183">Orateur</label>
                                    <input class="form-control" type="text" name="orateur" id="id_orateur" value="{{ old('orateur') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('orateur')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_theme" style="color: #818183">Thème</label>
                                    <input class="form-control" type="text" name="theme" id="id_theme" value="{{ old('theme') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('theme')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_synthese" style="color: #818183">Référence</label>
                                    <div>
                                        <div id="container_reference"></div>
                                        <button type="button" class="btn text-primary mt-2" id="btn_add_reference"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold">Ajouter une référence</span></i></button>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('reference')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_synthese" style="color: #818183">Synthèse de la prédication</label>
                                    <textarea class="form-control" placeholder="synthèse de la prédication" name="synthese" id="id_synthese">{{ old('synthese') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('synthese')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_tot_pers" style="color: #818183">Nombre total des personnes présentes dans le culte</label>
                                    <input class="form-control" type="number" name="total_pers_dans_le_culte" id="id_tot_pers" value="{{ old('total_pers_dans_le_culte', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_pers_dans_le_culte')"/>
                                </div>
                            </div>
                            @if($current_user->departement->designation === "comité provincial")
                                <div class="mb-3">
                                    <div class="form-group form-group-default">
                                        <label for="id_tot_papa" style="color: #818183">Nombre total des papas présents dans le culte</label>
                                        <input class="form-control" type="number" name="total_papas" id="id_tot_papa" value="{{ old('total_papas', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_papas')"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group form-group-default">
                                        <label for="id_tot_maman" style="color: #818183">Nombre total des mamans présentes dans le culte</label>
                                        <input class="form-control" type="number" name="total_mamans" id="id_tot_maman" value="{{ old('total_mamans', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_mamans')"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group form-group-default">
                                        <label for="id_tot_jeune" style="color: #818183">Nombre total des jeunes présents dans le culte</label>
                                        <input class="form-control" type="number" name="total_jeunes" id="id_tot_jeune" value="{{ old('total_jeunes', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_jeunes')"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group form-group-default">
                                        <label for="id_tot_enfant" style="color: #818183">Nombre total des enfants présents dans le culte</label>
                                        <input class="form-control" type="number" name="total_enfants" id="id_tot_enfant" value="{{ old('total_enfants', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_enfants')"/>
                                    </div>
                                </div>
                            @endif

                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <div class="mb-3">
                                            <div class="form-group-kaiadmin form-group-default-kaiadmin" style="background-color: #ffe2a6">
                                                <label style="color: #818183">Offrande du jour/FINANCE</label>
                                                <input class="form-control mb-2" type="number" name="offrande" step="any" placeholder="Veuillez renseigner l'offrande du jour" required value="{{ old("offrande") }}">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label for="id_don" style="color: #818183">Offrandes spéciales</label>
                                    <div>
                                        <div id="container_offrande_speciale"></div>
                                        <button type="button" class="btn text-primary" id="btn_add_special_offrande"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold"> Ajouter une offrande spéciale</span></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group form-group-default">
                                    <label style="color: #818183">Autres faits à renseigner</label>
                                    <div>
                                        <div id="container_autres_faits"></div>
                                        <button type="button" class="btn text-primary" id="btn_add_autres_faits"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold"> Ajouter un fait</span></i></button>
                                    </div>
                                </div>
                            </div>

                            <button name="action" value="draft" class="btn btn-warning mt-2 text-dark" type="submit">Enregistrer le draft</button>
                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <button name="action" value="soumission_validation" class="btn btn-success mt-2 text-light" type="submit">Soumettre pour validation</button>
                                    @endif
                                @endif
                            @endif
                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(!in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <button name="action" value="soumission_completion" class="btn btn-primary mt-2 text-light" type="submit">Soumettre à la caisse</button>
                                    @endif
                                @else
                                    <button name="action" value="soumission_completion" class="btn btn-primary mt-2 text-light" type="submit">Soumettre à la caisse</button>
                                @endif
                            @else
                                <button name="action" value="soumission_completion" class="btn btn-primary mt-2 text-light" type="submit">Soumettre à la caisse</button>
                            @endif
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/rapport_de_cultes_scripts/rapport_de_culte.js') }}"></script>
@endsection

