<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapportCulteController;

Route::middleware('auth')->name('rapportadmin.')->group(function () {
    Route::get('/rapportadmin/list', [RapportCulteController::class,
        'list_des_rapports'])->name('list_des_rapports');
});

