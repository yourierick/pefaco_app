@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('membres.save_edition_membre', $membre->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <h3 class="mb-3">Edition du Membre</h4>
                            
                            <div>
                                <img id="imagePreview"
                                    src="@if($membre->photo) /storage/{{ $membre->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif"
                                    alt=""
                                    style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
                            </div>
                            <div class="mb-3">
                                <input id="id_photo" name="photo" value="{{ $membre->photo }}" type="file"
                                        class="form-control"/>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                @php
                                    $paroisses = \App\Models\Paroisses::all();
                                @endphp
                                <label for="id_paroisse" style="color: #818183">Paroisse</label>
                                <select name="paroisse_id" id="id_paroisse" class="form-control">
                                    @foreach($paroisses as $paroisse)
                                        <option @if($membre->paroisse_id == $paroisse->id) selected @endif value="{{ $paroisse->id }}">{{ $paroisse->designation }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('paroisse_id')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom" style="color: #818183">Nom</label>
                                <input class="form-control" type="text" name="nom" id="id_nom" value="{{ old('nom', $membre->nom) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_sexe" style="color: #818183">Sexe</label>
                                <select name="sexe" id="id_sexe" class="form-control">
                                    <option @if($membre->sexe === "homme") selected @endif value="homme">homme</option>
                                    <option @if($membre->sexe === "femme") selected @endif value="femme">femme</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('sexe')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nationalite" style="color: #818183">Nationalité</label>
                                <input class="form-control" type="text" name="nationalite" id="id_nationalite" value="{{ old('nationalite', $membre->nationalite) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nationalite')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_lieu_de_naissance" style="color: #818183">Lieu de naissance</label>
                                <input class="form-control" type="text" name="lieu_de_naissance" id="id_lieu_de_naissance" value="{{ old('lieu_de_naissance', $membre->lieu_de_naissance) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('lieu_de_naissance')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_naissance" style="color: #818183">Date de naissance</label>
                                <input class="form-control" type="date" name="date_de_naissance" id="id_date_de_naissance" value="{{ old('date_de_naissance', $membre->date_de_naissance->format('Y-m-d')) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_naissance')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_adresse_de_residence_actuelle" style="color: #818183">Adresse de résidence actuelle</label>
                                <input class="form-control" type="text" name="adresse_de_residence_actuelle" id="id_adresse_de_residence_actuelle" value="{{ old('adresse_de_residence_actuelle', $membre->adresse_de_residence_actuelle) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse_de_residence_actuelle')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_adresse_de_residence_permanente" style="color: #818183">Adresse de résidence permanente</label>
                                <input class="form-control" type="text" name="adresse_de_residence_permanente" id="id_adresse_de_residence_permanente" value="{{ old('adresse_de_residence_permanente', $membre->adresse_de_residence_permanente) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse_de_residence_permanente')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_etat_civil" style="color: #818183">Etat civil</label>
                                <select name="etat_civil" id="id_etat_civil" class="form-control">
                                    <option @if ($membre->etat_civil === "marié(e)") selected @endif value="marié(e)">marié(e)</option>
                                    <option @if ($membre->etat_civil === "célibataire") selected @endif value="célibataire">célibataire</option>
                                    <option @if ($membre->etat_civil === "veuf(ve)") selected @endif value="veuf(ve)">veuf(ve)</option>
                                    <option @if ($membre->etat_civil === "divorcé(e)") selected @endif value="divorcé(e)">divorcé(e)</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('etat_civil')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_partenaire" style="color: #818183">Partenaire</label>
                                <input class="form-control" type="text" name="partenaire" id="id_partenaire" value="{{ old('partenaire', $membre->partenaire) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('partenaire')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nombre_enfants" style="color: #818183">Nombre d'enfants</label>
                                <input class="form-control" type="number" name="nombre_enfants" id="id_nombre_enfants" value="{{ old('nombre_enfants', $membre->nombre_enfants) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nombre_enfants')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_profession" style="color: #818183">Profession</label>
                                <input class="form-control" type="text" name="profession" id="id_profession" value="{{ old('profession', $membre->profession) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('profession')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_contacts" style="color: #818183">Contacts</label>
                                <input class="form-control" type="text" name="contacts" id="id_contacts" value="{{ old('contacts', $membre->contacts) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('contacts')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_email" style="color: #818183">Email</label>
                                <input class="form-control" type="text" name="email" id="id_email" value="{{ old('email', $membre->email) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_baptise" style="color: #818183">Baptisé ?</label>
                                <select name="baptise" id="id_baptise" class="form-control">
                                    <option @if ($membre->baptise === "Oui") selected @endif value="Oui">Oui</option>
                                    <option @if ($membre->baptise === "Non") selected @endif value="Non">Non</option>    
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('baptise', $membre->baptise)"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_bapteme" style="color: #818183">Date de baptême</label>
                                <input class="form-control" type="date" name="date_de_bapteme" id="id_date_de_bapteme" value="{{ old('date_de_bapteme', $membre->date_de_bapteme->format('Y-m-d')) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_bapteme')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_statut" style="color: #818183">Statut</label>
                                <select name="statut" id="id_statut" class="form-control">
                                    <option @if ($membre->statut === "Serviteur") selected @endif value="Serviteur">Serviteur</option>
                                    <option @if ($membre->statut === "Simple membre") selected @endif value="Simple membre">Simple membre</option>    
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('statut')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_fonction" style="color: #818183">Fonction</label>
                                <input class="form-control" type="text" name="fonction" id="id_fonction" value="{{ old('fonction', $membre->fonction) }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('fonction')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_responsabilites" style="color: #818183">Responsabilités</label>
                                <textarea class="form-control" name="responsabilites" id="id_responsabilites" value="">{{ old('responsabilites', $membre->responsabilites) }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('responsabilites')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_etat" style="color: #818183">Etat</label>
                                <select name="etat" id="id_etat" class="form-control">
                                    <option @if ($membre->etat === "En service") selected @endif value="En service">En service</option>
                                    <option @if ($membre->etat === "Suspendu") selected @endif value="Suspendu">Suspendre</option>    
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('etat')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_motif_de_suspension" style="color: #818183">Motif de suspension</label>
                                <textarea class="form-control" name="motif_de_suspension" id="id_motif_de_suspension" value="">{{ old('motif_de_suspension', $membre->motif_de_suspension) }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('motif_de_suspension')"/>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer les modifications</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/communiques_scripts/editer_script.js') }}"></script>
@endsection

