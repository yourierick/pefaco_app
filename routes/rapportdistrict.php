<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapportDistrictController;

Route::middleware('auth')->name('rapportdistrict.')->group(function () {
    Route::get('/rapportdistrict/list', [RapportDistrictController::class,
        'list_des_rapports'])->name('list_des_rapports');
    // Route::get('/rapportdistrict/voir_mes_drafts', [RapportDistrictController::class,  'voir_mes_drafts'])->name('voir_mes_drafts');
    // Route::get('/rapportdistrict/les_attentes_en_completion', [RapportDistrictController::class,
    //     'les_attentes_en_completion'])->name('les_attentes_en_completion');
    // Route::get('/rapportdistrict/les_attentes_en_validation', [RapportDistrictController::class,
    //     'les_attentes_en_validation'])->name('les_attentes_en_validation');
    // Route::get('/rapportdistrict/ajouter_nouveau_rapport', [RapportDistrictController::class,
    //     'ajouter_nouveau_rapport'])->name('ajouter_nouveau_rapport');
    // Route::post('/rapportdistrict/sauvegarder_le_rapport', [RapportDistrictController::class,
    //     'sauvegarder_le_rapport'])->name('sauvegarder_le_rapport');
    // Route::get("ajax_requete_load/{mois}/{departement_id}", [RapportDistrictController::class,
    //     'chargement_rapport_semaine_et_caisse'])->name("chargement_rapport_semaine_et_caisse");
    // Route::get('/rapportdistrict/afficher_rapport_mensuel/{rapport_id}', [RapportDistrictController::class,
    //     'afficher_rapport_mensuel'])->name('afficher_rapport_mensuel');
    // Route::get('/rapportdistrict/edit_le_rapport/{rapport_id}', [RapportDistrictController::class,
    //     'edit_le_rapport'])->name('edit_le_rapport');
    // Route::put('/rapportdistrict/save_edition_rapport/{rapport_id}', [RapportDistrictController::class,
    //     'save_edition_rapport'])->name('save_edition_rapport');
    // Route::put('/rapportdistrict/traitement_du_rapport/{rapport_id}', [RapportDistrictController::class,
    //     'traitement_du_rapport'])->name('traitement_du_rapport');
    // Route::delete('/rapportdistrict/supp_rapport', [RapportDistrictController::class,
    //     'supprimer_rapport'])->name('supprimer_rapport');
});

