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
                        <a style="font-weight: normal" href="{{ route('rapportdistrict.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"></span> voir mes drafts</a>
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a style="font-weight: normal" href="{{ route('rapportdistrict.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"></span> faire un rapport</a>
                                @endif
                            @endif
                        @endif
                        @if(!is_null($autorisation_speciale))
                            @if($autorisation_speciale->autorisation_speciale)
                                @if(in_array('peux approuver un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_approbation') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-info"></span> rapports en attente d'approbation</a>
                                @endif
                                @if(in_array('peux valider un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill text-secondary"></span> rapports en attente de validation</a>
                                @endif
                                @if(in_array('peux confirmer un rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a style="font-weight: normal" href="{{ route('rapportdistrict.les_attentes_en_confirmation') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"></span> rapports en attente de confirmation</a>
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
    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('rapportdistrict.sauvegarder_le_rapport') }}" class="mt-6 space-y-6">
                            <h3 class="mb-4">Nouveau Rapport de District</h3>
                            @csrf
                            <div class="p-1 mb-2" style="background: #4f718f; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> ADMINISTRATIF</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_mois" style="color: #818183">Mois de rapportage</label>
                                    <input class="form-control" type="month" name="mois" id="id_mois" value="{{ old('mois') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('mois')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_zone" style="color: #818183">Zone</label>
                                    <input class="form-control" type="text" name="zone" id="id_zone" value="{{ old('zone') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('zone')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_paroisses_concernees" style="color: #818183">Paroisses Concernées</label>
                                    <input class="form-control" type="text" name="paroisses_concernees" id="id_paroisses_concernees" value="{{ old('paroisses_concernees') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('paroisses_concernees')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_contexte" style="color: #818183">Contexte</label>
                                    <textarea class="form-control" type="text" placeholder="contexte" name="contexte" id="id_contexte">{{ old('contexte') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('contexte')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #8F794FFF; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> STATISTIQUES</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_nbr_cultes_tenus" style="color: #818183">Nombre des cultes tenus</label>
                                    <input class="form-control" type="number" name="nombre_des_cultes_tenus" id="id_nbr_cultes_tenus" value="{{ old('nombre_des_cultes_tenus', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('nombre_des_cultes_tenus')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_moyenne_de_frequentation" style="color: #818183">Moyenne de fréquentation</label>
                                    <input class="form-control" type="number" name="moyenne_de_frequentation" id="id_moyenne_de_frequentation" value="{{ old('moyenne_de_frequentation', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('moyenne_de_frequentation')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_nbr_des_personnes_baptises" style="color: #818183">Nombre des personnes baptisées</label>
                                    <input class="form-control" type="number" name="nombre_des_personnes_baptises" id="id_nbr_des_personnes_baptises" value="{{ old('nombre_des_personnes_baptises', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('nombre_des_personnes_baptises')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #618F4FFF; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> FINANCES</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_dime_des_dimes" style="color: #818183">Dime des dimes (en {{ $parametre_devise }})</label>
                                    <input class="form-control" type="number" step="any" name="dime_des_dimes" id="id_dime_des_dimes" value="{{ old('dime_des_dimes', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('dime_des_dimes')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_total_offrande" style="color: #818183">Total Offrande (en {{ $parametre_devise }})</label>
                                    <input class="form-control" type="number" step="any" name="total_offrande" id="id_total_offrande" value="{{ old('total_offrande', 0) }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_offrande')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_autres_contributions_a_renseigner" style="color: #818183">Autres contributions à renseigner</label>
                                    <textarea class="form-control" name="autres_contributions_a_renseigner" id="id_autres_contributions_a_renseigner">{{ old('autres_contributions_a_renseigner') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('autres_contributions_a_renseigner')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #8F594FFF; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> CONCLUSIONS</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_autres_evenements_a_rapporter" style="color: #818183">Autres faits à rapporter</label>
                                    <textarea class="form-control"  name="autres_evenements_a_rapporter" id="id_autres_evenements_a_rapporter">{{ old('autres_evenements_a_rapporter') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('autres_evenements_a_rapporter')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_observation" style="color: #818183">Observation</label>
                                    <textarea class="form-control" name="observation" id="id_observation">{{ old('observation') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('observation')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_difficultes_defis" style="color: #818183">Difficultés et défis rencontrés</label>
                                    <textarea class="form-control" name="difficultes_defis" id="id_difficultes_defis">{{ old('difficultes_defis') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('difficultes_defis')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_recommandations" style="color: #818183">Récommandations</label>
                                    <textarea class="form-control" name="recommandations" id="id_recommandations">{{ old('recommandations') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommandations')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_previsions_mois_prochain" style="color: #818183">Prévisions pour le mois prochain</label>
                                    <textarea class="form-control" name="previsions_mois_prochain" id="id_previsions_mois_prochain">{{ old('previsions_mois_prochain') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('previsions_mois_prochain')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_besoins_a_signaler" style="color: #818183">Besoins à signaler</label>
                                    <textarea class="form-control" name="besoins_a_signaler" id="id_besoins_a_signaler">{{ old('besoins_a_signaler') }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('besoins_a_signaler')"/>
                                </div>
                            </div>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="submit" name="action" value="soumettre_pour_approbation">Soumettre pour approbation</button>
                            <button class="btn btn-secondary text-light" style="font-weight: normal" type="submit" name="action" value="draft">Enregistrer en tant que draft</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection


