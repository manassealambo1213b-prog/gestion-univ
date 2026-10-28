<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('filiere')->latest()->get();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('etudiants.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required|unique:etudiants',
            'email' => 'nullable|email',
            'filiere_id' => 'required',
        ]);

        $email = $request->email ?? strtolower($request->prenom.'.'.$request->nom.'@gestion-univ.cd');

        Etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'email' => $email,
            'filiere_id' => $request->filiere_id,
            'statut' => 'non_valide',
        ]);

        return redirect('/etudiants')->with('success','Étudiant ajouté !');
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load('filiere','paiements');
        return view('etudiants.show', compact('etudiant'));
    }

    public function valider(Etudiant $etudiant)
    {
        $etudiant->update(['statut' => 'valide']);
        return back()->with('success', 'Étudiant validé !');
    }

    // --- LES 2 FONCTIONS QUI MANQUAIENT ET QUI FAISAIENT PLANTER ---

    public function fichePdf(Etudiant $etudiant)
    {
        $etudiant->load('filiere','paiements');
        return view('etudiants.fiche', compact('etudiant'));
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return back()->with('success','Étudiant supprimé');
    }
}
