@extends('layout')

@section('content')
<div class="container">
    <h1>Liste des ventes</h1>
    <a href="{{ route('ventes.create') }}" class="btn btn-primary mb-3">Nouvelle vente</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Client</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventes as $vente)
            <tr>
                <td>{{ $vente->produit->nom ?? 'Produit introuvable' }}</td>
<td>{{ $vente->client->nom ?? 'Client introuvable' }}</td>

                <td>{{ $vente->quantite }}</td>
                <td>{{ $vente->prix_total }} FCFA</td>
                <td>
                    <form action="{{ route('ventes.destroy', $vente) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
