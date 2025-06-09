@extends('layout')

@section('title', 'Modifier un client ')

@section('content')
<div class="container my-5">
    <div class="card border-0 shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🧪 Modifier un client</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('clients.update', $clients->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $clients->nom) }}" placeholder="Ex : Traoré" required>
                            @error('nom')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $clients->prenom) }}" placeholder="Ex : Fatoumata" required>
                            @error('prenom')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Numéro -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numéro</label>
                            <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $clients->numero) }}" placeholder="Ex : 70XXXXXX" required>
                            @error('numero')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Genre -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select name="genre" id="genre" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="Masculin" {{ old('genre', $clients->genre) == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                <option value="Féminin" {{ old('genre', $clients->genre) == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('genre')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Profession -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession', $clients->profession) }}" placeholder="Ex : Enseignant, Étudiant..." required>
                            @error('profession')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
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
