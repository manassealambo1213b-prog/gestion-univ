@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Liste des Étudiants</h3>
        <div>
            <a href="{{ route('etudiants.create') }}" class="btn btn-warning">+ Nouvel Étudiant</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Matricule</th>
                            <th>Nom Complet</th>
                            <th>Filière</th>
                            <th>Contact</th>
                            <th>Total Payé</th>
                            <th style="width:220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etudiants as $i => $etudiant)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td><span class="badge bg-secondary">{{ $etudiant->matricule }}</span></td>
                            <td class="fw-bold">{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->filiere->nom ?? '-' }} ({{ $etudiant->filiere->code ?? '' }})</td>
                            <td>{{ $etudiant->contact }}</td>
                            <td>
                                @php $total = $etudiant->paiements->sum('montant'); @endphp
                                <span class="badge {{ $total >= 200 ? 'bg-success' : 'bg-danger' }}">{{ $total }} $</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- BOUTON PDF FICHE --}}
                                    <a href="{{ route('etudiant.fiche.pdf', $etudiant->id) }}" class="btn btn-warning btn-sm" title="Fiche PDF">📄 Fiche</a>
                                    
                                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    
                                    <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Supprimer cet étudiant ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucun étudiant enregistré</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection