<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('private_layouts.login');
    }
    public function module_connexion(AuthRequest $request)
    {
        $credentials = $request->only(['email','password']);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if ($user->statut){
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }else{
                return to_route('login')->with('error_msg', "Ce compte est désactivé")->onlyInput('email');
            }
        }else{
            return to_route('login')->with('error_msg', "email ou mot de passe incorrect")->onlyInput('email');
        }
    }
    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
    }
}
