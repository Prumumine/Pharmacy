<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Produits;
use App\Models\Clients;

class VenteController extends Controller
{
    public function index()
    {
        // Charger les ventes avec les relations produit et client
        $ventes = Vente::with(['produit', 'client'])->get();
        return view('ventes.index', compact('ventes'));
    }

    public function create()
    {
        $produits = Produits::all();
        $clients = Clients::all();
        return view('ventes.create', compact('produits', 'clients'));
    }

    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'client_id' => 'required|exists:clients,id',
            'quantite' => 'required|integer|min:1',
        ]);

        // Récupérer le produit pour vérifier le stock
        $produit = Produits::findOrFail($request->produit_id);

        // Vérifier que la quantité demandée n'excède pas le stock
        if ($request->quantite > $produit->stock) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quantite' => 'La quantité demandée (' . $request->quantite . ') dépasse le stock disponible (' . $produit->stock . ').']);
        }

        // Calcul du prix total
        $prix_total = $produit->prix * $request->quantite;

        // Créer la vente
        Vente::create([
            'produit_id' => $request->produit_id,
            'client_id' => $request->client_id,
            'quantite' => $request->quantite,
            'prix_total' => $prix_total,
        ]);

        // Mettre à jour le stock du produit
        $produit->stock -= $request->quantite;
        $produit->save();

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
    }

    public function show(string $id)
    {
        $vente = Vente::with(['produit', 'client'])->findOrFail($id);
        return view('ventes.show', compact('vente'));
    }

    public function destroy(string $id)
    {
        Vente::destroy($id);
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }
}
