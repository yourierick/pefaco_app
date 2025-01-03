@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mb-3 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('annonce.save_annonce') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <h3>Nouvelle Annonce</h3>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">Date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ old('date') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ old('titre') }}" placeholder="titre">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>
                            
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_description" style="color: #818183">déscription</label>
                                <textarea class="form-control" name="description" placeholder="déscription" id="id_description">{{ old('description') }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')"/>
                            </div>
                            
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_photo" style="color: #818183">Photo déscriptive</label>
                                <input class="form-control" type="file" onchange="validateImageFileType(this)" name="photo_descriptive" id="id_photo">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo_descriptive')"/>
                            </div>
                            <hr class="w-100">
                            <button name="action" value="soumission" type="submit" class="btn btn-primary mt-2 text-light">Soumettre</button>
                            <button name="action" value="draft" type="submit" class="btn btn-secondary mt-2 ml-2 text-light">Enregistrer comme draft</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/annonces_scripts/annonce.js') }}"></script>
@endsection

