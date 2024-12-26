@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Rapport mensuel/liste des rapports')
@section("style")
    <style>
        .perso:hover{
            color: #000000;
            background-color: #d9d6d6;
            border-radius: 9px;
            transition: .5s ease;
        }
    </style>
@endsection
@section('other_content')
    <div class="modal fade" id='modal'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100 fw-normal">
                        <p>Voulez-vous vraiment supprimer ce rapport ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('rapportmensuel.supprimer_rapport') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="" name="rapport_id" id="rapport_id">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="supprimer ce rapport">
                            Oui je le veux
                        </button>
                        <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        <a href="{{ route('rapportmensuel.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-eye-fill text-secondary"> voir mes drafts</span></a>
                        @if(!is_null($autorisation))
                            @if($autorisation->autorisation_en_ecriture)
                                @if(in_array('peux ajouter un rapport', json_decode($autorisation->autorisation_en_ecriture, true)))
                                    <a href="{{ route('rapportmensuel.ajouter_nouveau_rapport') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-info"> faire un rapport</span></a>
                                @endif
                            @endif
                        @endif
                        @if(!is_null($autorisation_speciale))
                            @if($autorisation_speciale->autorisation_speciale)
                                @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a href="{{ route('rapportmensuel.les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span  class="bi-file-word-fill"> rapports en attente de validation</span></a>
                                @endif
                                @if(in_array('peux completer', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                    <a href="{{ route('rapportmensuel.les_attentes_en_completion') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"> rapports en attente de complétion</span></a>
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
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="table-responsive">
                                            <table class="table-sm table-striped w-100" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell" style="font-weight: normal; color: whitesmoke">N°</th>
                                                        <th class="cell" style="font-weight: normal; color: whitesmoke">Département</th>
                                                        <th class="cell" style="font-weight: normal; color: whitesmoke">Mois de rapportage</th>
                                                        <th class="cell" style="font-weight: normal; color: whitesmoke">Rapporteur</th>
                                                        <th class="cell" style="font-weight: normal; color: whitesmoke">Statut</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Département</th>
                                                        <th class="cell">Mois de rapportage</th>
                                                        <th class="cell">Rapporteur</th>
                                                        <th class="cell">Statut</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($rapports as $rapport)
                                                    <tr>
                                                        <td class="cell" style="font-size: 10pt">{{ $loop->iteration }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $rapport->departement->designation }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $rapport->mois_de_rapportage->translatedFormat('F Y') }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $rapport->user->nom }} {{ $rapport->user->postnom }} {{ $rapport->user->prenom }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $rapport->statut }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('rapportmensuel.afficher_rapport_mensuel', $rapport->id) }}"><span class="bi-pencil-square text-primary"></span></a>
                                                            @if($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux supprimer un rapport', json_decode($autorisation->autorisation_en_ecriture, true)) || $rapport->statut === 'draft')
                                                                        <button class="btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target='#modal' onchange="loadidrapport(this)" value="{{ $rapport->id }}"><span class="bi-trash-fill text-danger"></span></button>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div><!--//table-responsive-->
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function loadidrapport(element) {
            let input_id = document.getElementById("rapport_id");
            input_id.value = element.value
        }
    </script>
@endsection

