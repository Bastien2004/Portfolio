<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Page d'accueil (affichage)
Route::get('/', [ProjectController::class, 'index'])->name('projects.index');

// Page du formulaire d'ajout
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

// Action de sauvegarde
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
