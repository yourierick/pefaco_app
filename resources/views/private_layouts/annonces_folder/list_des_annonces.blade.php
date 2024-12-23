@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Annonces")
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
                    @if($autorisation_speciale)
                        @if($autorisation_speciale->autorisation_speciale)
                            @if(in_array('peux valider', json_decode($autorisation_speciale->autorisation_speciale, true)))
                                <a href="{{ route('annonce.voir_les_attentes_en_validation') }}" class="dropdown-item btn btn-outline-secondary perso" style="float:right"><span class="bi-file text-secondary"></span> en attente de validation</a>
                            @endif
                        @endif
                    @endif
                    @if($autorisation)
                        @if($autorisation->autorisation_en_ecriture)
                            @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                                <a href="{{ route('annonce.voir_mes_drafts') }}" class="dropdown-item btn btn-outline-secondary perso" style="float:right"><span class="bi-file-arrow-up-fill text-danger f-2"></span> voir mes drafts</a>
                                <a href="{{ route('annonce.nouvelle_annonce') }}" class="dropdown-item btn btn-outline-secondary perso" title="nouvel article" style="float:right"><span class="bi-plus-circle-fill text-primary"></span> nouvelle annonce</a>
                            @endif
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
                        <p>Voulez-vous vraiment supprimer cette annonce ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('annonce.supprimer_une_annonce') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="annonce_id" id="id_annonce">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="supprimer cette annonce">
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
                                    <div class="app-card-body table-responsive p-4">
                                        <div>
                                            <table class="table-sm table-striped w-100 mb-0 text-left" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                <tr>
                                                    <th class="cell" style="font-weight: normal">N°</th>
                                                    <th class="cell" style="font-weight: normal">date</th>
                                                    <th class="cell" style="font-weight: normal">titre</th>
                                                    <th class="cell" style="font-weight: normal">statut</th>
                                                    <th class="cell" style="font-weight: normal">audience</th>
                                                    <th class="cell"></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">date</th>
                                                        <th class="cell">titre</th>
                                                        <th class="cell">statut</th>
                                                        <th class="cell">audience</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($annonces as $annonce)
                                                    <tr>
                                                        <td class="cell" style="font-size: 10pt">{{ $loop->iteration }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $annonce->date->format('d-m-Y') }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $annonce->titre }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $annonce->statut }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $annonce->audience }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('annonce.afficher_annonce', $annonce->id) }}"><span class='bi-eye'></span></a>
                                                            @if($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        <a href="#" class="btn-sm app-btn-secondary" data-role="{{ $annonce->id }}" onclick="loadidannonceformodaldelete(this)" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadidannonceformodaldelete(element) {
            $("#id_annonce").val(element.getAttribute("data-role"));
        }
    </script>
@endsection

