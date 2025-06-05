@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Mes Commandes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->isEmpty())
        <p>Aucune commande trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    @if(Auth::user()->is_role === '1')
                        <th>Client</th>
                    @endif
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    @if(Auth::user()->is_role === '1')
                        <td>{{ $commande->user->name }}</td>
                    @endif
                    <td>{{ $commande->produit->nom }}</td>
                    <td>{{ $commande->quantite }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y à H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
