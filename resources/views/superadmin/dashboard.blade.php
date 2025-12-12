<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Super Admin Dashboard</span>
        <a href="{{ route('superadmin.logout') }}" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container">

    <h3 class="mb-4">Welcome, {{ auth()->user()->name }}</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Total Apps</h5>
                <h2>{{ $apps ?? 0 }}</h2>
                <a href="{{ route('superadmin.apps.index') }}">APPS</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Total Admins</h5>
                <h2>{{ $admins ?? 0 }}</h2>
                <a href="{{ route('superadmin.admins.index') }}">ADMINS</a>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-4 text-center">
                <h5>Total Customers</h5>
                <h2>{{ $customers ?? 0 }}</h2>
            </div>
        </div>
    </div>

</div>

</body>
</html>
