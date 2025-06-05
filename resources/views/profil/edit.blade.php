@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-user-cog me-2"></i>Modifier mes informations</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/profil/update') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" name="telephone" value="{{ Auth::user()->telephone }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <input type="text" value="{{ Auth::user()->role }}" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ url('/profil') }}" class="btn btn-secondary ms-2">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
