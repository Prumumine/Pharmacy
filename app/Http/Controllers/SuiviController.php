<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produits;
use App\Models\Vente;
use App\Models\Clients;
use App\Models\Suivi;

class SuiviController extends Controller
{
    public function index()
    {
        $totalProduits = Produits::count();
        $totalVentes = Vente::sum('quantite');
        $totalClients = Clients::count();

        $produitsEnAlerte = Produits::where('stock', '<', 5)->get(); // Collection d'objets Produits
        $alertes = $produitsEnAlerte->map(fn($p) => "Stock faible: {$p->nom}");
        $nombreAlertes = $produitsEnAlerte->count();

        $produitsDisponibles = Produits::where('stock', '>=', 5)->count();
        $suivis = Suivi::latest()->take(10)->get();

        $produits = Produits::all();
        $labels = $produits->pluck('nom')->toArray();
        $stocks = $produits->pluck('stock')->toArray();

        return view('suivis.index', compact(
            'totalProduits',
            'totalVentes',
            'totalClients',
            'produitsEnAlerte',
            'alertes',
            'nombreAlertes',
            'produitsDisponibles',
            'suivis',
            'labels',
            'stocks'
        ));
    }
}
