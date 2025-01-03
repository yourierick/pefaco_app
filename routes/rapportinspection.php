<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapportInspectionController;

Route::middleware('auth')->name('rapportinspection.')->group(function () {
    Route::get('/rapportinspection/list', [RapportInspectionController::class,
        'list_des_rapports'])->name('list_des_rapports');
    Route::get('/rapportinspection/ajouter_nouveau_rapport', [RapportInspectionController::class,
        'ajouter_nouveau_rapport'])->name('ajouter_nouveau_rapport');
    Route::post('/rapportinspection/sauvegarder_le_rapport', [RapportInspectionController::class,
        'sauvegarder_le_rapport'])->name('sauvegarder_le_rapport');
    Route::get('/rapportinspection/afficher_rapport/{rapport_id}/{notification_id?}', [RapportInspectionController::class,
        'afficher_rapport'])->name('afficher_rapport');
    Route::get('/rapportinspection/edit_le_rapport/{rapport_id}', [RapportInspectionController::class,
        'edit_le_rapport'])->name('edit_le_rapport');
    Route::put('/rapportinspection/save_edition_rapport/{rapport_id}', [RapportInspectionController::class,
        'save_edition_rapport'])->name('save_edition_rapport');
    Route::put('/rapportinspection/save_completion_offrande/{rapport_id}', [RapportInspectionController::class,
        'save_completion_offrande'])->name('save_completion_offrande');
    Route::delete('/rapportinspection/supp_rapport', [RapportInspectionController::class,
        'supprimer_rapport'])->name('supprimer_rapport');
    Route::get('/rapportinspection/voir_mes_drafts', [RapportInspectionController::class,  'voir_mes_drafts'])->name('voir_mes_drafts');
    Route::get('/rapportinspection/les_attentes_en_validation', [RapportInspectionController::class,
        'les_attentes_en_validation'])->name('les_attentes_en_validation');
    Route::put('/rapportinspection/traitement_du_rapport/{rapport_id}', [RapportInspectionController::class,
        'traitement_du_rapport'])->name('traitement_du_rapport');
});

