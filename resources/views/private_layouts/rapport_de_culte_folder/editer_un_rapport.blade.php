@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Editer un rapport')
@section('other_content')
    <div class="d-flex" style="gap: 3px; float: right">
        <div class="btn-group dropdown" style="float: right;">
            <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>
            <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                <li>
                    <p class="text-center">---------- MENU ----------</p>
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
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('rapportculte.save_edition_rapport', $rapport->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div class="p-1 mb-2" style="background: #4f718f; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> ADMINISTRATIF</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label style="color: #818183">Département</label>
                                    <select name="departement_id" class="form-control p-2" @if($rapport->statut === "en attente de complétion") disabled @else required @endif>
                                        @foreach($departements as $departement)
                                            <option value="{{ $departement->id }}" @if($rapport->departement_id === $departement->id) selected @endif>{{ $departement->designation }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date" style="color: #818183">Date</label>
                                    <input class="form-control" type="date" @if($rapport->statut === "en attente de complétion") disabled @else required @endif name="date" id="id_date" value="{{ $rapport->date->format('Y-m-d') }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_moderateur" style="color: #818183">Modérateur</label>
                                    <input class="form-control" type="text" name="moderateur" id="id_moderateur" value="{{ $rapport->moderateur }}" @if($rapport->statut === "en attente de complétion") disabled @else required @endif>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('moderateur')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_orateur" style="color: #818183">Orateur</label>
                                    <input class="form-control" type="text" name="orateur" id="id_orateur" value="{{ $rapport->orateur }}" @if($rapport->statut === "en attente de complétion") disabled @else required @endif>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('orateur')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_theme" style="color: #818183">Thème</label>
                                    <input class="form-control" type="text" name="theme" id="id_theme" value="{{ $rapport->theme }}" @if($rapport->statut === "en attente de complétion") disabled @else required @endif>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('theme')"/>
                                </div>
                            </div>
                            @if($rapport->statut != "en attente de complétion")
                                <div class="mb-3">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_synthese" style="color: #818183">Références</label>
                                        <div>
                                            <div id="container_reference">
                                                @php
                                                    $count = 0;
                                                    foreach (json_decode($rapport->reference, true) as $value) {
                                                        $count = $count + 1;
                                                    }
                                                @endphp
                                                <label id="lbl_count" style="display: none">{{ $count }}</label>
                                                @foreach(json_decode($rapport->reference, true) as $value)
                                                    <div class="d-flex" id="div_{{ $loop->iteration }}" style="gap: 5px; margin: 0">
                                                        <button type="button" onclick="deleteref(this)" style="margin-top: 10px" class="btn" id="btn_remove_div_{{ $loop->iteration }}"><span class="bi-trash-fill text-danger"></span></button>
                                                        <input name="reference[]" type="text" class="form-control" required value="{{ $value }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn text-primary mt-2" id="btn_add_reference"><i class='bx bx-plus-circle' ><span style="text-decoration: underline; font-weight: bold"> Ajouter une référence</span></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_synthese" style="color: #818183">Synthèse de la prédication</label>
                                    <textarea class="form-control" name="synthese" id="id_synthese" @if($rapport->statut === "en attente de complétion") disabled @else required @endif>{{ $rapport->synthese }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('synthese')"/>
                                </div>
                            </div>
                            <div class="p-1 mb-2" style="background: #8f7b4f; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> STATISTIQUE</p></div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_tot_pers" style="color: #818183">Nombre total des personnes présentes dans le culte</label>
                                    <input class="form-control" type="number" @if($rapport->statut === "en attente de complétion") disabled @else required @endif name="total_pers_dans_le_culte" id="id_tot_pers" value="{{ $rapport->total_pers_dans_le_culte }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_pers_dans_le_culte')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_tot_papa" style="color: #818183">Nombre total des papas présents dans le culte</label>
                                    <input class="form-control" type="number" @if($rapport->statut === "en attente de complétion") disabled @else required @endif name="total_papas" id="id_tot_papa" value="{{ $rapport->total_papas }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_papas')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_tot_maman" style="color: #818183">Nombre total des mamans présentes dans le culte</label>
                                    <input class="form-control" type="number" @if($rapport->statut === "en attente de complétion") disabled @else required @endif name="total_mamans" id="id_tot_maman" value="{{ $rapport->total_mamans }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_mamans')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_tot_jeune" style="color: #818183">Nombre total des jeunes présents dans le culte</label>
                                    <input class="form-control" type="number" @if($rapport->statut === "en attente de complétion") disabled @else required @endif name="total_jeunes" id="id_tot_jeune" value="{{ $rapport->total_jeunes }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_jeunes')"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_tot_enfant" style="color: #818183">Nombre total des enfants présents dans le culte</label>
                                    <input class="form-control" @if($rapport->statut === "en attente de complétion") disabled @else required @endif type="number" name="total_enfants" id="id_tot_enfant" value="{{ $rapport->total_enfants }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_enfants')"/>
                                </div>
                            </div>

                            @if($autorisation_speciale)
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <div class="p-1 mb-2" style="background: #17675e; border-radius: 9px"><p style="font-size: 12pt; font-weight: bold; color: whitesmoke"><span class="fa fa-file-word-o"></span> FINANCES</p></div>
                                        <div class="mb-3">
                                            <div class="form-group-kaiadmin form-group-default-kaiadmin" style="background-color: #ffe2a6">
                                                <label for="id_tot_offrande" style="color: #818183">Offrandes reçues (en {{ $parametre_devise }})</label>
                                                <input class="form-control" type="number" step="any" name="total_offrande" id="id_tot_offrande" value="{{ $rapport->total_offrande }}">
                                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_offrande')"/>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            @if($rapport->statut != "en attente de complétion")
                                <div class="mb-3">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_tot_jeune" style="color: #818183">Offrandes spéciales</label>
                                        <div>
                                            <div id="container_offrande_speciale">
                                                @php
                                                    $countdon = 0;
                                                    foreach (json_decode($rapport->don_special, true) as $value) {
                                                        $countdon = $countdon + 1;
                                                    }
                                                @endphp
                                                <label id="lbl_count_don" style="display: none">{{ $countdon }}</label>
                                                @foreach(json_decode($rapport->don_special, true) as $value)
                                                    <div class="d-flex" id="div_{{ $loop->iteration }}" style="gap: 5px">
                                                        <button type="button" style="margin-top: 10px" onclick="deletedon(this)" class="btn" id="btn_remove_div_{{ $loop->iteration }}"><span class="bi-trash-fill text-danger"></span></button>
                                                        <input name="don_special[]" type="text" class="form-control" required value="{{ $value }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn text-primary" id="btn_add_special_offrande"><i class='bx bx-plus-circle' > <span style="text-decoration: underline; font-weight: bold"> Ajouter une offrande spéciale</span></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($rapport->statut != "en attente de complétion")
                                <div class="mb-3">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_faits" style="color: #818183">Autres faits à renseigner</label>
                                        <div>
                                            <div id="container_autres_faits">
                                                @php
                                                    $countfait = 0;
                                                    foreach (json_decode($rapport->autres_faits_a_renseigner, true) as $value) {
                                                        $countfait = $countfait + 1;
                                                    }
                                                @endphp
                                                <label id="lbl_count_faits" style="display: none">{{ $countfait }}</label>
                                                @foreach(json_decode($rapport->autres_faits_a_renseigner, true) as $value)
                                                    <div class="d-flex" id="div_{{ $loop->iteration }}" style="gap: 5px">
                                                        <button type="button" onclick="deletefait(this)" class="btn" id="btn_remove_div_{{ $loop->iteration }}"><span class="bi-trash-fill text-danger"></span></button>
                                                        <input name="autres_faits_a_renseigner[]" type="text" class="form-control" required style="width: 80%;" value="{{ $value }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn text-primary" id="btn_add_autres_faits"><i class='bx bx-plus-circle'><span style="text-decoration: underline; font-weight: bold;"> Ajouter un fait</span></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer les modifications</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/rapport_de_cultes_scripts/edit_rapport_de_culte.js') }}"></script>
@endsection

