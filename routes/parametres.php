<?php

use App\Http\Controllers\ParametresController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/settings', [ParametresController::class, 'settings'])->name('settings');
    Route::post('/add_users_group', [ParametresController::class, 'add_users_group'])->name('add_users_group');
    Route::get('/autorisations/{groupe_id}', [ParametresController::class, 'autorisations'])->name('autorisations');
    Route::put('/charger_les_models/{groupe_id}', [ParametresController::class, 'charger_les_models'])->name('charger_les_models');
    Route::put('/save_autorisation_changes/{autorisation_id}', [ParametresController::class, 'save_autorisation_changes'])->name('save_autorisation_changes');
});


