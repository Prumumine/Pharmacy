<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{

    protected $table = 'produits';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','prix','stock' ,'categorie', 'image', 'ordonnance_obligatoire'];

     public function ventes()
    {
        return $this->hasMany(Vente::class);
    }


    
}
