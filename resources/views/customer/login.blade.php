@extends('applogin')

@section('title', 'DApp Header (HTML)')

@section('content')
<section
  class="w-full py-10 md:py-12 px-4 mx-auto min-h-[calc(90vh-50px)] flex items-center justify-center  relative overflow-hidden">

  <div class="w-full max-w-xl mx-auto">
    <div class="relative rounded-2xl">
      @if ($errors->has('referral'))
          <div class="text-red-500 text-sm mt-1">
              {{ $errors->first('referral') }}
          </div>
      @endif
      <div
        class="relative p-6 md:p-8 rounded-2xl w-full mx-auto group overflow-hidden neo-card border !border-blue-300/60
               transition-all duration-300 
               hover:-translate-y-1.5 ">

        {{-- soft glow background --}}
        <div class="pointer-events-none absolute inset-0 opacity-70">
          <div class="absolute -top-24 -left-24 h-40 w-40 rounded-full bg-[var(--theme-skky-200)]/60 blur-3xl group-hover:translate-y-3 transition-transform duration-300"></div>
          <div class="absolute -bottom-24 -right-24 h-44 w-44 rounded-full bg-indigo-200/60 blur-3xl group-hover:-translate-y-1 transition-transform duration-300"></div>
        </div>

        {{-- Logo --}}
        <div class="pb-4 text-center relative z-10">
          <div
            class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.10)] px-4 py-3">
            <img src="/assets/images/opai_7202.webp" width="64" height="48" alt="Logo"
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

          <div class="w-full flex-1  text-center">

            <p class="mb-4 leading-relaxed mx-auto max-w-sm text-slate-600 text-sm">
              Login to access your dashboard.
            </p>


    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4 relative z-10">
    @csrf
    <div class="relative space-y-5">

        {{-- username  --}}
        <!-- <div
            class="relative flex items-center p-3 rounded-lg gap-3 
            border border-slate-200 bg-white 
            focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
            focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
            
            <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" fill="none" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z" stroke="#0f172a" stroke-width="1.5"/>
                <path d="M3 22c0-4.4 4-8 9-8s9 3.6 9 8" stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"/>
            </svg>

            <input type="text" name="userid" id="userid" placeholder="Userid i.e. 1159A66F" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
        </div> -->

        {{-- email --}}
        <div
            class="relative flex items-center p-3 rounded-lg gap-3 
            border border-slate-200 bg-white 
            focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
            focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
            
            <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" fill="none" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z" stroke="#0f172a" stroke-width="1.5"/>
                <path d="M3 22c0-4.4 4-8 9-8s9 3.6 9 8" stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"/>
            </svg>

            <input type="text" name="email" id="email" placeholder="Email i.e. van@example.com" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
        </div>

        {{-- password --}}
        <div
            class="relative flex items-center p-3 rounded-lg gap-3 
            border border-slate-200 bg-white 
            focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
            focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

            <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="16" r="2" stroke="#0f172a" stroke-width="1.5"></circle>
                <path d="M6 10V8c0-3.3 2.7-6 6-6s6 2.7 6 6v2" stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M4 10h16v10H4z" stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"/>
            </svg>

            <input type="password" name="password" id="password" placeholder="Password" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
        </div>

    </div>

    {{-- button --}}
    <div class="">
       <button
                id="btnLogin"
                class="relative w-full mx-auto max-w-32 px-4 py-3 cursor-pointer 
                       flex items-center justify-center text-base capitalize tracking-wide mt-4 
                       rounded-lg border border-[var(--theme-skky-500)] 
                       bg-gradient-to-r from-[var(--theme-skky-500)] via-[var(--theme-cyyan-400)] to-[var(--theme-skky-300)] 
                       text-white font-semibold 
                       transition-all duration-300 ease-out group 
                       hover:-translate-y-0.5 
                       focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--theme-skky-400)] focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100">
            <span>Login</span>
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                </path>
            </svg>
        </button>
    </div>
</form>


            {{-- Connect Wallet Button --}}
            <div class="mx-auto max-w-sm mt-4">
             

              {{-- Sign up link --}}
              <div class="text-sm font-medium text-slate-600 mt-2 text-center">
                New here?
                <a href="{{ route('register') }}"
                   class="text-[var(--theme-high-text)] underline underline-offset-4 decoration-[var(--theme-skky-400)]/80 hover:text-[var(--theme-skky-500)] hover:decoration-[var(--theme-skky-500)] transition">
                  Sign Up
                </a>
              </div>

              {{-- Forget Password Link --}}
              <!-- <div class="text-sm font-medium text-slate-600 mt-2 text-center">
                <a href="{{ route('forgot') }}"
                   class="text-[var(--theme-high-text)] underline underline-offset-4 decoration-[var(--theme-skky-400)]/80 hover:text-[var(--theme-skky-500)] hover:decoration-[var(--theme-skky-500)] transition">
                  Forgot Password ? 
                </a>
              </div> -->

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
                   <img src="/assets/images/instagram.svg" width="24" height="24" alt="telegram">
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
