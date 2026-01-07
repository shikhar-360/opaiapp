@extends('admins.layouts.app')

@section('content')

<div class="container">
    <h2>App Packages</h2>

    <a href="{{ route('admin.leadershippackages.create') }}" class="btn btn-primary mb-3">
        Add New Package
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>App</th>
            <th>Rank</th>
            <th>Volume (₹)</th>
            <th>Points</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($packages as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->app_id }}</td>
                <td>{{ $p->rank }}</td>
                <td>{{ $p->volume }}</td>
                <td>{{ $p->points }}</td>
                
                <td>
                    {{-- <a href="{{ route('admin.packages.show', $p->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.leadershippackages.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.leadershippackages.destroy', $p->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this package?')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No packages found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection