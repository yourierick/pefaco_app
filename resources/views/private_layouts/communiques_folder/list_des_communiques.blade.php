@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Communiqués/liste des communiqués")
@section('other_content')
    <div class="d-flex" style="gap: 3px; float: right">
        @if ($autorisationspeciales)
            @if($autorisationspeciales->autorisation_speciale)
                @if(in_array('peux ajouter', json_decode($autorisationspeciales->autorisation_speciale, true)))
                    <a href="{{ route('communique.nouveau_communique') }}" class="btn btn-primary mb-2" title="nouvel enseignement" style="float:right"><span style="color: white"><i class='bx bx-edit-alt'></i></span></a>
                @endif
           @endif
        @endif
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
                        <p>voulez-vous vraiment supprimer ce communique ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('communique.supprimer_un_communique') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="communique_id" id="id_communique">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="supprimer ce communique">
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
                                                    <th class="cell" style="font-weight: normal; color: whitesmoke">N°</th>
                                                    <th class="cell" style="font-weight: normal; color: whitesmoke">Code</th>
                                                    <th class="cell" style="font-weight: normal; color: whitesmoke">titre</th>
                                                    <th class="cell" style="font-weight: normal; color: whitesmoke">date</th>
                                                    <th class="cell"></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Code</th>
                                                        <th class="cell">titre</th>
                                                        <th class="cell">date</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($communiques as $communique)
                                                    <tr>
                                                        <td class="cell">{{ $loop->iteration }}</td>
                                                        <td class="cell">Communiqué n°00{{ $communique->id }}</td>
                                                        <td class="cell">{{ $communique->titre }}</td>
                                                        <td class="cell">{{ $communique->date->format('d/m/Y') }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('communique.afficher_un_communique', $communique->id) }}">voir</a>
                                                            @if (!is_null($autorisationspeciales))
                                                                @if($autorisationspeciales->autorisation_speciale)
                                                                    @if(in_array('peux supprimer', json_decode($autorisationspeciales->autorisation_speciale, true)))
                                                                        <a href="#" data-role="{{ $communique->id }}" onclick="loadidcommuniqueformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadidcommuniqueformodaldelete(element) {
            $("#id_communique").val(element.getAttribute('data-role));
        }
    </script>
@endsection

