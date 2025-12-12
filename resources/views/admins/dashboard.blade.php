<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Admin Dashboard</span>
        <a href="{{ route('admin.logout') }}" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container">

    <h3 class="mb-4">Welcome, {{ auth()->user()->name }}</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>App Packages</h5>
                <h2>{{ $apps ?? 0 }}</h2>
                <a href="{{ route('admin.packages.index') }}">PACKAGES</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Level Packages</h5>
                <h2>{{ $admins ?? 0 }}</h2>
                <a href="{{ route('admin.levelpackages.index') }}">LEVEL PACKAGES</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Free Deposit Packages</h5>
                <h2>{{ $admins ?? 0 }}</h2>
                <a href="{{ route('admin.freedepositpackages.index') }}">FREE PACKAGES</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Total Customers</h5>
                <h2>{{ $customers ?? 0 }}</h2>
                <a href="{{ route('admin.appcustomers.index') }}">CUSTOMERS</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
