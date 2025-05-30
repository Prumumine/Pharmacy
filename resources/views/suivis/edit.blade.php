@extends('layout')

@section('title', 'Modifier un produit pharmaceutique')

@section('content')
<div class="container my-5">
    <div class="card border-0 shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🧪 Modifier un médicament ou produit de santé</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $produit->nom) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie (Ex : Antibiotique, Antalgique...)</label>
                        <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie', $produit->categorie) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="prix" class="form-label">Prix unitaire (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $produit->prix) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="stock" class="form-label">Quantité en stock <span class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $produit->stock) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="description" class="form-label">Forme / Détail (Ex : comprimé, sirop...)</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $produit->description) }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Retour à la liste
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save2"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
