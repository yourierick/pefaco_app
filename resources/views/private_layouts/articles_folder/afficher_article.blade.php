@extends('base_dashboard')
@section('other_content')
    <div style="float:right; display: flex; gap: 2px">
        @if($article->statut === "draft")
            <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
            <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="soumission" class="btn app-btn-secondary mb-2"><span>soumettre</span></button>
            </form>
        @endif
        @if($article->statut === "en attente de validation")
            @if($autorisation->autorisation_en_ecriture)
                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
                    </div>
                @endif
            @endif
            <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
                @csrf
                @method('put')
                <button type="submit" name="action" value="validation" class="btn app-btn-secondary mb-2"><span>valider</span></button>
            </form>
        @endif
        @if($article->statut === "validé")
            @if($autorisation->autorisation_en_ecriture)
                @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
                    <div style="float:right">
                        <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span style="color: white">modifier</span></a>
                    </div>
                @endif
            @endif
            @if($autorisation_speciale)
                @if($autorisation_speciale->autorisation_speciale)
                    @if(in_array("peux changer l'audience", json_decode($autorisation_speciale->autorisation_speciale, true)))
                        @if ($article->audience === "privé")
                            <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="publication" class="btn app-btn-secondary mb-2"><span>publier</span></button>
                            </form>
                        @endif
                        @if($article->audience === "public")
                            <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" name="action" value="prive" class="btn btn-danger text-light mb-2"><span class="text-light">privé</span></button>
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
@section('content')
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
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" style="height: 300px" src="/storage/{{ $bibliothequephoto[0] }}" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5 p-2">
                        <h2 class="fw-bolder mb-4 mt-5">Related</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="owl-carousel portfolio-slider">
                                    @foreach($bibliothequephoto as $photo)
                                        <div class="single-pf shadow">
                                            <div class="d-block">
                                                <img class="shadow-sm" src="/storage/{{ $photo }}" alt="...">
                                                <div class="details">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($bibliothequephoto as $photo)
                                    <div class="single-pf shadow">
                                        <div class="d-block">
                                            <img class="shadow-sm" src="/storage/{{ $photo }}" alt="...">
                                            <div class="details">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($bibliothequephoto as $photo)
                                <div class="single-pf shadow">
                                    <div class="d-block">
                                        <img class="shadow-sm" src="/storage/{{ $photo }}" alt="...">
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
                    <div class="card-header">COMMENTAIRE</div>
                    <div class="card-body">
                        <section class="mb-5">
                            <div class="card bg-light">
                                <div class="card-body"  style="padding: 0px">
                                    <p class="mb-4" style="text-align: justify">{{ $article->description }}</p>
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
@endsection


