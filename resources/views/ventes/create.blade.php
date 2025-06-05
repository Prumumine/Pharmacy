@extends('layout')

@section('content')
<div class="container">
    <h1>Nouvelle vente</h1>

    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="produit_id">Produit</label>
            <select name="produit_id" class="form-control" required>
                <option value="">-- Choisir --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                        {{ $produit->nom }} ({{ $produit->prix }} FCFA, Stock: {{ $produit->stock }})
                    </option>
                @endforeach
            </select>
            @error('produit_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="client_id">Client</label>
            <select name="client_id" class="form-control" required>
                <option value="">-- Choisir --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" class="form-control" min="1" value="{{ old('quantite') }}" required>
            @error('quantite')
                <div class="text-danger">{{ $message }}</div>  <!-- Affichage message d'erreur ici -->
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Valider</button>
    </form>
</div>
@endsection
