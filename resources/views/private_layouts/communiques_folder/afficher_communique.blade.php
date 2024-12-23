@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Communiqué')
@section('style')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if ($autorisationspeciales)
            @if($autorisationspeciales->autorisation_speciale)
                @if(in_array('peux modifier', json_decode($autorisationspeciales->autorisation_speciale, true)))
                    <div style="float:right">
                        <a href="{{ route('communique.edit_un_communique', $communique->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
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
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div>
                                            <!-- Single Table -->
                                            <div class="col-12">
                                                <div class="single-table">
                                                    <!-- Table Head -->
                                                    <div class="table-head">
                                                        <div>
                                                            <div class="p-4">
                                                                <div class="icon">
                                                                    <i class='bx bxs-bible fs-2 text-info' ></i><span class="fs-3">Eglise Pefaco Universelle| Communiqué du {{ $communique->date->format('d/m/Y') }}</span>
                                                                </div>
                                                                <hr>
                                                                <h5 class="title mb-4">Objet: "{{ $communique->titre }}" pour le {{ $communique->date->format('d/m/Y')  }}</h4>
                                                                <div>
                                                                    <div id="text">
                                                                        @foreach(json_decode($communique->contenu, true) as $value)
                                                                            <p><span style="font-weight: 600">{{ $loop->iteration }}.</span>  {{ $value }}</p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <p style="text-decoration: underline">Signé par {{ $communique->communiquant->nom }} {{ $communique->communiquant->postnom }} {{ $communique->communiquant->prenom }}</p>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <!-- End Single Table-->
                                        </div>
                                        <hr>
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


