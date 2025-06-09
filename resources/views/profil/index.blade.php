@extends('layout')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
        animation: fadeInUp 1s ease;
    }

    .profile-card {
        background: linear-gradient(145deg, #f0f0f0, #ffffff);
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .profile-photo {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #0d6efd;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .profile-photo:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px rgba(13, 110, 253, 0.5);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .profile-info {
        color: #666;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .profile-btn {
        padding: 10px 25px;
        font-size: 1rem;
        border-radius: 25px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .profile-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .badge-role {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 12px;
        background-color: #28a745;
        color: white;
    }

    @keyframes fadeInUp {
        0% {
            transform: translateY(50px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="container mt-5 profile-container">
    <div class="card profile-card text-center p-4">
        {{-- IMAGE DE PROFIL --}}
        @php
            $photoPath = Auth::user()->photo ? 'storage/' . Auth::user()->photo : 'images/default-profile.png';
        @endphp
        <img src="{{ asset($photoPath) }}" alt="Photo de profil" class="profile-photo mx-auto mb-3">

        <h3 class="profile-name">{{ Auth::user()->name }}</h3>
        <p class="profile-info">{{ Auth::user()->email }}</p>

        <p>
            <i class="fas fa-phone-alt me-2"></i>
            {{ trim(Auth::user()->telephone) !== '' ? Auth::user()->telephone : 'Non renseigné' }}
        </p>

        <p><strong>Rôle :</strong> <span class="badge-role">{{ Auth::user()->role }}</span></p>

        <a href="{{ url('/profil/editer') }}" class="btn btn-primary profile-btn mt-3">
            <i class="fas fa-user-edit me-1"></i> Modifier le profil
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const card = document.querySelector('.profile-card');
        card.style.opacity = 0;
        card.style.transform = 'scale(0.9)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = 1;
            card.style.transform = 'scale(1)';
        }, 200);
    });
</script>
@endsection
