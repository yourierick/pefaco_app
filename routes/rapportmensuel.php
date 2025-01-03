<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapportMensuelController;

Route::middleware('auth')->name('rapportmensuel.')->group(function () {
    Route::get('/rapportmensuel/list', [RapportMensuelController::class,
        'list_des_rapports'])->name('list_des_rapports');
    Route::get('/rapportmensuel/voir_mes_drafts', [RapportMensuelController::class,  'voir_mes_drafts'])->name('voir_mes_drafts');
    Route::get('/rapportmensuel/les_attentes_en_completion', [RapportMensuelController::class,
        'les_attentes_en_completion'])->name('les_attentes_en_completion');
    Route::get('/rapportmensuel/les_attentes_en_validation', [RapportMensuelController::class,
        'les_attentes_en_validation'])->name('les_attentes_en_validation');
    Route::get('/rapportmensuel/ajouter_nouveau_rapport', [RapportMensuelController::class,
        'ajouter_nouveau_rapport'])->name('ajouter_nouveau_rapport');
    Route::post('/rapportmensuel/sauvegarder_le_rapport', [RapportMensuelController::class,
        'sauvegarder_le_rapport'])->name('sauvegarder_le_rapport');
    Route::get("ajax_requete_load/{mois}/{departement_id}", [RapportMensuelController::class,
        'chargement_rapport_semaine_et_caisse'])->name("chargement_rapport_semaine_et_caisse");
    Route::get('/rapportmensuel/afficher_rapport_mensuel/{rapport_id}/{notification_id?}', [RapportMensuelController::class,
        'afficher_rapport_mensuel'])->name('afficher_rapport_mensuel');
    Route::get('/rapportmensuel/edit_le_rapport/{rapport_id}', [RapportMensuelController::class,
        'edit_le_rapport'])->name('edit_le_rapport');
    Route::put('/rapportmensuel/save_edition_rapport/{rapport_id}', [RapportMensuelController::class,
        'save_edition_rapport'])->name('save_edition_rapport');
    Route::put('/rapportmensuel/traitement_du_rapport/{rapport_id}', [RapportMensuelController::class,
        'traitement_du_rapport'])->name('traitement_du_rapport');
    Route::delete('/rapportmensuel/supp_rapport', [RapportMensuelController::class,
        'supprimer_rapport'])->name('supprimer_rapport');
});

