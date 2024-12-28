<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;

//LES MEMBRES
Route::middleware('auth')->name('membres.')->group(function () {
    Route::get('/membres/list', [MembreController::class,
        'list_des_membres'])->name('list_des_membres');
    Route::get('/membres/nouveau_membre', [MembreController::class,
        'nouveau_membre'])->name('nouveau_membre');
    Route::post('membres/save_membre', [MembreController::class,
        'save_membre'])->name('save_membre');
    Route::get('/membres/afficher_membre/{membre_id}', [MembreController::class,
        'afficher_membre'])->name('afficher_membre');
    Route::delete('/membres/supprimer_membre', [MembreController::class,
        'supprimer_membre'])->name('supprimer_membre');
    Route::get('/membres/edit_membre/{membre_id}', [MembreController::class,
        'edit_membre'])->name('edit_membre');
    Route::put('/membres/save_edition_membre/{membre_id}', [MembreController::class,
        'save_edition_membre'])->name('save_edition_membre');
});


//LES INVITES
Route::middleware('auth')->name('invites.')->group(function () {
    Route::get('/invites/list', [MembreController::class,
        'list_des_invites'])->name('list_des_invites');
    Route::get('/invites/nouvel_invite', [MembreController::class,
        'nouvel_invite'])->name('nouvel_invite');
    Route::post('invites/save_invite', [MembreController::class,
        'save_invite'])->name('save_invite');
    Route::delete('/invites/supprimer_invite', [MembreController::class,
        'supprimer_invite'])->name('supprimer_invite');
    Route::get('/invites/edit_invite/{invite_id}', [MembreController::class,
        'edit_invite'])->name('edit_invite');
    Route::put('/invites/save_edition_invite/{invite_id}', [MembreController::class,
        'save_edition_invite'])->name('save_edition_invite');
});


//LES BAPTISES
Route::middleware('auth')->name('baptemes.')->group(function () {
    Route::get('/baptemes/list', [MembreController::class,
        'list_des_baptises'])->name('list_des_baptises');
    Route::get('/baptemes/nouveau_baptise', [MembreController::class,
        'nouveau_baptise'])->name('nouveau_baptise');
    Route::post('baptemes/save_baptise', [MembreController::class,
        'save_baptise'])->name('save_baptise');
    Route::get('/baptemes/afficher_baptise/{baptise_id}', [MembreController::class,
        'afficher_baptise'])->name('afficher_baptise');
    Route::delete('/baptemes/supprimer_baptise', [MembreController::class,
        'supprimer_baptise'])->name('supprimer_baptise');
    Route::get('/baptemes/edit_baptise/{baptise_id}', [MembreController::class,
        'edit_baptise'])->name('edit_baptise');
    Route::put('/baptemes/save_edition_baptise/{baptise_id}', [MembreController::class,
        'save_edition_baptise'])->name('save_edition_baptise');
});
