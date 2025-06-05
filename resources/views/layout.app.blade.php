@php use App\Models\User; @endphp
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Pharmacie</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      margin: 0;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background-color: #198754; /* Vert Bootstrap */
      color: white;
      padding: 20px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 0;
    }
    .sidebar a:hover {
      background-color: #157347; /* Vert foncé Bootstrap */
      border-radius: 5px;
    }
    .content {
      flex: 1;
      padding: 20px;
      background-color: #f8f9fa;
    }
    .header {
      background-color: #198754;
      color: white;
      padding: 15px;
      text-align: center;
    }
  </style>
</head>
<body>


  <div class="sidebar">
    <h4 class="text-center">Menu</h4>
    @auth
        @if(Auth::user()->is_role == App\Models\User::ROLE_ADMIN)
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        @endif
    @endauth
       <a href="#">Profil</a>
    <a href="{{url('/produits')}}">Produits</a>
    <a href="{{url('/clients')}}">Clients</a>
    <form method="POST" action="{{ route('auth.logout') }}">
    @csrf
    <button type="submit" class="btn btn-link text-white p-0 m-0" style="text-decoration: none;">Déconnexion</button>
</form>

</form>

  </div>

 
  <div class="content">
    <div class="header">
      <h2>Application de Gestion de Pharmacie</h2>
    </div>

    <div class="mt-4">
      @yield('content')
    </div>
  </div>

</body>
</html>
