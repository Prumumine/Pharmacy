@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Liste des Commandes</h2>

    {{-- Vue pour les utilisateurs normaux --}}
    @if(Auth::user()->role === 'client')
        <a href="{{ route('commandes.create') }}" class="btn btn-success mb-3">Passer une commande</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Statut</th>
                    <th>Ordonnance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    @if($commande->user_id === Auth::id())
                    <tr>
                        <td>{{ $commande->produit->nom }}</td>
                        <td>{{ $commande->quantite }}</td>
                        <td>
                            @if($commande->statut === 'validee')
                                <span class="badge bg-success">Validée</span>
                            @elseif($commande->statut === 'rejettee')
                                <span class="badge bg-danger">Rejetée</span>
                            @else
                                <span class="badge bg-warning text-dark">En attente</span>
                            @endif
                        </td>
                        <td>
                            @if($commande->ordonnance_pdf)
                                <a href="{{ asset('storage/' . $commande->ordonnance_pdf) }}" target="_blank" class="btn btn-sm btn-primary">Voir PDF</a>
                            @else
                                <em>Aucune</em>
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Vue pour les administrateurs --}}
    @if(Auth::user()->role === 'admin')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Utilisateur</th>
                    <th>Quantité</th>
                    <th>Statut</th>
                    <th>Ordonnance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->produit->nom }}</td>
                    <td>{{ $commande->user->name }}</td>
                    <td>{{ $commande->quantite }}</td>
                    <td>
                        @if($commande->statut === 'validee')
                            <span class="badge bg-success">Validée</span>
                        @elseif($commande->statut === 'rejettee')
                            <span class="badge bg-danger">Rejetée</span>
                        @else
                            <span class="badge bg-warning text-dark">En attente</span>
                        @endif
                    </td>
                    <td>
                        @if($commande->ordonnance_pdf)
                            <a href="{{ asset('storage/' . $commande->ordonnance_pdf) }}" target="_blank" class="btn btn-sm btn-primary">Voir PDF</a>
                        @else
                            <em>Aucune</em>
                        @endif
                    </td>
                    <td>
                        @if($commande->statut === 'en_attente')
                            <form action="{{ route('commandes.valider', $commande->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmez-vous la validation de cette commande ?')">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </form>

                            <form action="{{ route('commandes.refuser', $commande->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmez-vous le rejet de cette commande ?')">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                            </form>
                        @else
                            <em>Aucune action</em>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
