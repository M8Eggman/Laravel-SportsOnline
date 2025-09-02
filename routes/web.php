<?php

use App\Http\Controllers\ContinentController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('accueil');

// Routes publiques (front)
Route::get('/equipe', [EquipeController::class, 'index_front'])->name('front.equipe.index');

// Routes admin (back)  
Route::prefix('back')->group(function () {
    Route::resource('equipe', EquipeController::class);
});

// route joueur 
// front
Route::get('/joueur', [JoueurController::class, 'index'])->name('joueur.index');
Route::get('/joueur/{id}/show', [JoueurController::class, 'show'])->name('joueur.show');

// back
Route::get('/back/joueur', [JoueurController::class, 'index_back'])->name('back.joueur.index');
Route::get('/back/joueur/create', [JoueurController::class, 'create'])->name('back.joueur.create');
Route::post('/back/joueur/store', [JoueurController::class, 'store'])->name('back.joueur.store');
Route::get('/back/joueur/{id}/edit', [JoueurController::class, 'edit'])->name('back.joueur.edit');
Route::put('/back/joueur/{id}/update', [JoueurController::class, 'update'])->name('back.joueur.update');
Route::get('/back/joueur/{id}/show', [JoueurController::class, 'show_back'])->name('back.joueur.show');
Route::delete('/back/joueur/{id}/delete', [JoueurController::class, 'destroy'])->name('back.joueur.delete');

// route users
Route::get('/back/user', [UserController::class, 'index_back'])->name('back.user.index');
Route::get('/back/user/create', [UserController::class, 'create'])->name('back.user.create');
Route::post('/back/user/store', [UserController::class, 'store'])->name('back.user.store');
Route::get('/back/user/{id}/edit', [UserController::class, 'edit'])->name('back.user.edit');
Route::put('/back/user/{id}/update', [UserController::class, 'update'])->name('back.user.update');
Route::get('/back/user/{id}/show', [UserController::class, 'show'])->name('back.user.show');
Route::delete('/back/user/{id}/delete', [UserController::class, 'destroy'])->name('back.user.delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
