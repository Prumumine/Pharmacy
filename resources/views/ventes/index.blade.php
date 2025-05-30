@extends('layout')

@section('title', 'Liste des Ventes')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-success">Ventes</h2>
        <a href="{{ route('ventes.create') }}" class="btn btn-success">+ Ajouter une vente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($ventes->isEmpty())
        <div class="alert alert-info">
            Aucune vente enregistrée pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix total (F)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventes as $vente)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vente->produit->nom }}</td>
                        <td>{{ $vente->quantite }}</td>
                        <td>{{ number_format($vente->prix_total, 0, ',', ' ') }}</td>
                        <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
