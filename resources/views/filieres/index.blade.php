@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Liste des Filières / Promotions</h3>
        <a href="{{ route('filieres.create') }}" class="btn btn-warning">+ Nouvelle Filière</a>
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
                            <th>Code</th>
                            <th>Nom de la Filière</th>
                            <th>Nbre Étudiants</th>
                            <th style="width:280px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($filieres as $i => $filiere)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $filiere->code }}</span></td>
                            <td class="fw-bold">{{ $filiere->nom }}</td>
                            <td>
                                <span class="badge bg-info">{{ $filiere->etudiants_count ?? $filiere->etudiants->count() }} inscrits</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- BOUTON PDF LISTE PAR PROMOTION --}}
                                    <a href="{{ route('filiere.liste.pdf', $filiere->id) }}" class="btn btn-dark btn-sm" title="Imprimer la liste">📄 Liste PDF</a>

                                    <a href="{{ route('filieres.edit', $filiere->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" onsubmit="return confirm('Supprimer cette filière ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Aucune filière enregistrée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection