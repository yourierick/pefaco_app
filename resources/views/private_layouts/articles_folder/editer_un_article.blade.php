@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Editer l'article")
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('article.save_edition_article', $article->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label style="color: #818183">Département</label>
                                <select name="departement_id" class="form-control p-2">
                                    @foreach($departements as $departement)
                                        <option value="{{ $departement->id }}" @if($article->departement_id === $departement->id) selected @endif>{{ $departement->designation }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">Date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ $article->date->format('Y-m-d') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ $article->titre }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_description" style="color: #818183">déscription</label>
                                <textarea class="form-control mb-4" type="text" name="description" id="id_description">{{ $article->description }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')"/>
                            </div>
                            <hr>
                            <p>Galerie photos</p>
                            <hr>
                            <div id="galerie_photo" style="width: 100%; height: 100%">
                                <div>
                                    @php
                                        $count = 0;
                                        $bibliotheques = json_decode($article->bibliotheque, true);
                                        foreach ($bibliotheques as $bibliotheque) {
                                            $count = $count + 1;
                                        }
                                    @endphp
                                    <label id="lbl_count" style="display: none">{{ $count }}</label>
                                    @if($bibliotheques)
                                        @foreach($bibliotheques as $bibliotheque)
                                            <div class="d-flex mb-2" id="div_{{ $loop->iteration }}" style="gap: 5px">
                                                <button type="button" onclick="deletephoto(this)" class="btn btn-danger" id="btn_remove_div_{{ $loop->iteration }}" style="height: 80%; color: white"><i class='bx bxs-trash'></i></button>
                                                <input name="bibliotheque[]" type="text" class="form-control mb-2" required style="width: 80%;" value="{{ $bibliotheque }}" readonly>
                                                <a href="{{ \Illuminate\Support\Facades\Storage::url($bibliotheque) }}">voir l'image</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary rounded mt-2" style="border: 1px solid" id="btn_add_photo"><i class='bx bx-plus-circle' > ajouter une photo</i></button>
                            <hr>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_video" style="color: #818183">vidéo déscriptive</label>
                                <input class="form-control" type="file" name="video" id="id_video">
                                @if($article->video)
                                    <div>
                                        <span>Actuellement: {{ $article->video }}</span>
                                        <div class="d-flex">
                                            <input type="checkbox" class="mr-2" name="delete_article" id="id_delete_article">
                                            <label for="id_delete_article" class="text-danger">Supprimer la vidéo</label>
                                        </div>
                                    </div>
                                @endif
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('video')"/>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2 text-light">Soumettre</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/articles_scripts/edit_article.js') }}"></script>
@endsection

