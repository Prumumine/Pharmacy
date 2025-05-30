<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmaciens extends Model
{

    protected $table = 'pharmaciens';
    protected $primaryKey = 'id';
    protected $fillable = ['nom','prenom','genre','poste'];
    
}
