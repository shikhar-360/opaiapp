@extends('admins.layouts.app')

@section('content')
<div class="container">
    <h2>Customer Details</h2>

    <div class="card p-3">

        <p><strong>Name:</strong> {{ $customer->name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        <p><strong>Status:</strong> {{ $customer->status == 1 ? 'Active' : 'Inactive' }}</p>
        <p><strong>Wallet:</strong> {{ $customer->wallet_address }}</p>

        <hr>

        <h5>Account Info</h5>

        <p><strong>Referral Code:</strong> {{ $customer->referral_code }}</p>
        <p><strong>Sponsor ID:</strong> {{ $customer->sponsor_id }}</p>
        <p><strong>Direct IDs:</strong> {{ $customer->direct_ids }}</p>
        <p><strong>Active Direct IDs:</strong> {{ $customer->active_direct_ids }}</p>
        <p><strong>Level ID:</strong> {{ $customer->level_id }}</p>

        <a href="{{ route('admin.appcustomers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.appcustomers.index') }}" class="btn btn-secondary">Back</a>

    </div>
</div>
@endsection
