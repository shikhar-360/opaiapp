@extends('superadmin.layout')

@section('content')
<div class="container">

    <h3>Edit App</h3>

    <form method="POST" action="{{ route('superadmin.apps.update', $app->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('superadmin.apps.editform')

        <button class="btn btn-primary mt-3">Update</button>
    </form>

</div>
@endsection
