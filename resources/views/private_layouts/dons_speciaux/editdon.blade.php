@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Editer un don')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('don.save_edition_don', $don->id) }}" class="mt-6 space-y-6" >
                            @csrf
                            @method('put')
                            <div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date">Date</label>
                                    <input id="id_date" type="date" value="{{ $don->date->format('Y-m-d') }}" name="date" class="form-control mb-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">  
                                    <label class="text-primary">Donateur</label>
                                    <input name="donateur" value="{{ $don->donateur}}" class="form-control" type="text">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('donateur')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">    
                                    <label class="text-primary">Don</label>
                                    <input name="don" value="{{ $don->don}}" class="form-control mt-2" type="text">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('don')"/>
                                </div>
                                <button class="btn btn-primary mt-2 text-light">Soumettre</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

