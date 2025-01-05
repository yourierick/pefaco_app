@extends('base_dashboard')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css">
<link rel="stylesheet" href="{{ asset('assets/css/add_enseignement.css') }}">
@endsection
@section('content')
<div class="py-12 mt-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
            <div class="max-w-xl">
                <section>
                    <form method="post" id="my_form" action="{{ route('enseignement.save_enseignement') }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <h3>Nouvel Enseignement</h3>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="id_titre" style="color: #818183">titre</label>
                            <input class="form-control" type="text" name="titre" id="id_titre"
                                value="{{ old('titre') }}" placeholder="titre">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')" />
                        </div>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="id_reference" style="color: #818183">référence</label>
                            <input class="form-control" type="text" name="reference" id="id_reference"
                                value="{{ old('reference') }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('reference')" />
                        </div><br>
                        <label for="editor" style="color: #818183">Enseignement (ou synthèse de la prédication)</label>
                        <div id="editor">

                        </div>
                        <textarea id="enseignement" style="visibility: hidden" name="enseignement"></textarea>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('enseignement')" />
                        <br>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="id_photo" style="color: #818183">Photo Affiche</label>
                            <input class="form-control" required accept=".jpeg, .jpg, .png, .jfif" type="file"
                                onchange="validateImageFileType(this)" name="affiche_photo" id="id_photo">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('affiche_photo')" />
                        </div>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="id_audio" style="color: #818183">fichier audio</label>
                            <input class="form-control" accept=".mp3" type="file" onchange="validateAudioFileType(this)"
                                name="audio" id="id_audio">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('audio')" />
                        </div>
                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                            <label for="id_link" style="color: #818183">Ajouter un lien youtube</label>
                            <textarea class="form-control mb-4" type="text" name="link_youtube"
                                id="id_link">{{ old('link_youtube') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('link_youtube')" />
                        </div>
                        <div id="progress-container" class="text-center" style="display: none; align-items:center; justify-content:center; align-content:center">
                            <div role="progressbar" class="text-center" id="progress-bar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="--value:  0"></div>
                        </div>
                        <hr class="w-100">
                        <input type="hidden" name="action" id="id_action">
                        <button value="soumission" type="button" onclick="axiosprogressbar(this)"
                            class="btn btn-primary mt-2 text-light">Soumettre</button>
                        <button value="draft" type="button" onclick="axiosprogressbar(this)"
                            class="btn btn-primary mt-2 ml-2 text-light">Enregistrer comme draft</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/enseignements_scripts/enseignement.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    function axiosprogressbar(element) {
        var content = quill.root.innerHTML;
        document.querySelector('#enseignement').value = content;
        document.getElementById('id_action').value = element.value;
        let form = document.getElementById('my_form');
        let formData = new FormData(form);
        let progressBar = document.getElementById('progress-bar');
        let progressContainer = document.getElementById('progress-container');

        progressContainer.style.display = "flex";
        axios.post('/enseignement/save_enseignement', formData, {
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
