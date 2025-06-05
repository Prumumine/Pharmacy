@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-body text-center">
            <img src="{{ Auth::user()->photo ?? asset('images/default-profile.png') }}" alt="Photo de profil" class="rounded-circle mb-3" width="120" height="120">
            <h3 class="card-title">{{ Auth::user()->name }}</h3>
            <p class="text-muted">{{ Auth::user()->email }}</p>
            <p><i class="fas fa-phone-alt me-2"></i>{{ Auth::user()->telephone ?? 'Non renseigné' }}</p>
            <p><strong>Rôle :</strong> 
                <span class="badge bg-success">{{ Auth::user()->role }}</span>
            </p>

            <a href="{{ url('/profil/editer') }}" class="btn btn-primary mt-3">
                <i class="fas fa-user-edit me-1"></i> Modifier le profil
            </a>
        </div>
    </div>
</div>
@endsection
