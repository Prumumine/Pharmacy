@extends('layout')

@section('title', 'Liste des Pharmaciens')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success mb-0">Liste des Pharmaciens</h2>
        <a href="{{ route('pharmaciens.create') }}" class="btn btn-success">+ Ajouter un Pharmacien</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pharmaciens->isEmpty())
        <div class="alert alert-info text-center">
            Aucun pharmacien enregistré pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th>Poste</th>
                        <th>Actions</th> <!-- Colonne ajoutée ici -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($pharmaciens as $pharmacien)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pharmacien->nom }}</td>
                        <td>{{ $pharmacien->prenom }}</td>
                        <td>{{ $pharmacien->genre }}</td>
                        <td>{{ $pharmacien->poste }}</td>
                        <td>
                            <a href="{{ route('pharmaciens.show', $pharmacien->id) }}" class="btn btn-sm btn-primary me-1">Voir</a>
                            <a href="{{ route('pharmaciens.edit', $pharmacien->id) }}" class="btn btn-sm btn-warning me-1">Modifier</a>
                            <form action="{{ route('pharmaciens.destroy', $pharmacien->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce pharmacien ?')">
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
