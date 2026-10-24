<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['nom', 'prenom', 'matricule', 'email', 'filiere_id', 'statut'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // TOTAL PAYE PAR L'ETUDIANT - COMPTE TOUT
    public function totalPaye()
    {
        return $this->paiements()->sum('montant');
    }

    // VALIDATION : 200$ MINIMUM
    public function inscriptionValidee()
    {
        return $this->totalPaye() >= 200;
    }
}