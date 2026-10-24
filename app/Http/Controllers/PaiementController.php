<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('etudiant.filiere')->latest()->get();
        return view('paiements.index', compact('paiements'));
    }

    public function create()
    {
        $etudiants = Etudiant::all();
        return view('paiements.create', compact('etudiants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required',
            'montant' => 'required|numeric|min:1',
        ]);

        Paiement::create([
            'etudiant_id' => $request->etudiant_id,
            'montant' => $request->montant,
            'motif' => $request->motif ?? 'Frais académiques',
        ]);

        return redirect('/paiements')->with('success', 'Paiement enregistré !');
    }

    public function recu(Paiement $paiement)
    {
        $paiement->load('etudiant.filiere');
        return view('paiements.recu', compact('paiement'));
    }
}