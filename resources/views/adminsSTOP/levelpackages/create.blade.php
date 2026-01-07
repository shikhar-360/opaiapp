@extends('admins.layouts.app')

@section('content')
<div class="container">
    <br><br><br><h2>Add New Level Package</h2>

    <form action="{{ route('admin.levelpackages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Level</label>
            <input type="text" name="level" value="{{ old('level') }}" class="form-control">
            @error('level') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Directs</label>
            <input type="number" name="directs" step="0.01" value="{{ old('directs') }}" class="form-control">
            @error('directs') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Reward (%)</label>
            <input type="number" name="reward" step="0.01" value="{{ old('reward') }}" class="form-control">
            @error('reward') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Save Package</button>
        <a href="{{ route('admin.levelpackages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
