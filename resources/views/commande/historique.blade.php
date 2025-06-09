@extends('layout')

@section('title', 'Historique des commandes')

@section('content')
<div class="container">
    <h2 class="mb-4">🕘 Historique & Suivi des Commandes</h2>

    @if($commandes->isEmpty())
        <div class="alert alert-info">Aucune commande trouvée.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Date</th>
                    <th>Statut</th>
                    @if(Auth::user()->is_role == 1)
                        <th>Client</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->produit->nom ?? 'Indisponible' }}</td>
                        <td>{{ $commande->quantite }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $commande->statut == 'validee' ? 'success' : (
                                    $commande->statut == 'rejettee' ? 'danger' : 'warning'
                                ) 
                            }}">
                                {{ ucfirst($commande->statut ?? 'en attente') }}
                            </span>
                        </td>
                        @if(Auth::user()->is_role == 1)
                            <td>{{ $commande->user->name ?? '-' }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
