<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CongeController;

Route::get('/', function () {
    return redirect('/employes');
});

// Ressources CRUD
Route::resource('employes', EmployeController::class);
Route::resource('departements', DepartementController::class);
Route::resource('conges', CongeController::class);

// Actions spécifiques (approuver / refuser congés)
Route::put('/conges/{conge}/approuver', [CongeController::class, 'approuver'])
    ->name('conges.approuver');

Route::put('/conges/{conge}/refuser', [CongeController::class, 'refuser'])
    ->name('conges.refuser');


use App\Http\Controllers\ContratController;

Route::resource('contrats', ContratController::class);