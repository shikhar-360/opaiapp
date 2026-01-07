@extends('admins.layouts.app')

@section('content')
<div class="container">
    
    <h2>Add New Champions Package</h2>

    <form action="{{ route('admin.championspackages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Rank</label>
            <input type="text" name="rank" value="{{ old('rank') }}" class="form-control">
            @error('rank') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Volume (₹)</label>
            <input type="number" name="team_volume" step="0.01" value="{{ old('team_volume') }}" class="form-control">
            @error('team_volume') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Points</label>
            <input type="number" name="points" step="0.01" value="{{ old('points') }}" class="form-control">
            @error('points') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Directs</label>
            <input type="number" name="directs" step="0.01" value="{{ old('directs') }}" class="form-control">
            @error('directs') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Save Package</button>
        <a href="{{ route('admin.championspackages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
