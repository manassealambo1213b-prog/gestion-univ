<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\URL;

if (app()->environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect('/etudiants');
});

Route::resource('filieres', FiliereController::class);
Route::resource('etudiants', EtudiantController::class);
Route::resource('paiements', PaiementController::class);

// Routes PDF - pour corriger ton erreur
Route::get('filieres/liste/pdf', [FiliereController::class, 'listePdf'])->name('filiere.liste.pdf');
Route::get('etudiants/liste/pdf', [EtudiantController::class, 'listePdf'])->name('etudiant.liste.pdf');
Route::get('etudiants/{etudiant}/pdf', [EtudiantController::class, 'pdf'])->name('etudiant.pdf');
Route::get('paiements/liste/pdf', [PaiementController::class, 'listePdf'])->name('paiement.liste.pdf');
