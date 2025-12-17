@extends('applogin')

@section('title', 'Register')

@section('content')
<section class="w-full py-10 md:py-12 px-4 mx-auto min-h-[calc(90vh-50px)] flex items-center justify-center relative overflow-hidden">

  <div class="w-full max-w-2xl mx-auto">
    <div class="relative rounded-3xl border border-slate-200/70 bg-white/60 backdrop-blur-xl shadow-[0_30px_90px_rgba(15,23,42,0.10)] overflow-hidden">

        {{-- soft glow background --}}
      <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-28 -left-28 h-60 w-60 rounded-full bg-sky-200 blur-3xl opacity-70"></div>
        <div class="absolute -bottom-28 -right-28 h-72 w-72 rounded-full bg-indigo-200 blur-3xl opacity-70"></div>
        </div>

      <div class="relative p-5">

        {{-- Logo --}}
        <!-- in opaiapphtml/assets/images/opai_7202.webp -->
        <div class="text-center">
          <div class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.10)] px-6 py-4">
            <img src="/assets/images/opai_7202.webp" width="64" height="48" alt="Logo"
                 class="w-14 h-14 object-contain">
          </div>
        </div>

        {{-- Heading --}}
        <div class="mt-6 text-center">
          <h1 class="text-2xl md:text-3xl font-semibold text-slate-900 tracking-tight">
            Welcome to
            <span class="bg-gradient-to-r from-sky-500 via-cyan-500 to-sky-400 bg-clip-text text-transparent">
              OpAi
            </span>
          </h1>
          <p class="mt-3 text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
              Create your account to access your dashboard, earnings and staking panel.
            </p>
        </div>
            {{-- Form --}}
            <form id="registerForm" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" class="mt-8">
              @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Sponsor ID (FIRST FIELD) --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">
                Sponsor ID
              </label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- users icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                    <path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke="currentColor" stroke-width="2"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="2"/>
                  </svg>
                </span>

                <input type="text" name="sponsor_code" placeholder="Enter Sponsor ID"
                       class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200"
                       value="{{ $sponsorcode }}"
                       readonly>

                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  {{-- check icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </span>
              </div>
            </div>

                {{-- Name --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">Name</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- user icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 21a8 8 0 0 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>

                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name"
                          class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200">
                    <!-- <input type="hidden" name="sponsor_code" value="{{ $sponsorcode }}"> -->
                    
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </span>
              </div>
            </div>

                {{-- Email --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">Email</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- mail icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4h16v16H4V4Z" stroke="currentColor" stroke-width="2" />
                    <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="Enter Email"
                           class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200">
                    
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </span>
                  </div>
                </div>

                {{-- Mobile --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">
                Mobile Number (Whatsapp)
                  </label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- phone icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.9 19.9 0 0 1 3 5.2 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.7c.1.8.3 1.6.6 2.3a2 2 0 0 1-.5 2.1L9 10a16 16 0 0 0 5 5l.9-1.1a2 2 0 0 1 2.1-.5c.7.3 1.5.5 2.3.6A2 2 0 0 1 22 16.9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                    <input type="text" id="mobile_number" name="phone" value="{{ old('phone') }}"
                           placeholder="Enter Mobile Number"
                           class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200">
                    
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </span>
                  </div>
                </div>

            {{-- Telegram --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">
                        Telegram Username
                  </label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- paper plane icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M22 2 11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M22 2 15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                    <input type="text" id="telegram_username" name="telegram_username"
                            value="{{ old('telegram_username') }}" placeholder="Enter Telegram Username"
                           class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200">
                    
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </span>
                  </div>
                </div>

                
                {{-- Password --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">Password</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  {{-- lock icon --}}
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 11h12v10H6V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </span>

                    <input type="password" id="password" name="password" 
                           placeholder="Enter Password"
                           class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200"
                           required>
                    
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </span>
                  </div>
                </div>

            {{-- Confirm Password (full width) --}}
            <div class="md:col-span-2">
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">
                    Confirm Password
                  </label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M7 11V8a5 5 0 0 1 10 0v3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 11h12v10H6V11Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </span>

                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Re-enter Password"
                           class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200"
                           required>
                    
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-emerald-500">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                </span>
                  </div>
                </div>

              </div>

          {{-- Button --}}
          <div class="mt-8 flex justify-center">
            <button type="submit" id="btnLogin"
                    class="w-full max-w-sm h-12 rounded-xl text-white font-semibold
                           bg-gradient-to-r from-sky-500 via-cyan-400 to-sky-300
                           shadow-[0_18px_40px_rgba(14,165,233,0.25)]
                           hover:opacity-95 transition">
              Create Your Account
                </button>

                
                </div>

          {{-- Login --}}
          <p class="text-sm text-slate-600 mt-4 text-center">
            Already have an account?
            <a href="{{route('login')}}" class="text-slate-900 underline underline-offset-4">LOGIN</a>
          </p>

          {{-- Community --}}
          <div class="mt-8">
            <div class="flex items-center gap-4">
              <span class="h-px flex-1 bg-slate-200"></span>
              <span class="text-[11px] tracking-[0.25em] text-slate-500">COMMUNITY</span>
              <span class="h-px flex-1 bg-slate-200"></span>
                </div>

            <div class="mt-4 flex justify-center">
              <div class="inline-flex items-center gap-4 rounded-xl bg-white border border-slate-200 px-6 py-3 shadow-sm">
                {{-- instagram --}}
                <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                  </svg>
                  </a>
                {{-- facebook --}}
                <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M14 9h3V6h-3a4 4 0 0 0-4 4v3H7v3h3v6h3v-6h3l1-3h-4v-3a1 1 0 0 1 1-1Z" fill="currentColor"/>
                  </svg>
                  </a>
                {{-- youtube --}}
                <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M22 12s0-4-1-5-5-1-9-1-8 0-9 1-1 5-1 5 0 4 1 5 5 1 9 1 8 0 9-1 1-5 1-5Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M10 15V9l6 3-6 3Z" fill="currentColor"/>
                  </svg>
                  </a>
                {{-- telegram --}}
                <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M22 2 11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M22 2 15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  </a>
                </div>
              
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>
</section>
@endsection
