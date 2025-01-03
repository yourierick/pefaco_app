<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Connexion</title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
        <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
        <link rel="shortcut icon" href="favicon.ico">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- FontAwesome JS-->
        <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>

        <!-- App CSS -->
        <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">

        <link rel="stylesheet" href="{{ asset('login_css/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">

        <link rel="stylesheet" href="{{ asset('login_css/css/style.css') }}">

    </head>

    <body class="app app-login p-0">
        <div class="wrapper shadow" style="background-image: url('{{ asset('login_css/images/bg-registration-form-2.jpg') }}');">
            <div class="inner">
                <form action="{{ route('login') }}" method="post">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="{{ route('home') }}"><img class="logo-icon me-2" style="width: 130px; height: 80px" src="/storage/{{ $parametre_logo }}" alt="logo"></a></div>
                    <h3 class="auth-heading text-center mb-5">Connectez vous à votre compte</h3>
                    <div class="form-wrapper">
                        @csrf
                        @if (Session::get('error_msg'))
                            <p class="small text-danger">{{ Session::get('error_msg') }}</p>
                        @endif
                        <label for="">Email</label>
                        <x-text-input type="text" class="form-control" id="email" type="email" name="email" :value="old('email')"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-wrapper">
                        <label for="">Mot de passe</label>
                        <x-text-input type="password" class="form-control" name="password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
                    </div>
                    <div class="checkbox row">
                        <div class="col-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">Se souvenir de moi!
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="forgot-password text-end">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="color: grey">Mot de passe oublié ?</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button>Connexion</button>
                </form>
            </div>
        </div>
    </body>
</html>

