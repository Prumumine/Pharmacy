@extends('layout')

@section('title', 'Pharmaciens')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Personnel</h4>
        </div>
        <div class="card-body">
            <!-- Affichage des erreurs globales -->
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
            <form action="{{ route('pharmaciens.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Nom -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Ex : Traoré" required>
                            @error('nom')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Prénom -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" placeholder="Ex : Fatoumata" required>
                            @error('prenom')
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
                                <option value="Masculin" {{ old('genre') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                <option value="Féminin" {{ old('genre') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('genre')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Poste -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="poste" class="form-label">Poste</label>
                            <input type="text" name="poste" id="poste" class="form-control" value="{{ old('poste') }}" placeholder="Ex : Pharmacien" required>
                            @error('poste')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pharmaciens.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
