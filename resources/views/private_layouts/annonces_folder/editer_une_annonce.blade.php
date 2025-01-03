@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('annonce.save_edition_annonce', $annonce->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <h3>Editer l'Annonce</h3>
                            
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date" style="color: #818183">Date</label>
                                <input class="form-control" type="date" name="date" id="id_date" value="{{ $annonce->date->format('Y-m-d') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                            </div>
                                
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_titre" style="color: #818183">titre</label>
                                <input class="form-control" type="text" name="titre" id="id_titre" value="{{ $annonce->titre }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('titre')"/>
                            </div>

                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_description" style="color: #818183">déscription</label>
                                <textarea class="form-control mb-4" type="text" name="description" id="id_description">{{ $annonce->description }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')"/>
                            </div>
                            <hr>

                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_photo" style="color: #818183">photo déscriptive</label>
                                <input class="form-control" type="file" value="{{ $annonce->photo_descriptive }}" name="photo_descriptive" id="id_photo">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo_descriptive')"/>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-2 text-light">Enregistrer</button>
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

