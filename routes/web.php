<?php

use App\Http\Controllers\ContinentController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::resource('continent', ContinentController::class);
// Route::resource('equipe', EquipeController::class);
Route::resource('genre', GenreController::class);
Route::resource('joueur', JoueurController::class);
Route::resource('position', PositionController::class);
Route::resource('role', RoleController::class);

Route::get('/equipe', [EquipeController::class, 'index']);

require __DIR__.'/auth.php';
