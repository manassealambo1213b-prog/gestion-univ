@php
$filieres = \App\Models\Filiere::all();
if($filieres->isEmpty()){
    \App\Models\Filiere::create(['nom' => 'Informatique', 'code' => 'INFO']);
    \App\Models\Filiere::create(['nom' => 'Gestion', 'code' => 'GES']);
    \App\Models\Filiere::create(['nom' => 'Droit', 'code' => 'DROIT']);
    $filieres = \App\Models\Filiere::all();
}
@endphp
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ajouter un Étudiant</h2>
    <a href="/etudiants" class="btn btn-secondary">← Retour</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="/etudiants">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nom *</label>
                    <input type="text" name="nom" class="form-control" placeholder="Ex: Kabongo" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Prénom</label>
                    <input type="text" name="prenom" class="form-control" placeholder="Ex: Manas">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Matricule *</label>
                    <input type="text" name="matricule" class="form-control" placeholder="Ex: L1-INFO-001" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Filière *</label>
                    <select name="filiere_id" class="form-select" required>
                        <option value="">-- Choisir Filière --</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->nom }} ({{ $filiere->code }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Email (facultatif)</label>
                <input type="email" name="email" class="form-control" placeholder="manas@univ.cd">
            </div>

            <div class="mb-3">
                <label class="fw-bold">Téléphone</label>
                <input type="text" name="telephone" class="form-control" placeholder="+243...">
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-lg">✅ Enregistrer l'Étudiant</button>
        </form>
    </div>
</div>
@endsection