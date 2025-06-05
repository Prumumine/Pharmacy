<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produits;
use App\Models\Clients;

class Vente extends Model
{
    protected $fillable = ['produit_id', 'client_id', 'quantite', 'prix_total'];

    // Relation vers Produit (singulier)
    public function produit()
    {
        return $this->belongsTo(Produits::class);
    }

    // Relation vers Client (singulier)
    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
