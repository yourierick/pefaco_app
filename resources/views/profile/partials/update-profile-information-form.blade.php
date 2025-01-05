<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Information de profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettre à jour les informations de votre profile") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <img id="imagePreview" src="@if($user->photo) {{ $user->imageUrl() }} @else {{ asset('css/images/businessman.png') }}  @endif" alt=""
                 style="width: 100px; height: 100px; border-radius: 50px" class="mb-2">
        </div>
        <div class="mb-3">
            <input id="id_photo" name="photo" value="{{ $user->photo }}" type="file" class="form-control"/>
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>

        <div class="mb-3">
            <x-input-label for="nom" :value="__('nom')" />
            <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full form-control" :value="old('nom', $user->nom)" required autofocus autocomplete="nom" />
            <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')" />
        </div>
        <div class="mb-3">
            <x-input-label for="postnom" :value="__('postnom')" />
            <x-text-input id="postnom" name="postnom" type="text" class="mt-1 block w-full form-control" :value="old('postnom', $user->postnom)" required autocomplete="postnom" />
            <x-input-error class="mt-2 text-danger" :messages="$errors->get('postnom')" />
        </div>
        <div class="mb-3">
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full form-control" :value="old('prenom', $user->prenom)" required autocomplete="prenom" />
        </div>
        <div class="mb-3">
            <x-input-label for="id_sexe" :value="__('sexe')"/>
            <select id="id_sexe" name="sexe" class="form-control" required>
                <option value=""></option>
                <option @if( old('sexe', $user->sexe) === "Homme" ) selected @endif value="Homme">Homme</option>
                <option @if( old('sexe', $user->sexe) === "Femme" ) selected @endif value="Femme">Femme</option>
            </select>
            <x-input-error :messages="$errors->get('sexe')" class="mt-2 text-danger"/>
        </div>
        <div class="mb-3">
            <x-input-label for="id_lieu" :value="__('lieu de naissance')"/>
            <x-text-input id="id_lieu" class="block mt-1 w-full form-control" type="text" name="lieu_de_naissance"
                          :value="old('lieu_de_naissance', $user->lieu_de_naissance)" placeholder="lieu de naissance"
                          autocomplete="lieu de naissance"/>
        </div>

        <div class="mb-3">
            <label for="id_date">date de naissance</label>
            <input id="id_date" name="date_de_naissance" value="{{ old('date_de_naissance', $user->date_de_naissance) }}" type="date"
                   class="form-control"/>
        </div>

        <div class="mb-3">
            <label class="sr-only-focusable" for="id_adresse">Adresse</label>
            <input id="id_adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}" type="text"
                   class="form-control" placeholder="Adresse de résidence permanente"/>
        </div>

        <div class="mb-3">
            <label for="id_telephone">Téléphone</label>
            <input id="id_telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" type="number"
                   class="form-control" placeholder="Numéro de téléphone"/>
            <x-input-error :messages="$errors->get('telephone')" class="mt-2 text-danger"/>
        </div>

        <div class="mb-3">
            <label for="id_etat_civil">Etat civil</label>
            <select id="id_etat_civil" name="etat_civil" class="form-control">
                <option value=""></option>
                <option @if( old('etat_civil', $user->etat_civil) === "Célibataire" ) selected @endif value="Célibataire">Célibataire</option>
                <option @if( old('etat_civil', $user->etat_civil) === "Marié(e)" ) selected @endif value="Marié(e)">Marié(e)</option>
                <option @if( old('etat_civil', $user->etat_civil) === "Séparé(e)" ) selected @endif value="Séparé(e)">Séparé(e)</option>
                <option @if( old('etat_civil', $user->etat_civil) === "Divorcé(e)" ) selected @endif value="Divorcé(e)">Divorcé(e)</option>
                <option @if( old('etat_civil', $user->etat_civil) === "Veuf(ve)" ) selected @endif value="Veuf(ve)">Veuf(ve)</option>
            </select>
            <x-input-error class="mt-2 text-danger" :messages="$errors->get('etat_civil')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full form-control" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <hr>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- Style --}}
<style>
    button[type=submit] {
        transition: .10s;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, 0.12);
        padding: 14px;
        background-color: #2450a2;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 14px;
        color: #fafafa;
    }

    button[type=submit]:hover {
        border-color: transparent;
        background-color: #1f4793;
        color: #fafafa;
    }
</style>
