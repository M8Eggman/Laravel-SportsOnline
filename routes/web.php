<?php

use App\Http\Controllers\ContinentController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('accueil');

Route::resource('continent', ContinentController::class);
Route::resource('genre', GenreController::class);
Route::resource('position', PositionController::class);
Route::resource('role', RoleController::class);
// Routes publiques (front)
Route::get('/equipe', [EquipeController::class, 'index_front'])->name('front.equipe.index');

// Routes admin (back)  
Route::prefix('back')->group(function () {
    Route::resource('equipe', EquipeController::class);
});

// route joueur
Route::get('/back/joueur', [JoueurController::class, 'index_back'])->name('back.joueur.index');
Route::get('/back/joueur/create', [JoueurController::class, 'create'])->name('back.joueur.create');
Route::post('/back/joueur/store', [JoueurController::class, 'store'])->name('back.joueur.store');
Route::get('/back/joueur/{id}/edit', [JoueurController::class, 'edit'])->name('back.joueur.edit');
Route::put('/back/joueur/{id}/update', [JoueurController::class, 'update'])->name('back.joueur.update');
Route::get('/back/joueur/{id}/show', [JoueurController::class, 'show'])->name('back.joueur.show');
Route::delete('/back/joueur/{id}/delete', [JoueurController::class, 'destroy'])->name('back.joueur.delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
