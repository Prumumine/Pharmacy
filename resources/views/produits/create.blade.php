@extends('layout')

@section('title', 'Ajouter un Produit Pharmaceutique')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Ajouter un nouveau produit pharmaceutique</h4>
        </div>
        <div class="card-body">
            <!-- Affichage des erreurs de validation -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire d'ajout -->
            <form action="{{ route('produits.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Nom du produit -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du produit</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Ex : Paracétamol" required>
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie') }}" placeholder="Ex : Analgésique" required>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description du produit">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <!-- Prix -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (en FCFA)</label>
                            <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix') }}" placeholder="Ex : 1500" step="0.01" min="0" required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="stock" class="form-label">Quantité en stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" placeholder="Ex : 100" min="0" required>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('produits.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
