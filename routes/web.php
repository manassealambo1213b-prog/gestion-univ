<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PaiementController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return redirect('/etudiants');
});

// Ressources
Route::resource('filieres', FiliereController::class);
Route::resource('etudiants', EtudiantController::class);
Route::resource('paiements', PaiementController::class);
