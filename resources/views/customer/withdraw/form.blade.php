
<h2>Withdraw Funds</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('customer.withdraw.withdraw') }}" method="POST">
    @csrf

    <label>Withdraw Amount</label>
    <input type="number" step="0.01" name="amount" required value="{{ old('amount') }}">

    @error('amount')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <button type="submit">Request Withdrawal</button>
</form>

