<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu {{ $paiement->id }}</title>
    <style>
        body{font-family:Arial; background:#f5f5f5; padding:20px}
        .page{max-width:750px; margin:20px auto; background:white; padding:40px; border:1px solid #ddd}
        .head{text-align:center; border-bottom:3px double #000; padding-bottom:20px; margin-bottom:30px}
        .head h1{margin:0; font-size:24px}
        .infos td{padding:10px; border-bottom:1px solid #eee}
        .montant{font-size:28px; font-weight:bold; text-align:center; background:#000; color:#fff; padding:15px; margin:25px 0}
        .tampon{border:4px solid #16a34a; color:#16a34a; padding:10px 25px; display:inline-block; transform:rotate(-12deg); font-weight:900; font-size:18px; margin-top:20px}
        .footer{display:flex; justify-content:space-between; margin-top:50px; text-align:center}
        @media print{ .no-print{display:none} body{background:white; padding:0} .page{border:none} }
    </style>
</head>
<body>
<div class="no-print" style="text-align:center; margin-bottom:15px">
    <button onclick="window.print()" style="padding:12px 25px; background:#2563eb; color:white; border:none; border-radius:5px; cursor:pointer; font-size:16px">🖨️ Imprimer / PDF</button>
    <a href="/paiements" style="padding:12px 25px; background:#6b7280; color:white; text-decoration:none; border-radius:5px; margin-left:10px">Retour</a>
</div>

<div class="page">
    <div class="head">
        <h1>UNIVERSITÉ - GESTION UNIV</h1>
        <p>Service Comptabilité & Inscriptions</p>
        <h2 style="margin-top:15px">REÇU DE PAIEMENT</h2>
    </div>

    <table class="infos" width="100%">
        <tr><td><strong>Reçu N°:</strong></td><td>{{ str_pad($paiement->id, 5, '0', STR_PAD_LEFT) }}</td><td><strong>Date:</strong></td><td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td></tr>
        <tr><td><strong>Étudiant:</strong></td><td colspan="3"><strong>{{ $paiement->etudiant->nom }} {{ $paiement->etudiant->prenom }}</strong></td></tr>
        <tr><td><strong>Matricule:</strong></td><td>{{ $paiement->etudiant->matricule }}</td><td><strong>Filière:</strong></td><td>{{ $paiement->etudiant->filiere->nom ?? '' }}</td></tr>
        <tr><td><strong>Motif:</strong></td><td colspan="3">{{ $paiement->motif }}</td></tr>
    </table>

    <div class="montant">MONTANT PAYÉ : {{ $paiement->montant }} $</div>

    <p><strong>Total déjà payé par l'étudiant:</strong> {{ $paiement->etudiant->totalPaye() }} $ / 200 $ 
    @if($paiement->etudiant->totalPaye() >= 200) <span style="color:green; font-weight:bold">→ DOSSIER VALIDÉ</span> @else <span style="color:red">→ Reste {{ 200 - $paiement->etudiant->totalPaye() }}$</span> @endif
    </p>

    <div class="footer">
        <div>Signature Étudiant</div>
        <div class="tampon">PAYÉ<br>GESTION UNIV</div>
        <div>Cachet & Signature<br>Service Comptabilité</div>
    </div>

    <p style="text-align:center; margin-top:40px; font-size:12px; color:#666">Merci pour votre paiement. Conservez ce reçu précieusement.</p>
</div>
</body>
</html>