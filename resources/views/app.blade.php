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


</html>
