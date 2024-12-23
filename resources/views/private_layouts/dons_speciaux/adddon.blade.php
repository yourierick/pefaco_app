@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Etablir une dépense')
@section('content')
    <div class="py-12 mt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('don.save_new_don') }}" class="mt-6 space-y-6" >
                            @csrf
                            <div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date">Date</label>
                                    <input id="id_date" type="date" value="{{ old('date') }}" name="date" class="form-control mb-2">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Donateur</label>
                                    <input name="donateur" placeholder="donateur" value="{{ old('donateur') }}" type="text" class="form-control">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('donateur')"/>
                                </div>
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label class="text-secondary">Don</label>
                                    <input name="don" placeholder="don" value="{{ old('don') }}" class="form-control mt-2" type="text">
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
@section('scripts')
    <script src="{{ asset('assets/js/depense_scripts/depense.js') }}"></script>
@endsection

