<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'is_role' => 'required|in:' . User::ROLE_ADMIN . ',' . User::ROLE_PHARMACIEN . ',' . User::ROLE_UTILISATEUR,
        ]);

        $user->update(['is_role' => $request->is_role]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    public function valider($id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = 'validee';
    $commande->save();

    return redirect()->back()->with('success', 'Commande validée.');
}

public function refuser($id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = 'refusee';
    $commande->save();

    return redirect()->back()->with('success', 'Commande refusée.');
}

}
