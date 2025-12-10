@extends('admins.layouts.app')

@section('content')
<h2>Edit Free Deposit Package</h2>

<form method="POST" action="{{ route('admin.freedepositpackages.update', $freedepositpackage->id) }}">
    @csrf
    @method('PUT')

    @include('admins.freedepositpackages.form')

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
