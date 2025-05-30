@extends('layout')

@section('title', 'Liste des clients')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success">Clients</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-success">+ Ajouter un client</a>
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
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->prenom }}</td>
                        <td>{{ $client->numero }}</td>
                        <td>{{ $client->genre }}</td>
                        <td>{{ $client->profession }}</td>
                        <td>
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-primary">Voir</a>
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
@endsection
