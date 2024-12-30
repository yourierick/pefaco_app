@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Article de rapportage')
@section('style')
    <style>
        .orange-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50%;
            height: 40px;
            background-color: rgb(145, 145, 145);
            transform: translateY(-50%);
        }
    </style>
    <link rel="stylesheet" href="{{ asset("assets/css/affichage_rapport_event.css") }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
@endsection
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
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <h5 class="text-primary" style="font-weight: bold; margin: 0"> Eglise pefaco universelle|  <span style="color: gray; font-size: 11pt">{{ $article->titre }} du {{ $article->date->format('d/m/Y') }}</h5>
                    <p style="margin: 0">Département: {{ $article->departement->designation }}</p>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row mt-5">
                    <div class="col-12 col-md-2">
                        <div class="mt-4">
                            <img src="/storage/{{ $article->rapporteur_user->photo }}" class="img-fluid" alt="" style="box-shadow: 4px 0 0 rgb(134, 134, 134); padding-right: 0px; max-height: 160px; max-width: 150px">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 p-4" style="align-content: center">
                        <div style="margin-top: 30px">
                            <p style="font-size: 12pt; margin: 0">Editeur</p>
                            <hr style="background-color: rgb(40, 41, 44); height: 4px; margin: 0">
                            <p class="text-primary" style="font-size: 14pt"> {{ $article->rapporteur }}</p>
                            <p>Date de rapportage: {{ $article->date->format("d-m-Y") }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 position-relative d-none d-md-block">
                        <div class="orange-line"></div>
                    </div>
                </div>
                <hr>
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <h3 class="ml-3 text-muted" style="text-transform: capitalize; font-weight: normal">{{ $article->titre }} du: {{ $article->date->format("d-m-Y") }}</h3>
                                        <div class="p-4">
                                            @php
                                                $bibliotheque = json_decode($article->bibliotheque, true);
                                                $firstelement = isset($bibliotheque[0]) ? $bibliotheque[0]: '#';
                                            @endphp
                                            <div class="row mt-4 mb-3">
                                                <div class="col-md-6 col-sm-12 pr-1">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($firstelement) }}" alt="#" style="max-height: 500px; width: 100%">
                                                </div>
                                                <div class="col-md-6 col-sm-12 pl-1">
                                                    <p style="color: darkgray; text-align: justify">{{ $article->description }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5 class="mb-2">Related</h5>
                                            <div>
                                                @php
                                                    $bibliotheques = json_decode($article->bibliotheque, true);
                                                @endphp
                                                <div class="row mt-3 p-2 shadow">
                                                    @foreach($bibliotheques as $bibliotheque)
                                                        <div class="col-2">    
                                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($bibliotheque) }}" alt="#" style="max-height: 100px; min-width: 100%">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @if($article->video)
                                            <hr>
                                            <h3 class="ml-3">Related Video</h3>
                                            <div class="p-3">
                                                <video controls height="300px" width="100%">
                                                    <video src="" controls></video>
                                                        <source src="{{ \Illuminate\Support\Facades\Storage::url($article->video) }}" type="video/mp4">
                                                        Votre navigateur ne supporte pas la balise vidéo.
                                                </video>
                                            </div>
                                        @endif
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                                <p style="font-style: italic">Signé par {{ $article->rapporteur }}</p>
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://kit.fontawesome.com/48764efa36.js" crossorigin="anonymous"></script>
@endsection

