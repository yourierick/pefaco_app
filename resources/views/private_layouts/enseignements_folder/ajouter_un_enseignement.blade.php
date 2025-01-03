@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('enseignement.save_enseignement') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <h3>Nouvel Enseignement</h3>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ old('titre') }}" placeholder="titre">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_reference" style="color: #818183">référence</label>
                                <input class="form-control" type="text" name="reference" id="id_reference" value="{{ old('reference') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('reference')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_enseignement" style="color: #818183">enseignement</label>
                                <textarea class="form-control" name="enseignement" placeholder="enseignement" id="id_enseignement">{{ old('enseignement') }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('enseignement')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_photo" style="color: #818183">Photo Affiche</label>
                                <input class="form-control" required accept=".jpeg, .jpg, .png, .jfif" type="file" onchange="validateImageFileType(this)" name="affiche_photo" id="id_photo">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('affiche_photo')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_audio" style="color: #818183">fichier audio</label>
                                <input class="form-control" accept=".mp3" type="file" onchange="validateAudioFileType(this)" name="audio" id="id_audio">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('audio')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_video" style="color: #818183">fichier vidéo</label>
                                <input class="form-control" type="file" accept=".mp4" onchange="validateVideoFileType(this)" name="video" id="id_video">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('video')"/>
                            </div>
                            <hr class="w-100">
                            <button name="action" value="soumission" type="submit" class="btn btn-primary mt-2 text-light">Soumettre</button>
                            <button name="action" value="draft" type="submit" class="btn btn-primary mt-2 ml-2 text-light">Enregistrer comme draft</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/enseignements_scripts/enseignement.js') }}"></script>
@endsection

