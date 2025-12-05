<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $app->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Primary Color</label>
    <input type="color" name="primary_color" class="form-control form-control-color"
           value="{{ old('primary_color', $app->primary_color ?? '#000000') }}">
</div>

<div class="mb-3">
    <label>Accent Color</label>
    <input type="color" name="accent_color" class="form-control form-control-color"
           value="{{ old('accent_color', $app->accent_color ?? '#ffffff') }}">
</div>

<div class="mb-3">
    <label>Coin Price</label>
    <input type="number" step="0.0001" name="coin_price" class="form-control"
           value="{{ old('coin_price', $app->coin_price ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">

    @if(isset($app) && $app->logo_path)
        <img src="{{ asset('storage/'.$app->logo_path) }}" width="60" class="mt-2">
    @endif
</div>
