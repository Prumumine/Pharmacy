@extends('layout')

@section('title', 'Liste des clients')

@section('content')
<style>
    .search-bar {
        display: flex;
        align-items: center;
        max-width: 350px;
        margin-bottom: 20px;
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
        margin-left: -30px;
        color: #198754;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success">Clients</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-success">+ Ajouter un client</a>
    </div>

    <!-- Barre de recherche -->
    <div class="search-bar position-relative">
        <input type="text" id="recherche-client" placeholder="Rechercher un client...">
        <i class="fas fa-search search-icon"></i>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($clients->isEmpty())
        <div class="alert alert-info">
            Aucun client disponible pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro</th>
                        <th>Genre</th>
                        <th>Profession</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="liste-clients">
                    @foreach($clients as $client)
                    <tr class="client-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->prenom }}</td>
                        <td>{{ $client->numero }}</td>
                        <td>{{ $client->genre }}</td>
                        <td>{{ $client->profession }}</td>
                        <td>
                            
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rechercheInput = document.getElementById('recherche-client');
        const lignes = document.querySelectorAll('.client-row');

        rechercheInput.addEventListener('input', function () {
            const terme = this.value.trim().toLowerCase();
            lignes.forEach(row => {
                const colonnes = row.querySelectorAll('td');
                let visible = false;

                colonnes.forEach(cell => {
                    if (cell.textContent.trim().toLowerCase().startsWith(terme)) {
                        visible = true;
                    }
                });

                row.style.display = visible || terme === "" ? '' : 'none';
            });
        });
    });
</script>
@endsection
