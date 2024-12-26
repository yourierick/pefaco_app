@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Caisses')
@section('other_content')
    @if ($autorisation->autorisation_en_ecriture)
        @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
            <a href="{{ route('caisses.add_new') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> Créer une caisse</span></a>
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
                        <p>Voulez-vous vraiment supprimer cette caisse ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('caisses.delete_caisse') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="caisse_id" id="id_caisse">
                        <button type="button" class="btn btn-danger text-light" style="font-weight: normal" title="Supprimer cette dépense">
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
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body table-responsive">
                                        <div class="p-3">
                                            <table class="table-sm mb-0 w-100 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                <tr>
                                                    <th class="cell" style="font-weight: normal">ID</th>
                                                    <th class="cell" style="font-weight: normal">Département</th>
                                                    <th class="cell" style="font-weight: normal">Caissier</th>
                                                    <th class="cell" style="font-weight: normal">Montant net actuel</th>
                                                    <th class="cell" style="font-weight: normal">Dernière mise à jour</th>
                                                    <th class="cell"></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th class="cell">ID</th>
                                                    <th class="cell">Département</th>
                                                    <th class="cell">Caissier</th>
                                                    <th class="cell">Montant net actuel</th>
                                                    <th class="cell">Dernière mise à jour</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                    @if($caisses)
                                                        @foreach($caisses as $caisse)
                                                            <tr>
                                                                <td class="cell" style="font-size: 10pt">{{ $caisse->id }}</td>
                                                                <td class="cell" style="font-size: 10pt">{{ $caisse->departement->designation }}</td>
                                                                <td class="cell" style="font-size: 10pt">{{ $caisse->caissier->nom }} {{ $caisse->caissier->postnom }} {{ $caisse->caissier->prenom }}</td>
                                                                <td class="cell" style="font-size: 10pt">{{ $caisse->montant_net_actuel}} FC</td>
                                                                <td class="cell" style="font-size: 10pt">{{ $caisse->updated_at->format('d-m-Y') }} à {{ $caisse->updated_at->format('h:i') }}</td>
                                                                <td class="cell d-flex gap-1">
                                                                    <a class="btn-sm" href="{{ route('caisses.vue_de_la_caisse', $caisse->id) }}"><span class="bi-eye-fill text-success"></span></a>
                                                                    @if($autorisation->autorisation_en_ecriture)
                                                                        @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                            <a class="btn-sm" href="{{ route('caisses.edit_caisse', $caisse->id) }}"><span class="bi-pencil-square text-primary"></span></a>
                                                                        @endif
                                                                        @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                            <a class="btn-sm text-danger" data-bs-toggle="modal" data-role="{{ $caisse->id }}" onclick="loadidcaisseformodaldelete(this)"  data-bs-target='#modaldelete'><span class="bi-trash2-fill text-danger"></span></a>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
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
        function loadidcaisseformodaldelete(element) {
            $("#id_caisse").val(element.getAttribute('data-role'))
        }
    </script>
@endsection

