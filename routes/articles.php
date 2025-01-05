<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

Route::middleware('auth')->name('article.')->group(function () {
    Route::get('/article/list', [ArticlesController::class,
        'list_des_articles'])->name('list_des_articles');
    Route::get('/article/nouvel_article', [ArticlesController::class,
        'nouvel_article'])->name('nouvel_article');
    Route::get('/article/voir_mes_drafts_articles', [ArticlesController::class,
        'voir_mes_drafts_articles'])->name('voir_mes_drafts_articles');
    Route::get('/article/voir_les_attentes_en_validation', [ArticlesController::class,
        'voir_les_attentes_en_validation'])->name('voir_les_attentes_en_validation');
    Route::post('/article/save_article', [ArticlesController::class,
        'save_article'])->name('save_article');
    Route::get('/article/afficher_article/{article_id}/{notification_id?}', [ArticlesController::class,
        'afficher_article'])->name('afficher_article');
    Route::delete('/article/supprimer_article', [ArticlesController::class,
        'supprimer_article'])->name('supprimer_article');
    Route::put('/article/traitement_article/{article_id}', [ArticlesController::class,
        'traitement_article'])->name('traitement_article');
    Route::get('/article/edit_article/{article_id}', [ArticlesController::class,
        'edit_article'])->name('edit_article');
    Route::put('/article/save_edition_article/{articlet_id}', [ArticlesController::class,
        'save_edition_article'])->name('save_edition_article');
});

