@extends('admins.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Edit Customer</h2>

    <form action="{{ route('admin.appcustomers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email', $customer->email) }}" class="form-control">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="number" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control">
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Password (leave blank to keep same)</label>
                <input type="password" name="password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label>Wallet Address</label>
                <input type="text" name="wallet_address"
                        value="{{ old('wallet_address', $customer->wallet_address) }}"
                        class="form-control" 
                        @if($customer->wallet_address) 
                            readonly 
                        @endif
                       >
                @error('wallet_address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- NON EDITABLE FIELDS --}}
            <div class="col-md-12">
                <h5 class="mt-3">Account Info (Read Only)</h5>
            </div>

            <div class="col-md-4 mb-3">
                <label>Referral Code</label>
                <input type="text" value="{{ $customer->referral_code }}" class="form-control" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>Sponsor ID</label>
                <input value="{{ $customer->sponsor_id }}" class="form-control" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>Direct IDs</label>
                <input value="{{ $customer->direct_ids }}" class="form-control" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>Active Direct IDs</label>
                <input value="{{ $customer->active_direct_ids }}" class="form-control" readonly>
            </div>

            <div class="col-md-4 mb-3">
                <label>Level ID</label>
                <input value="{{ $customer->level_id }}" class="form-control" readonly>
            </div>

        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.appcustomers.index') }}" class="btn btn-secondary">Back</a>

    </form>

</div>
@endsection
