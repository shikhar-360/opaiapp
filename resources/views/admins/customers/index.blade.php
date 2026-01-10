@extends('admins.layouts.app')

@section('content')
<div class="container-fluid">
    
    <h2 class="mb-3">Users</h2>

    {{-- <a href="{{ route('admin.appcustomers.create') }}" class="btn btn-primary mb-3">Add Customer</a> --}}

    <div class="flex text-center">
        <form method="POST" action="{{  route('admin.appcustomers.filterreport') }}"
            class="inline-flex items-center gap-4 mb-6">
            @csrf

            <label class="flex items-center gap-2 text-sm font-medium text-gray-600">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}"
                    placeholder="Search string"
                    class="px-3 py-2 border rounded-md text-sm"
                    >
            </label>

            <label class="flex items-center gap-2 text-sm font-medium text-gray-600">
                From 
                <input
                    type="date"
                    name="from"
                    value="{{ $from }}"
                    class="px-3 py-2 border rounded-md text-sm"
                    required
                >
            </label>

            <label class="flex items-center gap-2 text-sm font-medium text-gray-600">
                To
                <input
                    type="date"
                    name="to"
                    value="{{ $to }}"
                    class="px-3 py-2 border rounded-md text-sm"
                    required
                >
            </label>

            <button
                type="submit"
                onclick="document.getElementById('isDownload').value = 0"
                class="btn btn-info px-5 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold
                    hover:bg-blue-700 transition">
                Filter
            </button>

            <button
                type="submit"
                onclick="dwnld()"
                class="btn btn-success px-5 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold
                    hover:bg-blue-700 transition"
                id="downloadBtn"
                >
                Download
            </button>
            <input type="hidden" name="isDownload" id="isDownload" value="0">
        </form>
     </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="customers_datatable" class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Referral Code</th>
            <th>Wallet Address</th>
            <th>Sponsor</th>
            <th>Active Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($customer_details as $c)
            <tr>
                <td><a href="{{ route('admin.login.as.customer', $c->id) }}" class="btn btn-info btn-sm px-2 py-0" target="_blank">Login</a></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td>{{ $c->referral_code }}</td>
                <td>{{ substr($c->wallet_address,0,5) }}...{{ substr($c->wallet_address,-6) }}</td>
                <td>{{ $c->sponsor?->referral_code ?? 'N/A' }}</td>
                <td>{{ $c->firstPaidDeposit?->created_at?->format('d-m-Y') ?? '-' }}</td>
                <td>
                    {{-- <a href="{{ route('admin.appcustomers.show', $c->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('admin.appcustomers.edit', $c->id) }}" class="btn btn-warning btn-sm px-2 py-0">Edit</a>

                    <form action="{{ route('admin.appcustomers.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this customer?')" class="btn btn-danger btn-sm px-2 py-0">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">No customers found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#customers_datatable').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
});
function dwnld()
{
    // document.getElementById('depositSearch').value = $('#deposit_datatable').DataTable().search(); 
    document.getElementById('isDownload').value = 1
}
$('#customers_datatable').DataTable({
    language: {
        emptyTable: "No data found"
    }
});
</script>
<!-- <style>
table.dataTable tbody th, table.dataTable tbody td{
    padding:0!important;
}
</style> -->