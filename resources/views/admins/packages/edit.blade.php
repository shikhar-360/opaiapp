@extends('admins.layouts.app')

@section('content')
<div class="container">
    
    <h2>Edit Package</h2>

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Plan Code</label>
            <input type="text" name="plan_code" value="{{ old('plan_code', $package->plan_code) }}" class="form-control">
            @error('plan_code') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Deposit Amount (₹)</label>
            <input type="number" name="amount" step="0.01" value="{{ old('amount', $package->amount) }}" class="form-control">
            @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>ROI (%)</label>
            <input type="number" name="roi_percent" step="0.01" value="{{ old('roi_percent', $package->roi_percent) }}" class="form-control">
            @error('roi_percent') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Update Package</button>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
