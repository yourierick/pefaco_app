@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Modifier un utilisateur')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Information de profile') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Mettre à jour les informations de ce profile") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('manageprofile.update_user', $user->id) }}"
                              class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <img id="imagePreview"
                                     src="@if($user->photo) {{ $user->imageUrl() }} @else {{ asset('css/images/utilisateur.png') }}  @endif"
                                     alt=""
                                     style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
                            </div>
                            <div class="mb-3">
                                <input id="id_photo" name="photo" value="{{ $user->photo }}" type="file"
                                       class="form-control"/>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo')"/>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_nom">nom</label>
                                    <input id="id_nom" name="nom" type="text" class="mt-1 block w-full form-control"
                                                  value="{{old('nom', $user->nom)}}" required autofocus autocomplete="nom">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_postnom">postnom</label>
                                    <input id="id_postnom" name="postnom" type="text"
                                                  class="mt-1 block w-full form-control"
                                                  value="{{old('postnom', $user->postnom)}}" required autocomplete="postnom">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('postnom')"/>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_prenom">prénom</label>
                                    <input id="id_prenom" name="prenom" type="text"
                                                  class="mt-1 block w-full form-control"
                                                  value="{{old('prenom', $user->prenom)}}" required autocomplete="prenom"/>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('prenom')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_sexe">sexe</label>
                                    <select id="id_sexe" name="sexe" class="form-control p-2" required>
                                        <option value=""></option>
                                        <option @if( old('sexe', $user->sexe) === "Homme" ) selected @endif value="Homme">
                                            Homme
                                        </option>
                                        <option @if( old('sexe', $user->sexe) === "Femme" ) selected @endif value="Femme">
                                            Femme
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('sexe')" class="mt-2 text-danger"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_lieu">lieu de naissance</label>
                                    <input id="id_lieu" class="block mt-1 w-full form-control" type="text"
                                          name="lieu_de_naissance"
                                          value="{{old('lieu_de_naissance', $user->lieu_de_naissance)}}"
                                          placeholder="lieu de naissance"
                                          autocomplete="lieu de naissance">
                                    <x-input-error :messages="$errors->get('lieu_de_naissance')" class="mt-2 text-danger"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date">date de naissance</label>
                                    <input id="id_date" name="date_de_naissance"
                                           value="{{ old('date_de_naissance', $user->date_de_naissance) }}" type="date"
                                           class="form-control"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="sr-only-focusable" for="id_adresse">Adresse</label>
                                    <input id="id_adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}"
                                           type="text"
                                           class="form-control" placeholder="Adresse de résidence permanente"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_telephone">Téléphone</label>
                                    <input id="id_telephone" name="telephone"
                                           value="{{ old('telephone', $user->telephone) }}" type="number"
                                           class="form-control" placeholder="Numéro de téléphone"/>
                                    <x-input-error :messages="$errors->get('telephone')" class="mt-2 text-danger"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_etat_civil">Etat civil</label>
                                    <select id="id_etat_civil" name="etat_civil" class="form-control p-2">
                                        <option value=""></option>
                                        <option @if( old('etat_civil', $user->etat_civil) === "Célibataire" ) selected
                                                @endif value="Célibataire">Célibataire
                                        </option>
                                        <option @if( old('etat_civil', $user->etat_civil) === "Marié(e)" ) selected
                                                @endif value="Marié(e)">Marié(e)
                                        </option>
                                        <option @if( old('etat_civil', $user->etat_civil) === "Séparé(e)" ) selected
                                                @endif value="Séparé(e)">Séparé(e)
                                        </option>
                                        <option @if( old('etat_civil', $user->etat_civil) === "Divorcé(e)" ) selected
                                                @endif value="Divorcé(e)">Divorcé(e)
                                        </option>
                                        <option @if( old('etat_civil', $user->etat_civil) === "Veuf(ve)" ) selected
                                                @endif value="Veuf(ve)">Veuf(ve)
                                        </option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('etat_civil')"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_email">email</label>
                                    <input id="id_email" name="email" type="email"
                                          class="mt-1 block w-full form-control" value="{{old('email', $user->email)}}"
                                          required autocomplete="username">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')"/>
                                </div>
                            </div>
                            <p class="text-success">Paramètres d'administration</p>
                            <hr>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_paroisse">Paroisse</label>
                                    <select id="id_paroisse" name="paroisses_id" class="form-control p-2">
                                        @php
                                            $paroisses = App\Models\Paroisses::all()
                                        @endphp
                                        <option value=""></option>
                                        @foreach($paroisses as $paroisse)
                                            <option
                                                @if( old('paroisse', $user->paroisses_id) == $paroisse->id ) selected
                                                @endif value="{{ $paroisse->id }}">{{ $paroisse->designation }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('paroisses_id')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_dept">Département</label>
                                    <select id="id_dept" name="departement_id" class="form-control p-2">
                                        @php
                                            $departements = App\Models\Departements::all()
                                        @endphp
                                        <option value=""></option>
                                        @foreach($departements as $departement)
                                            <option
                                                @if( old('departement', $user->departement_id) === $departement->id ) selected
                                                @endif value="{{ $departement->id }}">{{ $departement->designation }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_qualite">Qualité</label>
                                    <label id="lbl_dept_id" style="display: none">{{ $user->departement_id }}</label>
                                    <label id="lbl_qualite_id" style="display: none">{{ $user->qualite_id }}</label>
                                    <select id="id_qualite" name="qualite_id" class="form-control p-2">

                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('qualite_id')"/>
                                </div>
                            </div>
                            <p class="text-success">Paramètres de compte</p>
                            <hr>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <div class="col-md-12">
                                        <p class="mb-0 mt-0">Groupe d'utilisateurs</p>
                                        <select name="groupe_utilisateur_id" class="form-control p-2">
                                            <option disabled selected>---------</option>
                                            @php
                                                $groupes = \App\Models\GroupesUtilisateurs::all()
                                            @endphp
                                            @foreach($groupes as $groupe)
                                                <option @if(old('groupe_utilisateur_id', $user->groupe_utilisateur_id) === $groupe->id ) selected @endif value={{ $groupe->id }}>{{ $groupe->groupe }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('groupe_utilisateur_id')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Changer le mot de passe') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Choisissez un mot de passe qui respecte les normes de sécurité') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('manageprofile.update_user_password', $user->id) }}"
                              class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="update_password_password">Nouveau mot de passe</label>
                                    <input id="update_password_password" name="password" type="password"
                                                  class="mt-1 block w-full form-control" autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger"/>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="update_password_password_confirmation">Confirmer le mot de passe</label>
                                    <input id="update_password_password_confirmation" name="password_confirmation"
                                                  type="password" class="mt-1 block w-full form-control"
                                                  autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                                   class="mt-2 text-danger"/>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mt-2">
                                <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __("Droits d'utilisateur") }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Cet utilisateur pourra:") }}
                            </p>
                        </header>
                        <div class="row g-4 settings-section">
                            <div class="col-12 col-md-4">
                                <span style="color: dodgerblue">Activer ou désactiver ce compte</span>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="app-card app-card-settings p-3">
                                    <div class="app-card-body">
                                        <form method="post" action="{{ route('manageprofile.user_account_status_check', $user->id) }}">
                                            <div class="form-check">
                                                @csrf
                                                @method('put')
                                                <div class="form-check form-switch">
                                                    <input name="statut" class="form-check-input" type="checkbox"
                                                           id="settings-switch-1" @if($user->statut == true) checked @endif>
                                                    <label class="form-check-label" for="settings-switch-1">Statut du
                                                        compte</label>
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//form-check-->
                                        </form>
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div>
                        </div><!--//row-->
                        <hr class="my-4">
                        @foreach($autorisations as $autorisation)
                            <form method="post" action="{{ route('manageprofile.save_autorisations_speciales', $autorisation->id) }}">
                                @csrf
                                @method('put')
                                <div class="row g-4 settings-section">
                                    <div class="col-12 col-md-4">
                                        <span style="color: dodgerblue">{{ $autorisation->table_name }}</span>
                                        <div class="section-intro">Cet utilisateur pourra réaliser les actions suivantes sur le document:</div>
                                    </div>
                                    @if($autorisation->table_name === 'depenses')
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider une dépense" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider une dépense', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux valider une dépense
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux confirmer une dépense" name="autorisation_speciale[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux confirmer une dépense', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                            peux confirmer une dépense
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux rejeter une dépense" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux rejeter une dépense', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux rejeter une dépense
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux mettre en attente une dépense" id="rpt_checkbox-4-{{ $autorisation->id }}" name="autorisation_speciale[]" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux mettre en attente une dépense', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-4-{{ $autorisation->id }}">
                                                            peux mettre en attente une dépense
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux annuler une action sur la dépense" id="rpt_checkbox-5-{{ $autorisation->id }}" name="autorisation_speciale[]" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux annuler une action sur la dépense', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-5-{{ $autorisation->id }}">
                                                            peux annuler une action sur la dépense
                                                        </label>
                                                    </div>
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif ($autorisation->table_name === 'rapport_de_cultes')
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider" name="autorisation_speciale[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                            peux valider un rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux changer l'audience" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux changer l'audience", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux changer l'audience d'un rapport
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux voir la partie financiere du rapport" name="autorisation_speciale[]" id="rpt_checkbox-4-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux voir la partie financiere du rapport", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-4-{{ $autorisation->id }}">
                                                            peux voir la partie financière du rapport
                                                        </label>
                                                    </div>
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn-sm btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif ($autorisation->table_name === "rapport_de_districts")
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux approuver un rapport" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux approuver un rapport', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux approuver un rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider un rapport" name="autorisation_speciale[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider un rapport', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                            peux valider un rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux confirmer un rapport" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux confirmer un rapport', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux confirmer un rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux voir la partie financière du rapport" name="autorisation_speciale[]" id="rpt_checkbox-4-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux voir la partie financière du rapport', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-4-{{ $autorisation->id }}">
                                                            peux voir la partie financière du rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif ($autorisation->table_name === 'rapport_mensuels')
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux voir la partie financiere du rapport" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux voir la partie financière du rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider" name="autorisation_speciale[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                            peux valider un rapport
                                                        </label>
                                                    </div><!--//form-check-->
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif ($autorisation->table_name === 'articles' || $autorisation->table_name === 'annonces' || $autorisation->table_name === 'enseignements')
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux valider
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux changer l'audience" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux changer l'audience", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux changer l'audience
                                                        </label>
                                                    </div>
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif ($autorisation->table_name === 'communiques')
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux ajouter" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux ajouter', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux ajouter
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux lire" name="autorisation_speciale[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux lire", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                            peux lire
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux modifier" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux modifier", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux modifier
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux supprimer" name="autorisation_speciale[]" id="rpt_checkbox-4-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux supprimer", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-4-{{ $autorisation->id }}">
                                                            peux supprimer
                                                        </label>
                                                    </div>
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @elseif($autorisation->table_name === 'rapport_inspections')
                                    <div class="col-12 col-md-8">
                                        <div class="app-card app-card-settings p-4">
                                            <div class="app-card-body">
                                                <div class="form-check">
                                                    <input type="checkbox" value="peux valider" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                    <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                        peux valider
                                                    </label>
                                                </div><!--//form-check-->
                                            </div><!--//app-card-body-->
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                            </div>
                                        </div><!--//app-card-->
                                    </div>
                                    @else
                                        <div class="col-12 col-md-8">
                                            <div class="app-card app-card-settings p-4">
                                                <div class="app-card-body">
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux valider" name="autorisation_speciale[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array('peux valider', json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                            peux valider
                                                        </label>
                                                    </div><!--//form-check-->
                                                    <div class="form-check">
                                                        <input type="checkbox" value="peux changer l'audience" name="autorisation_speciale[]" id="rpt_checkbox-3-{{ $autorisation->id }}" @if($autorisation->autorisation_speciale !== null) @if(in_array("peux changer l'audience", json_decode($autorisation->autorisation_speciale, true))) checked @endif @endif>
                                                        <label class="form-check-label" for="rpt_checkbox-3-{{ $autorisation->id }}">
                                                            peux changer l'audience
                                                        </label>
                                                    </div>
                                                </div><!--//app-card-body-->
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                                </div>
                                            </div><!--//app-card-->
                                        </div>
                                    @endif
                                </div><!--//row-->
                                <hr class="my-4">
                            </form>
                        @endforeach
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Effacer ce compte') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Une fois votre compte supprimé, toutes ses ressources seront également supprimées') }}
                            </p>
                        </header>
                        <button type="button" data-bs-toggle="modal" data-bs-target='#modal_supcompte'
                                class="btn btn-danger text-light">
                            SUPPRIMER
                        </button>
                        <div class="modal fade" id='modal_supcompte'>
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title h5 text-center "
                                            id="exampleModalCenteredScrollableTitle">
                                            Demande de confirmation
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post"
                                              action="{{ route('manageprofile.destroy_user_account', $user->id) }}"
                                              class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Etes-vous sûr de vouloir supprimer ce compte?') }}
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ __('Une fois ce compte supprimé, toutes ses ressources seront également supprimées') }}
                                            </p>

                                            <div class="mt-6">
                                                <x-text-input
                                                    id="password"
                                                    name="password"
                                                    type="password"
                                                    class="mt-1 block w-3/4 form-control mb-2"
                                                    placeholder="{{ __('veuillez entrer votre mot de passe') }}"
                                                />
                                                <x-input-error :messages="$errors->userDeletion->get('password')"
                                                               class="mt-2 text-danger"/>
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <button class="btn btn-danger btn-sm text-light" type="button">SUPPRIMER
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary btn-sm text-light" type="button"
                                                data-bs-dismiss="modal">Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- Style --}}
    <style>
        button[type=submit] {
            transition: .10s;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.12);
            padding: 9px;
            background-color: #2450a2;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 14px;
            color: #fafafa;
        }

        button[type=submit]:hover {
            border-color: transparent;
            background-color: #1f4793;
            color: #fafafa;
        }
    </style>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/update_profile.js') }}"></script>
@endsection

