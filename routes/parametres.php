<?php

use App\Http\Controllers\ParametresController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('parametres.')->group(function () {
    Route::get('/settings', [ParametresController::class, 'settings'])->name('settings');
    Route::post('/settings/add_users_group', [ParametresController::class, 'add_users_group'])->name('add_users_group');
    Route::get('/settings/autorisations/{groupe_id}', [ParametresController::class, 'autorisations'])->name('autorisations');
    Route::put('/settings/charger_les_models/{groupe_id}', [ParametresController::class, 'charger_les_models'])->name('charger_les_models');
    Route::put('/settings/save_autorisation_changes/{autorisation_id}', [ParametresController::class, 'save_autorisation_changes'])->name('save_autorisation_changes');
    Route::post('/settings/save_configuration_generale', [ParametresController::class, 'save_configuration_generale'])->name('save_configuration_generale');
    
    Route::post('/settings/ajouter_departement', [ParametresController::class, 'ajouter_departement'])->name('ajouter_departement');
    Route::post('/settings/ajouter_zone', [ParametresController::class, 'ajouter_zone'])->name('ajouter_zone');
    Route::post('/settings/ajouter_paroisse', [ParametresController::class, 'ajouter_paroisse'])->name('ajouter_paroisse');
    Route::post('/settings/ajouter_qualite', [ParametresController::class, 'ajouter_qualite'])->name('ajouter_qualite');
    Route::post('/settings/ajouter_programmeculte', [ParametresController::class, 'ajouter_programmeculte'])->name('ajouter_programmeculte');
    Route::post('/settings/ajouter_programmedupasteur', [ParametresController::class, 'ajouter_programmedupasteur'])->name('ajouter_programmedupasteur');

    Route::put('/settings/editer_departement', [ParametresController::class, 'editer_departement'])->name('editer_departement');
    Route::put('/settings/editer_zone', [ParametresController::class, 'editer_zone'])->name('editer_zone');
    Route::put('/settings/editer_qualite', [ParametresController::class, 'editer_qualite'])->name('editer_qualite');
    Route::put('/settings/editer_paroisse', [ParametresController::class, 'editer_paroisse'])->name('editer_paroisse');
    Route::put('/settings/editer_programmeculte', [ParametresController::class, 'editer_programmeculte'])->name('editer_programmeculte');
    Route::put('/settings/editer_programmedupasteur', [ParametresController::class, 'editer_programmedupasteur'])->name('editer_programmedupasteur');

    Route::delete('/settings/supprimer_departement', [ParametresController::class, 'supprimer_departement'])->name('supprimer_departement');
    Route::delete('/settings/supprimer_zone', [ParametresController::class, 'supprimer_zone'])->name('supprimer_zone');
    Route::delete('/settings/supprimer_qualite', [ParametresController::class, 'supprimer_qualite'])->name('supprimer_qualite');
    Route::delete('/settings/supprimer_paroisse', [ParametresController::class, 'supprimer_paroisse'])->name('supprimer_paroisse');
    Route::delete('/settings/supprimer_programmeculte', [ParametresController::class, 'supprimer_programmeculte'])->name('supprimer_programmeculte');
    Route::delete('/settings/supprimer_programmedupasteur', [ParametresController::class, 'supprimer_programmedupasteur'])->name('supprimer_programmedupasteur');
});
