<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommuniqueController;

Route::middleware('auth')->name('communique.')->group(function () {
    Route::get('/communique/list', [CommuniqueController::class,
        'list_des_communiques'])->name('list_des_communiques');
    Route::get('/communique/nouveau_communique', [CommuniqueController::class,
        'nouveau_communique'])->name('nouveau_communique');
    Route::post('communique/save_communique', [CommuniqueController::class,
        'save_communique'])->name('save_communique');
    Route::get('/communique/afficher_un_communique/{communique_id}', [CommuniqueController::class,
        'afficher_un_communique'])->name('afficher_un_communique');
    Route::delete('/communique/supprimer_un_communique', [CommuniqueController::class,
        'supprimer_un_communique'])->name('supprimer_un_communique');
    Route::get('/communique/edit_un_enseignement/{communique_id}', [CommuniqueController::class,
        'edit_un_communique'])->name('edit_un_communique');
    Route::put('/communique/save_edition_communique/{communique_id}', [CommuniqueController::class,
        'save_edition_communique'])->name('save_edition_communique');
});

