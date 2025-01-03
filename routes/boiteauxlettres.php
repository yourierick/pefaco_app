<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoiteAuxLettresController;

Route::middleware('auth')->name('boite.')->group(function () {
    Route::get('/boiteauxlettres/list', [BoiteAuxLettresController::class,
        'list_des_lettres'])->name('list_des_lettres');
    Route::delete('/boiteauxlettres/supprimer_message', [BoiteAuxLettresController::class,
        'supprimer_message'])->name('supprimer_message');
    Route::post('boiteauxlettres/reply_letter', [BoiteAuxLettresController::class, 'repondre_message'])->name('reply_letter');
});

