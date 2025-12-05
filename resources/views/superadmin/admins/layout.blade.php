<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - @yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            background: #343a40;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
        }
        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="{{ route('superadmin.dashboard') }}">Super Admin Panel</a> --}}

        {{-- <form method="POST" action="{{ route('superadmin.logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form> --}}
    </div>
</nav>

{{-- Sidebar --}}
<div class="sidebar">
    {{-- <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
    <a href="{{ route('superadmin.apps.index') }}">Manage Apps</a>
    <a href="{{ route('superadmin.admins.index') }}">Manage Admins</a> --}}
</div>

{{-- Page Content --}}
<div class="content">
    @yield('content')
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
