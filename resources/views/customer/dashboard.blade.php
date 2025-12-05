
<h2>Welcome, {{ auth()->user()->name }}</h2>

<p>Your App ID: {{ auth()->user()->app_id }}</p>

<a href="{{ route('customer.logout') }}" class="btn btn-outline-light btn-sm">Logout</a>