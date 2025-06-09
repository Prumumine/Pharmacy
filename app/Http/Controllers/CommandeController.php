<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_role == 1) {
            $commandes = Commande::with('produit', 'user')->latest()->get();
        } else {
            $commandes = Commande::with('produit')->where('user_id', $user->id)->latest()->get();
        }

        return view('commande.index', compact('commandes'));

        return redirect()->route('commandes.index')->with('success', 'Commande ' . $request->statut . ' avec succès.');

    }

    public function create()
    {
        $produits = Produits::all();
        return view('commande.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
        ]);

        $produit = Produits::findOrFail($request->produit_id);

        $rules = [
            'quantite' => 'required|integer|min:1',
        ];

        if ($produit->ordonnance_oligatoire) {
            $rules['ordonnance_pdf'] = 'required|file|mimes:pdf|max:2048';
        } else {
            $rules['ordonnance_pdf'] = 'nullable|file|mimes:pdf|max:2048';
        }

        $request->validate($rules);

        $commande = new Commande();
        $commande->user_id = Auth::id();
        $commande->produit_id = $request->produit_id;
        $commande->quantite = $request->quantite;

        if ($request->hasFile('ordonnance_pdf')) {
            $path = $request->file('ordonnance_pdf')->store('ordonnances', 'public');
            $commande->ordonnance_pdf = $path;
        }

        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');
    }

    public function valider($id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = 'validee';
    $commande->save();

    return redirect()->route('commandes.index')->with('success', 'Commande validée avec succès.');
}

public function refuser($id)
{
    $commande = Commande::findOrFail($id);
    $commande->statut = 'rejettee';
    $commande->save();

    return redirect()->route('commandes.index')->with('success', 'Commande rejetée avec succès.');
}

public function historique()
{
    $user = Auth::user();

    if ($user->is_role == 1) {
        $commandes = Commande::with('produit', 'user')->latest()->get();
    } else {
        $commandes = Commande::with('produit')->where('user_id', $user->id)->latest()->get();
    }

    return view('commande.historique', compact('commandes'));
}


}
