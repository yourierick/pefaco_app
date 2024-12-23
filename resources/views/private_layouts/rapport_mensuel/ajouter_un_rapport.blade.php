@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Nouvelle annonce')
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
                                    <a href="{{ route('rapportmensuel.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                                    <a href="{{ route('rapportmensuel.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> faire un rapport</span></a>
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
    <div class="py-12 mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('rapportmensuel.sauvegarder_le_rapport') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="p-1" style="background: #4f718f; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> ADMINISTRATIF</p></div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_dept">Département</label>
                                    <select name="departement_id" class="form-control p-2" id="id_dept">
                                        <option value="{{ $current_user->departement->id }}" @if(old('departement_id') === $current_user->departement->id) selected @endif>{{ $current_user->departement->designation }}</option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('departement_id')" class="mt-2 text-danger"/>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_mois" style="color: #818183">Mois de rapportage</label>
                                    <input class="form-control" type="month" name="mois_de_rapportage" id="id_mois" value="{{ old('mois_de_rapportage') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('mois_de_rapportage')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_objectif" style="color: #818183">Nos objectifs</label>
                                    <textarea class="form-control" type="text" placeholder="nos objectifs" name="objectifs" id="id_objectif">{{ old('objectifs') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('objectifs')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_vision" style="color: #818183">Notre vision</label>
                                    <textarea class="form-control" type="text" name="vision" placeholder="vision" id="id_vision">{{ old('vision') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('vision')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_mission" style="color: #818183">Notre mission</label>
                                    <textarea class="form-control" type="text" placeholder="notre mission" name="mission" id="id_mission">{{ old('mission') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('mission')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_prevision_mois" style="color: #818183">Prévisions de ce mois</label>
                                    <div>
                                        <div id="container_previsions_de_ce_mois"></div>
                                        <button type="button" class="btn text-primary mt-2" id="btn_add_prevision_de_ce_mois"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold"> Renseigner ce qui était prévu</span></i></button>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('previsions_pour_ce_mois')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_prevision_mois" style="color: #818183">Ce qui a été réalisé</label>
                                    <div>
                                        <div id="container_realisations_de_ce_mois"></div>
                                        <button type="button" class="btn text-primary mt-2" id="btn_add_realisations_pour_ce_mois"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold"> Renseigner ce qui a été réalisé</span></i></button>
                                    </div>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('realisations_pour_ce_mois')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_autres_a_rapporter" style="color: #818183">Autres faits à rapporter</label>
                                    <textarea class="form-control" placeholder="Autres faits à rapporter" name="autres_a_rapporter" id="id_autres_a_rapporter">{{ old('autres_a_rapporter') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('autres_a_rapporter')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_situation_actuelle" style="color: #818183">Situation actuelle</label>
                                    <textarea class="form-control" placeholder="Situation actuelle" name="situation_actuelle" id="id_situation_actuelle">{{ old('situation_actuelle') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('situation_actuelle')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #4f8f72; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> LOGISTIQUE</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_situation_actuelle" style="color: #818183">Situation actuelle de la logistique</label>
                                    <textarea class="form-control" placeholder="Situation actuelle de la logistique" name="situation_de_la_logistique" id="id_situation_de_la_logistique">{{ old('situation_de_la_logistique') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('situation_de_la_logistique')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #8f7b4f; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> STATISTIQUE</p></div>
                            @if($current_user->departement->designation ==="comité provincial" || $current_user->departement->designation ==="comité des mamans" ||
                                $current_user->departement->designation ==="comité des jeunes" || $current_user->departement->designation ==="ecodim")
                                <div class="mb-3">
                                    <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_tot_culte" style="color: #818183">Nombre total des cultes tenus</label>
                                        <input class="form-control" style="color: #1660c5" type="number" readonly name="nombre_des_cultes_tenus" id="id_tot_culte" value="{{ old('nombre_des_cultes_tenus', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('nombre_des_cultes_tenus')"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_tot_effectif_total" style="color: #818183">Nombre total actuel des membres</label>
                                        <input class="form-control" type="number" name="effectif_total" id="id_tot_effectif_total" value="{{ old('effectif_total', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_total')"/>
                                    </div>
                                </div>
                                @if($current_user->departement->designation ==="comité provincial")
                                    <div class="mb-3">
                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_tot_effectif_hommes" style="color: #818183">Désagrégation hommes</label>
                                            <input class="form-control" type="number" name="effectif_hommes" id="id_tot_effectif_hommes" value="{{ old('effectif_hommes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_hommes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_tot_effectif_femmes" style="color: #818183">Désagrégation femmes</label>
                                            <input class="form-control" type="number" name="effectif_femmes" id="id_tot_effectif_femmes" value="{{ old('effectif_femmes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_femmes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_tot_effectif_jeunes" style="color: #818183">Désagrégation jeunes</label>
                                            <input class="form-control" type="number" name="effectif_jeunes" id="id_tot_effectif_jeunes" value="{{ old('effectif_jeunes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_jeunes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_tot_effectif_enfants" style="color: #818183">Désagrégation enfants</label>
                                            <input class="form-control" type="number" name="effectif_enfants" id="id_tot_effectif_enfants" value="{{ old('effectif_enfants', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_enfants')"/>
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_moyenne_mensuel_total" style="color: #818183">Moyenne mensuelle d'effectif dans les cultes</label>
                                        <input class="form-control" style="color: #eea608" type="number" readonly name="moyenne_mensuel_total" id="id_moyenne_mensuel_total" value="{{ old('moyenne_mensuel_total', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_mensuel_total')"/>
                                    </div>
                                </div>
                                @if($current_user->departement->designation === "comité provincial")
                                    <div class="mb-3">
                                        <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_moyenne_mensuel_hommes" style="color: #818183">Moyenne mensuel d'hommes</label>
                                            <input class="form-control" style="color: #3aa103" type="number" readonly name="moyenne_mensuel_hommes" id="id_moyenne_mensuel_hommes" value="{{ old('moyenne_mensuel_hommes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_mensuel_hommes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_moyenne_mensuel_femmes" style="color: #818183">Moyenne mensuel des femmes</label>
                                            <input class="form-control" style="color: #3aa103" type="number" readonly name="moyenne_mensuel_femmes" id="id_moyenne_mensuel_femmes" value="{{ old('moyenne_mensuel_femmes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_mensuel_femmes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_moyenne_mensuel_jeunes" style="color: #818183">Moyenne mensuel des jeunes</label>
                                            <input class="form-control" style="color: #3aa103" type="number" readonly name="moyenne_mensuel_jeunes" id="id_moyenne_mensuel_jeunes" value="{{ old('moyenne_mensuel_jeunes', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_mensuel_jeunes')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="background-color: #f3f3f3!important;" class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_moyenne_mensuel_enfants" style="color: #818183">Moyenne mensuel d'enfants</label>
                                            <input class="form-control" type="number" style="color: #3aa103" readonly name="moyenne_mensuel_enfants" id="id_moyenne_mensuel_enfants" value="{{ old('moyenne_mensuel_enfants', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_mensuel_enfants')"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                            <label for="id_nombre_des_personnes_baptises" style="color: #818183">Total des personnes baptisées</label>
                                            <input class="form-control" type="number" name="nombre_des_personnes_baptises" id="id_nombre_des_personnes_baptises" value="{{ old('nombre_des_personnes_baptises', 0) }}">
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('nombre_des_personnes_baptises')"/>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="mb-3">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_tot_effectif_total" style="color: #818183">Nombre total actuel des membres</label>
                                        <input class="form-control" type="number" name="effectif_total" id="id_tot_effectif_total" value="{{ old('effectif_total', 0) }}">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('effectif_total')"/>
                                    </div>
                                </div>
                            @endif
                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <div class="p-1 mb-2" style="background: #17675e; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> FINANCES</p></div>
                                        <div class="mb-3">
                                            <div class="form-group-kaiadmin form-group-default-kaiadmin" style="background-color: #f3f3f3!important;">
                                                <label for="id_situation_caisse" style="color: #818183">Situation actuelle de la caisse</label>
                                                <input class="form-control" style="color: #3aa103" type="number" name="situation_caisse" id="id_situation_caisse" value="{{ old('situation_caisse', 0) }}">
                                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('situation_caisse')"/>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                <label for="id_autres_contribution_a_renseigner" style="color: #818183">Autres contributions à renseigner</label>
                                                <textarea class="form-control" type="text" placeholder="autres contributions à renseigner" name="autres_contributions_a_renseigner" id="id_autres_contribution_a_renseigner">{{ old('autres_contributions_a_renseigner') }}</textarea>
                                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('autres_contributions_a_renseigner')"/>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            <div class="p-1 mb-2" style="background: #40801d; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> CONCLUSION</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_difficultes" style="color: #818183">Difficultés et défis</label>
                                    <textarea class="form-control" type="text" placeholder="difficultés et défis" name="difficultes_defis" id="id_difficultes">{{ old('difficultes_defis') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('difficultes_defis')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_recommandation" style="color: #818183">Récommandations</label>
                                    <textarea class="form-control" type="text" placeholder="récommandations" name="recommandations" id="id_recommandation">{{ old('recommandations') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommandations')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_prevision_mois_prochain" style="color: #818183">Prévisions pour le mois prochain</label>
                                    <div>
                                        <div id="container_previsions_mois_prochain"></div>
                                        <button type="button" class="btn text-primary" id="btn_add_prevision_mois_prochain"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold"> Renseigner une prévision</span></i></button>
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
    <script src="{{ asset('assets/js/rapport_mensuel/ajout_rapport_mensuel_script.js') }}"></script>
@endsection

