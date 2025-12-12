@extends('applogin')

@section('title', 'DApp Header (HTML)')

@section('content')
<section
  class="w-full py-10 md:py-12 px-4 mx-auto min-h-[calc(90vh-50px)] flex items-center justify-center  relative overflow-hidden">

  <div class="w-full max-w-xl mx-auto">
    <div class="relative rounded-2xl">

      <div
        class="relative p-6 md:p-8 rounded-2xl w-full mx-auto group overflow-hidden neo-card
                transition-all duration-300 
               hover:-translate-y-1.5">

        {{-- soft glow background --}}
        <div class="pointer-events-none absolute inset-0 opacity-70">
          <div class="absolute -top-24 -left-24 h-40 w-40 rounded-full bg-[var(--theme-skky-200)] blur-3xl group-hover:translate-y-3 transition-transform duration-300"></div>
          <div class="absolute -bottom-24 -right-24 h-44 w-44 rounded-full bg-indigo-200 blur-3xl group-hover:-translate-y-1 transition-transform duration-300"></div>
        </div>

        {{-- Logo --}}
        <div class="pb-4 text-center relative z-10">
          <div
            class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.10)] px-4 py-3">
            <img src="/assets/images/opai.webp" width="64" height="48" alt="Logo"
                 class="w-full max-w-20 mx-auto">
          </div>
        </div>

        <div class="mt-4 flex flex-col items-center relative z-10">
          <h1 class="text-2xl xl:text-3xl font-semibold text-slate-900 text-center tracking-tight">
            Welcome to
            <span class="bg-gradient-to-r from-[var(--theme-skky-500)] via-[var(--theme-cyyan-500)] to-[var(--theme-skky-400)] bg-clip-text text-transparent">
              OpAi
            </span>
          </h1>

          <div class="w-full flex-1 mt-3 text-center">

            <p class="mb-4 leading-relaxed mx-auto max-w-sm text-slate-600 text-sm">
              Create your account to access your dashboard, earnings and staking panel.
            </p>

            <form id="registerForm" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" class="w-full relative z-10">
              @csrf
              <div class="mx-auto w-full space-y-2">

                {{-- Name --}}
                <div class="text-left">
                  <label for="name"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Name
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                    
                    {{-- left icon --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 12c2.7614 0 5-2.2386 5-5s-2.2386-5-5-5-5 2.2386-5 5 2.2386 5 5 5Z"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M4 21c1.5-3 4-5 8-5s6.5 2 8 5"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <input type="text" id="name" name="name" value="" placeholder="Enter Name"
                          class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                          required aria-describedby="hs-validation-name-success-helper">
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Email --}}
                <div class="text-left">
                  <label for="email"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Email
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (envelope) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <rect x="3" y="5" width="18" height="14" rx="2" ry="2"
                            stroke="currentColor" stroke-width="1.7" />
                      <path d="M5 7.5 12 12l7-4.5"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <input type="email" id="email" name="email" value=""
                           placeholder="Enter Email"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required aria-describedby="hs-validation-name-success-helper">
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Mobile --}}
                <div class="text-left">
                  <label for="mobile_number"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Mobile Number (whatsapp)
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (phone) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <path d="M7 4.5 9.5 4a1 1 0 0 1 1.1.6l1.1 2.7a1 1 0 0 1-.2 1.1l-1.2 1.2a10.5 10.5 0 0 0 4.4 4.4l1.2-1.2a1 1 0 0 1 1.1-.2l2.7 1.1a1 1 0 0 1 .6 1.1L19.5 17a3 3 0 0 1-3 2.5A11.5 11.5 0 0 1 6.5 7.5 3 3 0 0 1 7 4.5Z"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <input type="text" id="mobile_number" name="phone" value=""
                           placeholder="Enter Mobile Number"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required aria-describedby="hs-validation-name-success-helper">
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Telegram username --}}
                <div class="text-left">
                  <label for="walletaddress"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                        Telegram Username
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (telegram paper plane) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <path d="M20.5 4.5 4.8 10.3c-.7.26-.69 1.23.02 1.47L9 13.5l1.8 4.3c.3.7 1.28.68 1.53-.03L20.5 4.5Z"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="m9 13.5 3-3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>

                    <input type="text" id="telegram_username" name="telegram_username"
                           value="" placeholder="Enter Telegram Username"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required aria-describedby="hs-validation-name-success-helper">
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Wallet Address --}}
                <div class="text-left">
                  <label for="walletaddress"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Wallet Address
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (telegram paper plane) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <path d="M20.5 4.5 4.8 10.3c-.7.26-.69 1.23.02 1.47L9 13.5l1.8 4.3c.3.7 1.28.68 1.53-.03L20.5 4.5Z"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="m9 13.5 3-3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>

                    <input type="text" id="walletaddress" name="wallet_address"
                           value="" placeholder="Enter Wallet Address"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required aria-describedby="hs-validation-name-success-helper">
                    <input type="hidden" name="sponsor_code" value="{{ $sponsorcode }}">
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Password --}}
                <div class="text-left">
                  <label for="password"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Password
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (lock) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <rect x="4" y="11" width="16" height="9" rx="2" ry="2"
                            stroke="currentColor" stroke-width="1.7" />
                      <path d="M8 11V8a4 4 0 0 1 8 0v3"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                      <circle cx="12" cy="15" r="1.4" stroke="currentColor" stroke-width="1.4" />
                    </svg>

                    <input type="password" id="password" name="password"
                           placeholder="Enter Password"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required>
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Confirm Password --}}
                <div class="text-left">
                  <label for="password_confirmation"
                        class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Confirm Password
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

                    {{-- left icon (double check lock vibe – key) --}}
                    <svg class="w-5 h-5 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                      <circle cx="8.5" cy="15.5" r="3.5"
                              stroke="currentColor" stroke-width="1.7" />
                      <path d="M11.5 15.5H20M16 15.5V12"
                            stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Re-enter Password"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required>
                    
                    {{-- right tick --}}
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

              </div>

              <div class="mx-auto max-w-sm mt-4">
                <button
                  type="submit"
                  id="btnLogin"
                  class="relative w-full mx-auto max-w-52 px-5 py-3 cursor-pointer 
                        flex items-center justify-center gap-2 text-base capitalize tracking-wide mt-4 
                        rounded-lg border border-[var(--theme-skky-500)] whitespace-nowrap
                        bg-gradient-to-r from-[var(--theme-skky-500)] via-[var(--theme-cyyan-400)] to-[var(--theme-skky-300)] 
                        text-white font-semibold 
                        transition-all duration-300 ease-out group 
                        hover:-translate-y-0.5 
                        focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--theme-skky-400)] focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100">

                  <span
                    class="pointer-events-none absolute inset-0 rounded-full bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.65),_transparent_55%)] opacity-70 group-hover:opacity-90 transition-opacity duration-300 mix-blend-screen"></span>

                  <span class="relative z-10 flex items-center justify-center">
                    <span class="font-semibold text-[15px]">
                      Create your Account
                    </span>

                    {{-- arrow icon --}}
                    <svg id="svg1-icon"
                        class="w-5 h-5 ml-1 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-0.5"
                        data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                      </path>
                    </svg>

                    {{-- loader icon (hidden by default) --}}
                    <svg id="svg2-icon"
                        class="w-6 h-6 ml-1 transition-transform duration-500 group-hover:translate-x-1 hidden"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                      <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="40" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                                keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate>
                      </circle>
                      <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="100" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                                keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate>
                      </circle>
                      <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="160" cy="65">
                        <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                                keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate>
                      </circle>
                    </svg>
                  </span>
                </button>

                {{-- Login link --}}
                <div class="text-sm font-medium text-slate-600 mt-3 text-center">
                  Already have an account?
                  <a href="{{ route('login') }}"
                    class="text-[var(--theme-high-text)] underline underline-offset-4 decoration-[var(--theme-skky-400)]/80 hover:text-[var(--theme-skky-500)] hover:decoration-[var(--theme-skky-500)] transition">
                    Login
                  </a>
                </div>

                {{-- Divider --}}
                <div class="flex items-center gap-3 my-5">
                  <span class="h-px flex-1 bg-slate-500"></span>
                  <span class="text-[11px] uppercase tracking-[0.2em] text-slate-500">
                    Community
                  </span>
                  <span class="h-px flex-1 bg-slate-500"></span>
                </div>

                {{-- Social / community links --}}
                <div
                  class="relative flex items-center justify-center rounded-xl p-3 gap-4 leading-none mx-auto w-full max-w-fit 
                        border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.08)]">

                  <a href="#"
                    type="button" target="_blank"
                    class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-[var(--theme-high-text)] transition-transform duration-200 hover:-translate-y-0.5 invert">
                    <span class="[&>svg]:h-6 [&>svg]:w-8 relative z-20">
                      <img src="/assets/images/instagram.svg" width="24" height="24" alt="instagram">
                    </span>
                  </a>

                  <a href="#"
                    type="button" target="_blank"
                    class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-[var(--theme-high-text)] transition-transform duration-200 hover:-translate-y-0.5">
                    <span class="relative z-20">
                      <img src="/assets/images/facebook.svg" width="28" height="28" alt="facebook">
                    </span>
                  </a>

                  <a href="#"
                    type="button" target="_blank"
                    class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-[var(--theme-high-text)] transition-transform duration-200 hover:-translate-y-0.5">
                    <span class="relative z-20">
                      <img src="/assets/images/youtube.svg" width="28" height="28" alt="youtube">
                    </span>
                  </a>

                  <a href="#"
                    type="button" target="_blank"
                    class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-[var(--theme-high-text)] transition-transform duration-200 hover:-translate-y-0.5 invert">
                    <span class="relative z-20">
                      <img src="/assets/images/telegram.svg" width="24" height="24" alt="telegram">
                    </span>
                  </a>
                </div>
              </div>
            </form>

            {{-- Create Account Button --}}
            
          </div>
        </div>

        <div
          class="absolute inset-x-6 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100">
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
