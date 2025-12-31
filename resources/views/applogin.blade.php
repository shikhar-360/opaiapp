<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>OPAI – AI-Powered Digital Ecosystem for Smart Growth & Community Empowerment</title>
 <meta name="description" content="OPAI is an AI-powered digital ecosystem that empowers individuals with intelligent automation, smart tools, and a transparent, future-ready platform for growth.">
 <!-- in opaiapphtml/assets/images/favicon2.ico -->
<link rel="icon" type="image/x-icon" href="/assets/images/favicon2.ico">

    <style> 
:root {
 
  --theme-bg: #f9fbff;
  --theme-header-bg: #f1f6ff;
  --theme-menu-bg: #eaf2ff;
  --theme-primary-bg: #4a63d9;
  --theme-primary-text: #2f3a8f;
  --theme-high-text: #3b6fff;
  --theme-cyyan-500: #6fa8ff;
  --theme-cyyan-400: #8fc0ff;
  --theme-cyyan-200: #d6e8ff;
  --theme-skky-600: #3f5bd8;
 --theme-skky-500: #5b78ff;
  --theme-skky-400: #6fa8ff;
  --theme-skky-300: #9ac5ff;
  --theme-skky-200: #cfe2ff;
  --theme-skky-100: #edf4ff;
  --theme-skkky-50: #f7faff;
  --theme-bllue-500: #2a3480;
  --theme-bllue-400: #5f86ff;
  --theme-primary-border: #c7d4ff;
  --theme-secondary-border: #9bb7ff80;
  --theme-secondary-text: #6a78b8;
  --theme-cardbg: #ffffff;
}

  </style>

  @vite(entrypoints: 'resources/css/app.css')
  @vite(['resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col text-white !bg-[var(--theme-bg)]  ">

  {{-- @include('components.header')  --}}

  <main class="flex-1 main-bgimg relative ">

    <img src="/assets/images/white-grid.png"  alt="bnrbg"
             class="absolute top-14 left-0 w-full h-full object-cover -z-10 opacity-100">
             
    @yield('content')

  </main>

  {{-- @include('components.footer') --}}

  @stack('scripts')

</body>

<!-- Notyf JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
var notyf = new Notyf({
    duration: 3000, // Auto-close after 3s
    dismissible: true,
    position: {
        x: 'right',
        y: 'top'
    },
    ripple: false, // Prevent overlapping animations
    types: [{
            type: 'success',
            background: 'green',
        },
        {
            type: 'error',
            background: 'red',
        },
        {
            type: 'warning',
            background: 'orange',
        },
        {
            type: 'info',
            background: 'blue',
        }
    ]
});
var notyfNotifications = [];
function showToast(type, message) {
    let input = message || "";
    if (type === 'success') 
    {
        notyf.success(input);
    } 
    else if (type === 'error') 
    {
        notyf.error(input);
    } 
    else 
    {
        notyf.open({ type, message: input });
    }
}
</script>
@if ($errors->has('status_code') && $errors->first('status_code') == 'error')
    <script>
        showToast("error", {!! json_encode($errors->first('message')) !!});
    </script>
@elseif ($errors->has('status_code') && $errors->first('status_code') == 'success')
    <script>
    showToast("success", {!! json_encode($errors->first('message')) !!});
    </script>    
@endif

@if (session('status_code') === 'error')
    <script>
        showToast("error", {!! json_encode(session('message')) !!});
    </script>
@elseif (session('status_code') === 'success')
    <script>
        showToast("success", {!! json_encode(session('message')) !!});
    </script>
@endif
<script>
document.getElementById("registerForm").addEventListener("submit", function (e) {
    // let errors = [];

    // Read input values
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("mobile_number").value.trim();
    const telegram = document.getElementById("telegram_username").value.trim();
    const wallet = document.getElementById("walletaddress").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPass = document.getElementById("password_confirmation").value.trim();

    // VALIDATIONS
    if (name.length < 3) {
        e.preventDefault();
      showToast("error", "Name must be at least 3 characters long.");
      return false;
    }

    if (!validateEmail(email)) {
        e.preventDefault();
      showToast("error", "Enter a valid email address.");
      return false;
    }

    if (!/^[0-9]{10}$/.test(phone)) {
        e.preventDefault();
      showToast("error", "Mobile number must be 10 digits.");
      return false;
    }

    if (telegram.length < 3) {
        e.preventDefault();
      showToast("error", "Telegram username is too short.");
     return false;
    }

    if (wallet.length < 10) {
        e.preventDefault();
      showToast("error", "Enter a valid wallet address.");
      return false;
    }

    if (password.length < 3 || password.length > 20) {
        e.preventDefault();
      showToast("error", "Password must be between 3 and 20 characters.");
      return false;
    }

    if (password !== confirmPass) {
        e.preventDefault();
        showToast("error", "Passwords do not match.");
        return false;
    }

    // If errors exist, stop form submit + show toasts
    if (errors.length > 0) {
        e.preventDefault();

        // errors.forEach(error => {
        //     showToast("error", error);
        // });

        return false;
    }

    return true;
});

// EMAIL VALIDATION HELPER
function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
</script>
</html>
