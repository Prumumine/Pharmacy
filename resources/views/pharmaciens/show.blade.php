@extends('layout')

@section('title', 'Détails du pharmaciens')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Détails du pharmacien : {{ $pharmaciens->nom }}</h4>
            <a href="{{ route('pharmaciens.index') }}" class="btn btn-light btn-sm">← Retour à la liste</a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-muted">Nom du pharmaciens</h5>
                    <p class="fs-5">{{ $pharmaciens->nom }}</p>

                    <h5 class="text-muted mt-4">Prenom du pharmacien</h5>
                    <p class="fs-5">{{ $pharmaciens->prenom }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="text-muted">Genre</h5>
                    <p class="fs-5">{{ $pharmaciens->genre }}</p>

                    <h5 class="text-muted mt-4">Poste</h5>
                    <p class="fs-5">{{ $pharmaciens->poste }}</p>
                </div>


               
        </div>

        <div class="card-footer bg-light text-end">
            <a href="{{ route('pharmaciens.edit', $pharmaciens->id) }}" class="btn btn-warning me-2">Modifier</a>
            <form action="{{ route('pharmaciens.destroy', $pharmaciens->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
