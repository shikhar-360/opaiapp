@extends('superadmin.layout')

@section('title', 'Admins')

@section('content')
<h3 class="mb-3">Manage Admins</h3>

<a href="{{ route('superadmin.admins.create') }}" class="btn btn-primary mb-3">+ Add Admin</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>App</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ $admin->app->name ?? '—' }}</td>
            <td>
                <a href="{{ route('superadmin.admins.edit', $admin) }}" class="btn btn-sm btn-warning">Edit</a>

                <a href="{{ route('superadmin.admins.loginAs', $admin) }}" class="btn btn-sm btn-info">Login As</a>

                <form action="{{ route('superadmin.admins.destroy', $admin) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete admin?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $admins->links() }}

@endsection
