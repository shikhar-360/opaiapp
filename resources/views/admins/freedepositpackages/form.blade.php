{{-- <div class="mb-3">
    <label>App ID</label>
    <input type="number" name="app_id" class="form-control"
           value="{{ old('app_id', $freeDepositPackage->app_id ?? '') }}" required>
</div> --}}

<div class="mb-3">
    <label>Package ID</label>
    <select name="package_id" id="package_id" class="form-control" required>
        <option value="">Select Package</option>
        @foreach($packages as $id => $name)
            <option value="{{ $id }}" {{ old('package_id', $freedepositpackage->package_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Customer ID</label>
    <select name="customer_id" id="customer_id" class="form-control" required>
        <option value="">Select Customer</option>
        @foreach($customers as $id => $name)
            <option value="{{ $id }}" {{ old('customer_id', $freedepositpackage->customer_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1" {{ old('status', $freeDepositPackage->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('status', $freeDepositPackage->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
