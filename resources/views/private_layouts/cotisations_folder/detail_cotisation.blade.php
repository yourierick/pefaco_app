@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre')
    <span>
        #Comptes
    </span>
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        <div class="btn-group dropdown" style="float: right;">
            <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
                Options
            </button>
            <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
                <li>
                    <p class="text-center">MENU</p>
                    <div class="dropdown-divider"></div>
                    @if($autorisation->ecriture === 1)
                        @if($cotisation->statut === "en cours")
                            <a href="{{ route('cotisation.inserer_cotisation_account', $cotisation->id) }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-plus-circle-fill text-primary"></span> nouvelle cotisation</a>
                            <form method="post" action="{{ route('cotisation.mettre_en_attente', $cotisation->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-pause-circle-fill text-info"></span> mettre en attente</button>
                            </form>
                            <form method="post" action="{{ route('cotisation.terminer_la_cotisation', $cotisation->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-exclamation-circle-fill text-danger"></span> terminer</button>
                            </form>
                        @endif
                        @if($cotisation->statut === "en attente")
                            <form method="post" action="{{ route('cotisation.lancer_la_cotisation', $cotisation->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="dropdown-item btn btn-outline-secondary perso"><span class="text-light"> lancer la cotisation</span></button>
                            </form>
                        @endif
                    @endif
                </li>
            </ul>
        </div>
    </div>
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
                        <p>Voulez-vous vraiment annuler cette cotisation ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('cotisation.annuler_cotisation_account', $cotisation->id) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="cotisation_account_id" id="id_cotisation_account">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="annuler cette ligne">
                            Oui je le veux
                        </button>
                    </form>
                    <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="p-2 table-responsive">
                                            <table class="table-sm table-striped mb-0 text-left w-100" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                <tr>
                                                    <th class="cell" style="font-weight: normal">N°</th>
                                                    <th class="cell" style="font-weight: normal">Date</th>
                                                    <th class="cell" style="font-weight: normal">Cotisant(e)</th>
                                                    <th class="cell" style="font-weight: normal">Montant</th>
                                                    <th class="cell"></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th class="cell" style="font-weight: normal">N°</th>
                                                    <th class="cell" style="font-weight: normal">Date</th>
                                                    <th class="cell" style="font-weight: normal">Cotisant(e)</th>
                                                    <th class="cell" style="font-weight: normal">Montant</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($cotisation_accounts as $cotisation_account)
                                                    <tr>
                                                        <td class="cell" style="font-size: 10pt">{{ $loop->iteration }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation_account->created_at->format('d-m-Y') }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation_account->cotisant }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $cotisation_account->montant }} FC</td>
                                                        <td class="cell">
                                                            @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                <a href="{{ route('cotisation.edit_cotisation_account', $cotisation_account->id) }}" class="btn-sm app-btn-secondary"><span class="bi-pencil-square text-primary"></span></a>
                                                            @endif
                                                            @if($autorisation->autorisation_en_ecriture)
                                                                @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                    <a href="#" data-role="{{ $cotisation_account->id }}" onclick="loadidcotisationformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
            $('#id_cotisation_account').val(element.getAttribute('data-role'));
        }
    </script>
@endsection

