@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Horaire')
@section('style')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if ($autorisation)
            @if($autorisation->autorisation_en_ecriture)
                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal" title="editer la semaine"  data-bs-target='#modaledithoraire'><span style="color: white"><i class='bx bx-edit-alt'></i></span></a>
                        <div class="modal fade" id='modaledithoraire'>
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                            Modifier la semaine
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="w-100 fw-normal">
                                            <form method="post" action="{{ route('horairehebdo.save_edition_horaire', $horaire->id) }}">
                                                @csrf
                                                @method('put')
                                                <div class="p-3">
                                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                        <label>date de début</label>
                                                        <input type="date" name="date_debut" value="{{ $horaire->date_debut->format('Y-m-d') }}" onchange="checkDateDifference()" class="form-control mb-2" id="input_date_debut" required>
                                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_debut')"/>
                                                    </div>
                                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                        <label>date de fin</label>
                                                        <input type="date" name="date_fin" value="{{ $horaire->date_fin->format('Y-m-d') }}" onchange="checkDateDifference()" class="form-control" id="input_date_fin" required>
                                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_fin')"/>
                                                    </div>
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
                    </div>
                @endif
                @if(in_array('peux ajouter', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="{{ route('horairehebdo.programmer', $horaire->id) }}" class="btn btn-secondary mb-2"><span style="color: white">programmer</span></a>
                    </div>
                @endif
            @endif
        @endif
    </div>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <h2>Semaine du lundi {{ $horaire->date_debut->format('d/m/Y') }} au dimanche {{ $horaire->date_fin->format('d/m/Y') }}</h2>
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body table-responsive">
                                <br><table class="table table-striped w-100 mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">N°</th>
                                            <th class="cell">Jour</th>
                                            <th class="cell">Programme</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($programmes as $programme)
                                        <tr>
                                            <td style="vertical-align: top; font-weight: bold">{{ $loop->iteration }}</td>
                                            <td style="vertical-align: top; font-weight: bold; background-color: #d2ecff">{{ $programme->jour }}</td>
                                            <td style="vertical-align: top">
                                                @foreach(json_decode($programme->programme, true) as $value)
                                                    <span style="font-weight: bold">{{ $loop->iteration }}.</span> <span class="ml-3">{{ $value }}</span><br>
                                                @endforeach
                                            </td>
                                            <td style="vertical-align: top">
                                                <a class="btn-sm app-btn-secondary mt-2" href="{{ route('horairehebdo.editer_programme', $programme->id) }}"><i class='bx bx-edit-alt'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/horairehebdo_scripts/add_semaine.js') }}"></script>
@endsection

