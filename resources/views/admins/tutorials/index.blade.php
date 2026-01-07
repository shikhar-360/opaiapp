@extends('admins.layouts.app')
@section('content')

<div class="container">

<h2>Tutorials</h2>


<div class="text-end mb-3">
    <a href="{{ route('admin.tutorials.create') }}" class="btn btn-primary">Add New</a>
</div>
<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Sub-Title</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tutorials as $tutorial)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tutorial->title }}</td>
            <td>{{ $tutorial->sub_title }}</td>
            <td>{{ $tutorial->resource_type }}</td>
            <td>
                <a href="{{ $tutorial->url }}" target="_blank" class="btn btn-sm btn-info px-2 py-0">View</a>
                <a href="{{ route('admin.tutorials.edit', $tutorial) }}" class="btn btn-sm btn-warning px-2 py-0">Edit</a>
                <form method="POST" action="{{ route('admin.tutorials.destroy', $tutorial) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger px-2 py-0">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- {{ $tutorials->links() }} --}}

@endsection