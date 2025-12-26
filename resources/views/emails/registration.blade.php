<h2>Welcome {{ $user->name }}</h2>
<p>Your registration was successful.</p>

<p>
    <strong>User ID:</strong> {{ $user->referral_code }}
</p>

<p>
    <strong>Email:</strong> {{ $user->email }}
</p>

<p>Please keep this User ID and Email safe for login and future reference.</p>