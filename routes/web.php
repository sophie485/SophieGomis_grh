<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\DepartementController;

Route::get('/', function () {
    return redirect('/employes');
});

Route::resource('employes', EmployeController::class);
Route::resource('departements', DepartementController::class);