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
        <p><strong>Rank:</strong> {{ $package->rank }}</p>
        <p><strong>Volume:</strong> {{ $package->team_volume }}₹ </p>
        <p><strong>Points:</strong> {{ $package->points }}%</p>
        <a href="{{ route('admin.leadershippackages.edit', $package->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('admin.leadershippackages.destroy', $package->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete this package?')" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('admin.leadershippackages.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
