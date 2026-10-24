<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model {
    protected $fillable = ['etudiant_id','montant','motif','reference','date_paiement'];
    public function etudiant(){ return $this->belongsTo(Etudiant::class); }
}