
<div class="card">
    <div class="card-header"><h4>Wallet Transfer</h4></div>

    <div class="card-body">
        <form action="{{ route('customer.transfer.transfer') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Wallet Address of Receiver</label>
                <input type="text" name="wallet_address" value="{{ old('wallet_address') }}"
                    class="form-control" required>

                @error('wallet_address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label>Amount</label>
                <input type="number" name="amount" value="{{ old('amount') }}"
                    step="0.00000001" class="form-control" required>

                @error('amount')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Transfer</button>
        </form>
    </div>
</div>
