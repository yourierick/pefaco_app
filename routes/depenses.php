<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepenseController;

Route::middleware('auth')->name('depense.')->group(function () {
    Route::get('/depenses/list', [DepenseController::class, 'liste_des_depenses'])->name('list');
    Route::get('/depenses/add_new_depense', [DepenseController::class, 'add_new_depense'])->name('ajouter');
    Route::get('/depenses/afficher/{depense_id}/{notification_id?}', [DepenseController::class, 'afficher_la_depense'])->name('afficher');
    Route::post('/depenses/save', [DepenseController::class, 'save_new_depense'])->name('save_new_depense');
    Route::get('/depenses/edit_depense/{depense_id}', [DepenseController::class, 'edit_depense'])->name('edit_depense');
    Route::put('/depenses/save_edit_depense/{depense_id}', [DepenseController::class, 'save_edit_depense'])->name('save_edit_depense');
    Route::put('/depenses/traitement_depense/{depense_id}', [DepenseController::class, 'traitement_depense'])->name('traitement_depense');
    Route::put('/depenses/annuler_action/{depense_id}', [DepenseController::class, 'annuler_action'])->name('annuler_action');
    Route::delete('/depenses/supprimer/{depense_id}', [DepenseController::class, 'supprimer_depense'])->name('supprimer_depense');
});

Route::middleware('auth')->group(function () {
    #Route Ajax pour charger les utilisateurs par département pour le poste de caissier
    Route::get('/depenses/generate_code', [DepenseController::class, 'generate_depense_code'])->name('generate_code');
});
