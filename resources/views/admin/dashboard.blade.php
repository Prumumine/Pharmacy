@extends('layout')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin area!</p>
    <p><a href="{{ route('admin.users.index') }}">Manage Users</a></p>
</div>
@endsection
