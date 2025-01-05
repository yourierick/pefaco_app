@extends('base_dashboard')
@section('page_title', 'Ajouter un utilisateur')
@section('titre', '#Ajouter un utilisateur')
@section('style')
    <link id="theme-style" rel="stylesheet" href="{{ asset("assets/css/register.css") }}">
    <style>
        input {
            font-size: 12pt!important;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data" class="shadow p-3" id="formulaire"
              action="{{ route('register') }}">
            @csrf
            <div>
                <img id="imagePreview" src="{{ asset('css/images/utilisateur.png') }}" alt=""
                     style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
            </div>
            <div class="mb-3">
                <x-text-input id="id_photo" class="block mt-1 w-full" type="file" class="form-control" name="photo"/>
                <x-input-error :messages="$errors->get('photo')" class="mt-2 text-danger"/>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_nom">nom</label>
                    <input id="id_nom" class="block mt-1 w-full form-control" type="text" name="nom" value="{{old('nom')}}"
                                  placeholder="nom" required autofocus autocomplete="nom">
                    <x-input-error :messages="$errors->get('nom')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_postnom">postnom</label>
                    <input id="id_postnom" class="block mt-1 w-full form-control" type="text" name="postnom"
                                  value="{{old('postnom')}}" placeholder="postnom" required autocomplete="postnom"/>
                    <x-input-error :messages="$errors->get('postnom')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_prenom">prénom</label>
                    <input id="id_prenom" class="block mt-1 w-full form-control" type="text" name="prenom" value="{{old('prenom')}}"
                                  placeholder="prenom" autocomplete="prenom">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_sexe">sexe</label>
                    <select id="id_sexe" name="sexe" class="form-control p-1" required>
                        <option value=""></option>
                        <option @if( old('sexe') === "Homme" ) selected @endif value="Homme">Homme</option>
                        <option @if( old('sexe') === "Femme" ) selected @endif value="Femme">Femme</option>
                    </select>
                    <x-input-error :messages="$errors->get('sexe')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_lieu">lieu de naissance</label>
                    <input id="id_lieu" class="block mt-1 w-full form-control" type="text" name="lieu_de_naissance"
                                  value="{{old('lieu_de_naissance')}}" placeholder="lieu de naissance"
                                  autocomplete="lieu de naissance">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_date">date de naissance</label>
                    <input id="id_date" name="date_de_naissance" value="{{ old('date_de_naissance') }}" type="date"
                           class="form-control"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_etat_civil">Etat civil</label>
                    <select id="id_etat_civil" name="etat_civil" class="form-control p-1" required>
                        <option value=""></option>
                        <option @if( old('etat_civil') === "Célibataire" ) selected @endif value="Célibataire">Célibataire
                        </option>
                        <option @if( old('etat_civil') === "Marié(e)" ) selected @endif value="Marié(e)">Marié(e)</option>
                        <option @if( old('etat_civil') === "Séparé(e)" ) selected @endif value="Séparé(e)">Séparé(e)
                        </option>
                        <option @if( old('etat_civil') === "Divorcé(e)" ) selected @endif value="Divorcé(e)">Divorcé(e)
                        </option>
                        <option @if( old('etat_civil') === "Veuf(ve)" ) selected @endif value="Veuf(ve)">Veuf(ve)</option>
                    </select>
                    <x-input-error :messages="$errors->get('etat_civil')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_adresse">Adresse</label>
                    <input id="id_adresse" name="adresse" value="{{ old('adresse') }}" type="text" class="form-control"
                           placeholder="Adresse de résidence permanente"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_telephone">téléphone</label>
                    <input id="id_telephone" class="block mt-1 w-full form-control" type="number" name="telephone"
                                    value="{{old('telephone')}}" placeholder="numéro de téléphone" required
                                    autocomplete="téléphone">
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="email mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_mail">email</label>
                    <input id="id_mail" class="block mt-1 w-full form-control" type="email" name="email" value="{{old('email')}}"
                                  placeholder="exemple@exemple.com" required autocomplete="email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="email mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_paroisse">paroisse</label>
                    <select id="id_paroisse" name="paroisse_id" class="form-control p-1" required>
                        @php
                            $paroisses = App\Models\Paroisses::all()
                        @endphp
                        <option value=""></option>
                        @foreach($paroisses as $paroisse)
                            <option @if( old('paroisse_id') == $paroisse->id ) selected
                                    @endif value="{{ $paroisse->id }}">{{ $paroisse->designation }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('paroisse_id')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="email mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_dept">département</label>
                    <select id="id_dept" name="departement_id" class="form-control p-1" required>
                        @php
                            $departements = App\Models\Departements::all()
                        @endphp
                        <option value=""></option>
                        @foreach($departements as $departement)
                            <option @if( old('departement_id') == $departement->id ) selected
                                    @endif value="{{ $departement->id }}">{{ $departement->designation }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('departement_id')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                    <label for="id_qualite">Qualité</label>
                    <select id="id_qualite" name="qualite_id" class="form-control p-1" required>
                        <option disabled>Sélectitonner la fonction</option>
                    </select>
                    <x-input-error :messages="$errors->get('qualite')" class="mt-2 text-danger"/>
                </div>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="row p-0">
                    <div class="col-md-4 p-0">
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="password">mot de passe</label>
                            <input id="password" class="block mt-1 w-full form-control"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password" aria-describedby="requirements">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="password-confirmation">confirmer le mot de passe</label>
                            <input id="password-confirmation" class="block mt-1 w-full form-control"
                                          type="password" name="password-confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password-confirmation')" class="mt-2 text-danger" />
                        </div>
                        <div class="password-requirements">
                            <p class="requirement error" id="match" style="display: none">Les mots de passe
                                doivent correspondre</p>
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label class="mb-0 mt-0">groupe d'utilisateurs</label>
                            <select name="groupe_utilisateur_id" class="form-control p-1" required>
                                <option disabled selected>----------------</option>
                                @php
                                    $users_groups = \App\Models\GroupesUtilisateurs::all()
                                @endphp
                                @foreach($users_groups as $group)
                                    <option @if( old('groupe_utilisateur_id') === $group->id ) selected @endif value="{{ $group->id }}">{{ $group->groupe }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('groupe_utilisateur_id')" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-2">Exigences du mot de passe</p>
                        <p class="small text-muted mb-2">Pour créer un nouveau mot de passe, vous devez
                            remplir toutes les exigences suivantes:</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li class="requirement" id="length">Minimum 8 caractères</li>
                            <li class="requirement" id="lowercase">Doit inclure une miniscule</li>
                            <li class="requirement" id="uppercase">Doit inclure une majuscule</li>
                            <li class="requirement" id="number">Doit inclure un chiffre</li>
                            <li class="requirement" id="characters">Doit inclure un caractère spécial:
                                #.-?!@$%^&*
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-100" value="Enregistrer" id="submit_form" disabled> Enregistrer</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset("assets/js/register.js") }}"></script>
@endsection

