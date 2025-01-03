<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ConfigurationGenerale;

class Parametres
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $devise = Cache::remember('parametre_devise', 60, function () {
            return ConfigurationGenerale::first()->devise ?? 'FC';
        });
        $pourcentage_eglise = Cache::remember('parametre_pourcentage', 60, function () {
            return ConfigurationGenerale::first()->pourcentage_eglise ?? 0;
        });
        $logo = Cache::remember('parametre_logo', 60, function () {
            return ConfigurationGenerale::first()->logo ?? "";
        });

        View::share('parametre_devise', $devise);
        View::share('parametre_pourcentage', $pourcentage_eglise);
        View::share('parametre_logo', $logo);

        $request->attributes->set('parametre_devise', $devise);
        $request->attributes->set('parametre_pourcentage', $pourcentage_eglise);
        $request->attributes->set('parametre_logo', $logo);
        return $next($request);
    }
}
