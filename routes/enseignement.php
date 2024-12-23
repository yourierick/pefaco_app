<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnseignementController;

Route::middleware('auth')->name('enseignement.')->group(function () {
    Route::get('/enseignement/list', [EnseignementController::class,
        'list_des_enseignements'])->name('list_des_enseignements');
    Route::get('/enseignement/nouvel_enseignement', [EnseignementController::class,
        'nouvel_enseignement'])->name('nouvel_enseignement');
    Route::get('/enseignement/voir_mes_drafts_enseignement', [EnseignementController::class,
        'voir_mes_drafts_enseignement'])->name('voir_mes_drafts_enseignement');
    Route::get('/enseignement/voir_les_attentes_en_validation', [EnseignementController::class,
        'voir_les_attentes_en_validation'])->name('voir_les_attentes_en_validation');
    Route::post('enseignement/save_enseignement', [EnseignementController::class,
        'save_enseignement'])->name('save_enseignement');
    Route::get('/enseignement/afficher_un_enseignement/{enseignement_id}', [EnseignementController::class,
        'afficher_un_enseignement'])->name('afficher_un_enseignement');
    Route::delete('/enseignement/supprimer_un_enseignement', [EnseignementController::class,
        'supprimer_un_enseignement'])->name('supprimer_un_enseignement');
    Route::put('/enseignement/traitement_enseignement/{enseignement_id}', [EnseignementController::class,
        'traitement_enseignement'])->name('traitement_enseignement');
    Route::get('/enseignement/edit_un_enseignement/{enseignement_id}', [EnseignementController::class,
        'edit_un_enseignement'])->name('edit_un_enseignement');
    Route::put('/enseignement/save_edition_enseignement/{enseignement_id}', [EnseignementController::class,
        'save_edition_enseignement'])->name('save_edition_enseignement');
});

