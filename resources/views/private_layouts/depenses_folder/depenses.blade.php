@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Dépenses')
@section('other_content')
    @if($autorisation)
        @if($autorisation->autorisation_en_ecriture)
            @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                <a href="{{ route('depense.ajouter') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> Engager une dépense</span></a>
            @endif
        @endif
    @endif
@endsection
@section('content')
    <div class="py-12 mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body p-4">
                                        <div>
                                            <table class="table-sm table-responsive table-striped w-100 mb-0 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell">ID</th>
                                                        <th class="cell">date</th>
                                                        <th class="cell">département</th>
                                                        <th class="cell">code</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">statut</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">ID</th>
                                                        <th class="cell">date</th>
                                                        <th class="cell">département</th>
                                                        <th class="cell">code</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">statut</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($depenses as $depense)
                                                    <tr>
                                                        <td class="cell">{{ $depense->id }}</td>
                                                        <td class="cell">{{ $depense->created_at->format('d-m-Y') }}</td>
                                                        <td class="cell">{{ $depense->departement->designation }}</td>
                                                        <td class="cell">{{ $depense->code_de_depense }}</td>
                                                        <td class="cell">{{ $depense->montant }} {{ $parametre_devise }}</td>
                                                        <td class="cell">{{ $depense->statut }}</td>
                                                        <td class="cell text-center">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('depense.afficher', $depense->id) }}"><span class="bi-eye"></span></a>
                                                            @if($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        @if ($depense->statut !== 'en attente de validation' && $depense->statut !== 'en attente de confirmation')
                                                                            <a href="#" class="btn-sm btn-primary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
                                                                        @endif
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

