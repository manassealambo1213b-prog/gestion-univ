@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Liste des Paiements</h2>
    <a href="{{ route('paiements.create') }}" class="btn btn-primary">+ Ajouter Paiement</a>
</div>

<div class="card shadow">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Étudiant</th>
                    <th>Montant</th>
                    <th>Motif</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->etudiant->nom }} {{ $p->etudiant->prenom }} <br><small>{{ $p->etudiant->matricule }}</small></td>
                    <td><span class="badge bg-success">{{ $p->montant }} $</span></td>
                    <td>{{ $p->motif }}</td>
                    <td>{{ $p->created_at->format('d/m/Y') }}</td>
                    <td><a href="{{ route('paiements.recu', $p) }}" class="btn btn-sm btn-dark">🧾 Reçu</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection