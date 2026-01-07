@extends('admins.layouts.app')

@section('content')
<h2>Free Deposit Packages</h2>

<div class="text-end mb-3">
    <a href="{{ route('admin.freedepositpackages.create') }}" class="btn btn-primary mb-3">
    Add New
    </a>
</div>
<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>App ID</th>
            <th>Package ID</th>
            <th>Customer ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($records as $row)
        <tr>
            {{-- <td>{{ $row->app->name }} ({{ $row->id }})</td> --}}
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->app_id }} </td>
            <td>{{ $row->package->plan_code }} ({{ $row->package_id }})</td>
            <td>{{ $row->customer->name }} ({{ $row->customer_id }})</td>
            <td>{{ $row->status ? 'Active': 'In-Active' }}</td>
            <td>
                <a href="{{ route('admin.freedepositpackages.edit', $row->id) }}" class="btn btn-sm btn-warning px-2 py-0">Edit</a>

                <form method="POST" action="{{ route('admin.freedepositpackages.destroy', $row->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger px-2 py-0" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $records->links() }}

@endsection
