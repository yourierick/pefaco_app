<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <style>
        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 8px;
        }
        #form_display {
            display: flex;
            flex-direction: column;
            width: 500px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;

        }
        p, button{
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div id="form_display">
        <img class="logo-icon me-2" style="width: 130px; height: 80px" src="{{ asset('css/images/logo.jpg') }}" alt="logo">
        <hr style="border: 2px solid #095ba9; width: 100%">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('email')" />
                <input id="email" class="block mt-1 w-full form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('nouveau mot de passe')" />
                <input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('confirmer le mot de passe')" />
                <input id="password_confirmation" class="block mt-1 w-full form-control"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    {{ __('Réinitialiser le mot de passe') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>


