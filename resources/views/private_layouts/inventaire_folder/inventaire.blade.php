@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Inventaire')
@section('other_content')
    @if($autorisation)
        @if($autorisation->autorisation_en_ecriture)
            @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                <a href="{{ route('inventaire.ajouter') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> enregistrer un bien</span></a>
            @endif
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
                        <p>Voulez-vous vraiment supprimer ce bien ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('inventaire.supprimer_bien') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="bien_id" id="id_bien">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="Supprimer cette dépense">
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
                                    <div class="app-card-body table-responsive p-4">
                                        <div>
                                            <table class="table-sm table-striped mb-0 w-100 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: white">
                                                    <tr>
                                                        <th class="cell" style="font-weight: normal">N°</th>
                                                        <th class="cell" style="font-weight: normal">Désignation</th>
                                                        <th class="cell" style="font-weight: normal">Date d'acquisition</th>
                                                        <th class="cell" style="font-weight: normal">Prix unit.</th>
                                                        <th class="cell" style="font-weight: normal">Qté</th>
                                                        <th class="cell" style="font-weight: normal">Affectation</th>
                                                        <th class="cell" style="font-weight: normal">Etat</th>
                                                        <th class="cell" style="font-weight: normal">Date de création</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Désignation</th>
                                                        <th class="cell">Date d'acquisition</th>
                                                        <th class="cell">Prix unit.</th>
                                                        <th class="cell">Qté</th>
                                                        <th class="cell">Affectation</th>
                                                        <th class="cell">Etat</th>
                                                        <th class="cell">Date de création</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($biens as $bien)
                                                    <tr>
                                                        <td class="cell" style="font-size: 10pt">{{ $loop->iteration }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->designation }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->date_acquisition ? $bien->date_acquisition->format('d-m-Y'): "" }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->prix_unitaire }} FC</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->quantite }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->affectation }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->etat }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $bien->created_at->format('d-m-Y') }}</td>
                                                        <td class="cell">
                                                            @if($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        <a class="btn-sm app-btn-secondary" href="{{ route('inventaire.edit_bien', $bien->id) }}"><span class="bi-pencil-square"></span></a>
                                                                    @endif
                                                                    @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        <a href="#" data-role="{{ $bien->id }}" onclick="loadidbienformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadidbienformodaldelete(element) {
            $("#id_bien").val(element.getAttribute('data-role'));
        }
    </script>
@endsection

