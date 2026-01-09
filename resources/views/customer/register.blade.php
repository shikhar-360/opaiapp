@extends('applogin')

@section('title', 'Register')

@section('content')
<section class="w-full pb-16 md:pb-12 pt-0 md:pt-6 px-4 mx-auto min-h-[calc(90vh-50px)] flex items-center justify-center relative overflow-hidden">

  <div class="w-full max-w-2xl mx-auto">
    <div class="relative p-6 md:p-8 rounded-2xl w-full mx-auto group overflow-hidden neo-card border !border-blue-300/60">

<div class="pointer-events-none absolute inset-0 opacity-70">
          <div class="absolute -top-24 -left-24 h-40 w-40 rounded-full bg-[var(--theme-skky-200)]/60 blur-3xl group-hover:translate-y-3 transition-transform duration-300"></div>
          <div class="absolute -bottom-24 -right-24 h-44 w-44 rounded-full bg-indigo-200/60 blur-3xl group-hover:-translate-y-1 transition-transform duration-300"></div>
        </div>

      <div class="relative ">

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
            <span class="bg-gradient-to-r from-[var(--theme-skky-500)] via-[var(--theme-cyyan-500)] to-[var(--theme-skky-400)] bg-clip-text text-transparent">
              OPAI
            </span>
          </h1>
          <p class="mt-3 text-sm text-slate-600 max-w-md mx-auto leading-relaxed">
              Create your account to access your dashboard.
            </p>
        </div>

            {{-- Form --}}
            <form id="registerForm" method="POST" action="{{ route('register.submit') }}" enctype="multipart/form-data" class="mt-8">
              @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Sponsor ID (FIRST FIELD) --}}
            <div>
              <label class="block text-[11px] uppercase tracking-wide font-medium text-slate-700 mb-2">
                Mentor ID
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

                <input type="text" name="sponsor_code" placeholder="Enter Mentor ID"
                       class="w-full h-12 rounded-xl border border-slate-200 bg-white pl-11 pr-10 outline-none focus:ring-2 focus:ring-sky-200"
                       value="{{ $sponsorcode }}"
                      {{ $sponsorcode ? 'readonly' : '' }}
                      >

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

          {{-- Terms Checkbox --}}
          <div class="mt-6 mx-auto">
            <label class="flex items-start justify-center gap-3 text-sm text-slate-600 select-none">
              <input id="termsCheck" type="checkbox"
                     class="mt-1 h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-200"
                     disabled>
              <span>
                I have read all
                <button type="button" id="openTermsBtn"
                        class="text-slate-900 underline underline-offset-4 cursor-pointer">
                  Terms &amp; Conditions
                </button>
              </span>
            </label>

            <p id="termsError" class="mt-2 text-xs text-red-600 hidden text-center">
              Please read and accept the Terms &amp; Conditions to continue.
            </p>
          </div>

          {{-- Button --}}
          <div class="mt-4 flex justify-center">
            <button type="submit" id="btnLogin"
                    class="relative w-full mx-auto max-w-48 px-4 py-3 cursor-pointer
                       flex items-center justify-center text-base capitalize tracking-wide mt-4
                       rounded-lg border border-[var(--theme-skky-500)]
                       bg-gradient-to-r from-[var(--theme-skky-500)] via-[var(--theme-cyyan-400)] to-[var(--theme-skky-300)]
                       text-white font-semibold
                       transition-all duration-300 ease-out group
                       hover:-translate-y-0.5
                       focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--theme-skky-400)] focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100">
              Create Your Account
                </button>
          </div>


                


          {{-- Login --}}
          <p class="text-sm text-slate-600 mt-4 text-center">
            Already have an account?
            <a href="{{route('login')}}" class="text-slate-900 underline underline-offset-4">LOGIN</a>
          </p>

          {{-- Community ss--}}
          <div class="mt-4">
            <div class="flex items-center gap-4">
              <span class="h-px flex-1 bg-slate-200"></span>
              <span class="text-[11px] tracking-[0.25em] text-slate-500">COMMUNITY</span>
              <span class="h-px flex-1 bg-slate-200"></span>
            </div>

            <div class="mt-4 flex justify-center">
              <div class="inline-flex items-center gap-4 rounded-xl bg-white border border-slate-200 px-6 py-3 shadow-sm">
                {{-- x --}}
                <a href="https://x.com/opainetwork" class="text-slate-800 hover:text-slate-950">
                  <img src="{{ asset('assets/images/x.webp') }}" alt="x"
                    class="w-auto h-5">
                </a>
                {{-- instagram --}}
                <!-- <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                  </svg>
                  </a> -->
                {{-- facebook --}}
                <a href="https://www.facebook.com/people/OPAI/61584302932195/" class="text-slate-800 hover:text-slate-950">
                  <img src="{{ asset('assets/images/Fb.webp') }}" alt="facebook"
                        class="w-auto h-5">
                  </a>
                {{-- youtube --}}
                <!-- <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M22 12s0-4-1-5-5-1-9-1-8 0-9 1-1 5-1 5 0 4 1 5 5 1 9 1 8 0 9-1 1-5 1-5Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M10 15V9l6 3-6 3Z" fill="currentColor"/>
                  </svg>
                  </a> -->
                {{-- telegram --}}
                <!-- <a href="#" class="text-slate-800 hover:text-slate-950">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M22 2 11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M22 2 15 22l-4-9-9-4 20-7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  </a>
                </div> -->
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>

{{-- Terms Modal --}}
<div id="termsModal" class="fixed inset-0 z-50 hidden">
  
  <div id="termsBackdrop" class="absolute inset-0 bg-slate-900/60"></div>

  
  <div class="fixed inset-0 flex items-center justify-center p-4 md:p-6">
    
    <div
      class="w-full max-w-3xl rounded-2xl bg-white shadow-xl h-full
             overflow-hidden max-h-[90vh] flex flex-col">

      
      <div class="flex items-center justify-between px-4 md:px-5 py-3 md:py-4 border-b border-slate-200">
        <h3 class="text-base font-semibold text-slate-900">
          Terms &amp; Conditions
        </h3>
        <button type="button" id="closeTermsBtn"
                class="rounded-lg px-3 py-1.5 text-slate-600 hover:bg-slate-100">
          Close
        </button>
      </div>


      <div class="flex-1 overflow-hidden p-3 md:p-4">
        <div class="h-full w-full rounded-xl border border-slate-200 bg-slate-50 overflow-hidden">
          <!-- <object
            data="{{ asset('storage/Signup-T&C.pdf') }}"
            type="application/pdf"
            class="w-full h-full"> 
            <p class="p-4 text-sm text-slate-600 text-center">
              PDF preview not supported.
              <a href="/assets/terms.pdf" target="_blank"
                 class="text-slate-900 underline">
                Open PDF
              </a>
            </p>
          </object> -->
          <div class="w-full h-screen bg-gray-100 flex justify-center">
            <div
                id="pdf-viewer"
                class="w-full max-w-4xl h-full overflow-y-auto bg-white p-4">
            </div>
          </div>
        </div>
      </div>

    
      <div class="flex items-center justify-end gap-3 px-4 md:px-5 py-3 md:py-4 border-t border-slate-200">
        <button type="button" id="declineTermsBtn"
                class="px-4 py-2 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50">
          Decline
        </button>

        <button type="button" id="agreeTermsBtn"
                class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:opacity-90">
          I Agree
        </button>
      </div>

    </div>
  </div>
</div>


</section>
<style>
  #pdf-viewer canvas {
      display: block;
      margin: 0 auto 24px auto;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script>
  (function () {
    const registerForm = document.getElementById('registerForm');

    const termsCheck = document.getElementById('termsCheck');
    const openTermsBtn = document.getElementById('openTermsBtn');
    const termsModal = document.getElementById('termsModal');
    const termsBackdrop = document.getElementById('termsBackdrop');

    const closeTermsBtn = document.getElementById('closeTermsBtn');
    const declineTermsBtn = document.getElementById('declineTermsBtn');
    const agreeTermsBtn = document.getElementById('agreeTermsBtn');

    const termsError = document.getElementById('termsError');

    function openModal() {
      termsModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      termsModal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    openTermsBtn.addEventListener('click', openModal);

    closeTermsBtn.addEventListener('click', closeModal);
    termsBackdrop.addEventListener('click', closeModal);

    declineTermsBtn.addEventListener('click', function () {
      termsCheck.checked = false;
      termsCheck.disabled = true;
      closeModal();
    });

    agreeTermsBtn.addEventListener('click', function () {
      termsCheck.checked = true;
      termsCheck.disabled = true; // lock after agree
      termsError.classList.add('hidden');
      closeModal();
    });

    // Esc close
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && !termsModal.classList.contains('hidden')) closeModal();
    });

    // Form submit guard
    registerForm.addEventListener('submit', function (e) {
      if (!termsCheck.checked) {
        e.preventDefault();
        termsError.classList.remove('hidden');
        openModal();
      }
    });
  })();


const pdfUrl = "https://user.ordinarypeopleai.com/storage/Signup-T&C.pdf";

pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js";

pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
    const container = document.getElementById('pdf-viewer');

    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
        pdf.getPage(pageNum).then(page => {
            const scale = 1.3;
            const viewport = page.getViewport({ scale });

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.height = viewport.height;
            canvas.width = viewport.width;
            canvas.classList.add('mb-6', 'mx-auto');

            container.appendChild(canvas);

            page.render({
                canvasContext: context,
                viewport: viewport
            });
        });
    }
});


</script>

@endsection
