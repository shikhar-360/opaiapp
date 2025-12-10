
<h2>Make a Deposit</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('customer.deposit.deposit') }}" method="POST">
    @csrf

    Top-up Amount: {{ $topup_amount }}
    <label>Package</label>
    <select name="package_id">
        <option value="1">P1 - 5</option>
        <option value="2">P2 - 10</option>
        <option value="3">P3 - 25</option>
        <option value="4">P4 - 50</option>
    </select>
    
    <label>Deposit Amount</label>
    <input type="number" name="amount" step="0.01" value="{{ $topup_amount }}" required value="{{ old('amount') }}">

    @error('amount')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <button type="submit">Submit Deposit</button>
</form>

