<!-- resources/views/emails/forgot-password.blade.php -->

<h2>Password Reset Request</h2>

<p>You requested to reset your password.</p>

<p>
    <a href="{{ $resetUrl }}" style="padding:10px 15px;background:#0d6efd;color:#fff;text-decoration:none;">
        Reset Password
    </a>
</p>

<p>If you did not request this, please ignore this email.</p>
