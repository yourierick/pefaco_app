<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonController;

Route::middleware('auth')->name('don.')->group(function () {
    Route::get('/dons/list', [DonController::class, 'list_des_dons'])->name('list');
    Route::get('/dons/add_new', [DonController::class, 'add_new_don'])->name('ajouter');
    Route::post('/dons/save', [DonController::class, 'save_new_don'])->name('save_new_don');
    Route::get('/dons/edit_don/{don_id}', [DonController::class, 'edit_don'])->name('edit_don');
    Route::put('/dons/save_edition/{don_id}', [DonController::class, 'save_edition_don'])->name('save_edition_don');
    Route::delete('/dons/supp_don', [DonController::class, 'supprimer_don'])->name('supprimer_don');
});

