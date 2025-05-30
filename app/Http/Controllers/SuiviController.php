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

        $ventes = Vente::selectRaw('DATE(created_at) as date, SUM(quantite) as total')
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();

        $labels = $ventes->pluck('date')->toArray();
        $donneesVentes = $ventes->pluck('total')->toArray();

        $alertes = Produits::where('stock', '<', 5)->pluck('nom')->map(function($nom) {
            return "Stock faible pour le produit : $nom";
        });

        $suivis = Suivi::latest()->take(10)->get();

        return view('suivis.index', compact(
            'totalProduits',
            'totalVentes',
            'totalClients',
            'labels',
            'donneesVentes',
            'alertes',
            'suivis'
        ));
    }
}
