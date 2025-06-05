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

        // Admin voit tout
        if ($user->role === 'admin') {
            $commandes = Commande::with('produit', 'user')->latest()->get();
        } else {
            // Client voit seulement ses commandes
            $commandes = Commande::with('produit')->where('user_id', $user->id)->latest()->get();
        }

        return view('commande.index', compact('commandes'));
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
            'quantite' => 'required|integer|min:1',
        ]);

        Commande::create([
            'user_id' => Auth::id(),
            'produit_id' => $request->produit_id,
            'quantite' => $request->quantite,
        ]);

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');
    }
}