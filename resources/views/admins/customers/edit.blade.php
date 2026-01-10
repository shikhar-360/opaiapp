@extends('admins.layouts.app')

@section('content')
<div class="container">
    
    <h2 class="mb-3">Edit User</h2>

    <form action="{{ route('admin.appcustomers.update', $customer->id) }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">

        {{-- PROFILE PHOTO --}}
        <div class="col-md-3 text-center mb-4">
            {{-- <label class="mb-2">Profile Photo</label> --}}
            <div class="mb-2">
                <img 
                    src="{{ $customer->profile_image 
                            ? asset('storage/' . $customer->profile_image) 
                            : asset('images/default-user.png') }}"
                    class="img-thumbnail rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover;">
            </div>

            <input type="file" 
                   name="profile_image" 
                   class="form-control mt-2"
                   accept="image/*">

            @error('profile_photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- BASIC DETAILS --}}
        <div class="col-md-9">
            <h5 class="mb-3">Basic Information</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $customer->name) }}" 
                           class="form-control">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', $customer->email) }}" 
                           class="form-control">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" 
                           name="phone" 
                           value="{{ old('phone', $customer->phone) }}" 
                           class="form-control">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password <small>(leave blank to keep same)</small></label>
                    <input type="password" name="password" class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Wallet Address</label>
                    <input type="text"
                           name="wallet_address"
                           value="{{ old('wallet_address', $customer->wallet_address) }}"
                           class="form-control"
                           {{ $customer->wallet_address ? 'readonly' : '' }}>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $customer->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$customer->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- READ ONLY INFO --}}
        <div class="col-md-12 mt-4">
            <h5>Account Info (Read Only)</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Sponsor Code</label>
                    <input class="form-control" value="{{ $c->sponsor?->referral_code ?? 'N/A' }}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Referral Code</label>
                    <input class="form-control" value="{{ $customer->referral_code }}" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Telegram Username</label>
                    <input class="form-control" value="{{ $customer->telegram_username }}" readonly>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <h5>Settings</h5>
            
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>P2P Status</label>
                    <select name="isP2P" class="form-control">
                        <option value="1" {{ $customer->customer_settings->isP2P ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$customer->customer_settings->isP2P ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Self Transfer</label>
                    <select name="isSelfTransfer" class="form-control">
                        <option value="1" {{ $customer->customer_settings->isSelfTransfer ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$customer->customer_settings->isSelfTransfer ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Free Package</label>
                    <select name="isFreePackage" class="form-control">
                        <option value="1" {{ $customer->customer_settings->isFreePackage ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$customer->customer_settings->isFreePackage ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Withdraw</label>
                    <select name="isWithdraw" class="form-control">
                        <option value="1" {{ $customer->customer_settings->isWithdraw ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$customer->customer_settings->isWithdraw ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <h5>Financials</h5>
         
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Total Deposits</label>
                    <input class="form-control" value="{{ $customer->finance->total_deposit }}" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Income</label>
                    <input class="form-control" value="{{ $customer->finance->total_income }}" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Withdraws</label>
                    <input class="form-control" value="{{ $customer->finance->total_withdraws }}" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Capping Limit</label>
                    <input class="form-control" value="{{ $customer->finance->capping_limit }}" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Topup</label>
                    <input class="form-control" value="{{ $customer->finance->total_topup }}" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Tokens</label>
                    <input class="form-control" name="total_tokens" value="{{ $customer->finance->total_tokens }}">
                </div>
            </div>
        </div>
        
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.appcustomers.index') }}" class="btn btn-secondary">Back</a>
</form>


</div>
@endsection
