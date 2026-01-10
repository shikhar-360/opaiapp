<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            padding-top: 56px; /* ADD THIS */
        }
        .sidebar {
            width: 240px;
            background: #343a40;
            height: 100vh;
            position: fixed;
            top: 56px; /* CHANGE from 0 */
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
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <!-- <input id="globalSearch" type="text" placeholder="Search..." class="form-control form-control-sm mx-3" style="width: 50%;">
        <div id="searchDropdown"
             class="dropdown-menu w-100 shadow"
             style="max-height: 300px; overflow-y: auto;">
        </div> -->
        <a href="{{  route('admin.logout') }}" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

{{-- Sidebar --}}
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.adminapp.index') }}">App Settings</a>
    <a href="{{ route('admin.packages.index') }}">Packages</a>
    <a href="{{ route('admin.levelpackages.index') }}">Level Packages</a>
    <a href="{{ route('admin.leadershippackages.index') }}">Leadership Income</a>
    <a href="{{ route('admin.championspackages.index') }}">Champions Income</a>
    <a href="{{ route('admin.freedepositpackages.index') }}">Free Packages</a>
    <a href="{{ route('admin.appcustomers.index') }}">Customers</a>
    <a href="{{ route('admin.tutorials.index') }}">Tutorials</a>
    <a href="{{ route('admin.appcustomers.earningsreport') }}">Earnings</a>
    <a href="{{ route('admin.appcustomers.depositsreport') }}">Deposits</a>
    <a href="{{ route('admin.appcustomers.withdrawsreport') }}">Withdraws</a>
    <a href="{{ route('admin.appcustomers.p2ptransfersreport') }}">P2P Transfers</a>
    <a href="{{ route('admin.appcustomers.selftransfersreport') }}">Self Transfers</a>
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
