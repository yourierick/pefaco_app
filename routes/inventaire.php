<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventaireController;

Route::middleware('auth')->name('inventaire.')->group(function () {
    Route::get('/inventaire/list', [InventaireController::class, 'list_des_biens'])->name('list_des_biens');
    Route::get('/inventaire/ajouter_nouveau', [InventaireController::class, 'ajouter_nouveau_bien'])->name('ajouter');
    Route::post('/inventaire/sauvegarder_le_bien', [InventaireController::class, 'sauvegarder_le_bien'])->name('sauvegarder_le_bien');
    Route::get('/inventaire/edit_bien/{bien_id}', [InventaireController::class, 'edit_bien'])->name('edit_bien');
    Route::put('/inventaire/save_edition_bien/{bien_id}', [InventaireController::class, 'save_edition_bien'])->name('save_edition_bien');
    Route::delete('/inventaire/supp_bien', [InventaireController::class, 'supprimer_bien'])->name('supprimer_bien');
});

