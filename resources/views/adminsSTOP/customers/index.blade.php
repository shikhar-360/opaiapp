@extends('admins.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Customers</h2>

    <a href="{{ route('admin.appcustomers.create') }}" class="btn btn-primary mb-3">Add Customer</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Referral Code</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($customers as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td>{{ $c->referral_code }}</td>

                <td>
                    {{-- <a href="{{ route('admin.appcustomers.show', $c->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.login.as.customer', $c->id) }}" class="btn btn-info btn-sm">Login as Customer</a>
                    <a href="{{ route('admin.appcustomers.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.appcustomers.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this customer?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">No customers found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
