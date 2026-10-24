<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Liste {{ $filiere->code }}</title></head>
<body style="font-family: sans-serif; font-size:12px;">
<h2 style="text-align:center">UNIVERSITÉ - GESTION UNIV</h2>
<h3 style="text-align:center">Liste des Inscrits - {{ $filiere->nom }} ({{ $filiere->code }})</h3>
<p>Date: {{ date('d/m/Y') }} | Total: {{ $etudiants->count() }} étudiants</p>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
<tr style="background:#000;color:#fff">
<th>#</th><th>Matricule</th><th>Nom Complet</th><th>Sexe</th><th>Total Payé</th>
</tr>
@foreach($etudiants as $i => $etudiant)
<tr>
<td>{{ $i+1 }}</td>
<td>{{ $etudiant->matricule }}</td>
<td>{{ $etudiant->nom }} {{ $etudiant->postnom }} {{ $etudiant->prenom }}</td>
<td>{{ $etudiant->sexe }}</td>
<td>{{ $etudiant->paiements->sum('montant') }} $</td>
</tr>
@endforeach
</table>
</body>
</html>