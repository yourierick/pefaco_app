@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Enseignements/liste d'enseignements validés")
@section('other_content')
    <div class="btn-group dropdown" style="float: right;">
        <button class="btn dropdown-toggle" type="button" style="background-color: whitesmoke; color: darkblue" data-bs-toggle="dropdown" aria-expanded="false">
            Options
        </button>
        <ul class="dropdown-menu p-2" role="menu" style="background-color: #ffffff; border: 1px solid blue">
            <li>
                <p class="text-center">MENU</p>
                <div class="dropdown-divider"></div>
                @if(!is_null($autorisation_speciale))
                    @if($autorisation_speciale->autorisation_speciale)
                        @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                            <a href="{{ route('enseignement.voir_les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso"><span class="bi-file-word-fill text-primary"> en attente validation</span></a>
                        @endif
                    @endif
                @endif
                @if($autorisation)
                    @if($autorisation->autorisation_en_ecriture)
                        @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                            <a href="{{ route('enseignement.voir_mes_drafts_enseignement') }}" class="dropdown-item btn btn-outline-secondary perso" style="float:right"><span class="bi-file-fill text-info"> voir mes drafts</span></a>
                            <a href="{{ route('enseignement.nouvel_enseignement') }}" class="dropdown-item btn btn-outline-secondary perso" title="nouvel enseignement" style="float:right"><span class="bi-pencil-square"> nouvel enseignement</span></a>
                        @endif
                    @endif
                @endif
            </li>
        </ul>
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
                        <p>Voulez-vous vraiment supprimer cet enseignement ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('enseignement.supprimer_un_enseignement') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="enseignement_id" id="id_enseignement">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="supprimer cet enseignement">
                            Oui je le veux
                        </button>
                    </form>
                    <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body p-2">
                                        <div class="table-responsive">
                                            <table class="table table-striped w-100 mb-0 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                    <tr>
                                                        <th class="cell" style="color: whitesmoke; font-weight: normal">N°</th>
                                                        <th class="cell" style="color: whitesmoke; font-weight: normal">titre</th>
                                                        <th class="cell" style="color: whitesmoke; font-weight: normal">référence</th>
                                                        <th class="cell" style="color: whitesmoke; font-weight: normal">statut</th>
                                                        <th class="cell" style="color: whitesmoke; font-weight: normal">audience</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">titre</th>
                                                        <th class="cell">référence</th>
                                                        <th class="cell">statut</th>
                                                        <th class="cell">audience</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($enseignements as $enseignement)
                                                    <tr>
                                                        <td class="cell">{{ $loop->iteration }}</td>
                                                        <td class="cell">{{ $enseignement->titre }}</td>
                                                        <td class="cell">{{ $enseignement->reference }}</td>
                                                        <td class="cell">{{ $enseignement->statut }}</td>
                                                        <td class="cell">{{ $enseignement->audience }}</td>
                                                        <td class="d-flex">
                                                            <a class="btn-sm" href="{{ route('enseignement.afficher_un_enseignement', $enseignement->id) }}"><span class="bi-eye text-secondary"></span></a>
                                                            @if($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        <a href="#" data-role="{{ $enseignement->id }}" onclick="loadidenseignementformodaldelete(this)" class="btn-sm" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadidenseignementformodaldelete(element) {
            $("#id_enseignement").val(element.getAttribute("data-role"));
        }
    </script>
@endsection

