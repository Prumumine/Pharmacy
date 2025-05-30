@extends('layout')

@section('title', 'Nouvelle Vente')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 text-success">Nouvelle Vente</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ventes.store') }}" method="POST" class="card card-body shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit</label>
            <select name="produit_id" id="produit_id" class="form-select" required>
                <option value="">-- Choisir un produit --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ $produit->prix }} F)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer la vente</button>
        <a href="{{ route('ventes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
