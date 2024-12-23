<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotisationsController;

Route::middleware('auth')->name('cotisation.')->group(function () {
    Route::get('/cotisation/list', [CotisationsController::class, 'liste_des_cotisations'])->name('list');
    Route::get('/cotisation/add_new_cotisation', [CotisationsController::class, 'add_new_cotisation'])->name('ajouter');
    Route::post('/cotisation/save', [CotisationsController::class, 'save_new_cotisation'])->name('save_new_cotisation');
    Route::get('/cotisation/edit_cotisation/{cotisation_id}', [CotisationsController::class, 'edit_cotisation'])->name('edit_cotisation');
    Route::post('/cotisation/save_edition_cotisation/{cotisation_id}', [CotisationsController::class, 'save_edition_cotisation'])->name('save_edition_cotisation');
    Route::get('/cotisation/afficher/{cotisation_id}', [CotisationsController::class, 'afficher_la_cotisation'])->name('afficher');
    Route::put('/cotisation/mettre_en_attente/{cotisation_id}', [CotisationsController::class, 'mettre_en_attente'])->name('mettre_en_attente');
    Route::delete('/cotisation/supprimer', [CotisationsController::class, 'supprimer_cotisation'])->name('supprimer_cotisation');
    Route::delete('/cotisation/annuler/{cotisation_id}', [CotisationsController::class, 'annuler_cotisation_account'])->name('annuler_cotisation_account');
    Route::put('/cotisation/lancer_la_cotisation/{cotisation_id}', [CotisationsController::class, 'lancer_cotisation'])->name('lancer_la_cotisation');
    Route::put('/cotisation/mettre_en_attente/{cotisation_id}', [CotisationsController::class, 'mettre_en_attente'])->name('mettre_en_attente');
    Route::put('/cotisation/terminer_la_cotisation/{cotisation_id}', [CotisationsController::class, 'terminer_la_cotisation'])->name('terminer_la_cotisation');
    Route::get('/cotisation/inserer_cotisation_account/{cotisation_id}', [CotisationsController::class, 'inserer_cotisation_account'])->name('inserer_cotisation_account');
    Route::post('/cotisation/save_new_cotisation_account/{cotisation_id}', [CotisationsController::class, 'save_new_cotisation_account'])->name('save_new_cotisation_account');
    Route::get('/cotisation/edit_cotisation_account/{cotisation_account_id}', [CotisationsController::class, 'edit_cotisation_account'])->name('edit_cotisation_account');
    Route::post('/cotisation/save_edition_cotisation_account/{cotisation_account_id}', [CotisationsController::class, 'save_edition_cotisation_account'])->name('save_edition_cotisation_account');
});

