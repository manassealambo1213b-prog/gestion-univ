<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PaiementController;

if (app()->environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect('/etudiants');
});

// Ressources
Route::resource('filieres', FiliereController::class);
Route::resource('etudiants', EtudiantController::class);
Route::resource('paiements', PaiementController::class);

// --- ROUTES PDF QUI MANQUAIENT (c'est ça qui faisait planter) ---
Route::get('/etudiants/{etudiant}/fiche-pdf', [EtudiantController::class, 'fichePdf'])->name('etudiant.fiche.pdf');
Route::get('/filieres/{filiere}/liste-pdf', [FiliereController::class, 'listePdf'])->name('filiere.liste.pdf');
