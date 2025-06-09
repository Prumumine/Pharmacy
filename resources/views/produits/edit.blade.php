@extends('layout')

@section('title', 'Modifier un produit pharmaceutique')

@section('content')

<style>
    .card {
        border-radius: 15px;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background: linear-gradient(45deg, #198754, #28a745);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .form-control {
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
    }

    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
    }

    .btn-success {
        background: linear-gradient(45deg, #198754, #28a745);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #157347, #1f9c5c);
        transform: scale(1.03);
    }

    .btn-outline-secondary {
        border-radius: 10px;
        padding: 10px 20px;
        transition: 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        transform: scale(1.02);
    }

    .img-thumbnail {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    label {
        font-weight: 600;
    }

    .required {
        color: red;
    }

</style>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header text-white">
            <h5 class="mb-0">🧪 Modifier un médicament</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom du produit <span class="required">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $produit->nom) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie (Ex : Antibiotique, Antalgique...)</label>
                        <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie', $produit->categorie) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="prix" class="form-label">Prix unitaire (FCFA) <span class="required">*</span></label>
                        <input type="number" name="prix" id="prix" class="form-control" value="{{ old('prix', $produit->prix) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="stock" class="form-label">Quantité en stock <span class="required">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $produit->stock) }}" required>
                    </div>
                    
                </div>

                <div class="mb-3">
                    <label for="description_longue" class="form-label">Description détaillée</label>
                    <textarea name="description_longue" id="description_longue" class="form-control" rows="4" placeholder="Informations supplémentaires sur le produit...">{{ old('description_longue', $produit->description_longue) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image du produit</label>
                    <input type="file" name="image" id="image" class="form-control">

                    @if($produit->image)
                        <div class="mt-2">
                            <p class="mb-1">Image actuelle :</p>
                            <img src="{{ asset('images/produits/' . $produit->image) }}" alt="Image actuelle" width="100" class="img-thumbnail">
                        </div>
                    @endif
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
