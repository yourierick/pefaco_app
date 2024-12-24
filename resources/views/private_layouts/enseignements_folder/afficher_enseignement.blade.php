@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Enseignement')
@section('style')
    <link rel="stylesheet" href="{{ asset("assets/css/enseignement.css") }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if($enseignement->statut === "draft")
            <a href="{{ route('enseignement.edit_un_enseignement', $enseignement->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
            <form method="post" action="{{ route('enseignement.traitement_enseignement', $enseignement->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="soumission" class="btn app-btn-secondary mb-2"><span>soumettre</span></button>
            </form>
        @endif
        @if($enseignement->statut === "en attente de validation")
            @if($autorisation->autorisation_en_ecriture)
                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="{{ route('enseignement.edit_un_enseignement', $enseignement->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
                    </div>
                @endif
            @endif
            <form method="post" action="{{ route('enseignement.traitement_enseignement', $enseignement->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="validation" class="btn app-btn-secondary mb-2"><span>valider</span></button>
            </form>
        @endif
        @if($enseignement->statut === "validé")
            @if($autorisation->autorisation_en_ecriture)
                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="{{ route('enseignement.edit_un_enseignement', $enseignement->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
                    </div>
                @endif
            @endif
            @if($autorisation_speciale)
                @if($autorisation_speciale->autorisation_speciale)
                    @if(in_array("peux changer l'audience", json_decode($autorisation_speciale->autorisation_speciale, true)))
                        @if ($enseignement->audience === "privé")
                            <form method="post" action="{{ route('enseignement.traitement_enseignement', $enseignement->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="publication" class="btn app-btn-secondary mb-2"><span>publier</span></button>
                            </form>
                        @endif
                        @if($enseignement->audience === "public")
                            <form method="post" action="{{ route('enseignement.traitement_enseignement', $enseignement->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="prive" class="btn btn-danger mb-2"><span class="text-light">privé</span></button>
                            </form>
                        @endif
                     @endif
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
                                                        <div class="p-3">
                                                            <div class="icon">
                                                                <i class='bx bxs-bible fs-3' ></i><span class="title text-info fs-4">Thème: "{{ $enseignement->titre }}"</span>
                                                            </div>
                                                            <div class="ml-3" style="box-shadow: -2px 0 0 rgb(194, 194, 194); padding-left: 10px">
                                                                <div class="ml-4">
                                                                    <div>
                                                                        <p><span style="font-weight: 600">{{ $enseignement->reference }}</span></p>
                                                                    </div>
                                                                    <div>
                                                                        <p id="text" style="text-align: justify">
                                                                            {{ $enseignement->enseignement }}
                                                                        </p>
                                                                        <a href="#" class="btn text-primary" id="toggleButton">voir plus</a>
                                                                    </div>
                                                                    @if($enseignement->video)
                                                                        <div class="mt-2">
                                                                            <video style="width: 100%; height: 300px" controls>
                                                                                <source src="/storage/{{ $enseignement->video }}" type="video/mp4">
                                                                                Votre navigateur ne supporte pas la balise audio.
                                                                            </video>
                                                                        </div>
                                                                    @endif
                                                                    @if($enseignement->audio)
                                                                        <div class="mt-2">
                                                                            <audio style="width: 100%" controls>
                                                                                <source src="/storage/{{ $enseignement->audio }}" type="audio/mpeg">
                                                                                Votre navigateur ne supporte pas la balise audio.
                                                                            </audio>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <p class="mt-3" style="font-style: italic">Signé par {{ $enseignement->auteur->nom }} {{ $enseignement->auteur->postnom }} {{ $enseignement->auteur->prenom }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Table-->
                                        </div>
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
    <script src="{{ asset('assets/js/enseignements_scripts/afficher_enseignement.js') }}"></script>
@endsection

