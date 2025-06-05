@extends('layout')

@section('title', 'Détails du Produit')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Détails du produit : {{ $produit->nom }}</h4>
            <a href="{{ route('produits.index') }}" class="btn btn-light btn-sm">← Retour à la liste</a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-muted">Nom du produit</h5>
                    <p class="fs-5">{{ $produit->nom }}</p>

                    <h5 class="text-muted mt-4">Catégorie</h5>
                    <p class="fs-5">{{ $produit->categorie }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="text-muted">Prix</h5>
                    <p class="fs-5">{{ number_format($produit->prix, 2) }} FCFA</p>

                    <h5 class="text-muted mt-4">Quantité en stock</h5>
                    <p class="fs-5">{{ $produit->stock }} unités</p>
                </div>

                <div class="col-12">
                    <h5 class="text-muted">Description</h5>
                    <p class="fs-6">{{ $produit->description ?: 'Aucune description disponible.' }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-end">
            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning me-2">Modifier</a>
            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
