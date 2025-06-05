<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Méthode qui affiche la vue des pharmaciens
    public function pharmaciens()
    {
        return view('pharmaciens.index');
    }

    // Méthode qui affiche la liste des utilisateurs (avec contrôle d'accès admin)
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        $users = User::all();

        return view('user.index', compact('users'));
    }
}
