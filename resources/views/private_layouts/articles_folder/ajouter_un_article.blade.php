@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('article.save_article') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">Département</label>
                                <select name="departement_id" class="form-control">
                                    @foreach($departements as $departement)
                                        <option value="{{ $departement->id }}" @if(old('departement_id') === $departement->id) selected @endif>{{ $departement->designation }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">Date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ old('date') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ old('titre') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_description" style="color: #818183">déscription</label>
                                <textarea class="form-control" name="description" id="id_description">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')"/>
                            </div>
                            <hr class="w-100">
                            <p>Galerie photos</p>
                            <div class="p-2" id="bibliotheque">

                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('bibliotheque')"/>
                            <button type="button" class="btn btn-outline-secondary rounded mt-2" style="border: 1px solid" id="btn_add_bibliotheque"><i class='bx bx-plus-circle' > ajouter une photo à la galerie</i></button>
                            <hr class="w-100">
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_video" style="color: #818183">vidéo déscriptive</label>
                                <input class="form-control" type="file" onchange="avalidateVideoFileType(this)" name="video" id="id_video">
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
    <script src="{{ asset('assets/js/articles_scripts/article.js') }}"></script>
@endsection

