@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Cotisations')
@section('other_content')
    @if($autorisation->autorisation_en_ecriture)
        @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
            <a href="{{ route('cotisation.ajouter') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> Nouvelle cotisation</span></a>
        @endif
    @endif
@endsection
@section('content')
    <div class="modal fade" id='modaldelete'>
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
                        <p>Voulez-vous vraiment supprimer cette cotisation ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('cotisation.supprimer_cotisation') }}">
                        @csrf
                        @method('delete')
                        <input type='hidden' name='cotisation_id' id='id_cotisation'>
                        <button type="button" class="btn btn-danger text-light" style="font-weight: normal" title="Supprimer cette cotisation">
                            Oui je le veux
                        </button>
                    </form>
                    <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body p-4">
                                        <div class="table-responsive">
                                            <table class="table-sm table-striped table-responsive mb-0 w-100 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell" style="font-weight: normal">id</th>
                                                        <th class="cell" style="font-weight: normal">département</th>
                                                        <th class="cell" style="font-weight: normal">motif</th>
                                                        <th class="cell" style="font-weight: normal">début</th>
                                                        <th class="cell" style="font-weight: normal">fin</th>
                                                        <th class="cell" style="font-weight: normal">statut</th>
                                                        <th class="cell" style="font-weight: normal">montant</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">id</th>
                                                        <th class="cell">département</th>
                                                        <th class="cell">motif</th>
                                                        <th class="cell">début</th>
                                                        <th class="cell">fin</th>
                                                        <th class="cell">statut</th>
                                                        <th class="cell">montant</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($cotisations as $cotisation)
                                                    <tr>
                                                        <td class="cell"><span style="font-weight: normal;">{{ $cotisation->id }}</span>
                                                        </td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->departement->designation }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->motif }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->date_debut->format('d-m-Y') }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->date_fin->format('d-m-Y') }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->statut }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation->montant_total_net }} {{ $parametre_devise }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('cotisation.afficher', $cotisation->id) }}"><span class="bi-eye-fill"></span></a>
                                                            @if($autorisation->autorisation_en_ecriture)
                                                                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                    <a class="btn-sm app-btn-secondary" href="{{ route('cotisation.edit_cotisation', $cotisation->id) }}"><span class="bi-pencil-square text-primary"></span></a>
                                                                @endif
                                                                @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                    <a href="#" data-role="{{ $cotisation->id }}" onclick="loadidcotisationformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class='bi-trash-fill text-danger'></span></a>
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
        function loadidcotisationformodaldelete(element) {
            $("#id_cotisation").val(element.getAttribute('data-role'))
        }
    </script>
@endsection

