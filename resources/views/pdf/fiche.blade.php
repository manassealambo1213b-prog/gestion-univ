<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{font-family:DejaVu Sans,sans-serif;font-size:12px}
.header{text-align:center;border:2px solid #000;padding:15px}
.box{border:1px solid #ccc;padding:15px;margin-top:15px}
table{width:100%;border-collapse:collapse}
th,td{padding:8px;border:1px solid #eee;text-align:left}
</style>
</head>
<body>
<div class="header"><h2>FICHE D'INSCRIPTION - 2025/2026</h2></div>

<div class="box">
<p><strong>Nom:</strong> {{ $etudiant->nom }} {{ $etudiant->postnom }} {{ $etudiant->prenom }}<br>
<strong>Matricule:</strong> {{ $etudiant->matricule }}<br>
<strong>Filière:</strong> {{ $etudiant->filiere->nom }} ({{ $etudiant->filiere->code }})<br>
<strong>Sexe:</strong> {{ $etudiant->sexe }}</p>
</div>

<div class="box">
<h3>Paiements</h3>
<table>
<tr style="background:#000;color:#fff"><th>Date</th><th>Motif</th><th>Montant</th><th>Référence</th></tr>
@foreach($etudiant->paiements as $p)
<tr>
<td>{{ $p->date_paiement }}</td>
<td>{{ $p->motif }}</td>
<td>{{ $p->montant }} $</td>
<td>{{ $p->reference }}</td>
</tr>
@endforeach
<tr style="font-weight:bold;background:#ffc107">
<td colspan="2">TOTAL</td>
<td colspan="2">{{ $total }} $</td>
</tr>
</table>
<p>Statut: {{ $total >= 200 ? 'VALIDÉ' : 'NON VALIDÉ - Reste '.(200-$total).' $' }}</p>
</div>

</body>
</html>