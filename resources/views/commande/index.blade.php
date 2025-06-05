@extends('layout')

@section('content')
    <h1>Liste des commandes</h1>

    @if(auth()->user()->is_role === '3')
        <a href="{{ route('commandes.create') }}" class="btn btn-primary mb-3">Passer une commande</a>
    @endif

    @foreach($commandes as $commande)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Produit :</strong> {{ $commande->produit->nom ?? 'Non défini' }}<br>
                <strong>Quantité :</strong> {{ $commande->quantite }}<br>

                @if(auth()->user()->is_role === '1')
                    <strong>Client :</strong> {{ $commande->user->name ?? 'Inconnu' }}
                @endif
            </div>
        </div>
    @endforeach
@endsection
