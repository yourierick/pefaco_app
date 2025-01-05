@extends('base_dashboard')
@section('other_content')
<div class="mt-3" style="float:right; display: flex; gap: 2px">
    @if($article->statut === "draft")
    <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span
            style="color: white">modifier</span></a>
    <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
        @csrf
        @method('put')
        <button type="submit" name="action" value="soumission"
            class="btn app-btn-secondary mb-2"><span>soumettre</span></button>
    </form>
    @endif
    @if($article->statut === "en attente de validation")
    @if($autorisation->autorisation_en_ecriture)
    @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
    <div style="float:right">
        <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span
                style="color: white">modifier</span></a>
    </div>
    @endif
    @endif
    <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
        @csrf
        @method('put')
        <button type="submit" name="action" value="validation"
            class="btn app-btn-secondary mb-2"><span>valider</span></button>
    </form>
    @endif
    @if($article->statut === "validé")
    @if($autorisation->autorisation_en_ecriture)
    @if(in_array('peux modifier', json_decode($autorisation->autorisation_en_ecriture, true)))
    <div style="float:right">
        <a href="{{ route('article.edit_article', $article->id) }}" class="btn btn-primary mb-2"><span
                style="color: white">modifier</span></a>
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
        <button type="submit" name="action" value="publication"
            class="btn app-btn-secondary mb-2"><span>publier</span></button>
    </form>
    @endif
    @if($article->audience === "public")
    <form method="post" action="{{ route('article.traitement_article', $article->id) }}">
        @csrf
        @method('put')
        <button type="submit" name="action" value="prive" class="btn btn-danger text-light mb-2"><span
                class="text-light">dépublier</span></button>
    </form>
    @endif
    @endif
    @endif
    @endif
    @endif
</div>
@endsection
@section('content')
<div class="mt-5 p-2">
    <hr>
    <article>
        <!-- Post header-->
        <header class="mb-4 p-2">
            <!-- Post title-->
            <h1 class="fw-bolder mb-1">{{ $article->titre }}</h1>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2">Publié le {{ $article->date->format("d/m/Y") }}, par {{
                $article->rapporteur_user->nom }} {{ $article->rapporteur_user->postnom }} {{
                $article->rapporteur_user->prenom }}</div>
            @if ($article->lien_acces_youtube)
                <a id="youtube" href="{{ $article->lien_acces_youtube }}" target="_blank">
                    <span class="bi-youtube text-danger fs-1 bx-flashing"></span>
                </a>
            @endif
        </header>
        <!-- Preview image figure-->
        <div class="row">
            <div class="col-xs-12 col-md-6 p-3">
                @if ($bibliothequephoto)
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="/storage/{{ $bibliothequephoto[0] }}" style="max-height: 400px" alt="...">
                            </div>
                            @foreach ($bibliothequephoto as $photo)
                                <div class="carousel-item">
                                    <img src="/storage/{{ $photo }}" class="d-block w-100" style="max-height: 400px" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="col-xs-12 col-md-6">
                <!-- Post content-->
                <section class="mb-5 p-2">
                    <p class="mb-4" style="text-align: justify">{{ $article->description }}</p>
                </section>
            </div>
        </div>
    </article>
    <hr>
    <h2 class="fw-bolder mt-5">Related</h2>
    <span class="fst-italic">Bibliothèque médias</span>
    @if($bibliothequephoto)
        <div class="container mt-5">
            <video class="d-block w-100" loop controls style="max-height: 300px">
                <source src="/storage/{{ $article->video }}" type="video/mp4" />
                Votre navigateur ne peut pas lire cette vidéo.
            </video>
        </div>
    @endif
</div>
@endsection
