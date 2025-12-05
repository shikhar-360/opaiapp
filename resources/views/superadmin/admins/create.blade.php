@extends('superadmin.layout')

@section('title', 'Create Admin')

@section('content')
<h3>Create New Admin</h3>

<form method="POST" action="{{ route('superadmin.admins.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" value="" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Assign App</label>
        <select name="app_id" class="form-control" required>
            <option value="">Select App</option>
            @foreach($apps as $app)
            <option value="{{ $app->id }}">{{ $app->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Create Admin</button>
</form>
@endsection
