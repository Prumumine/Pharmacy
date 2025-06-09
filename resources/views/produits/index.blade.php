@extends('layout')

@section('title', 'Liste des Produits')

@section('content')
<style>
    .search-bar {
        display: flex;
        align-items: center;
        max-width: 350px;
        margin-bottom: 20px;
        position: relative;
    }

    .search-bar input {
        border: 2px solid #198754;
        border-radius: 25px;
        padding: 8px 12px;
        width: 100%;
        outline: none;
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #198754;
    }

    .no-result {
        display: none;
        text-align: center;
        font-weight: bold;
        color: #888;
        margin-top: 20px;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success">Produits</h2>

        @if(Auth::check() && Auth::user()->is_role == 1)
            <a href="{{ route('produits.create') }}" class="btn btn-success">+ Ajouter un produit</a>
        @endif
    </div>

    <!-- Barre de recherche -->
    <div class="search-bar">
        <input type="text" id="recherche-produit" placeholder="Rechercher un produit...">
        <i class="fas fa-search search-icon"></i>
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
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix (FCFA)</th>
                        <th>Stock</th>
                        <th>Date d'ajout</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="liste-produits">
                    @foreach($produits as $produit)
                    <tr class="produit-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($produit->image)
                                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" width="60" height="60" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Aucune image</span>
                            @endif
                        </td>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->categorie }}</td>
                        <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>
                        <td>{{ $produit->stock }}</td>
                        <td>{{ $produit->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-primary">Voir</a>
                            @if(Auth::check() && Auth::user()->is_role == 1)
                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
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
            <div id="no-result" class="no-result">Aucun produit trouvé.</div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{-- {{ $produits->links() }} --}}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rechercheInput = document.getElementById('recherche-produit');
        const lignesProduits = document.querySelectorAll('.produit-row');
        const messageAucun = document.getElementById('no-result');

        rechercheInput.addEventListener('input', function () {
            const valeurRecherche = this.value.trim().toLowerCase();
            let nombreVisible = 0;

            lignesProduits.forEach(function (ligne) {
                const nom = ligne.querySelector('td:nth-child(3)').innerText.toLowerCase();
                const categorie = ligne.querySelector('td:nth-child(4)').innerText.toLowerCase();
                const correspond = nom.includes(valeurRecherche) || categorie.includes(valeurRecherche);

                ligne.style.display = correspond ? '' : 'none';
                if (correspond) nombreVisible++;
            });

            messageAucun.style.display = nombreVisible === 0 ? 'block' : 'none';
        });
    });
</script>
@endsection
