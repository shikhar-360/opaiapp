@extends('admins.layouts.app')
@section('content')
<div class="container">

    <h3>Edit App</h3>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-red-700">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('admin.adminapp.update', $adminapp->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admins.app.editform')

        <button class="btn btn-primary mt-3">Update</button>
    </form>

</div>
@endsection
