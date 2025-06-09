@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bold text-primary">Suivis Pharmacie</h1>

    <!-- Statistiques principales -->
    <div class="row mb-5 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-primary text-white rounded">
                    <h6 class="card-subtitle mb-2 text-uppercase">Produits</h6>
                    <h3 class="card-title">{{ $totalProduits }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-success text-white rounded">
                    <h6 class="card-subtitle mb-2 text-uppercase">Clients</h6>
                    <h3 class="card-title">{{ $totalClients }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-warning text-white rounded">
                    <h6 class="card-subtitle mb-2 text-uppercase">Ventes totales</h6>
                    <h3 class="card-title">{{ $totalVentes }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes de stock -->
    @if($alertes->count())
    <div class="alert alert-danger shadow-sm">
        <h5 class="fw-bold">⚠️ Alertes de stock faible :</h5>
        <ul class="mb-0">
            @foreach($alertes as $alerte)
                <li>{{ $alerte }}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <!-- Graphique des stocks -->
    <div class="card shadow-sm border-0 my-4">
        <div class="card-header bg-light">
            <h5 class="mb-0 fw-bold">📦 Graphique des stocks de produits</h5>
        </div>
        <div class="card-body">
            <canvas id="stockChart" height="120"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};
    const stocks = {!! json_encode($stocks) !!};

    // Déterminer les couleurs selon le niveau de stock
    const backgroundColors = stocks.map(stock =>
        stock < 5 ? 'rgba(255, 0, 0, 0.7)' : 'rgba(54, 162, 235, 0.7)'
    );
    const borderColors = stocks.map(stock =>
        stock < 5 ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
    );

    const ctx = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantité en stock',
                data: stocks,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#222',
                    titleColor: '#fff',
                    bodyColor: '#eee'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
