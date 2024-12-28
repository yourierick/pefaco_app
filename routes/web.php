<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicSpaceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [PublicSpaceController::class, 'home'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->name('manageprofile.')->group(function () {
    Route::get('/manage_user/edit_user/{user}', [UserController::class, 'edit_user'])->name('edit_user');
    Route::patch('/manage_user/update_user/{user}', [UserController::class, 'update_user'])->name('update_user');
    Route::get('/manage_user', [UserController::class, 'profiles'])->name('list_users');
    Route::delete('/manage_user/destroy_user_account/{user}', [UserController::class, 'destroy_user_account'])->name('destroy_user_account');
    Route::put('/manage_user/update_user_password/{user}', [UserController::class, 'update_user_password'])->name('update_user_password');
    Route::get('/manage_user/autorisation_speciales/{user}', [UserController::class, 'autorisation_speciales'])->name('autorisation_speciales');
    Route::post('/manage_user/load_autorisation_speciales/{user_id}', [UserController::class, 'load_autorisation_speciales'])->name('load_autorisation_speciales');
    Route::put('/manage_user/user_account_status_check/{user_id}', [UserController::class, 'user_account_status_check'])->name('user_account_status_check');
    Route::put('/manage_user/save_autorisations_speciales/{autorisation_id}', [UserController::class, 'save_autorisations_speciales'])->name('save_autorisations_speciales');
});
require __DIR__.'/publicroutes.php';
require __DIR__.'/auth.php';
require __DIR__.'/depenses.php';
require __DIR__.'/caisses.php';
require __DIR__.'/cotisation.php';
require __DIR__.'/dons.php';
require __DIR__.'/inventaire.php';
require __DIR__.'/rapportculte.php';
require __DIR__ .'/articles.php';
require __DIR__.'/parametres.php';
require __DIR__.'/annonce.php';
require __DIR__.'/enseignement.php';
require __DIR__.'/communiques.php';
require __DIR__.'/horairehebdo.php';
require __DIR__.'/rapportmensuel.php';
require __DIR__.'/rapportinspection.php';
require __DIR__.'/rapportdistrict.php';
require __DIR__.'/membres.php';
