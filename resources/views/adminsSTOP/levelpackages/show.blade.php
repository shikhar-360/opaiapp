@extends('admins.layout')

@section('content')
<div class="container">
    <h2>Package Details</h2>
    @php
        print_r($package);
    @endphp
    <td>{{ $package->plan_code }}</td>
                <td>{{ $package->amount }}</td>
                <td>{{ $package->roi_percent }}</td>

    <div class="card p-3">
        <p><strong>ID:</strong> {{ $package->id }}</p>
        <p><strong>Name:</strong> {{ $package->plan_code }}</p>
        <p><strong>Price:</strong> {{ $package->amount }}₹ </p>
        <p><strong>Price:</strong> {{ $package->roi_percent }}%</p>
        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete this package?')" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
