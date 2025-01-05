@extends('base_dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/add_article.css') }}">
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" id="my_form" action="{{ route('article.save_edition_article', $article->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label>Galerie photos (Vous pouvez ajouter jusqu'à 10 photos de 2Mo)</label>
                                <input class="form-control" onchange="validateImageFileType(this)" type="file" name="galerie[]" id="id_galerie" accept=".jpg, .jpeg, .png, .jfif" value="{{ old('galerie') }}" multiple>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('galerie')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_video" style="color: #818183">vidéo déscriptive</label>
                                <input class="form-control" type="file" onchange="validateVideoFileType(this)" name="video" id="id_video">
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
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_link" style="color: #818183">Ajouter un lien youtube</label>
                                <textarea class="form-control mb-4" type="text" name="link_youtube"
                                    id="id_link">{{ old('link_youtube', $article->lien_acces_youtube) }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('link_youtube')" />
                            </div>
                            <div id="progress-container" class="text-center" style="display: none; align-items:center; justify-content:center; align-content:center">
                                <div role="progressbar" class="text-center" id="progress-bar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="--value:  0"></div>
                            </div>
                            <hr>
                            <button type="button" onclick="axiosprogressbar()" class="btn btn-primary mt-2 text-light">Enregistrer</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/articles_scripts/article.js') }}"></script>
    <script>
        function axiosprogressbar() {
            let form = document.getElementById('my_form');
            let formData = new FormData(form);
            let progressBar = document.getElementById('progress-bar');
            let progressContainer = document.getElementById('progress-container');

            progressContainer.style.display = "flex";
            axios.post('/article/save_edition_article/'+ {{ $article->id }}, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    if (progressEvent.lengthComputable) {
                        const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        progressBar.style.setProperty('--value', percentCompleted);
                        if (percentCompleted == 100) {
                            progressContainer.style.display = "none";
                        }
                    }
                },
            }).then(response => {
                $.notify({
                    icon: 'bi-bell',
                    title: 'Pefaco APP',
                    message: "enregistré",
                }, {
                    type: 'primary',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });

                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                }
            }).catch(error => {
                $.notify({
                    icon: 'bi-bell',
                    title: 'Pefaco APP',
                    message: error,
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
            })
        }
    </script>
@endsection

