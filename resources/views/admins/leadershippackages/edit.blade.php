@extends('admins.layouts.app')

@section('content')
<div class="container">
    <br><br><br>
    <h2>Edit Package</h2>

    <form action="{{ route('admin.leadershippackages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Rank</label>
            <input type="text" name="rank" value="{{ old('rank', $package->rank) }}" class="form-control">
            @error('rank') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Volume (₹)</label>
            <input type="number" name="volume" step="0.01" value="{{ old('volume', $package->volume) }}" class="form-control">
            @error('volume') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Points</label>
            <input type="number" name="points" step="0.01" value="{{ old('points', $package->points) }}" class="form-control">
            @error('points') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Update Package</button>
        <a href="{{ route('admin.leadershippackages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
