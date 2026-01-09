<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $adminapp->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Primary Color</label>
    <input type="color" name="primary_color" class="form-control form-control-color"
           value="{{ old('primary_color', $adminapp->primary_color ?? '#000000') }}">
</div>

<div class="mb-3">
    <label>Accent Color</label>
    <input type="color" name="accent_color" class="form-control form-control-color"
           value="{{ old('accent_color', $adminapp->accent_color ?? '#ffffff') }}">
</div>

<div class="mb-3">
    <label>Coin Price</label>
    <input type="number" step="0.0001" name="coin_price" class="form-control"
           value="{{ old('coin_price', $adminapp->coin_price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">

    @if(isset($adminapp) && $adminapp->logo_path)
        <img src="{{ asset('storage/'.$adminapp->logo_path) }}" width="60" class="mt-2">
    @endif
</div>

<div class="mb-3">
    <label>Currency</label>
    <input type="text" name="currency" class="form-control"
           value="{{ old('currency', $adminapp->currency ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Admin Withdraw Fee</label>
    <input type="text" name="admin_withdraw_fee" class="form-control"
           value="{{ old('admin_withdraw_fee', $adminapp->admin_withdraw_fee    ?? '') }}" required>
</div>

<div class="mb-3">
    <label>CappingX</label>
    <input type="text" name="cappingx" class="form-control"
           value="{{ old('cappingx', $adminapp->cappingx    ?? '') }}" required>
</div>