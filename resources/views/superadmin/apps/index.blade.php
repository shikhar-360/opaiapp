@extends('superadmin.layout')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h3>Manage Apps</h3>
        <a href="{{ route('superadmin.apps.create') }}" class="btn btn-primary">Create App</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Coin Price</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($apps as $app)
                <tr>
                    <td>{{ $app->name }}</td>
                    <td>{{ $app->slug }}</td>
                    <td>{{ $app->coin_price }}</td>
                    <td>
                        @if($app->logo_path)
                            <img src="{{ asset('storage/'.$app->logo_path) }}" width="40">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('superadmin.apps.edit', $app->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('superadmin.apps.destroy', $app->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete app?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $apps->links() }}

</div>
@endsection
