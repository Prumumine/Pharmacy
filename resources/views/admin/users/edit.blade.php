@extends('layout')

@section('content')
<div class="container">
    <h1>Edit User Role: {{ $user->name }}</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="is_role">Role:</label>
            <select name="is_role" id="is_role" class="form-control">
                <option value="{{ App\Models\User::ROLE_ADMIN }}" {{ $user->is_role == App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Admin</option>
                <option value="{{ App\Models\User::ROLE_PHARMACIEN }}" {{ $user->is_role == App\Models\User::ROLE_PHARMACIEN ? 'selected' : '' }}>Pharmacien</option>
                <option value="{{ App\Models\User::ROLE_UTILISATEUR }}" {{ $user->is_role == App\Models\User::ROLE_UTILISATEUR ? 'selected' : '' }}>Utilisateur</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Role</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
