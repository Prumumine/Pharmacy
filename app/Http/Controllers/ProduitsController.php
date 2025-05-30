<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Produits;
use Illuminate\View\View;

class ProduitsController extends Controller
{
    public function index(): View
    {
        $produits = Produits::all();
        return view ('produits.index')->with('produits', $produits);
    }

    public function create(): View
    {
        return view('produits.create');
    }

    // Exemple dans ProduitsController
public function store(Request $request)
{
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
        $produits= Produits::find($id);
        return view('produits.show')->with('produit', $produits);
    }

     public function edit(string $id): View  
    {
        $produits= Produits::find($id);
        return view('produits.edit')->with('produit', $produits);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $produits = Produits::find($id);
        $input = $request->all();
        $produits->update($input);
        return redirect('produits')->with('flash_message', 'Produit modifie');
    }

    public function destroy(string $id): RedirectResponse
    {
        Produits::destroy($id);
        return redirect('produits')->with('flash_message', 'Ce produit a ete supprimer avec succes');
    }

}
