@extends('applogin')

@section('content')
<div class="card">
    <h2>Customer Login</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        
        
         @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>
@endsection
