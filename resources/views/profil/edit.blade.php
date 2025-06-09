@extends('layout')

@section('content')

<style>
    /* (ton style inchangé) */
    .form-container {
        max-width: 650px;
        margin: 0 auto;
        animation: fadeIn 0.6s ease-in-out;
    }

    .form-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
    }

    .btn-success, .btn-secondary {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        border-color: #0d6efd;
    }

    .preview-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #0d6efd;
        margin-top: 10px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container mt-5 form-container">
    <div class="card form-card">
        <div class="card-header bg-primary text-white">
            <h4><i class="fas fa-user-cog me-2"></i>Modifier mes informations</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ url('/profil/update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', Auth::user()->telephone ?? '') }}" class="form-control @error('telephone') is-invalid @enderror" placeholder="Entrez votre numéro de téléphone">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <input type="text" value="{{ Auth::user()->role }}" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo de profil</label>
                    <input type="file" name="photo" id="photoInput" class="form-control">
                   <img id="preview" src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-profile.png') }}" alt="Aperçu" class="preview-img">

                </div>

                <hr>
                <h5 class="mb-3"><i class="fas fa-lock me-2"></i>Modifier le mot de passe</h5>

                <div class="mb-3">
                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Laissez vide si vous ne changez pas le mot de passe">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Nouveau mot de passe">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirmez le nouveau mot de passe">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                    <a href="{{ url('/profil') }}" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const [file] = e.target.files;
        if (file) {
            document.getElementById('preview').src = URL.createObjectURL(file);
        }
    });
</script>

@endsection
