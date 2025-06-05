<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function edit() {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // Ajoute validation mot de passe ou photo si tu veux
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profil.index')->with('success', 'Profil mis à jour !');
    }
}
