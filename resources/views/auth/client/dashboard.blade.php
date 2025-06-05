@extends('layout.app')

@section('content')
<div class="container">
    <h1>Bienvenue, {{ Auth::user()->name }} (Client)</h1>
    <p>Ceci est votre tableau de bord client.</p>
</div>
@endsection
