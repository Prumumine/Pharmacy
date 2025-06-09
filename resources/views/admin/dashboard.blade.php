@auth
    @if(Auth::user()->is_role === App\Models\User::ROLE_ADMIN)
        <a href="{{ route('suivis.index') }}">Tableau de bord</a>
        <a href="{{ route('pharmaciens.index') }}">Pharmacien</a>
        <a href="{{ route('ventes.index') }}">Ventes</a>
        <a href="{{ route('clients.index') }}">Clients</a>
        <a href="{{ route('user.index') }}">Utilisateurs</a>
    @endif
@endauth
