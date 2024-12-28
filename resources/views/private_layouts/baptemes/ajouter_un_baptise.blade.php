@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('baptemes.save_baptise') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            <h3 class="mb-3">Nouveau Baptisé</h4>
                            <div>
                                <img id="imagePreview"
                                    src="{{ asset('css/images/utilisateur.png') }}"
                                    alt="img"
                                    style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
                            </div>
                            <div class="mb-3">
                                <input id="id_photo" name="photo" type="file"
                                        class="form-control"/>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('photo')"/>
                            </div>
                            
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom" style="color: #818183">Nom</label>
                                <input class="form-control" type="text" name="nom" id="id_nom" value="{{ old('nom') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_sexe" style="color: #818183">Sexe</label>
                                <select name="sexe" id="id_sexe" class="form-control">
                                    <option value="homme">homme</option>
                                    <option value="femme">femme</option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('sexe')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_adresse_de_residence" style="color: #818183">Adresse de résidence</label>
                                <input class="form-control" type="text" name="adresse_de_residence" id="id_adresse_de_residence" value="{{ old('adresse_de_residence') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse_de_residence')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_naissance" style="color: #818183">Date de naissance</label>
                                <input class="form-control" type="date" name="date_de_naissance" id="id_date_de_naissance" value="{{ old('date_de_naissance') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_naissance')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_date_de_bapteme" style="color: #818183">Date de baptême</label>
                                <input class="form-control" type="date" name="date_de_bapteme" id="id_date_de_bapteme" value="{{ old('date_de_bapteme') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_bapteme')"/>
                            </div>
                            <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                <label for="id_nom_de_bapteme" style="color: #818183">Nom de baptême</label>
                                <input class="form-control" type="text" name="nom_de_bapteme" id="id_nom_de_bapteme" value="{{ old('nom_de_bapteme') }}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom_de_bapteme')"/>
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
    <script>
        function previewImage() {
            const fileInput = document.getElementById('id_photo');
            const imagePreview = document.getElementById('imagePreview');

            const file = fileInput.files[0];
            if (file) {
                const imageUrl = URL.createObjectURL(file);

                // Créez un élément <img> pour afficher la prévisualisation
                imagePreview.src = imageUrl;
            }
        }

        var fileInput = document.getElementById('id_photo');
        fileInput.addEventListener("change", previewImage);
    </script>
@endsection

