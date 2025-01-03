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
    </style>
@endsection
@section('container')
    <div class="mt-5 p-2">
        <hr>
        <div class="row">
            <div class="col-lg-8 p-3">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4 p-2">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $article->titre }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Publié le {{ $article->date->format("d/m/Y") }}, par {{ $article->rapporteur_user->nom }} {{ $article->rapporteur_user->postnom }} {{ $article->rapporteur_user->prenom }}</div>
                        <form id="formlikeordislike" action="{{ route('public.likeordislikearticle', $article->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="action" id="input_action">
                            <div class="d-flex gap-3">
                                <button class="btn likeaction p-0 m-0" onclick="setActionValueForLikeorDislike(this)" value="liker" type="submit" style="border: none; box-shadow: none"><span id="count_likes">{{ $article->like }} </span><i style="font-size: 13pt" class='bx bxs-like text-primary'></i></button>
                                <button class="btn likeaction p-0 m-0" onclick="setActionValueForLikeorDislike(this)" value="disliker" type="submit" style="border: none; box-shadow: none"><span id="count_dislikes">{{ $article->dislike }} </span><i style="font-size: 13pt" class='bx bx-dislike text-danger'></i></button>
                            </div>
                        </form>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4 w-100"><img class="img-fluid rounded" style="height: 100%!important" src="/storage/{{ $bibliothequephoto[0] }}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5 p-2">
                        <p class="mb-4" style="text-align: justify">{{ $article->description }}</p>
                        
                        <h2 class="fw-bolder mb-4 mt-5">Related</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="owl-carousel portfolio-slider">
                                    @foreach($bibliothequephoto as $photo)
                                        <div class="single-pf shadow">
                                            <div class="d-block">
                                                <img class="shadow-sm" style="height: 100%!important" src="/storage/{{ $photo }}" alt="...">
                                                <div class="details">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if ($article->video)
                            <div class="col-lg-12 col-md-8 col-sm-12 p-0">
                                <video class="w-100" loop controls style="max-height: 500px">
                                <source src="/storage/{{ $article->video }}" type="video/mp4" />
                                </video>
                            </div>
                        @endif
                    </section>
                </article>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4 p-3">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">COMMENTAIRES</div>
                    <div class="card-body">
                        <section class="mb-5">
                            <div class="card bg-light">
                                <div class="card-body"  style="padding: 0px">
                                    <!-- Comment form-->
                                    <form class="mb-4 d-flex flex-row p-2 border-bottom" method="post" action="{{ route('public.save_commentaire_article', $article->id) }}">
                                        @csrf
                                        <input type="text" max="100" placeholder="commentaire" name="commentaire" class="form-control">
                                        <button type="submit" class="btn text-success" style="border: none; box-shadow: none">
                                            <span class="bi-send">
                                            </span>
                                        </button>
                                    </form>
                                    @foreach($article->commentaires as $commentaire)
                                        <div class="d-flex mb-4 scrollable-div">
                                            <!-- Parent comment-->
                                            <div class="flex-shrink-0" style="padding: 4px"><img style="width: 40px; height: 40px" class="rounded-circle" src="{{ asset('css/images/utilisateur.png') }}" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">Commentaire #{{ $loop->iteration }}</div>
                                                    <div style="margin-bottom: 1px">
                                                        {{ $commentaire->commentaire }}
                                                        <p style="margin-bottom: 0px">
                                                            <span class="bi-reply btn-reply-comment" id="{{ $commentaire->id }}" onclick="displayornotform_comment_child(this)">
                                                            </span>
                                                            @auth
                                                                @if (auth()->user()->id == $article->rapporteur_id)
                                                                    <form action="{{ route('public.supprimer_commentaire_article', $commentaire->id) }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"><span class="bi-trash text-danger"></span></button>
                                                                    </form>
                                                                @endif
                                                            @endauth
                                                            <span class="text-muted small">il y a {{ $commentaire->created_at->diffForHumans() }}</span>
                                                        </p>
                                                    </div>
                                                    <div id="form_comment_child_{{ $commentaire->id }}" style="display: none">
                                                        <form action="{{ route('public.save_commentairechild_article', $commentaire->id) }}" method="post" class="mb-4 d-flex flex-row p-2">
                                                            @csrf
                                                            <input type="text" max="100" placeholder="commentaire" name="commentaire" class="form-control">
                                                            <button type="submit" class="btn" style="border: none; box-shadow: none">
                                                                <span class="bi-send">
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @foreach($commentaire->commentairechildren as $commentairechild)
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-shrink-0" style="padding: 4px"><img style="width: 40px; height: 40px" class="rounded-circle" src="{{ asset('css/images/utilisateur.png') }}" alt="..." /></div>
                                                            <div class="ms-3">
                                                                <div class="fw-bold">Réponse #{{ $loop->iteration }}</div>
                                                                {{ $commentairechild->commentaire }}
                                                                <p>
                                                                    @auth
                                                                        @if (auth()->user()->id == $article->rapporteur_id)
                                                                            <form action="{{ route('public.supprimer_commentairechild_article', $commentairechild->id) }}">
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
    </script>
@endsection