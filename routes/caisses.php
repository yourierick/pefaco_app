<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaisseController;

Route::middleware('auth')->name('caisses.')->group(function () {
    Route::get('/caisses', [CaisseController::class, 'liste_des_caisses'])->name('list');
    Route::get('/caisses/add_new', [CaisseController::class, 'add_new_caisse'])->name('add_new');
    Route::post('/caisses/add_new', [CaisseController::class, 'save_new_caisse'])->name('add_new');
    Route::get('/caisses/edit_caisse/{caisse_id}', [CaisseController::class, 'edit_caisse'])->name('edit_caisse');
    Route::put('/caisses/save_edit_caisse/{caisse_id}', [CaisseController::class, 'save_edit_caisse'])->name('save_edit_caisse');
    Route::get('/caisses/vue_de_la_caisse/{caisse_id}', [CaisseController::class, 'vue_de_la_caisse'])->name('vue_de_la_caisse');
    #Ajouter une ligne à la table caisse_account
    Route::get('/caisses/nouvelle_transaction/{caisse_id}', [CaisseController::class, 'nouvelle_transaction'])->name('nouvelle_transaction');
    #Verification du code de la dépense route:: Ajax
    Route::get('/check_code_de_depense/{code}/{caisse_id}', [CaisseController::class, 'check_code_de_depense'])->name('check_code_de_depense');
    #Enregistrement des données saisies sur le formulaire add_caisse_account
    Route::post('/caisses/save_transaction/{caisse_id}', [CaisseController::class, 'save_transaction'])->name('save_transaction');
    Route::delete('/caisses/delete_caisse', [CaisseController::class, 'delete_caisse'])->name('delete_caisse');
    Route::delete('/caisses/annuler_transaction/{caisse_id}', [CaisseController::class, 'annuler_transaction'])->name('annuler_transaction');
});

Route::middleware('auth')->group(function () {
    #Route Ajax pour charger les utilisateurs par département pour le poste de caissier
    Route::get('load_users/{dept_id}', [CaisseController::class, 'load_users'])->name('load_users');
});
