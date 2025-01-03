@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', "#Editer un enseignement")
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('enseignement.save_edition_enseignement', $enseignement->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ $enseignement->titre }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_reference" style="color: #818183">référence</label>
                                <input class="form-control" type="text" name="reference" id="id_reference" value="{{ $enseignement->reference }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('reference')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_enseignement" style="color: #818183">enseignement</label>
                                <textarea class="form-control mb-4" type="text" name="enseignement" id="id_enseignement">{{ $enseignement->enseignement }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('enseignement')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_photo" style="color: #818183">Photo Affiche</label>
                                <input class="form-control" accept=".jpeg, .jpg, .png, .jfif" type="file" onchange="validateImageFileType(this)" name="affiche_photo" id="id_photo">
                                @if($enseignement->affiche_photo)
                                    <div>
                                        <span>Actuellement: {{ $enseignement->affiche_photo }}</span>
                                        <div class="d-flex">
                                            <input type="checkbox" class="mr-2" name="delete_affiche_photo" id="id_delete_affiche_photo">
                                            <label for="id_delete_affiche_photo" class="text-danger">Supprimer la photo</label>
                                        </div>
                                    </div>
                                @endif
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('affiche_photo')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_audio" style="color: #818183">fichier audio</label>
                                <input class="form-control" type="file" onchange="validateAudioFileType(this)" name="audio" id="id_audio">
                                @if($enseignement->audio)
                                    <div>
                                        <span>Actuellement: {{ $enseignement->audio }}</span>
                                        <div class="d-flex">
                                            <input type="checkbox" class="mr-2" name="delete_audio" id="id_delete_audio">
                                            <label for="id_delete_audio" class="text-danger">Supprimer l'audio</label>
                                        </div>
                                    </div>
                                @endif
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('audio')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_video" style="color: #818183">fichier vidéo</label>
                                <input class="form-control" type="file" onchange="validateVideoFileType(this)" name="video" id="id_video">
                                @if($enseignement->video)
                                    <div>
                                        <span>Actuellement: {{ $enseignement->video }}</span>
                                        <div class="d-flex">
                                            <input type="checkbox" class="mr-2" name="delete_video" id="id_delete_video">
                                            <label for="id_delete_video" class="text-danger">Supprimer la vidéo</label>
                                        </div>
                                    </div>
                                @endif
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('video')"/>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/enseignements_folder/enseignement.js') }}"></script>
@endsection

