@extends('admins.layouts.app')

@section('content')
<div class="container-fluid">
    
    <h2 class="mb-3">User P2P Transfers</h2>



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

     <div class="flex text-center">
        <form method="POST" action="{{  route('admin.appcustomers.withdrawsreport') }}"
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

    <table id="p2ptransfer_datatable" class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Withdraw Date</th>
            <th>Name</th>
            <th>Referral Code</th>
            <th>Wallet Address</th>

            <th>Amount</th>
            <th>Admin Charge</th>
            <th>Net Amount</th>
            <th>To Customer</th>
            <th>Type</th>
            <th>Txn Id</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($p2ptransfer_details as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->withdrawdate }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->referral_code }}</td>
                <td>{{ substr($d->wallet_address,0,5) }}...{{ substr($d->wallet_address,-6) }}</td>

                <td>{{ $d->amount }}</td>
                <td>{{ $d->admin_charge }}</td>
                <td>{{ $d->net_amount }}</td>
                <td>{{ $d->to_customer_name }}</td>
                <td>{{ $d->transaction_type }}</td>
                <td>{{ $d->transaction_id }}</td>
                <td>{{ $d->transaction_status }}</td>
                {{-- <td>
                    <a href="{{ route('admin.login.as.customer', $c->id) }}" class="btn btn-info btn-sm px-2 py-0">Login as Customer</a>
                    <a href="{{ route('admin.appcustomers.edit', $c->id) }}" class="btn btn-warning btn-sm px-2 py-0">Edit</a>

                    <form action="{{ route('admin.appcustomers.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this customer?')" class="btn btn-danger btn-sm px-2 py-0">
                            Delete
                        </button>
                    </form>
                </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#p2ptransfer_datatable').DataTable({
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
$('#p2ptransfer_datatable').DataTable({
    language: {
        emptyTable: "No data found"
    }
});
</script>