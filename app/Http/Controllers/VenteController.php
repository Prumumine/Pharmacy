<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $ventes = \App\Models\Vente::with('produit')->latest()->get();
    return view('ventes.index', compact('ventes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
    ]);

    $produit = \App\Models\Produit::find($request->produit_id);
    $prix_total = $produit->prix * $request->quantite;

    \App\Models\Vente::create([
        'produit_id' => $produit->id,
        'quantite' => $request->quantite,
        'prix_total' => $prix_total,
    ]);

    return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
