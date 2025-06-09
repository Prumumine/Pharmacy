<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'telephone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telephone = $request->telephone;

        if ($request->filled('new_password')) {
            // Vérifie que le mot de passe actuel est correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                    ->withInput();
            }

            // Met à jour le nouveau mot de passe
            $user->password = Hash::make($request->new_password);
        }

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Supprimer l'ancienne photo si elle existe
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Stocker la nouvelle photo dans storage/app/public/photos
            $path = $photo->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('profil.index')->with('success', 'Profil mis à jour !');
    }
}
