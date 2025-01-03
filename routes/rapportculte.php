<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapportCulteController;

Route::middleware('auth')->name('rapportculte.')->group(function () {
    Route::get('/rapportculte/list', [RapportCulteController::class,
        'list_des_rapports'])->name('list_des_rapports');
    Route::get('/rapportculte/ajouter_nouveau_rapport', [RapportCulteController::class,
        'ajouter_nouveau_rapport'])->name('ajouter_nouveau_rapport');
    Route::post('/rapportculte/sauvegarder_le_rapport', [RapportCulteController::class,
        'sauvegarder_le_rapport'])->name('sauvegarder_le_rapport');
    Route::get('/rapportculte/afficher_rapport_culte/{rapport_id}', [RapportCulteController::class,
        'afficher_rapport_culte'])->name('afficher_rapport_culte');
    Route::get('/rapportculte/edit_le_rapport/{rapport_id}', [RapportCulteController::class,
        'edit_le_rapport'])->name('edit_le_rapport');
    Route::put('/rapportculte/save_edition_rapport/{rapport_id}', [RapportCulteController::class,
        'save_edition_rapport'])->name('save_edition_rapport');
    Route::put('/rapportculte/save_completion_offrande/{rapport_id}', [RapportCulteController::class,
        'save_completion_offrande'])->name('save_completion_offrande');
    Route::delete('/rapportculte/supp_rapport', [RapportCulteController::class,
        'supprimer_rapport'])->name('supprimer_rapport');
    Route::get('/rapportculte/voir_mes_drafts', [RapportCulteController::class,  
        'voir_mes_drafts'])->name('voir_mes_drafts');
    Route::get('/rapportculte/les_attentes_en_completion', [RapportCulteController::class,
        'les_attentes_en_completion'])->name('les_attentes_en_completion');
    Route::get('/rapportculte/les_attentes_en_validation', [RapportCulteController::class,
        'les_attentes_en_validation'])->name('les_attentes_en_validation');
    Route::put('/rapportculte/save_completion/{rapport_id}', [RapportCulteController::class,
        'save_completion'])->name('save_completion');
    Route::put('/rapportculte/traitement_du_rapport/{rapport_id}', [RapportCulteController::class,
        'traitement_du_rapport'])->name('traitement_du_rapport');
    Route::put('/rapportculte/audience_rapport/{rapport_id}', [RapportCulteController::class, 'audience_rapport'])->name('audience_rapport');
});

