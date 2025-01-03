@extends('base_dashboard')
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
@section('style')
    <style>
        .btn-reply-comment:hover{
            color: dodgerblue;
            cursor: pointer;
        }
        .btn-trash-comment:hover{
            color: #ef904d;
        }
        .owl-prev, .owl-next {
            display: none!important;
        }
        .bi-send:hover {
            cursor: pointer;
            color: blue
        }

        button {
            border: none!important;
            box-shadow: none!important;
        }
        .scrollable-div {
            max-height: 500px;
            overflow-y: auto;
            padding: 10px;
        }
        .likeaction {
            transition: box-shadow 0.3s ease
        }
        .likeaction:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5)
        }

        /*---------------------------------------------------------------------*/
     

        .audio-container {
            position: relative;
            height: 300px;
            background: url('/storage/{{ $enseignement->affiche_photo }}') no-repeat center center;
            background-size: cover;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .audio-container audio {
            position: absolute;
            bottom: 0.1px;
            background: transparent;
            width: 100%;
            opacity: 0.6;
            border: none;
            border-radius: 0!important;
        }

        .audio-container audio::webkit-media-controls-panel,
        .audio-container audio::webkit-media-controls-play-button,
        .audio-container audio::webkit-media-controls-mute-button,
        .audio-container audio::webkit-media-controls-timeline,
        .audio-container audio::webkit-media-controls-current-time-display,
        .audio-container audio::webkit-media-controls-time-remaining-display,
        .audio-container audio::webkit-media-controls-seek-back-button,
        .audio-container audio::webkit-media-controls-seek-forward-button,
        .audio-container audio::webkit-media-controls-fullscreen-button,
        .audio-container audio::webkit-media-controls-volume-slider {
            background: transparent;
            color: white;
        },
    </style>
@endsection
@section('content')
    <div class="mt-3 p-2">
        <hr>
        <div class="row">
            <div class="col-12">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4 p-2">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">Thème: {{ $enseignement->titre }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Publié le {{ $enseignement->created_at->format("d/m/Y") }}, par {{ $enseignement->auteur->nom }} {{ $enseignement->auteur->postnom }} {{ $enseignement->auteur->prenom }}</div>
                    </header>

                    <!-- Preview image figure-->
                    <div class="audio-container">
                        <audio controls>
                            <source src="/storage/{{ $enseignement->audio }}" preload="metadata" type="audio/mpeg">
                            Votre navigateur ne supporte pas la balise audio.
                        </audio>
                    </div>
                    <!-- Post content-->
                    <section class="mb-5 p-2" style="background-color: rgb(238, 236, 236)">
                        <p class="mb-4 mt-4" style="text-align: justify">{{ $enseignement->enseignement }}</p>
                        <h2 class="fw-bolder mb-4 mt-5">Related</h2>
                        <hr>
                        @if ($enseignement->video)
                            <div class="col-lg-12 col-md-8 col-sm-12 p-0">
                                <video class="w-100" loop controls style="max-height: 500px">
                                <source src="/storage/{{ $enseignement->video }}" type="video/mp4" />
                                </video>
                            </div>
                        @endif
                    </section>
                </article>
            </div>
        </div> 
        <hr>
    </div> 
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/enseignements_scripts/afficher_enseignement.js') }}"></script>
@endsection


