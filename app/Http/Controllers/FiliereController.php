<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::withCount('etudiants')->get();
        return view('filieres.index', compact('filieres'));
    }

    public function create()
    {
        return view('filieres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'code' => 'required|unique:filieres,code',
            'description' => 'nullable',
        ]);

        Filiere::create([
            'nom' => $request->nom,
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return redirect()->route('filieres.index')->with('success', 'Filière créée avec succès !');
    }

    public function edit($id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('filieres.edit', compact('filiere'));
    }

    public function update(Request $request, $id)
    {
        $filiere = Filiere::findOrFail($id);
        
        $request->validate([
            'code' => 'required|unique:filieres,code,'.$filiere->id,
            'nom' => 'required',
            'description' => 'nullable',
        ]);

        $filiere->update([
            'code' => $request->code,
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('filieres.index')->with('success', 'Filière modifiée !');
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filière supprimée !');
    }
}