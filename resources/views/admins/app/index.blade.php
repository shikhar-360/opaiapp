@extends('admins.layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Currency</th>
                <th>Admin Withdraw Fee</th>
                <th>CappingX</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($apps as $app)
                <tr>
                    <td>
                        @if($app->logo_path)
                            <img src="{{ asset('storage/'.$app->logo_path) }}" width="40">
                        @endif
                    </td>
                    <td>{{ $app->name }}</td>
                    <td>{{ $app->slug }}</td>
                    <!-- <td>{{ $app->coin_price }}</td> -->
                    <td>{{ $app->currency }}</td>
                    <td>{{ $app->admin_withdraw_fee }}</td>
                    <td>{{ $app->cappingx }}</td>
                    <td>
                        <a href="{{ route('admin.adminapp.edit', $app->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $apps->links() }}

</div>
@endsection
