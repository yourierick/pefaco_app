@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Vue du rapport de culte')
@section('other_content')
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
                                <a href="{{ route('rapportmensuel.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                            @endif
                            @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a href="{{ route('rapportmensuel.les_attentes_en_completion') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"> rapports en attente de complétion</span></a>
                            @endif
                        @endif
                    @endif
                    <div class="dropdown-divider"></div>
                    <p class="text-center mb-1">ACTION SUR LE DOCUMENT</p>
                    @if($rapport->statut !== "draft")
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                @if(in_array('peux modifier un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportmensuel.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-primary"></span> {{ $rapport->statut === "en attente de complétion" && !is_null($autorisation_speciale) && $autorisation_speciale->autorisation_speciale && in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)) ? "compléter le rapport": "modifier" }}</a>
                                @endif
                            @endif
                        @endif
                    @else
                        <a href="{{ route('rapportmensuel.edit_le_rapport', $rapport->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pencil-square text-primary"></span> {{ $rapport->statut === "en attente de complétion" && !is_null($autorisation_speciale) && $autorisation_speciale->autorisation_speciale && in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)) ? "compléter le rapport": "modifier" }}</a>
                    @endif
                    <form action="{{ route('rapportmensuel.traitement_du_rapport', $rapport->id) }}" method="post">
                        @csrf
                        @method('put')
                        @if($rapport->statut === 'draft')
                            @if($autorisation_speciale)
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <button name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre pour validation</button>
                                    @else
                                        <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                                    @endif
                                @else
                                    <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                                @endif
                            @else
                                <button name="action" value="soumission" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"></span> soumettre à la caisse</button>
                            @endif
                        @endif
                        @if($rapport->statut === 'en attente de validation')
                            <button name="action" value="validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"> valider</span></button>
                        @endif
                        @if($rapport->statut === 'en attente de complétion')
                            <button name="action" value="soumettre_pour_validation" class="dropdown-item btn btn-outline-secondary perso" type="submit"><span class="bi-check-circle-fill text-success"> soumettre pour validation</span></button>
                        @endif
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .orange-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            height: 40px;
            background-color: orangered;
            transform: translateY(-50%);
        }
    </style>
    <link href="{{ asset("new_styles_and_scripts/css/afficher_rapport_mensuel_styles.css") }}" rel="stylesheet">
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <h5 class="text-primary" style="font-weight: bold; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 13pt">Rapport mensuel @if($rapport->departement->designation === "comité provincial") de l'église @endif</span></h5>
                    <p style="margin: 0">Département: {{ $rapport->departement->designation }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="/storage/{{ $rapport->user->photo }}" class="img-fluid" alt="" style="box-shadow: 4px 0 0 orangered; padding-right: 10px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Rapporteur</p>
                            <hr style="background-color: orangered; height: 4px; margin: 0">
                            <p class="text-primary" style="font-size: 14pt"> {{ $rapport->user->nom }} {{ $rapport->user->postnom }} {{ $rapport->user->prenom }}</p>
                            <h6 class="text-muted" style="margin: 0">Qualité: <span style="text-transform: capitalize">{{ $rapport->user->qualite->designation }}</span></h6>
                            <p>Mois de rapportage: {{ $rapport->mois_de_rapportage->translatedFormat("F Y") }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 position-relative d-none d-md-block">
                        <div class="orange-line"></div>
                    </div>
                </div>
                <hr style="height: 1px;">
                <div class="mt-5">
                    <h6 class="text-muted">0. SOMMAIRE</h6>
                    <div class="row ml-5">
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">1. OBJECTIFS</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">2. VISION</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">3. MISSION</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">4. SITUATION</span></p>
                                    <ul>
                                        <li>prévisions pour ce mois</li>
                                        <li>réalisations de ce mois</li>
                                        <li>situation actuelle</li>
                                        <li>autres à rapporter</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-timeline list-timeline-primary">
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">5. VUE SUR LA LOGISTIQUE</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">6. STATISTIQUES</span></p>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">7. VUE DE LA CAISSE ET CONTRIBUTIONS</span></p>
                                    <ul>
                                        <li>solde actuel de la caisse</li>
                                        <li>autres contributions à renseigner</li>
                                    </ul>
                                </li>
                                <li class="list-timeline-item p-0 pb-4 pb-lg-4 d-flex flex-wrap flex-column" data-toggle="collapse" data-target="#day-1-item-2">
                                    <p class="my-0 text-dark show flex-fw text-sm text-uppercase"><span class="text-primary op-8 infinite animated flash" data-animate="flash" data-animate-infinite="1" data-animate-duration="3.5" style="animation-duration: 3.5s;"></span></p>
                                    <p class="my-0 collapse flex-fw text-xs text-dark op-8 show" id="day-1-item-2"><span style="font-weight: 500">8. CONCLUSION</span></p>
                                    <ul>
                                        <li>difficultés et défis</li>
                                        <li>récommandations</li>
                                        <li>prévisions pour le mois prochain</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container my-5">
                        <div>
                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-church text-warning fs-3"></i>
                                </div>
                                <div style="background: #457ebe;" class="card-content">
                                    <h5 class="text-white">1. OBJECTIFS</h5>
                                </div>
                            </div>
                            <p class="custom-card-text mt-2">
                                {{ $rapport->objectifs }}
                            </p>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-person-burst text-secondary fs-3"></i>
                                </div>
                                <div class="card-content bg-secondary">
                                    <h5 class="text-white">2. VISION</h5>
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                <p>{{ $rapport->vision }}</p>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-bible text-secondary fs-3"></i>
                                </div>
                                <div class="card-content bg-secondary">
                                    <h5 class="text-white">3. MISSION</h5>
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                <p>{{ $rapport->mission }}</p>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-file-archive text-warning fs-3"></i>
                                </div>
                                <div style="background: #457ebe;" class="card-content">
                                    <h5 class="text-white">4. SITUATION</h5>
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                <h6 class="ml-2">4.1. Prévisions de ce mois</h6>
                                <div class="ml-3">
                                    @foreach(json_decode($rapport->previsions_pour_ce_mois, true) as $value)
                                        <p>- {{ $value }}</p>
                                    @endforeach
                                </div>

                                <h6 class="ml-2 mt-3">4.2. Réalisations de ce mois</h6>
                                <div class="ml-3">
                                    @foreach(json_decode($rapport->realisations_de_ce_mois, true) as $value)
                                        <p>- {{ $value }}</p>
                                    @endforeach
                                </div>

                                <h6 class="ml-2 mt-3">4.3. Situation actuelle</h6>
                                <div class="ml-3">
                                    <p>{{ $rapport->situation_actuelle }}</p>
                                </div>

                                <h6 class="ml-2 mt-3">4.4. Autres à rapporter</h6>
                                <div class="ml-3">
                                    <p>{{ $rapport->autres_a_rapporter }}</p>
                                </div>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-lightbulb text-warning fs-3"></i>
                                </div>
                                <div style="background: #457ebe;" class="card-content">
                                    <h5 class="text-white">5. VUE SUR LA LOGISTIQUE</h5>
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                <p>{{ $rapport->situation_de_la_logistique }}</p>
                            </div>

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-chart-pie text-secondary fs-3"></i>
                                </div>
                                <div style="background: #bea800;" class="card-content">
                                    <h5 class="text-white">6. STATISTIQUES</h5>
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                @if($rapport->departement->designation === "comité provincial")
                                    <ul><li style="font-weight: bold">Effectifs généraux de l'église</li></ul>
                                    <p>Le rapport indique que l'église compte à ce jour un effectif total de <span style="font-weight: bold; color: blue">{{ $rapport->effectif_total }} Personnes</span> tel que détaillé par le graphique ci-dessous:</p>
                                    <div class="chart-container">
                                        <canvas id="statutChart"></canvas>
                                    </div>
                                    <br>
                                    <ul><li style="font-weight: bold">Moyennes mensuelles de fréquentation</li></ul>
                                    <p>Le rapport indique que la moyenne générale de fréquentation aux cultes est de <span style="font-weight: bold; color: blue">{{ $rapport->moyenne_mensuel_total }} Personnes.</span> Ceci est détaillé dans le graphique ci-dessous par catégorie d'individus:</p>
                                    <div class="chart-container">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                    <br>
                                    <ul><li style="font-weight: bold">Total mensuel des personnes baptisées</li></ul>
                                    <p>Le rapport indique que le nombre des personnes baptisées au courant de ce mois est de <span style="font-weight: bold; color: blue">{{ $rapport->nombre_des_personnes_baptises }} Personnes.</span></p>
                                @elseif($rapport->departement->designation === "ecodim" || $rapport->departement->designation === "comité des mamans" || $rapport->departement->designation === "comité des jeunes")
                                    <ul><li style="font-weight: bold">Nombre total actuel des membres dans le département</li></ul>
                                    <p>Le rapport indique que le département compte à ce jour un effectif total de <span style="font-weight: bold; color: blue">{{ $rapport->effectif_total }} Personnes</span></p>
                                    <ul><li style="font-weight: bold">Moyenne mensuelle de participation dans les cultes</li></ul>
                                    <p>Le rapport indique que la moyenne mensuelle de participation aux cultes est de <span style="font-weight: bold; color: blue">{{ $rapport->moyenne_mensuel_total }} Personnes</span></p>
                                @else
                                    <ul><li style="font-weight: bold">Nombre total actuel des membres dans le département</li></ul>
                                    <p>Le rapport indique que le département compte à ce jour un effectif total de <span style="font-weight: bold; color: blue">{{ $rapport->effectif_total }} Personnes</span></p>
                                @endif
                            </div>
                            @if(!is_null($autorisation_speciale))
                                @if($autorisation_speciale->autorisation_speciale)
                                    @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                        <div class="custom-card d-flex align-items-center">
                                            <div class="icon-circle text-white">
                                                <i class="fa fa-coins text-secondary fs-3"></i>
                                            </div>
                                            <div style="background: #195900;" class="card-content">
                                                <h5 class="text-white">7. FINANCES</h5>
                                            </div>
                                        </div>
                                        <div class="custom-card-text mt-2">
                                            <ul><li style="font-weight: bold">Situation actuelle de la caisse</li></ul>
                                            <p>Le montant actuellement dans la caisse est <span style="font-weight: bold; color: blue">{{ $rapport->situation_caisse }} FC</span></p>
                                            <br>
                                            <h5>Rélevé des transactions de ce mois</h5>
                                            <div>
                                                <table class="table-sm table-striped w-100 text-left" id="multi-filter-select">
                                                    <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">date de la transaction</th>
                                                        <th class="cell">type de transaction</th>
                                                        <th class="cell">code de la dépense</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">motif</th>
                                                        <th class="cell">source</th>
                                                        @if($rapport->departement->id !== 1)
                                                            <th class="cell">% de l'église</th>
                                                        @endif
                                                        <th class="cell">montant net restant</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">date de la transaction</th>
                                                        <th class="cell">transaction</th>
                                                        <th class="cell">code de la dépense</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">motif</th>
                                                        <th class="cell">source</th>
                                                        @if($rapport->departement->id !== 1)
                                                            <th class="cell">% de l'église</th>
                                                        @endif
                                                        <th class="cell">montant net restant</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    @foreach($releve_des_transactions_mensuelles as $transaction)
                                                        <tr>
                                                            <td class="cell">{{ $loop->iteration }}</td>
                                                            <td class="cell">{{ $transaction->date_de_la_transaction->format('d-m-Y') }}</td>
                                                            <td class="cell">{{ $transaction->type_de_transaction }}</td>
                                                            <td class="cell">{{ $transaction->code_de_depense }}</td>
                                                            <td class="cell">{{ $transaction->montant }} FC</td>
                                                            <td class="cell">{{ $transaction->motif }} FC</td>
                                                            <td class="cell">{{ $transaction->source }}</td>
                                                            @if($rapport->departement->id !== 1)
                                                                <td class="cell">{{ $transaction->pourcentage_eglise }} %</td>
                                                            @endif
                                                            <td class="cell">{{ $transaction->montant_net_restant }} FC</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <ul><li style="font-weight: bold">Autres contributions ou dons à renseigner</li></ul>
                                            <p>{{ $rapport->autres_contributions_a_renseigner ? : 'Rien à signaler' }}</p>
                                        </div>
                                    @endif
                                @endif
                            @endif

                            <div class="custom-card d-flex align-items-center">
                                <div class="icon-circle text-white">
                                    <i class="fa fa-file text-secondary fs-3"></i>
                                </div>
                                <div style="background: #606060;" class="card-content">
                                    @if(!is_null($autorisation_speciale))
                                        @if($autorisation_speciale->autorisation_speciale)
                                            @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                                <h5 class="text-white">8. CONCLUSION</h5>
                                            @else
                                                <h5 class="text-white">7. CONCLUSION</h5>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="custom-card-text mt-2">
                                <ul><li style="font-weight: bold">Difficultés et défis</li></ul>
                                <p>{{ $rapport->difficultes_defis ? : "Rien à signaler" }}</p>
                                <br>
                                <ul><li style="font-weight: bold">Récommandations</li></ul>
                                <p>{{ $rapport->recommandations ? : 'Rien à signaler' }}</p>
                                <ul><li style="font-weight: bold">Prévisions pour le mois prochain</li></ul>
                                <div class="ml-3">
                                    @foreach(json_decode($rapport->previsions_mois_prochain, true) as $value)
                                        <p>- {{ $value }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script>
        const ctx = document.getElementById("statutChart").getContext("2d");
        let total = {{ $rapport->effectif_total }};
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["hommes", "femmes", "jeunes", "enfants"],
                datasets: [
                    {
                        label: "effectif par catégorie",
                        data: [{{ $rapport->effectif_hommes }}, {{ $rapport->effectif_femmes }}, {{ $rapport->effectif_jeunes }}, {{ $rapport->effectif_enfants }}],
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} sur ${total} membres de l'église`;
                                }
                            }
                        }
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "top",
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuad'
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: { left: 15, right: 15, top: 15, bottom: 15 },
                },
                scales : {
                    y: {
                        beginAtZero: true
                    }
                },
            },
        });

        const ctex = document.getElementById("barChart").getContext("2d");
        new Chart(ctex, {
            type: 'line',
            data: {
                labels: ["hommes", "femmes", "jeunes", "enfants"],
                datasets: [
                    {
                        label: "MMFC",
                        borderColor: "#f39d1d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#000000",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: "rgba(231,163,3,0.6)",
                        fill: true,
                        borderWidth: 1,
                        data: [{{ $rapport->moyenne_mensuel_hommes }}, {{ $rapport->moyenne_mensuel_femmes }}, {{ $rapport->moyenne_mensuel_jeunes }}, {{ $rapport->moyenne_mensuel_enfants }}],
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} en moyenne`;
                                }
                            }
                        }
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "top",
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuad'
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: { left: 15, right: 15, top: 15, bottom: 15 },
                },
                scales : {
                    y: {
                        beginAtZero: true
                    }
                },
            },
        });
    </script>
@endsection
