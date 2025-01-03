@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#caisse du '.$caisse->departement->designation)
@section('style')
    <style>
        .orange-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            height: 40px;
            background-color: dodgerblue;
            transform: translateY(-50%);
        }
    </style>
@endsection
@section('other_content')
    @if($autorisation->autorisation_en_ecriture)
        @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
            <div style="float:right; margin-left: 5px">
                <a href="{{ route('caisses.nouvelle_transaction', $caisse->id) }}" class="btn btn-primary mb-2"><span style="color: white"> insérer</span></a>
            </div>
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
                        <p>Voulez-vous vraiment annuler cette transaction ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('caisses.annuler_transaction', $caisse->id) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="transaction_id" id="id_transaction">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="annuler ce mouvement">
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
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <h5 class="text-primary" style="font-weight: bold; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 13pt">Vue de la caisse</span></h5>
                    <p style="margin: 0">Département: {{ $caisse->departement->designation }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="@if ($caisse->caissier->photo) /storage/{{ $caisse->caissier->photo }} @else {{ asset('css/images/utilisateur.png') }} @endif" class="img-fluid" alt="" style="box-shadow: 4px 0 0 orangered; padding-right: 10px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Caissier</p>
                            <hr style="background-color: #007bff; height: 4px; margin: 0">
                            <p class="text-primary" style="font-size: 14pt"> {{ $caisse->caissier->nom }} {{ $caisse->caissier->postnom }} {{ $caisse->caissier->prenom }}</p>
                            <p>Date de création: {{ $caisse->created_at->format("d-m-Y") }}</p>
                            <p>Montant actuel dans la caisse : <span style="color: orangered">{{ $caisse->montant_net_actuel }} {{ $parametre_devise }}</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 position-relative d-none d-md-block">
                        <div class="orange-line"></div>
                    </div>
                </div>
                <div class="mt-5 max-w-xl">
                    <section>
                        <h4 class="text-muted mb-4">Livre de la Caisse</h4>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body table-responsive">
                                        <div class="p-3">
                                            <table class="table-sm table-striped w-100 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Mois de la transaction</th>
                                                        <th class="cell">date de la transaction</th>
                                                        <th class="cell">type de transaction</th>
                                                        <th class="cell">code de la dépense</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">motif</th>
                                                        <th class="cell">source</th>
                                                        @if($departement->id !== 1)
                                                            <th class="cell">% de l'église</th>
                                                        @endif
                                                        <th class="cell">montant net restant</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Mois de la transaction</th>
                                                        <th class="cell">date de la transaction</th>
                                                        <th class="cell">transaction</th>
                                                        <th class="cell">code de la dépense</th>
                                                        <th class="cell">montant</th>
                                                        <th class="cell">motif</th>
                                                        <th class="cell">source</th>
                                                        @if($departement->id !== 1)
                                                            <th class="cell">% de l'église</th>
                                                        @endif
                                                        <th class="cell">montant net restant</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td class="cell">{{ $loop->iteration }}</td>
                                                        <td class="cell">{{ $transaction->date_de_la_transaction->translatedFormat('F Y') }}</td>
                                                        <td class="cell">{{ $transaction->date_de_la_transaction->format('d-m-Y') }}</td>
                                                        <td class="cell">{{ $transaction->type_de_transaction }}</td>
                                                        <td class="cell">{{ $transaction->code_de_depense }}</td>
                                                        <td class="cell">{{ $transaction->montant }} {{ $parametre_devise }}</td>
                                                        <td class="cell">{{ $transaction->motif }}</td>
                                                        <td class="cell">{{ $transaction->source }}</td>
                                                        @if($departement->id !== 1)
                                                            <td class="cell">{{ $transaction->pourcentage_eglise }} %</td>
                                                        @endif
                                                        <td class="cell">{{ $transaction->montant_net_restant }} {{ $parametre_devise }}</td>
                                                        <td class="cell">
                                                            @if($autorisation->autorisation_en_ecriture)
                                                                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                    <button class="btn text-secondary" onclick="load_transaction_id(this)" value="{{ $transaction->id }}" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span style="color: red">annuler</span></button>
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
        function load_transaction_id(element) {
            $("#id_transaction").val(element.value);
        }
    </script>
@endsection

