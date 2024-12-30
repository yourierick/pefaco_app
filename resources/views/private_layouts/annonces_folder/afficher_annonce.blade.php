@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('style')
    <link rel="stylesheet" href="{{ asset("assets/css/affichage_rapport_event.css") }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
@endsection
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if($annonce->statut === "draft")
            <a href="{{ route('annonce.edit_une_annonce', $annonce->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
            <form method="post" action="{{ route('annonce.traitement_annonce', $annonce->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="soumission" class="btn app-btn-secondary mb-2"><span>soumettre</span></button>
            </form>
        @endif
        @if($annonce->statut === "en attente de validation")
            <form method="post" action="{{ route('annonce.traitement_annonce', $annonce->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="validation" class="btn app-btn-secondary mb-2"><span>valider</span></button>
            </form>
        @endif
        @if($autorisation->autorisation_en_ecriture)
            @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))

                <div style="float:right">
                    <a href="{{ route('annonce.edit_une_annonce', $annonce->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
                </div>
            @endif
        @endif
        @if($annonce->statut === "validé")
            @if(!is_null($autorisation_speciale))
                @if($autorisation_speciale->autorisation_speciale)
                    @if(in_array("peux changer l'audience", json_decode($autorisation_speciale->autorisation_speciale, true)))
                        @if ($annonce->audience === "privé")
                            <form method="post" action="{{ route('annonce.traitement_annonce', $annonce->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="publication" class="btn app-btn-secondary mb-2"><span>publier</span></button>
                            </form>
                        @endif
                        @if($annonce->audience === "public")
                            <form method="post" action="{{ route('annonce.traitement_annonce', $annonce->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="prive" class="btn btn-danger mb-2"><span class="text-light">dépublier</span></button>
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
                                <div class="app-card app-card-orders-table mb-5">
                                    <div class="app-card-body">
                                        <div class="row p-4">
                                            <div class="col col-xs-12 col-md-6">
                                                <div>
                                                    <h2>{{ $annonce->titre }} en ce jour du {{ $annonce->date->format('d/m/Y') }}</h2>
                                                    <img style="max-height: 500px; width: 100%" src="{{ \Illuminate\Support\Facades\Storage::url($annonce->photo_descriptive) }}" alt="#">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6 mt-2">
                                                <p style="color: darkgray; font-size: 10pt; text-align: justify; font-weight: normal">{{ $annonce->description }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->
                    </section>
                </div>
                <p style="font-weight: normal; font-size: 10pt; font-style: italic">Signé par {{ $annonce->annonceur->nom }} {{ $annonce->annonceur->postnom }} {{ $annonce->annonceur->prenom }}</p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://kit.fontawesome.com/48764efa36.js" crossorigin="anonymous"></script>
@endsection

