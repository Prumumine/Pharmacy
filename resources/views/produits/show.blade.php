@extends('layout')

@section('title', 'Détails du produit pharmaceutique')

@section('content')
<style>
  .produit-detail-container {
    max-width: 850px;
    margin: 60px auto;
    padding: 2rem;
    background: #fefefe;
    border-radius: 15px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 2.5rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .produit-image-wrapper {
    flex: 1;
    max-width: 320px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,123,255,0.15);
    transition: box-shadow 0.3s ease;
    cursor: pointer;
  }
  .produit-image-wrapper:hover {
    box-shadow: 0 15px 40px rgba(0,123,255,0.35);
  }
  .produit-image-wrapper img {
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
    transition: transform 0.4s ease;
    border-radius: 15px;
  }
  .produit-image-wrapper:hover img {
    transform: scale(1.07);
  }

  .produit-info {
    flex: 1.4;
    display: flex;
    flex-direction: column;
  }

  .produit-info h1 {
    font-size: 2.4rem;
    font-weight: 800;
    color: #007bff;
    margin-bottom: 0.6rem;
  }

  .badge-categorie {
    display: inline-block;
    padding: 6px 18px;
    background: #17a2b8;
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 40px;
    margin-bottom: 1.6rem;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
  }

  .details-list {
    font-size: 1.12rem;
    color: #444;
    margin-bottom: 1.8rem;
    line-height: 1.65;
  }
  .details-list p {
    margin: 0.7rem 0;
  }
  .details-list strong {
    color: #0056b3;
  }

  .description-box {
    background: #e9f5ff;
    border-left: 6px solid #007bff;
    padding: 1.3rem 1.6rem;
    border-radius: 12px;
    font-size: 1.05rem;
    color: #222;
    line-height: 1.6;
    margin-bottom: 2rem;
    font-style: italic;
  }

  .button-group {
    display: flex;
    gap: 1.4rem;
  }
  .btn-custom {
    flex: 1;
    padding: 13px 0;
    font-size: 1.15rem;
    font-weight: 700;
    border-radius: 50px;
    text-align: center;
    cursor: pointer;
    user-select: none;
    text-decoration: none;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }
  .btn-edit {
    background-color: #ffc107;
    color: #222;
    box-shadow: 0 5px 12px rgba(255, 193, 7, 0.3);
  }
  .btn-edit:hover {
    background-color: #e0a800;
    box-shadow: 0 8px 22px rgba(224, 168, 0, 0.5);
    color: #fff;
  }
  .btn-back {
    border: 2px solid #007bff;
    background: transparent;
    color: #007bff;
    box-shadow: 0 5px 12px rgba(0, 123, 255, 0.25);
  }
  .btn-back:hover {
    background-color: #007bff;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0, 123, 255, 0.55);
  }

  /* Responsive */
  @media (max-width: 720px) {
    .produit-detail-container {
      flex-direction: column;
      padding: 1.5rem;
    }
    .produit-image-wrapper {
      max-width: 100%;
      margin: 0 auto;
    }
    .produit-info h1 {
      text-align: center;
    }
    .badge-categorie {
      display: block;
      text-align: center;
      margin: 0 auto 1.8rem;
    }
    .button-group {
      flex-direction: column;
    }
    .btn-custom {
      width: 100%;
    }
  }
</style>

<div class="produit-detail-container">
  <div class="produit-image-wrapper" title="Voir l'image en zoom léger">
    @if($produit->image)
      <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit {{ $produit->nom }}" loading="lazy" />
    @else
      <img src="{{ asset('images/produits/default.png') }}" alt="Image par défaut" loading="lazy" />
    @endif
  </div>

  <div class="produit-info">
    <h1>{{ $produit->nom }}</h1>

    @if($produit->categorie)
      <span class="badge-categorie">{{ $produit->categorie }}</span>
    @endif

    <div class="details-list">
      <p><strong>Prix unitaire :</strong> {{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
      <p><strong>Quantité en stock :</strong> {{ $produit->stock }}</p>
      <p><strong>Categorie</strong> {{ $produit->categorie ?? 'Non précisé' }}</p>
    </div>

    <div class="description-box">
      {!! nl2br(e($produit->description ?? 'Aucune description disponible.')) !!}
    </div>

    <div class="button-group">
      <a href="{{ route('produits.edit', $produit->id) }}" class="btn-custom btn-edit">
        <i class="bi bi-pencil-square"></i> Modifier
      </a>
      <a href="{{ route('produits.index') }}" class="btn-custom btn-back">
        <i class="bi bi-arrow-left-circle"></i> Retour à la liste
      </a>
    </div>
  </div>
</div>
@endsection
