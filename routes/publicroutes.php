<?php

use App\Http\Controllers\PublicSpaceController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicSpaceController::class, 'home'])->name('home');

Route::name('public.')->group(function () {
    Route::post('/customer_space/subscribeToNewsLetter', [PublicSpaceController::class, 'subscribeToNewsLetter'])->name('subscribeToNewsLetter');
    Route::post('/customer_space/messageEtCommentaire', [PublicSpaceController::class, 'messageEtCommentaire'])->name('messageEtCommentaire');

    Route::get('/customer_space/afficher_article/{article_id}', [PublicSpaceController::class, 'afficher_article'])->name('afficher_article');
    Route::post('/customer_space/save_commentaire_article/{article_id}', [PublicSpaceController::class, 'save_commentaire_article'])->name('save_commentaire_article');
    Route::delete('/customer_space/supprimer_commentaire_article/{commentaire_id}', [PublicSpaceController::class, 'supprimer_commentaire_article'])->name('supprimer_commentaire_article');
    Route::post('/customer_space/save_commentairechild_article/{commentparent_id}', [PublicSpaceController::class, 'save_commentairechild_article'])->name('save_commentairechild_article');
    Route::delete('/customer_space/supprimer_commentairechild_article/{commentchild_id}', [PublicSpaceController::class, 'supprimer_commentairechild_article'])->name('supprimer_commentairechild_article');
    Route::post('/customer_space/likeordislikearticle/{article_id}', [PublicSpaceController::class, 'likeordislikearticle'])->name('likeordislikearticle');
    Route::get('/customer_space/list_des_articles', [PublicSpaceController::class, 'list_des_articles'])->name('list_des_articles');

    Route::get('/customer_space/afficher_enseignement/{enseignement_id}', [PublicSpaceController::class, 'afficher_enseignement'])->name('afficher_enseignement');
    Route::post('/customer_space/save_commentaire_enseignement/{enseignement_id}', [PublicSpaceController::class, 'save_commentaire_enseignement'])->name('save_commentaire_enseignement');
    Route::delete('/customer_space/supprimer_commentaire_enseignement/{commentaire_id}', [PublicSpaceController::class, 'supprimer_commentaire_enseignement'])->name('supprimer_commentaire_enseignement');
    Route::post('/customer_space/save_commentairechild_enseignement/{commentparent_id}', [PublicSpaceController::class, 'save_commentairechild_enseignement'])->name('save_commentairechild_enseignement');
    Route::delete('/customer_space/supprimer_commentairechild_enseignement/{commentchild_id}', [PublicSpaceController::class, 'supprimer_commentairechild_enseignement'])->name('supprimer_commentairechild_enseignement');
    Route::post('/customer_space/likeordislikeenseignement/{enseignement_id}', [PublicSpaceController::class, 'likeordislikeenseignement'])->name('likeordislikeenseignement');
    Route::get('/customer_space/list_des_enseignements', [PublicSpaceController::class, 'list_des_enseignements'])->name('list_des_enseignements');
});
