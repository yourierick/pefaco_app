@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Paramètres')
@section('other_content')
    @if($autorisations->count() === 0)
        <div style="float:right; display: flex; gap: 2px">
            <form method="post" action="{{ route('charger_les_models', $groupe->id) }}">
                @csrf
                @method('put')
                <button type="submit" class="btn app-btn-secondary mb-2"><span>charger les modèles</span></button>
            </form>
        </div>
    @endif
@endsection
@section('content')
    <style>
        .param_advanced{
            color: dodgerblue;
        }

        .param_advanced:hover{
            color: #0765be;
            transition: color 1s ease;
        }
    </style>
    <div>
        <p style="color: darkgreen; font-weight: bold">Gestion des droit du groupe : {{ $groupe->groupe }}</p>
        @foreach($autorisations as $autorisation)
            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">{{ $autorisation->table_name }}</h3>
                    <div class="section-intro">Définir l'accès en lecture et en écriture pour les utilisateurs du groupe {{ $groupe->groupe }} dans l'application</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('save_autorisation_changes', $autorisation->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="lecture" type="checkbox" id="settings-checkbox-1-{{ $autorisation->id }}" @if($autorisation->lecture === 1) checked @endif>
                                    <label class="form-check-label" for="settings-checkbox-1-{{ $autorisation->id }}">lecture</label>
                                    <div class="ml-4">
                                        @if($autorisation->table_name === 'rapport_de_cultes' || $autorisation->table_name === 'rapport_mensuels')
                                            <span style="color: dodgerblue">paramètres avancés</span>
                                            <div>
                                                <div class="form-check">
                                                    <input type="radio" value="peux voir tous les rapports" name="autorisation_en_lecture[]" id="radio_input_1_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir tous les rapports', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                    <label class="form-check-label" for="radio_input_1_{{ $autorisation->id }}">
                                                        peux voir tous les rapports
                                                    </label>
                                                </div><!--//form-check-->
                                                <div class="form-check mb-3">
                                                    <input type="radio" value="peux voir seulement les rapports de son département" name="autorisation_en_lecture[]" id="radio_input_2_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir seulement les rapports de son département', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                    <label class="form-check-label" for="radio_input_2_{{ $autorisation->id }}">
                                                        peux voir seulement les rapports de son département
                                                    </label>
                                                </div>
                                            </div>
                                        @elseif ($autorisation->table_name === "caisses")
                                            <span style="color: dodgerblue">paramètres avancés</span>
                                            <div class="form-check">
                                                <input type="radio" value="peux voir toutes les caisses" name="autorisation_en_lecture[]" id="radio_input_1_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir toutes les caisses', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_1_{{ $autorisation->id }}">
                                                    peux voir toutes les caisses
                                                </label>
                                            </div><!--//form-check-->
                                            <div class="form-check mb-3">
                                                <input type="radio" value="peux voir seulement la caisse de son département" name="autorisation_en_lecture[]" id="radio_input_2_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir seulement la caisse de son département', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_2_{{ $autorisation->id }}">
                                                    peux voir seulement la caisse de son département
                                                </label>
                                            </div>
                                        @elseif ($autorisation->table_name === "enseignements")
                                            <span style="color: dodgerblue">paramètres avancés</span>
                                            <div class="form-check">
                                                <input type="radio" value="peux voir tous les enseignements" name="autorisation_en_lecture[]" id="radio_input_1_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir tous les enseignements', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_1_{{ $autorisation->id }}">
                                                    peux voir tous les enseignements
                                                </label>
                                            </div><!--//form-check-->
                                            <div class="form-check mb-3">
                                                <input type="radio" value="peux voir seulement ses enseignements" name="autorisation_en_lecture[]" id="radio_input_2_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir seulement ses enseignements', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_2_{{ $autorisation->id }}">
                                                    peux voir seulement ses enseignements
                                                </label>
                                            </div>
                                        @elseif ($autorisation->table_name === "cotisations")
                                            <span style="color: dodgerblue">paramètres avancés</span>
                                            <div class="form-check">
                                                <input type="radio" value="peux voir toutes les cotisations" name="autorisation_en_lecture[]" id="radio_input_1_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir toutes les cotisations', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_1_{{ $autorisation->id }}">
                                                    peux voir toutes les cotisations
                                                </label>
                                            </div><!--//form-check-->
                                            <div class="form-check mb-3">
                                                <input type="radio" value="peux voir seulement les cotisations de son département" name="autorisation_en_lecture[]" id="radio_input_2_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir seulement les cotisations de son département', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_2_{{ $autorisation->id }}">
                                                    peux voir seulement les cotisations de son département
                                                </label>
                                            </div>
                                        @elseif ($autorisation->table_name === "depenses")
                                            <span style="color: dodgerblue">paramètres avancés</span>
                                            <div class="form-check">
                                                <input type="radio" value="peux voir toutes les dépenses" name="autorisation_en_lecture[]" id="radio_input_1_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir toutes les dépenses', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_1_{{ $autorisation->id }}">
                                                    peux voir toutes les dépenses
                                                </label>
                                            </div><!--//form-check-->
                                            <div class="form-check mb-3">
                                                <input type="radio" value="peux voir seulement les dépenses de son département" name="autorisation_en_lecture[]" id="radio_input_2_{{ $autorisation->id }}" @if($autorisation->autorisation_en_lecture !== null) @if(in_array('peux voir seulement les dépenses de son département', json_decode($autorisation->autorisation_en_lecture, true))) checked @endif @endif>
                                                <label class="form-check-label" for="radio_input_2_{{ $autorisation->id }}">
                                                    peux voir seulement les dépenses de son département
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" onchange="handleCheckboxClick(this)" name="ecriture" type="checkbox" id="settings-checkbox-2-{{ $autorisation->id }}" @if($autorisation->ecriture === 1) checked @endif>
                                    <label class="form-check-label" for="settings-checkbox-2-{{ $autorisation->id }}">écriture</label>
                                    <div class="ml-4">
                                        @if($autorisation->table_name === 'rapport_de_cultes' || $autorisation->table_name === 'rapport_mensuels' || $autorisation->table_name === 'rapport_inspections')
                                            <div class="row g-4 settings-section">
                                                <div class="col-12 col-md-4">
                                                    <span style="color: dodgerblue">paramètres avancés</span>
                                                    <div class="section-intro">les utilisateurs de ce groupe pourront réaliser les actions suivantes sur le document:</div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="app-card app-card-settings p-4">
                                                        <div class="app-card-body">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux ajouter un rapport" name="autorisation_en_ecriture[]" id="rpt_checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="rpt_checkbox-1-{{ $autorisation->id }}">
                                                                    peux faire un rapport
                                                                </label>
                                                            </div><!--//form-check-->
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux modifier un rapport" name="autorisation_en_ecriture[]" id="rpt_checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux modifier un rapport', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="rpt_checkbox-2-{{ $autorisation->id }}">
                                                                    peux modifier un rapport
                                                                </label>
                                                            </div><!--//form-check-->
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux supprimer un rapport" id="rpt_checkbox-4-{{ $autorisation->id }}" name="autorisation_en_ecriture[]" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux supprimer un rapport', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="rpt_checkbox-4-{{ $autorisation->id }}">
                                                                    peux supprimer un rapport
                                                                </label>
                                                            </div>
                                                        </div><!--//app-card-body-->
                                                    </div><!--//app-card-->
                                                </div>
                                            </div><!--//row-->
                                        @elseif ($autorisation->table_name === 'users' || $autorisation->table_name === 'inventaires' || $autorisation->table_name === 'rapport_inspections' || $autorisation->table_name === 'articles' || $autorisation->table_name === 'annonces' || $autorisation->table_name === 'enseignements' || $autorisation->table_name === 'horaire_hebdos' || $autorisation->table_name === 'don_specials' || $autorisation->table_name === 'caisses' || $autorisation->table_name === 'cotisations' || $autorisation->table_name === 'depenses')
                                            <div class="row g-4 settings-section">
                                                <div class="col-12 col-md-4">
                                                    <span style="color: dodgerblue">paramètres avancés</span>
                                                    <div class="section-intro">les utilisateurs de ce groupe pourront réaliser les actions suivantes sur le document:</div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="app-card app-card-settings p-4">
                                                        <div class="app-card-body">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux ajouter" name="autorisation_en_ecriture[]" id="checkbox-1-{{ $autorisation->id }}" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="checkbox-1-{{ $autorisation->id }}">
                                                                    peux ajouter
                                                                </label>
                                                            </div><!--//form-check-->
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux modifier" name="autorisation_en_ecriture[]" id="checkbox-2-{{ $autorisation->id }}" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="checkbox-2-{{ $autorisation->id }}">
                                                                    peux modifier
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="child_ecriture_chkbox settings-checkbox-2-{{ $autorisation->id }}" value="peux supprimer" id="checkbox-3-{{ $autorisation->id }}" name="autorisation_en_ecriture[]" @if($autorisation->autorisation_en_ecriture !== null) @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true))) checked @endif @endif>
                                                                <label class="form-check-label" for="checkbox-3-{{ $autorisation->id }}">
                                                                    peux supprimer
                                                                </label>
                                                            </div>
                                                        </div><!--//app-card-body-->
                                                    </div><!--//app-card-->
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn app-btn-primary" >Enregistrer</button>
                                </div>
                            </form>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            <hr class="my-4">
        @endforeach
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/parametre_scripts/parametre.js') }}"></script>
@endsection
