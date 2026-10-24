@extends('layouts.app')
@section('content')
<h2>Nouveau Paiement</h2>
<div class="card p-4">
<form method="POST" action="/paiements">@csrf
<label>Étudiant</label>
<select name="etudiant_id" class="form-select mb-3" required>
@foreach($etudiants as $e)<option value="{{$e->id}}">{{$e->nom}} {{$e->prenom}} - {{$e->matricule}}</option>@endforeach
</select>
<label>Montant ($)</label><input type="number" name="montant" class="form-control mb-3" required>
<label>Motif</label><input type="text" name="motif" class="form-control mb-3" value="Frais Académiques">
<button class="btn btn-success w-100">💰 Encaisser</button>
</form></div>
@endsection