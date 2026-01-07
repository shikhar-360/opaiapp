@extends('admins.layouts.app')

@section('content')
<h2>Create Free Deposit Package</h2>

<form method="POST" action="{{ route('admin.freedepositpackages.store') }}">
    @csrf

    @include('admins.freedepositpackages.form')

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
