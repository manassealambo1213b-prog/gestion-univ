<!DOCTYPE html><html><head><title>Ajouter Filière</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="container mt-4">
<h1>Nouvelle Filière</h1>
<form action="{{route('filieres.store')}}" method="POST">@csrf
<div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
<div class="mb-3"><label>Code (ex: L1-INFO)</label><input type="text" name="code" class="form-control" required></div>
<div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
<button class="btn btn-success">Enregistrer</button>
<a href="{{route('filieres.index')}}" class="btn btn-secondary">Retour</a>
</form></body></html>