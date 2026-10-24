<!DOCTYPE html><html><head><title>Modifier</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="container mt-4">
<h1>Modifier Filière</h1>
<form action="{{route('filieres.update',$filiere->id)}}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Nom</label><input type="text" name="nom" value="{{$filiere->nom}}" class="form-control" required></div>
<div class="mb-3"><label>Code</label><input type="text" name="code" value="{{$filiere->code}}" class="form-control" required></div>
<div class="mb-3"><label>Description</label><textarea name="description" class="form-control">{{$filiere->description}}</textarea></div>
<button class="btn btn-success">Mettre à jour</button>
<a href="{{route('filieres.index')}}" class="btn btn-secondary">Retour</a>
</form></body></html>