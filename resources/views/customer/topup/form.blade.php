<meta name="viewport" content="width=device-width, initial-scale=1.0">

<form action="{{ route('customer.topup.topup') }}" method="POST">
    @csrf

    <label>Amount</label>
    <input type="number" name="amount" step="0.01" value="10" required>

    <label>Deposit Amount</label>
    <select name="chain" required>
        <option value="ETH">Ethereum (ETH)</option>
        <option value="TRON">Tron (TRX)</option>
    </select>

    <label>Fee Amount</label>
    <input type="number" name="fees_amount" step="0.01" value="4" required>

    <label>Received Amount</label>
    <input type="number" name="received_amount" step="0.01" value="4" required>

    <label>Chain</label>
    <input type="text" name="chain" value="POLYG" required>
            
    <label>Received Amount</label>
    <input type="text" name="currency" value="USD" required>

    @error('amount')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <button type="submit">Submit Deposit</button>
</form>
<h2>Scan QR Code to Top Up</h2>

<p><strong>ETH Address:</strong> {{ $QRs['ethAddress'] }}</p>
<img src="{{$QRs['ethQrCode']}}" alt="ETH QR Code" class="qr-code">

<p><strong>TRON Address:</strong> {{ $QRs['tronAddress'] }}</p>
<img src="{{$QRs['ethQrCode']}}" alt="TRON QR Code" class="qr-code">

<button>Cancel</button>
