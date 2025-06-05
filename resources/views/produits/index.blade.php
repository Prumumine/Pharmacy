@extends('layout')

@section('title', 'Liste des Produits')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success">Produits</h2>

        @if(Auth::check() && Auth::user()->is_role == 1)
            <a href="{{ route('produits.create') }}" class="btn btn-success">+ Ajouter un produit</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($produits->isEmpty())
        <div class="alert alert-info">
            Aucun produit disponible pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix (FCFA)</th>
                        <th>Stock</th>
                        <th>Date d'ajout</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->categorie }}</td>
                        <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>
                        <td>{{ $produit->stock }}</td>
                        <td>{{ $produit->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-primary">Voir</a>

                            @if(Auth::check() && Auth::user()->is_role == 1)
                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination (si nécessaire, à activer dans le contrôleur avec paginate()) -->
        <div class="d-flex justify-content-center">
            {{-- {{ $produits->links() }} --}}
        </div>
    @endif
</div>
@endsection
