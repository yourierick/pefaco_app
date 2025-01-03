@extends('base_dashboard')
@section('style')
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .carousel__buttons {
            margin: 10px 0;
            display: flex;
            width: 80%;
        }

        .carousel__buttons .carousel-button:focus {
            background-color: rgb(154, 163, 247);
        }

        .carousel__buttons .carousel-button:hover {
            background-color: #ddd;
        }

        .carousel__buttons .carousel-button:not(:nth-last-child()) {
            margin-right: 10px;
        }

        .carousel__buttons .carousel-button {
            font-size: 1rem;
            margin-right: 10px;
            box-shadow: 0 4px 8px #eee;
            padding: 0.5rem 0.8rem;
            cursor: pointer;
            border: 1px solid #ddd;
            color: #454545;
            border-radius: 50%;
            height: 40px;
            width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            outline: none;
        }

        .carousel {
            width: 80%;
            border: 1px solid rgb(206, 206, 206);
            overflow: hidden;
            display: grid;
            border-radius: 5px;
            box-shadow: 0 4px 8px #eee;
            padding: 20px;
            grid-template-columns: repeat(6, 90%);
        }

        .carousel .carousel__item.active {
            transform: scale(1) translateX(-0%);
        }

        .carousel .carousel__item {
            width: 100%;
            transform: translateX(-0%) scale(0.9);
            border-radius: 5px;
            transition: all 0.7s ease;
            display: flex;

            background-color: rgb(240, 240, 240);
            text-transform: uppercase;
            justify-content: center;

            align-items: center;
            padding: 10px;
            height: 400px;
        }

        .bg-yellow.active {
            background: darkslategrey;
            color: white;
        }

        .bg-brown.active {
            background-color: rosybrown;
        }

        .bg-green.active {
            background-color: greenyellow;
        }

        .bg-blue.active {
            background-color: dodgerblue;
        }
    </style>
@endsection
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
        </header>
        <!-- Preview image figure-->
        <div class="row">
            <div class="col-xs-12 col-md-6">
                @if ($bibliothequephoto)
                <figure class="mb-4"><img class="img-fluid w-100" style="height: 300px"
                        src="/storage/{{ $bibliothequephoto[0] }}" alt="..." /></figure>
                @else
                <figure class="mb-4"><img class="img-fluid rounded" style="height: 300px" src="" alt="..." /></figure>
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
            <div class="carousel">
                @if ($article->video)
                    <div class="carousel__item active">
                        <video class="shadow-sm" loop controls style="max-height: 100%">
                            <source src="/storage/{{ $article->video }}" type="video/mp4" />
                        </video>
                    </div>
                @else
                    <div class="carousel__item active">
                        <img class="shadow-sm" style="max-height: 100%" src="/storage/{{ $bibliothequephoto[0] }}" alt="...">
                    </div>
                @endif
                @foreach ($bibliothequephoto as $photo)
                    <div class="carousel__item">
                        <img class="shadow-sm" style="max-height: 100%" src="/storage/{{ $photo }}" alt="...">
                    </div>
                @endforeach
            </div>
            <div class="carousel__buttons">
                <button type="button" class="carousel-button">&#10094;</button>
                <button type="button" class="carousel-button">&#10095;</button>
            </div>
        </div>
    @endif
    <hr>
</div>
@endsection
@section('scripts')
    <script>
        const carousel = document.querySelector(".carousel");
        let carouselItems = document.querySelectorAll(".carousel__item");
        const [btnLeftCarousel, btnRightCarousel] = document.querySelectorAll(
        ".carousel-button"
        );
        let carouselCount = carouselItems.length;
        let pos = 0;
        let translateX = 0;

        btnLeftCarousel.addEventListener("click", (e) => {
        let calculate = pos > 0 ? (pos - 1) % carouselCount : carouselCount;
        if (pos > 0) translateX = pos === 1 ? 0 : translateX - 100.5;
        else if (pos <= 0) {
            translateX = 100.5 * (carouselCount - 1);
            calculate = carouselCount - 1;
        }

        console.log(pos);

        pos = slide({
            show: calculate,
            disable: pos,
            translateX: translateX
        });
        });

        btnRightCarousel.addEventListener("click", (e) => {
        let calculate = (pos + 1) % carouselCount;
        if (pos >= carouselCount - 1) {
            calculate = 0;
            translateX = 0;
        } else {
            translateX += 100.5;
        }

        pos = slide({
            show: calculate,
            disable: pos,
            translateX: translateX
        });
        });

        function slide(options) {
        function active(_pos) {
            carouselItems[_pos].classList.toggle("active");
        }

        function inactive(_pos) {
            carouselItems[_pos].classList.toggle("active");
        }

        inactive(options.disable);
        active(options.show);

        document.querySelectorAll(".carousel__item").forEach((item, index) => {
            if (index === options.show) {
            item.style.transform = `translateX(-${options.translateX}%) scale(1)`;
            } else {
            item.style.transform = `translateX(-${options.translateX}%) scale(0.9)`;
            }
        });

        return options.show;
        }
    </script>
@endsection
