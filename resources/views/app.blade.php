<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>OPAI – AI-Powered Digital Ecosystem for Smart Growth & Community Empowerment</title>
 <meta name="description" content="OPAI is an AI-powered digital ecosystem that empowers individuals with intelligent automation, smart tools, and a transparent, future-ready platform for growth.">


  <style> 
    :root {
      --theme-bg: #F5F7FC;
      --theme-primary-text:#7ed3ff;
      --theme-high-text: #74d4ff;
      --theme-primary-bg : #1da3d8;
      --theme-primary-border : #314158;
      --theme-secondary-border: #70c4ff80;
      --theme-secondary-text: #778ecc;
      /* --theme-primary-border: #ffffff; */
      --theme-cardbg: #3a3a3d;
      
    }
  </style>

  @vite(entrypoints: 'resources/css/app.css')
  @vite(['resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col text-white !bg-[var(--theme-bg)]">

  @include('components.header') 

  <main class="flex-1 pt-16 md:pt-[56px] md:ml-64 main-bgimg relative">

    <img src="/assets/images/diag-ascii.png"  alt="bnrbg"
             class="absolute top-14 left-0 w-full h-full object-cover -z-10 opacity-100">
    @yield('content')

  </main>

  @include('components.footer')

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
    if (type === 'success') {
        notyf.success(input);
    } else if (type === 'error') {
        notyf.error(input);
    } else {
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
</html>
