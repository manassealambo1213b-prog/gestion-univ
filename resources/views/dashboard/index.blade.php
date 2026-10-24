@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-1">Tableau de Bord</h2>
    <p class="text-muted mb-4">Bienvenue Manas !</p>

    <div class="row mt-4 g-3">
        {{-- Encaissé --}}
        <div class="col-md-3">
            <div class="card bg-success text-white p-3 shadow" style="border:none; border-radius:12px;">
                <h6>Encaissé</h6>
                <h2 class="fw-bold">{{ $totalEncaisse ?? 250 }} $</h2>
                <small>Total paiements</small>
            </div>
        </div>

        {{-- Étudiants --}}
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3 shadow" style="border:none; border-radius:12px;">
                <h6>Étudiants</h6>
                <h2 class="fw-bold">{{ $totalEtudiants ?? 12 }}</h2>
                <small>Inscrits</small>
            </div>
        </div>

        {{-- Validés --}}
        <div class="col-md-3">
            <div class="card bg-info text-white p-3 shadow" style="border:none; border-radius:12px;">
                <h6>Validés</h6>
                <h2 class="fw-bold">{{ $valides ?? 8 }}</h2>
                <small>Dossiers complets</small>
            </div>
        </div>

        {{-- Non Validés --}}
        <div class="col-md-3">
            <div class="card bg-warning p-3 shadow" style="border:none; border-radius:12px;">
                <h6>Non Validés</h6>
                <h2 class="fw-bold">{{ $nonValides ?? 4 }}</h2>
                <small>En attente</small>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card p-4 shadow-sm">
                <h5>Raccourcis</h5>
                <a href="/etudiants/create" class="btn btn-primary me-2">+ Nouvel Étudiant</a>
                <a href="/paiements/create" class="btn btn-warning">+ Nouveau Paiement</a>
                <a href="/filieres" class="btn btn-outline-secondary">Gérer Filières</a>
            </div>
        </div>
    </div>
</div>
@endsection