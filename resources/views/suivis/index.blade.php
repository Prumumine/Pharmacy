@extends('layout')

@section('title', 'Tableau de bord')

@section('content')
<div class="container-fluid mt-4">

    <!-- Statistiques globales -->
    <div class="row text-white">
        <div class="col-md-3">
            <div class="card bg-primary shadow">
                <div class="card-body">
                    <h5>Total Produits</h5>
                    <h3>{{ $totalProduits }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success shadow">
                <div class="card-body">
                    <h5>Total Ventes</h5>
                    <h3>{{ $totalVentes }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning shadow">
                <div class="card-body">
                    <h5>Total Clients</h5>
                    <h3>{{ $totalClients }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">Évolution des ventes</div>
                <div class="card-body">
                    <canvas id="ventesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Alertes -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">Alertes</div>
                <div class="card-body">
                    @forelse($alertes as $alerte)
                        <div class="alert alert-danger">
                            {{ $alerte }}
                        </div>
                    @empty
                        <div class="alert alert-success">Aucune alerte</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des suivis -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">Historique des actions</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suivis as $suivi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst($suivi->type) }}</td>
                                <td>{{ $suivi->description }}</td>
                                <td>{{ $suivi->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ventesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Ventes',
                data: {!! json_encode($donneesVentes) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3,
                fill: false
            }]
        }
    });
</script>
@endpush
