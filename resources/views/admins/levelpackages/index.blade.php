@extends('admins.layouts.app')

@section('content')

<div class="container">
    <h2>App Level Packages</h2>

    <div class="text-end mb-3">
        <a href="{{ route('admin.levelpackages.create') }}" class="btn btn-primary mb-3">Add New</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Level</th>
            <th>Directs</th>
            <th>Reward (%)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($packages as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->level }}</td>
                <td>{{ $p->directs }}</td>
                <td>{{ $p->reward }}</td>
                
                <td>
                    {{-- <a href="{{ route('admin.packages.show', $p->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.levelpackages.edit', $p->id) }}" class="btn btn-warning btn-sm px-2 py-0">Edit</a>
                    <form action="{{ route('admin.levelpackages.destroy', $p->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this package?')" class="btn btn-danger btn-sm px-2 py-0">
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