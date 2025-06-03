<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = '1';
    const ROLE_PHARMACIEN = '2';
    const ROLE_UTILISATEUR = '3';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
