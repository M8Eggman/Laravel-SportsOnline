<?php

use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminVerification;
use App\Http\Middleware\CoachVerification;
use App\Http\Middleware\RoleVerification;
use App\Http\Middleware\UserVerification;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('accueil');



// Routes equipe 
// front
Route::get('/equipe/masculine', [EquipeController::class, 'index_masculin'])->name('equipe.masculin.index');
Route::get('/equipe/feminine', [EquipeController::class, 'index_feminin'])->name('equipe.feminin.index');
Route::get('/equipe/mixed', [EquipeController::class, 'index_mixte'])->name('equipe.mixte.index');
Route::get('/equipe/{id}/show', [EquipeController::class, 'show'])->name('equipe.show');

// back
Route::middleware([CoachVerification::class])->group(function () {
    Route::get('/back/equipe', [EquipeController::class, 'index_back'])->name('back.equipe.index');
    Route::get('/back/equipe/create', [EquipeController::class, 'create'])->name('back.equipe.create');
    Route::post('/back/equipe/store', [EquipeController::class, 'store'])->name('back.equipe.store');
    Route::get('/back/equipe/{id}/edit', [EquipeController::class, 'edit'])->name('back.equipe.edit');
    Route::put('/back/equipe/{id}/update', [EquipeController::class, 'update'])->name('back.equipe.update');
    Route::get('/back/equipe/{id}/show', [EquipeController::class, 'show_back'])->name('back.equipe.show');
    Route::delete('/back/equipe/{id}/delete', [EquipeController::class, 'destroy'])->name('back.equipe.delete');
});
// route joueur 
// front
Route::get('/joueur', [JoueurController::class, 'index'])->name('joueur.index');
Route::get('/joueur/{id}/show', [JoueurController::class, 'show'])->name('joueur.show');

// back
Route::middleware([UserVerification::class])->group(function () {
    Route::get('/back/joueur', [JoueurController::class, 'index_back'])->name('back.joueur.index');
    Route::get('/back/joueur/create', [JoueurController::class, 'create'])->name('back.joueur.create');
    Route::post('/back/joueur/store', [JoueurController::class, 'store'])->name('back.joueur.store');
    Route::get('/back/joueur/{id}/edit', [JoueurController::class, 'edit'])->name('back.joueur.edit');
    Route::put('/back/joueur/{id}/update', [JoueurController::class, 'update'])->name('back.joueur.update');
    Route::get('/back/joueur/{id}/show', [JoueurController::class, 'show_back'])->name('back.joueur.show');
    Route::delete('/back/joueur/{id}/delete', [JoueurController::class, 'destroy'])->name('back.joueur.delete');
});

// route users
Route::middleware([AdminVerification::class])->group(function () {
    Route::get('/back/user', [UserController::class, 'index_back'])->name('back.user.index');
    Route::get('/back/user/create', [UserController::class, 'create'])->name('back.user.create');
    Route::post('/back/user/store', [UserController::class, 'store'])->name('back.user.store');
    Route::get('/back/user/{id}/edit', [UserController::class, 'edit'])->name('back.user.edit');
    Route::put('/back/user/{id}/update', [UserController::class, 'update'])->name('back.user.update');
    Route::get('/back/user/{id}/show', [UserController::class, 'show'])->name('back.user.show');
    Route::delete('/back/user/{id}/delete', [UserController::class, 'destroy'])->name('back.user.delete');
});
require __DIR__ . '/auth.php';
