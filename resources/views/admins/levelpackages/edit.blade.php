@extends('admins.layouts.app')

@section('content')
<div class="container">
    
    <h2>Edit Level Package</h2>

    <form action="{{ route('admin.levelpackages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Level</label>
            <input type="text" name="level" value="{{ old('level', $package->level) }}" class="form-control">
            @error('level') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Directs</label>
            <input type="number" name="directs" step="0.01" value="{{ old('directs', $package->directs) }}" class="form-control">
            @error('directs') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Reward (%)</label>
            <input type="number" name="reward" step="0.01" value="{{ old('reward', $package->reward) }}" class="form-control">
            @error('reward') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Update Level Package</button>
        <a href="{{ route('admin.levelpackages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
