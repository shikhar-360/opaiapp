@extends('superadmin.layout')

@section('title', 'Edit Admin')

@section('content')
<h3>Edit Admin</h3>

<form method="POST" action="{{ route('superadmin.admins.update', $admin) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $admin->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" value="" class="form-control">
    </div>

    <div class="mb-3">
        <label>Assign App</label>
        <select name="app_id" class="form-control" required>
            @foreach($apps as $app)
            <option value="{{ $app->id }}" 
                @selected($admin->app_id == $app->id)>
                {{ $app->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
