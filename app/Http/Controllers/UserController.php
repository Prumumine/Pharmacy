<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Méthode pour afficher la page des pharmaciens
    public function pharmaciens()
    {
        return view('pharmaciens.index');
    }

    // Méthode index réservée aux admins
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        $users = User::all();

        return view('user.index', compact('users'));
    }

    // Affiche le formulaire d'édition du profil (pour l'user connecté)
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Met à jour le profil de l'user connecté, avec gestion de la photo
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048', // max 2Mo, adapte si besoin
        ]);

        if ($request->hasFile('photo')) {
            // Supprimer ancienne photo si existe
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            // Stocker la nouvelle photo dans 'photos' dans le disque public
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        // Mise à jour des autres champs
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->save();

        return redirect()->route('profil.show')->with('success', 'Profil mis à jour avec succès.');
    }

    // Affiche le profil (pour que la route profil.show pointe ici)
    public function show()
    {
        $user = Auth::user();
        return view('user.show', compact('user'));
    }
}
