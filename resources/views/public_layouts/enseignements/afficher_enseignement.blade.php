@extends('base_public_second')
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
            height: 500px;
            background: url('/storage/{{ $enseignement? $enseignement->affiche_photo : "" }}') no-repeat center center;
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
@section('container')
    <div class="mt-5 p-2">
        <hr>
        <div class="row">
            <div class="col-lg-8 p-3" style="background-color: rgb(248, 246, 244)">
                <!-- Post content-->
                @if ($enseignement->lien_acces_youtube)
                    <div class="p-3">
                        <a id="youtube" href="{{ $enseignement->lien_acces_youtube }}" target="_blank">
                            <span class="bi-youtube text-danger fs-1 bx-flashing"></span>
                        </a>
                    </div>
                @endif
                <article>
                    <!-- Post header-->
                    <header class="mb-4 p-2">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">Thème: {{ $enseignement->titre }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Publié le {{ $enseignement->created_at->format("d/m/Y") }}, par {{ $enseignement->auteur->nom }} {{ $enseignement->auteur->postnom }} {{ $enseignement->auteur->prenom }}</div>
                        <form id="formlikeordislike" action="{{ route('public.likeordislikeenseignement', $enseignement->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="action" id="input_action">
                            <div class="d-flex gap-3">
                                <button class="btn likeaction p-0 m-0" onclick="setActionValueForLikeorDislike(this)" value="liker" type="submit" style="border: none; box-shadow: none"><span id="count_likes">{{ $enseignement->like }} </span><i style="font-size: 13pt" class='bx bxs-like text-primary'></i></button>
                                <button class="btn likeaction p-0 m-0" onclick="setActionValueForLikeorDislike(this)" value="disliker" type="submit" style="border: none; box-shadow: none"><span id="count_dislikes">{{ $enseignement->dislike }} </span><i style="font-size: 13pt" class='bx bx-dislike text-danger'></i></button>
                            </div>
                        </form>
                    </header>
                    <!-- Preview image figure-->
                    <div class="audio-container">
                        <audio controls>
                            <source src="/storage/{{ $enseignement->audio }}" preload="metadata" type="audio/mpeg">
                            Votre navigateur ne supporte pas la balise audio.
                        </audio>
                    </div>

                </article>
                <!-- Post content-->
                <section class="mb-5 p-2 mt-3">
                    <p class="mb-4" style="text-align: justify">{!! $enseignement->enseignement !!}</p>
                </section>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4 p-3">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">COMMENTAIRES</div>
                    <div class="card-body">
                        <section class="mb-5">
                            <div class="card bg-light">
                                <div class="card-body scrollable-div"  style="padding: 0px">
                                    <!-- Comment form-->
                                    <form class="mb-4 d-flex flex-row p-2 border-bottom" method="post" action="{{ route('public.save_commentaire_enseignement', $enseignement->id) }}">
                                        @csrf
                                        <input type="text" max="100" placeholder="commentaire" name="commentaire" class="form-control">
                                        <button type="submit" class="btn text-success" style="border: none; box-shadow: none">
                                            <span class="bi-send">
                                            </span>
                                        </button>
                                    </form>
                                    <div >
                                        @foreach($enseignement->commentaires as $commentaire)
                                        <div class="d-flex mb-3">
                                            <!-- Parent comment-->
                                            <div class="flex-shrink-0" style="padding: 4px"><img style="width: 40px; height: 40px" class="rounded-circle" src="{{ asset('css/images/utilisateur.png') }}" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-normal fst-italic">Commentaire #{{ $loop->iteration }}</div>
                                                    <div style="margin-bottom: 1px">
                                                        {{ $commentaire->commentaire }}
                                                        <p style="margin-bottom: 0px">
                                                            <div class="d-flex">
                                                                <span class="bi-reply btn-reply-comment" id="{{ $commentaire->id }}" onclick="displayornotform_comment_child(this)">
                                                                </span>
                                                                @auth
                                                                    @if (auth()->user()->id == $enseignement->auteur->id)
                                                                        <form action="{{ route('public.supprimer_commentaire_enseignement', $commentaire->id) }}" method="post">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="btn"><span class="bi-trash text-danger"></span></button>
                                                                        </form>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                            <span class="text-muted small">il y a {{ $commentaire->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                    <div id="form_comment_child_{{ $commentaire->id }}" style="display: none">
                                                        <form action="{{ route('public.save_commentairechild_enseignement', $commentaire->id) }}" method="post" class="mb-4 d-flex flex-row p-2">
                                                            @csrf
                                                            <input type="text" max="100" placeholder="commentaire" name="commentaire" class="form-control">
                                                            <button type="submit" class="btn" style="border: none; box-shadow: none">
                                                                <span class="bi-send">
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @foreach($commentaire->commentaire_child as $commentairechild)
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0" style="padding: 4px"><img style="width: 40px; height: 40px" class="rounded-circle" src="{{ asset('css/images/utilisateur.png') }}" alt="..." /></div>
                                                            <div class="ms-3">
                                                                <div class="fw-normal fst-italic">Réponse #{{ $loop->iteration }}</div>
                                                                {{ $commentairechild->commentaire }}
                                                                <p>
                                                                    @auth
                                                                        @if (auth()->user()->id == $enseignement->auteur->id)
                                                                            <form action="{{ route('public.supprimer_commentairechild_enseignement', $commentairechild->id) }}" method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"><span class="bi-trash text-danger"></span></button>
                                                                            </form>
                                                                        @endif
                                                                    @endauth
                                                                    <span class="text-muted small">il y a {{ $commentairechild->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
@section('scripts')
    <script>
        function displayornotform_comment_child(element){
            let id_comment = element.id;
            let str = "form_comment_child_" + id_comment;
            let form_comment = document.getElementById(str);
            if (form_comment.style.display == "none"){
                form_comment.style.display = "unset";
                element.setAttribute("class", "bi-x-circle btn-reply-comment")
            }else {
                form_comment.style.display = "none";
                element.setAttribute("class", "bi-reply btn-reply-comment")
            }
        }

        function setActionValueForLikeorDislike(element) {
            $('#input_action').val(element.value);
        }

        $('#formlikeordislike').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#count_likes").text(data.likes);
                    $("#count_dislikes").text(data.dislikes);
                }, error: function (error) {
                }
            })
        })

        //------------------------------------------------------------//
        //like & shuffle button
    </script>
@endsection
