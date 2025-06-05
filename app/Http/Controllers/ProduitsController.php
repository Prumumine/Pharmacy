<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Produits;

class ProduitsController extends Controller
{
    public function index(): View
    {
        $produits = Produits::all();
        return view('produits.index', [
            'produits' => $produits,
            'isAdmin' => auth()->check() && auth()->user()->is_role == 1
        ]);
    }

    public function create(): View
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Accès non autorisé.');
        }

        return view('produits.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Action non autorisée.');
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Produits::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'description' => $request->description,
            'categorie' => $request->categorie,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function show(string $id): View
    {
        $produit = Produits::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    public function edit(string $id): View
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Accès non autorisé.');
        }

        $produit = Produits::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Action non autorisée.');
        }

        $produit = Produits::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Action non autorisée.');
        }

        Produits::destroy($id);
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
