<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Produits;

class ProduitsController extends Controller
{
    public function index(Request $request): View
    {
        $query = Produits::query();

        // Gestion de la recherche
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%');
                  
            });
        }

        $produits = $query->paginate(10); 

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
            'description' => 'nullable|string',
            'categorie' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ordonnance_obligatoire' => 'nullable|boolean',
        ]);

        $data = [
            'nom' => $request->nom,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'ordonnance_obligatoire' => $request->has('ordonnance_obligatoire'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
            $data['image'] = $imagePath;
        }

        Produits::create($data);

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

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ordonnance_obligatoire' => 'nullable|boolean',
        ]);

        $data = [
            'nom' => $request->nom,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'ordonnance_obligatoire' => $request->has('ordonnance_obligatoire'),
        ];

        if ($request->hasFile('image')) {
            if ($produit->image && \Storage::disk('public')->exists($produit->image)) {
                \Storage::disk('public')->delete($produit->image);
            }

            $imagePath = $request->file('image')->store('produits', 'public');
            $data['image'] = $imagePath;
        }

        $produit->update($data);

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(string $id): RedirectResponse
    {
        if (auth()->user()->is_role != 1) {
            abort(403, 'Action non autorisée.');
        }

        $produit = Produits::findOrFail($id);

        if ($produit->image && \Storage::disk('public')->exists($produit->image)) {
            \Storage::disk('public')->delete($produit->image);
        }

        Produits::destroy($id);

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
