@extends('superadmin.layout')

@section('content')
<div class="container">

    <h3>Create App</h3>

    <form method="POST" action="{{ route('superadmin.apps.store') }}" enctype="multipart/form-data">
        @csrf

        @include('superadmin.apps.form')

        <button class="btn btn-primary mt-3">Create</button>
    </form>

</div>
@endsection
