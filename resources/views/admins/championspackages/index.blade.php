@extends('admins.layouts.app')

@section('content')

<div class="container">
    <h2>App Champions Packages</h2>

    <div class="text-end mb-3">
        <a href="{{ route('admin.championspackages.create') }}" class="btn btn-primary">
            Add New
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            {{-- <th>App</th> --}}
            <th>Rank</th>
            <th>Volume</th>
            <th>Points</th>
            <th>Directs</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($packages as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->rank }}</td>
                <td>{{ $p->team_volume }}</td>
                <td>{{ $p->points }}</td>
                <td>{{ $p->directs }}</td>
                
                <td>
                    {{-- <a href="{{ route('admin.packages.show', $p->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.championspackages.edit', $p->id) }}" class="btn btn-warning btn-sm px-2 py-0">Edit</a>
                    <form action="{{ route('admin.championspackages.destroy', $p->id) }}" method="POST" style="display:inline">
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