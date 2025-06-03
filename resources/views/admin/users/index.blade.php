@extends('layout')

@section('content')
<div class="container">
    <h1>User Management</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_role == App\Models\User::ROLE_ADMIN)
                        Admin
                    @elseif($user->is_role == App\Models\User::ROLE_PHARMACIEN)
                        Pharmacien
                    @elseif($user->is_role == App\Models\User::ROLE_UTILISATEUR)
                        Utilisateur
                    @else
                        Unknown
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">Edit Role</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
