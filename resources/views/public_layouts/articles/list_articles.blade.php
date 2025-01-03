@extends('base_public_second')
@section('style')
@endsection
@section('container')
<br>
<h3 class="mt-5 ml-5">Articles</h5>
<hr>
<div class="articles p-3">
    @foreach($articles as $article)
        <article>
            <div class="article-wrapper">
                <figure>
                    @php
                        $bibliotheque = json_decode($article->bibliotheque);
                    @endphp
                    <img src="/storage/{{ $bibliotheque[0] }}" alt="" />
                </figure>
                <div class="article-body">
                    <h2>{{ $article->titre }}</h2>
                    <p class="mb-2" style="text-align: justify">
                        {{ Str::limit($article->description, 200) }}
                    </p>
                    <span class="mb-2" style="font-style: italic; color: black">{{ $article->created_at->diffForHumans() }}</span><br>
                    <a href="{{ route('public.afficher_article', $article->id) }}" class="read-more">
                    En savoir plus <span class="sr-only">à propos de cet article</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    </a>
                </div>
            </div>
        </article>
    @endforeach
</div>
<section class="services section mt-2 p-3" id="section_apropos">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    @if($articles)
                        @if(!$articles->isEmpty())
                            <div>
                                {{ $articles->links('pagination') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection