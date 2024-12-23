<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoraireHebdoController;

Route::middleware('auth')->name('horairehebdo.')->group(function () {
    Route::get('/horairehebdo/list', [HoraireHebdoController::class,
        'list_des_horaires'])->name('list_des_horaires');
    Route::post('horairehebdo/save_horaire', [HoraireHebdoController::class,
        'save_horaire'])->name('save_horaire');
    Route::get('/horairehebdo/afficher_un_horaire/{horaire_id}', [HoraireHebdoController::class,
        'afficher_un_horaire'])->name('afficher_un_horaire');
    Route::get('/horairehebdo/programmer/{horaire_id}', [HoraireHebdoController::class,
        'programmer'])->name('programmer');
    Route::post('horairehebdo/save_programmation/{horaire_id}', [HoraireHebdoController::class,
        'save_programmation'])->name('save_programmation');
    Route::delete('/horairehebdo/supprimer_un_horaire', [HoraireHebdoController::class,
        'supprimer_un_horaire'])->name('supprimer_un_horaire');
    Route::put('/horairehebdo/save_edition_horaire/{horaire_id}', [HoraireHebdoController::class,
        'save_edition_horaire'])->name('save_edition_horaire');
    Route::get('/horairehebdo/editer_programme/{horaire_id}', [HoraireHebdoController::class,
        'editer_programme'])->name('editer_programme');
    Route::put('/horairehebdo/save_edition_programme/{horaire_id}', [HoraireHebdoController::class,
        'save_edition_programme'])->name('save_edition_programme');
});

