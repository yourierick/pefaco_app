@extends('base_dashboard')
@section('page_title', 'Dashboard')
@section('titre', '#EGLISE PEFACO')
@section('content')
    <div class="mt-4 app-card alert alert-dismissible shadow mb-4 border-left-decoration" role="alert">
        <div class="inner">
            <div class="app-card-body">
                <h3 class="mb-4" style="color: #1E2723FF;">EGLISE PEFACO UNIVERSELLE BUKAVU</h3>
                <div class="row gap-2">
                    <div class="col-xs-12 col-md-3 col-sm-4 p-0 m-0">
                        <img src="{{ asset("assets/images/photo1.jpg") }}" style="height: 200px; width: 100%" alt="...">
                    </div>
                    <div class="col-xs-12 col-md-8 col-sm-7 p-0 m-0">
                        <div><p style="text-align: justify; font-weight: 500; font-size: 11pt">L' Eglise PEFACO Universelle Bukavu vous souhaite la bienvenue sur son portail de gestion et vous souhaite d'avoir une meilleur expérience utilisateur, si vous rencontrez un problème, veuillez consultez l'onglet "Aide" pour votre renseignement</p></div>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-body-->
        </div><!--//inner-->
    </div><!--//app-card-->
    <hr>
    @if (!is_null($horairehebdo))
        <h5 class="fst-italic text-muted mb-3">Horaire Hebdomadaire du Lundi {{ $horairehebdo->date_debut->format('d/m/Y') }} au {{ $horairehebdo->date_fin->format('d/m/Y') }}</h5>
        <div>
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body table-responsive">
                    <br><table class="table table-striped w-100 mb-0 text-left" id="multi-filter-select">
                        <thead>
                            <tr>
                                <th class="cell">N°</th>
                                <th class="cell">Département</th>
                                <th class="cell">Jour</th>
                                <th class="cell">Programme</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="cell">N°</th>
                                <th class="cell">Département</th>
                                <th class="cell">Jour</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($horairehebdo->programmes as $programme)
                            <tr>
                                <td style="vertical-align: top; font-weight: bold">{{ $loop->iteration }}</td>
                                <td style="vertical-align: top; font-weight: bold; background-color: #d2ecff">{{ $programme->departement }}</td>
                                <td style="vertical-align: top; font-weight: bold; background-color: #d2ecff">{{ $programme->jour }}</td>
                                <td style="vertical-align: top">
                                    @foreach(json_decode($programme->programme, true) as $value)
                                        <span style="font-weight: bold">{{ $loop->iteration }}.</span> <span class="ml-3">{{ $value }}</span><br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    @endif
    @if (isset($rapports_de_culte))
        @if ($rapports_de_culte->count() != 0)
            <h5 class="fst-italic text-muted">Rapport de culte</h5>
            @foreach($rapports_de_culte as $rapport_de_culte)
                <div class="row g-4 mb-4">
                    <div class="col-xs-12 col-sm-6">
                        <div class="app-card app-card-progress-list h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Informations générales</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-4">
                                <div class="item p-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="title mb-1 ">Date</div>
                                            <p>{{ $rapport_de_culte->date->format('d-m-Y') }}</p>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->
                                <div class="item p-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="title mb-1 ">Modérateur</div>
                                            <p>{{ $rapport_de_culte->moderateur }}</p>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->
                                <div class="item p-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="title mb-1 ">Orateur</div>
                                            <p>{{ $rapport_de_culte->orateur }}</p>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->

                                <div class="item p-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="title mb-1 ">Thème et Références</div>
                                            <p style="font-style: italic">{{ $rapport_de_culte->theme }}</p>
                                            <p style="font-style: italic">
                                                @foreach(json_decode($rapport_de_culte->reference, true) as $value)
                                                    * <span>{{ $value }}</span><br>
                                                @endforeach
                                            </p>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//item-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                    <div class="col-xs-12 col-sm-6">
                        <div class="app-card app-card-stats-table h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Statistiques</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                        <tr>
                                            <th class="meta">Type</th>
                                            <th class="meta stat-cell">Quantité</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="border-bottom">
                                            <td>Total</td>
                                            <td class="stat-cell">{{ $rapport_de_culte->total_pers_dans_le_culte }} Personnes</td>
                                        </tr>
                                        <tr>
                                            <td>Papas</td>
                                            <td class="stat-cell">{{ $rapport_de_culte->total_papas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mamans</td>
                                            <td class="stat-cell">{{ $rapport_de_culte->total_mamans }}</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#">Jeunes</a></td>
                                            <td class="stat-cell">{{ $rapport_de_culte->total_jeunes }}</td>
                                        </tr>
                                        <tr>
                                            <td><a href="#">Enfants </a></td>
                                            <td class="stat-cell">{{ $rapport_de_culte->total_enfants }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Offrandes et Dons spéciaux</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                @if($autorisation_speciale)
                                    @if($autorisation_speciale->autorisation_speciale)
                                        @if(in_array('peux voir la partie financiere du rapport', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                            <div class="chart-container">
                                                <span class="fw-bold" style="color: orangered; text-transform: uppercase">Total Offrande:</span> <span class="fw-bold">{{ $rapport_de_culte->total_offrande }} {{ $parametre_devise }}</span>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                <div class="chart-container">
                                    <span style="color: dodgerblue; text-transform: uppercase" class="fw-bold">Autres offrandes:</span>
                                    @foreach(json_decode($rapport_de_culte->don_special, true) as $value)
                                        <br>* <span>{{ $value }}</span>
                                    @endforeach
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="app-card app-card-chart h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Autres faits qui se sont déroulés durant le culte à rapporter</h4>
                                    </div><!--//col-->
                                </div><!--//row-->
                            </div><!--//app-card-header-->
                            <div class="app-card-body p-3 p-lg-4">
                                <div class="chart-container">
                                    @foreach(json_decode($rapport_de_culte->autres_faits_a_renseigner, true) as $value)
                                        * <span>{{ $value }}</span><br>
                                    @endforeach
                                </div>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </div><!--//row-->
            @endforeach

            @if($rapports_de_culte)
                @if($rapports_de_culte->count() !== 0)
                    <div>
                        {{ $rapports_de_culte->links('pagination_copy') }}
                    </div>
                @endif
            @endif
        @endif
    @endif
@endsection
