@extends('admins.layouts.app')

@section('content')
<div class="container">
    <br><br><br>
<h3>Add Tutorial</h3>
<form method="POST" action="{{ route('admin.tutorials.store') }}">
    @include('admins.tutorials._form')
</form>
</div>
@endsection
