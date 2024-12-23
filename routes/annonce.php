<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceController;

Route::middleware('auth')->name('annonce.')->group(function () {
    Route::get('/annonces/list', [AnnonceController::class,
        'list_des_annonces'])->name('list_des_annonces');
    Route::get('/annonces/nouvelle_annonce', [AnnonceController::class,
        'nouvelle_annonce'])->name('nouvelle_annonce');
    Route::get('/annonces/voir_mes_drafts', [AnnonceController::class,
        'voir_mes_drafts'])->name('voir_mes_drafts');
    Route::get('/annonces/voir_les_attentes_en_validation', [AnnonceController::class,
        'voir_les_attentes_en_validation'])->name('voir_les_attentes_en_validation');
    Route::post('annonces/save_annonce', [AnnonceController::class,
        'save_annonce'])->name('save_annonce');
    Route::get('/annonces/afficher_une_annonce/{annonce_id}', [AnnonceController::class,
        'afficher_annonce'])->name('afficher_annonce');
    Route::delete('/annonces/supprimer_une_annonce', [AnnonceController::class,
        'supprimer_une_annonce'])->name('supprimer_une_annonce');
    Route::put('/annonces/traitement_annonce/{annonce_id}', [AnnonceController::class,
        'traitement_annonce'])->name('traitement_annonce');
    Route::get('/annonces/edit_une_annonce/{annonce_id}', [AnnonceController::class,
        'edit_une_annonce'])->name('edit_une_annonce');
    Route::put('/annonces/save_edition_annonce/{annonce_id}', [AnnonceController::class,
        'save_edition_annonce'])->name('save_edition_annonce');
});

