@extends('admins.layouts.app')

@section('content')
<div class="container">
    
<h3>Edit Tutorial</h3>
<form method="POST" action="{{ route('admin.tutorials.update', $tutorial) }}">
    @method('PUT')
    @include('admins.tutorials._form')
</form>
</div>
@endsection
