<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index', [
            'totalEncaisse' => Paiement::sum('montant'),
            'totalEtudiants' => Etudiant::count(),
            'valides' => Etudiant::where('statut','valide')->count(),
            'nonValides' => Etudiant::where('statut','non_valide')->count(),
        ]);
    }
}