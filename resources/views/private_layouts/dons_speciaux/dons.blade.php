@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Dons spéciaux')
@section('other_content')
    @if($autorisations)
        @if($autorisations->autorisation_en_ecriture)
            @if(in_array('peux ajouter', json_decode($autorisations->autorisation_en_ecriture, true)))
                <a href="{{ route('don.ajouter') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> enregistrer un don</span></a>
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
                        <p>Voulez-vous vraiment supprimer ce don ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('don.supprimer_don') }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="don_id" id="id_don">
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
                                    <div class="app-card-body table-responsive p-3">
                                        <table class="table-sm table-striped mb-0 text-left w-100" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                <tr>
                                                    <th class="cell" style="font-weight: normal">N°</th>
                                                    <th class="cell" style="font-weight: normal">Date</th>
                                                    <th class="cell" style="font-weight: normal">Donateur</th>
                                                    <th class="cell" style="font-weight: normal">Don</th>
                                                    <th class="cell"></th>
                                                </tr>
                                                </thead>
                                                <tfoot >
                                                <tr>
                                                    <th class="cell">N°</th>
                                                    <th class="cell">Date</th>
                                                    <th class="cell">Donateur</th>
                                                    <th class="cell">Don</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($dons as $don)
                                                    <tr>
                                                        <td class="cell" style="font-size: 10pt">{{ $loop->iteration }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $don->date ? $don->date->format('d-m-Y'): "" }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $don->donateur }}</td>
                                                        <td class="cell" style="font-size: 10pt">{{ $don->don }} FC</td>
                                                        <td class="cell text-center">
                                                            @if($autorisations)
                                                                @if($autorisations->autorisation_en_ecriture)
                                                                    @if(in_array('peux modifier', json_decode($autorisations->autorisation_en_ecriture, true)))
                                                                        <a class="btn-sm app-btn-secondary" href="{{ route('don.edit_don', $don->id) }}"><span class="bi-pencil-fill"></span></a>
                                                                    @endif
                                                                    @if(in_array('peux supprimer', json_decode($autorisations->autorisation_en_ecriture, true)))
                                                                        <a href="#" data-role="{{ $don->id }}" onclick="loadiddonformodaldelete(this)" class="btn-sm app-btn-secondary" data-bs-toggle="modal"  data-bs-target='#modaldelete'><span class="bi-trash-fill text-danger"></span></a>
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
        function loadiddonformodaldelete(element) {
            $("#id_don").val(element.getAttribute('data-role'));
        }
    </script>
@endsection

