<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Univ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="d-flex">
    {{-- SIDEBAR --}}
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="text-center">GESTION UNIV</h4>
        <hr class="bg-white">
        <div class="d-grid gap-2">
            <a href="/dashboard" class="btn btn-outline-light text-start"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="/etudiants" class="btn btn-outline-light text-start"><i class="bi bi-people"></i> Étudiants</a>
            <a href="/filieres" class="btn btn-outline-light text-start"><i class="bi bi-book"></i> Filières</a>
            <a href="/paiements" class="btn btn-warning text-start"><i class="bi bi-cash-stack"></i> Paiements</a>
            <a href="/logout" class="btn btn-outline-danger text-start mt-5"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
        </div>
    </div>

    {{-- CONTENU PRINCIPAL --}}
    <div class="flex-grow-1 p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>