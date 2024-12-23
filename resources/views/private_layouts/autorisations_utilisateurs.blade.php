@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#autorisations spéciales')
@section('other_content')
    @if ($autorisations->count() === 0)
        <div>
            <form method="post" action="{{ route('manageprofile.load_autorisation_speciales', $user->id) }}" style="float: right;">
                @csrf
                <button type="submit" class="btn btn-success">charger les autorisations</button>
            </form>
        </div>
    @endif
@endsection
@section('content')
    <div class="app-content">
        <h6>USER ID: {{ $user->id }}</h6>
        <div class="container-xl">
            <hr class="mb-4">
            @if ($autorisations)
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <span style="color: dodgerblue">Activer ou désactiver ce compte</span>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings p-4">
                            <div class="app-card-body">
                                <form method="post" action="{{ route('manageprofile.user_account_status_check', $user->id) }}">
                                    <div class="form-check">
                                        @csrf
                                        @method('put')
                                        <div class="form-check form-switch mt-4">
                                            <input name="statut" class="form-check-input" type="checkbox"
                                                   id="settings-switch-1" @if($user->statut == true) checked @endif>
                                            <label class="form-check-label" for="settings-switch-1">Statut du
                                                compte</label>
                                        </div>
                                    </div><!--//form-check-->
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary text-light" >Enregistrer</button>
                                    </div>
                                </form>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
                <hr class="my-4">
            @endif
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
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection

