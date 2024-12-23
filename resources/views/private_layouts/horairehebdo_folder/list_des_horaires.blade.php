@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Horaire/liste des programmes")
@section('other_content')
    <div class="d-flex" style="gap: 3px; float: right">
        @if ($autorisation)
            @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" title="nouvel horaire"  data-bs-target='#modaladdhoraire'><span style="color: white"><i class='bx bx-edit-alt'></i></span></a>
                <div class="modal fade" id='modaladdhoraire'>
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                    Renseigner la semaine
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="w-100 fw-normal">
                                    <form method="post" action="{{ route('horairehebdo.save_horaire') }}">
                                        @csrf
                                        <div class="p-3">
                                            <label>date de début</label>
                                            <input type="date" name="date_debut" class="form-control mb-2" id="input_date_debut" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_debut')"/>
                                            <label>date de fin</label>
                                            <input type="date" name="date_fin" onchange="checkDateDifference()" class="form-control" id="input_date_fin" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_fin')"/>
                                            <br>
                                            <button type="submit" class="btn btn-success text-light" style="font-weight: normal">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p>voulez-vous vraiment supprimer cet horaire ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('horairehebdo.supprimer_un_horaire') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="horaire_id" id="id_horaire">
                        <button type="submit" class="btn btn-danger text-light" style="font-weight: normal" title="supprimer cet horaire">
                            Oui je le veux
                        </button>
                    </form>
                    <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
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
                                                        <th class="cell" style="font-weight: normal">Début de la semaine</th>
                                                        <th class="cell" style="font-weight: normal">Fin de la semaine</th>
                                                        <th class="cell"></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th class="cell">N°</th>
                                                        <th class="cell">Début de la semaine</th>
                                                        <th class="cell">Fin de la semaine</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($horaires as $horaire)
                                                    <tr>
                                                        <td class="cell">{{ $loop->iteration }}</td>
                                                        <td class="cell">{{ $horaire->date_debut->format('d/m/Y') }}</td>
                                                        <td class="cell">{{ $horaire->date_fin->format('d/m/Y') }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('horairehebdo.afficher_un_horaire', $horaire->id) }}">voir</a>
                                                            @if ($autorisation)
                                                                @if($autorisation->autorisation_en_ecriture)
                                                                    @if(in_array('peux supprimer', json_decode($autorisation->autorisation_en_ecriture, true)))
                                                                        <a href="#" data-role="{{ $horaire->id }}" onclick="loadidhoraireformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadidhoraireformodaldelete(element) {
            $("#id_horaire").val(element.getAttribute('data-role'));
        }
    </script>
    <script src="{{ asset('assets/js/horairehebdo_scripts/add_semaine.js') }}"></script>
@endsection

