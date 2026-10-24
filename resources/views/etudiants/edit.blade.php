<!DOCTYPE html>
<html>
<head><title>Modifier Étudiant</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<h1>Modifier Étudiant</h1>
<form action="{{route('etudiants.update',$etudiant->id)}}" method="POST">
@csrf @method('PUT')
<div class="mb-3"><label>Nom</label><input type="text" name="nom" value="{{$etudiant->nom}}" class="form-control" required></div>
<div class="mb-3"><label>Prénom</label><input type="text" name="prenom" value="{{$etudiant->prenom}}" class="form-control" required></div>
<div class="mb-3"><label>Email</label><input type="email" name="email" value="{{$etudiant->email}}" class="form-control" required></div>
<div class="mb-3"><label>Matricule</label><input type="text" name="matricule" value="{{$etudiant->matricule}}" class="form-control" required></div>
<div class="mb-3"><label>Filière</label>
<select name="filiere_id" class="form-control">
@foreach($filieres as $f)
<option value="{{$f->id}}" @if($f->id==$etudiant->filiere_id) selected @endif>{{$f->nom}}</option>
@endforeach
</select>
</div>
<button class="btn btn-warning">Modifier</button>
<a href="{{route('etudiants.index')}}" class="btn btn-secondary">Retour</a>
</form>
</body>
</html>