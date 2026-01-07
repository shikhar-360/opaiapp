@extends('admins.layouts.app')

@section('content')

<div class="container">
    <h2>App Level Packages</h2>

    <a href="{{ route('admin.levelpackages.create') }}" class="btn btn-primary mb-3">
        Add New Level Package
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Level</th>
            <th>Directs</th>
            <th>Reward (%)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($packages as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->level }}</td>
                <td>{{ $p->directs }}</td>
                <td>{{ $p->reward }}</td>
                
                <td>
                    {{-- <a href="{{ route('admin.packages.show', $p->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.levelpackages.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.levelpackages.destroy', $p->id) }}" method="POST" style="display:inline">
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