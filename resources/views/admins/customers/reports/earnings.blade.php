@extends('admins.layouts.app')

@section('content')
<div class="container">
    
    <h2 class="mb-3">User Earnings</h2>



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

     <div class="flex text-center">
        <form method="POST" action="{{  route('admin.appcustomers.earningsreport') }}"
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

    <table id="earning_datatable" class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Earning Date</th>
            <th>Name</th>
            <th>Referral Code</th>
            <th>Wallet Address</th>
            <th>Reference Customer</th>
            <th>Ref Level</th>
            <th>Ref Amount</th>
            <th>Earned Amount</th>
            <th>Flush Amount</th>
            <th>Type</th>
        </tr>
        </thead>

        <tbody>
        @forelse ($earning_details as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->created_at->format("d-m-Y") }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->referral_code }}</td>
                <td>{{ $d->wallet_address }}</td>
                <td>{{ $d->reference_id }}</td>
                <td>{{ 'C'.$d->reference_level }}</td>
                <td>{{ $d->reference_amount }}</td>
                <td>{{ $d->amount_earned }}</td>
                <td>{{ $d->flush_amount }}</td>
                <td>{{ $d->earning_type }}</td>
                
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
        @empty
            <tr><td colspan="6" class="text-center">No data found.</td></tr>
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
  $('#earning_datatable').DataTable({
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

</script>