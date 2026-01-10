@extends('customer.layout')

@section('content')
<div class="card">
    <h2>Customer Registration</h2>
    <?php $code = 'AB123C'; ?>
    <a href="{{ route('customer.register', ['sponsorcode' => $code]) }}">Register with code {{ $code }}</a>
    <br>
    <form action="{{ route('customer.register.submit') }}" method="POST">
        @csrf

        @if($sponsorcode)
            <input type="hidden" name="sponsor_code" value="{{ $sponsorcode }}">
        @endif
        
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <button type="submit">Register</button>
    </form>
</div>
@endsection
