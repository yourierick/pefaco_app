<?php

use App\Http\Controllers\PublicSpaceController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicSpaceController::class, 'home'])->name('home');

Route::name('public.')->group(function () {
    Route::post('/public/subscribeToNewsLetter', [PublicSpaceController::class, 'subscribeToNewsLetter'])->name('subscribeToNewsLetter');
    Route::post('/public/messageEtCommentaire', [PublicSpaceController::class, 'messageEtCommentaire'])->name('messageEtCommentaire');
});
