<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PaiementController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome', [
        'totalEtudiants' => \App\Models\Etudiant::count(),
        'totalFilieres' => \App\Models\Filiere::count(),
        'totalPaiements' => \App\Models\Paiement::sum('montant'),
    ]);
});

// Ressources
Route::resource('filieres', FiliereController::class);
Route::resource('etudiants', EtudiantController::class);
Route::resource('paiements', PaiementController::class);

// --- Reçu de paiement --- C'EST ÇA QUI MANQUAIT
Route::get('/paiements/{paiement}/recu', [PaiementController::class, 'recu'])->name('paiements.recu');

// --- PDF --- C'EST ICI QUE TOUT SE JOUE POUR LA DÉFENSE
// 1. Liste des inscrits par promotion
Route::get('/filiere/{id}/liste-pdf', function($id){
    $filiere = \App\Models\Filiere::with('etudiants.paiements')->findOrFail($id);
    $pdf = Pdf::loadView('pdf.liste', [
        'filiere' => $filiere,
        'etudiants' => $filiere->etudiants
    ]);
    return $pdf->download('Liste-'.$filiere->code.'.pdf');
})->name('filiere.liste.pdf');

// 2. Fiche d'inscription + récap paiements
Route::get('/etudiant/{id}/fiche-pdf', function($id){
    $etudiant = \App\Models\Etudiant::with('filiere','paiements')->findOrFail($id);
    $pdf = Pdf::loadView('pdf.fiche', [
        'etudiant' => $etudiant,
        'total' => $etudiant->paiements->sum('montant')
    ]);
    return $pdf->download('Fiche-'.$etudiant->matricule.'.pdf');
})->name('etudiant.fiche.pdf');