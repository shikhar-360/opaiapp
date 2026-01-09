@extends('admins.layouts.app')
@section('content')

<div class="container">

<h2>Tutorials</h2>

<a href="{{ route('admin.tutorials.create') }}" class="btn btn-primary">Add Tutorial</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Video</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tutorials as $tutorial)
        <tr>
            <td>{{ $tutorial->title }}</td>
            <td>{{ $tutorial->resource_type }}</td>
            <td>
                <a href="{{ $tutorial->url }}" target="_blank">View</a>
            </td>
            <td>
                <a href="{{ route('admin.tutorials.edit', $tutorial) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('admin.tutorials.destroy', $tutorial) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- {{ $tutorials->links() }} --}}

@endsection