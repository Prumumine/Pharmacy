<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produit_id', 'quantite' , 'ordonnance_pdf'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function produit() {
        return $this->belongsTo(Produits::class);
    }
}