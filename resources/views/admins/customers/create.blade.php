@extends('admins.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Add User</h2>

    <form action="{{ route('admin.appcustomers.store') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Phone</label>
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control">
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label>Wallet Address</label>
                <input type="text" name="wallet_address" value="{{ old('wallet_address') }}" class="form-control">
                @error('wallet_address') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.appcustomers.index') }}" class="btn btn-secondary">Back</a>

    </form>
</div>
@endsection
