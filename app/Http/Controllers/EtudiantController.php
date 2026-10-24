<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('filiere')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create(){
        $filieres = Filiere::all();
        return view('etudiants.create', compact('filieres'));
    }

    public function store(Request $request){
        $request->validate([
            'nom'=>'required',
            'matricule'=>'required|unique:etudiants,matricule',
            'filiere_id'=>'required',
        ]);

        // CORRECTION DEFINITIVE DE L'EMAIL
        $email = $request->filled('email') ? $request->email : strtolower($request->prenom ?? 'etudiant').$request->matricule.'@univ.cd';

        Etudiant::create([
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'matricule'=>$request->matricule,
            'email'=>$email,
            'filiere_id'=>$request->filiere_id,
            'statut'=>'non_valide',
        ]);
        return redirect('/etudiants')->with('success','Étudiant ajouté !');
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load('filiere', 'paiements');
        return view('etudiants.show', compact('etudiant'));
    }

    public function valider(Etudiant $etudiant)
    {
        $etudiant->update(['statut' => 'valide']);
        return back()->with('success', 'Étudiant validé !');
    }
}