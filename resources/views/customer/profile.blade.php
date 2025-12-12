@extends('app')

@section('title', 'Profile')

@section('content')
<section class="min-h-screen py-8 bg-slate-50/50">
  <div class="mx-auto px-4 max-w-[900px]">

    <div class="grid grid-cols-1 gap-5 max-w-2xl mx-auto">

      {{-- Center content --}}
      <div class="grid grid-cols-1">
        <div class="col-span-1 grid grid-cols-1">
          <h2 class="text-2xl font-semibold mb-4 text-slate-900 text-center">
            Profile
          </h2>
          
          {{-- MAIN PROFILE CARD --}}
          <div
            class="relative p-4 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden 
                   border border-slate-200 bg-white backdrop-blur-2xl 
                   shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
                   hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.20)]">

            {{-- subtle gradient glow --}}
            <div class="pointer-events-none absolute inset-0 opacity-70">
              <div class="absolute -top-24 -left-24 w-64 h-64 bg-sky-300/20 rounded-full blur-3xl"></div>
              <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-blue-400/15 rounded-full blur-3xl"></div>
            </div>

            <form method="POST" action="{{ route('customer.profile.save') }}" enctype="multipart/form-data" class="w-full relative z-10">
              @csrf
              <div class="mx-auto w-full space-y-4">

                {{-- Name --}}
                <div class="text-left">
                  <label for="name"
                    class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
                    Name
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                           focus-within:bg-sky-50/60 transition-colors">
                    <input type="text" id="name" name="name" value="{{ $customer->name }}" placeholder="Enter Name"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required aria-describedby="hs-validation-name-success-helper">
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
                    class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
                    Wallet Address
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                           focus-within:bg-sky-50/60 transition-colors">
                    <input type="text" id="wallet_address" name="wallet_address"
                      value="{{ $customer->wallet_address }}" placeholder="Enter Wallet Address"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required aria-describedby="hs-validation-name-success-helper" disabled>
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
                    class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
                    Email
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                           focus-within:bg-sky-50/60 transition-colors">
                    <input type="email" id="email" name="email" value="{{ $customer->email }}"
                      placeholder="Enter Email"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required aria-describedby="hs-validation-name-success-helper" disabled >
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
                  <label for="phone"
                    class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
                    Mobile Number
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                           focus-within:bg-sky-50/60 transition-colors">
                    <input type="text" id="phone" name="phone" value="{{ $customer->phone }}"
                      placeholder="Enter Mobile Number"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required aria-describedby="hs-validation-name-success-helper">
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                  <button type="submit"
                    class="px-5 py-2.5 mx-auto flex items-center justify-center gap-2 
                           text-sm sm:text-base tracking-wide mt-4 
                           rounded-full border border-sky-500 
                           bg-gradient-to-r from-sky-500 to-sky-600 
                           text-white font-semibold 
                           shadow-[0_8px_20px_rgba(56,189,248,.35)] 
                           hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] 
                           active:scale-95 transition-all duration-300 ease-out">
                    <span>Update</span>
                    <svg id="svg1-icon"
                      class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                      aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>

            <div
              class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-sky-400/70 to-transparent opacity-100">
            </div>
          </div>
        </div>
      </div>

    </div>

    {{-- Password + referral box (hidden by default) --}}
    <div class="grid grid-cols-1 hidden gap-5 mt-5 max-w-2xl mx-auto">
      <div
        class="relative p-4 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden 
               border border-slate-200 bg-white backdrop-blur-2xl 
               shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
               hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(15,23,42,0.20)]">

        {{-- bg glow --}}
        <div class="pointer-events-none absolute inset-0 opacity-60">
          <div class="absolute -top-24 -right-24 w-64 h-64 bg-sky-300/20 rounded-full blur-3xl"></div>
        </div>

        {{-- Referral box --}}
        <div
          class="relative z-10 bg-white border border-slate-200 mb-4 p-4 rounded-xl flex items-center justify-between shadow-sm">
          <div class="flex flex-wrap sm:flex-nowrap items-center sm:space-x-3 w-full">
            <img src="/assets/images/opai.webp" width="64" height="48" alt="Logo"
              class="w-12 h-auto object-contain">
            <div class="w-full mt-2 sm:mt-0">
              <h3 class="text-base mb-2 leading-none text-slate-900">
                OpAi Referral Link
              </h3>
              <div
                class="bg-slate-50 px-2 py-1 rounded flex items-center justify-between overflow-auto 
                       border border-slate-200">
                <span id="referral-link"
                  class="text-xs truncate text-ellipsis overflow-auto text-slate-800"
                  style="text-overflow: unset; overflow: auto;">
                  https://OpAi.farm/register?sponser_code=E50C95
                </span>
                <button onclick="copyReferrallink(); showToast('success', 'Copied to clipboard!')"
                  class="ml-2 pl-2 border-l border-slate-200 flex items-center justify-center">
                  <svg class="w-6 h-6 min-w-6 min-h-6 ml-1" viewBox="0 0 1024 1024">
                    <path fill="#38bdf8"
                      d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z">
                    </path>
                    <path fill="#38bdf8"
                      d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z">
                    </path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <script>
          function copyReferrallink() {
            const linkElement = document.getElementById("referral-link");
            if (!linkElement) {
              console.error("Referral link element not found!");
              return;
            }
            const link = linkElement.innerText;
            navigator.clipboard.writeText(link).catch(() => {
              console.error("Failed to copy text!");
            });
          }
        </script>

        {{-- Password form --}}
        <form method="POST" action="{{ route('customer.profile.save') }}" class="space-y-4 relative z-10">
          @csrf
          <div class="relative space-y-5">

            {{-- old password --}}
            <div
              class="relative flex items-center p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="16" r="2" stroke="#0f172a" stroke-width="1.5"></circle>
                <path
                  d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                  stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"></path>
                <path
                  d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                  stroke="#0f172a" stroke-width="1.5" stroke-linecap="round"></path>
              </svg>
              <input type="password" name="old_password" id="old_password" placeholder="Old Password" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
            </div>

            {{-- New password --}}
            <div
              class="relative flex items-center p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" viewBox="0 0 24 24" fill="none">
                <path
                  d="M21 13V8C21 6.89543 20.1046 6 19 6H5C3.89543 6 3 6.89543 3 8V14C3 15.1046 3.89543 16 5 16H12"
                  stroke="#0f172a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M14.5 18.5L16.5 20.5L20.5 16.5" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12 11.01L12.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M16 11.01L16.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8 11.01L8.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <input type="password" name="new_password" id="new_password" placeholder="New Password" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
            </div>

            {{-- Repeat password --}}
            <div
              class="relative flex items-center p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-slate-500" viewBox="0 0 24 24" fill="none">
                <path
                  d="M21 13V8C21 6.89543 20.1046 6 19 6H5C3.89543 6 3 6.89543 3 8V14C3 15.1046 3.89543 16 5 16H12"
                  stroke="#0f172a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M20.8789 16.9174C21.3727 17.2211 21.3423 17.9604 20.8337 18.0181L18.2671 18.309L17.1159 20.6213C16.8878 21.0795 16.1827 20.8552 16.0661 20.2873L14.8108 14.1713C14.7123 13.6913 15.1437 13.3892 15.561 13.646L20.8789 16.9174Z"
                  stroke="#0f172a" stroke-width="1.5"></path>
                <path d="M12 11.01L12.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M16 11.01L16.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8 11.01L8.01 10.9989" stroke="#0f172a" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat password"
                required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]">
            </div>
          </div>

          {{-- button --}}
          <div class="pt-2">
            <button type="submit"
              class="px-5 py-2.5 mx-auto flex items-center justify-center gap-2 
                     text-sm sm:text-base tracking-wide mt-4 
                     rounded-full border border-sky-500 
                     bg-gradient-to-r from-sky-500 to-sky-600 
                     text-white font-semibold 
                     shadow-[0_8px_20px_rgba(56,189,248,.35)] 
                     hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] 
                     active:scale-95 transition-all duration-300 ease-out">
              <span>Reset Password</span>
              <svg id="svg1-icon"
                class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                </path>
              </svg>
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
