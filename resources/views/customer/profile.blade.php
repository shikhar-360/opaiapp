@extends('app')

@section('title', 'Profile')

@section('content')
<section class="min-h-screen pt-8 pb-16 lg:pb-8 bg-slate-50/50">
  <div class="mx-auto max-w-[1400px] px-4">


    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

      {{-- =================  profile ================= --}}
      <div class="space-y-5">
        <div class="grid grid-cols-1 h-full">
          <div class="col-span-1 grid grid-cols-1 h-full">
            <h2 class="text-xl font-semibold mb-2 text-slate-900 text-center">
            Profile
          </h2>
          
          {{-- MAIN PROFILE CARD --}}
          <div
              class="h-full relative p-4 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden 
                   border border-slate-200 bg-white backdrop-blur-2xl 
                   shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
                   hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.20)]">

              {{-- subtle gradient glow --}}
              <div class="pointer-events-none absolute inset-0 opacity-70">
                  <div class="absolute -top-24 -left-24 w-64 h-64 bg-[var(--theme-skky-300)]/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-blue-400/15 rounded-full blur-3xl"></div>
              </div>
            <form id="profileForm" method="POST" action="{{ route('customer.profile.save') }}" enctype="multipart/form-data" class="w-full relative z-10">
              @csrf
              <div class="flex items-center gap-4 mb-4">
                <div class="relative">
     
                  <div
        class="w-16 h-16   md:w-20 md:h-20 rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-md
                           ring-1 ring-[var(--theme-skky-400)]/20">
                      @if ($customer->profile_image)
                        <img id="profilePreview" src="{{ asset('storage/' . $customer->profile_image) }}"
                            alt="Profile" class="w-full h-full object-cover">
                      @else
                        <img id="profilePreview" src="/assets/images/default-avatar.png" alt="Profile"
                            class="w-full h-full object-cover">
                      @endif

                      
                  </div>

                  {{-- Camera button --}}
                  <label for="profile_pic"
                    class="absolute -bottom-2 -right-2 w-9 h-9 rounded-full cursor-pointer
                           bg-[var(--theme-skky-600)] text-white flex items-center justify-center
                           border border-[var(--theme-skky-500)] shadow-md hover:bg-sky-700 active:scale-95 transition">
                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none">
                      <path d="M9 7l1.2-2h3.6L15 7h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h2Z"
                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                            stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </label>

                  {{-- Hidden input --}}
                  <input id="profile_pic" name="profile_pic" type="file" accept="image/*" class="hidden">
                </div>

                {{-- Name + Badge + Rank --}}
                <div class="min-w-0">
                  <h3 class="text-base sm:text-lg font-semibold text-slate-900 leading-tight truncate">
                    <span id="profileNameText">{{ $customer->name }}</span>
                  </h3>

                  <div class="mt-2 flex flex-wrap items-center gap-2">
                    {{-- Badge --}}
                   <span
                      class="inline-flex items-center gap-1 rounded-lg bg-[var(--theme-skkky-50)]
         border border-[var(--theme-skky-200)] p-1 text-[11px] sm:text-xs
         font-medium text-[var(--theme-primary-text)]">
                      <!-- <img src="/assets/images/rank/emerald-rank.webp"
                           alt="Rank"
                           class="w-8 h-8 object-contain"> -->
                            @if($customer->leadership_rank == 1 || $customer->leadership_rank == 'gold')
                                <img src="{{ asset('assets/images/rank/gold-rank.webp?v=1') }}"
                                alt="Rank"
                                class="w-6 h-6 object-contain">
                            @elseif($customer->leadership_rank == 2 || $customer->leadership_rank == 'sapphire')
                                <img src="{{ asset('assets/images/rank/sapphire-rank.webp?v=1') }}" 
                                alt="Rank"
                                class="w-6 h-6 object-contain">
                            @elseif($customer->leadership_rank == 3 || $customer->leadership_rank == 'emerald')
                                <img src="{{ asset('assets/images/rank/emerald-rank.webp?v=1') }}" 
                                alt="Rank"
                                class="w-6 h-6 object-contain">
                            @elseif($customer->leadership_rank == 4 || $customer->leadership_rank == 'ruby')
                                <img src="{{ asset('assets/images/rank/ruby-rank.webp?v=1') }}" 
                                alt="Rank"
                                class="w-6 h-6 object-contain">
                            @elseif($customer->leadership_rank == 5 || $customer->leadership_rank == 'diamond')
                                <img src="{{ asset('assets/images/rank/diamond-rank.webp?v=1') }}" 
                                alt="Rank"
                                class="w-8 h-8 object-contain">
                            @endif
                          
                      {{-- Rank:  <span class="font-semibold">{{ $customer->leadership_rank??'-' }}</span> --}}
                    </span>


                    {{-- Rank --}}
                    <span
                      class="inline-flex gap-1 items-center rounded-full bg-emerald-50 px-2 py-1 text-[11px] text-emerald-700 border border-emerald-300 justify-center">
                      Vip Level: <span class="font-semibold text-slate-900">{{ $customer->champions_rank??'-' }}</span>
                    </span>
                  </div>

                  <p class="text-[11px] sm:text-xs text-slate-500 mt-2">
                    JPG/PNG recommended • Max 2MB
                  </p>
                </div>
              </div>
            
              <div class="mx-auto w-full space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2"> 
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
                </div>
                {{-- Wallet Address --}}
                @php
                $wareadonly = '';
                if(!$customer['iswallet_editable'])
                {
                  $wareadonly = 'readonly';
                }
                $phreadonly = '';
                if(!$customer['isphone_editable'])
                {
                  $phreadonly = 'readonly';
                }
                @endphp
                



  <div class="grid grid-cols-1 sm:grid-cols-2 gap-2"> 

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
                    <input type="text" id="wallet_address" name="wallet_address"
                      value="{{ $customer->wallet_address }}" placeholder="Enter Wallet Address"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                             required aria-describedby="hs-validation-name-success-helper" {{ $wareadonly }}>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                      </div>
                    </div>
                  </div>
                
                {{--Confirm Wallet Address --}}
                <div class="text-left">
                  <label for="confirm_walletaddress"
                          class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                  Confirm Wallet Address
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                            border border-slate-200 bg-white 
                            focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                            focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                    <input type="text" id="confirm_walletaddress" name="confirm_walletaddress"
                             value="{{ $customer->wallet_address }}" placeholder="Confirm Wallet Address"
                            class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                            required aria-describedby="hs-validation-name-success-helper" {{ $wareadonly }}>
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

                 

                {{-- Email --}}
                

                {{-- Mobile --}}
                <div class="text-left">
                  <label for="phone"
                    class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    Mobile Number
                  </label>
                  <div
                      class="relative flex items-center p-3 rounded-lg gap-3 
                             border border-slate-200 bg-white 
                             focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                             focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                    <input type="text" id="phone" name="phone" value="{{ $customer->phone }}"
                      placeholder="Enter Mobile Number"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required 
                      aria-describedby="hs-validation-name-success-helper" {{ $phreadonly }}>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                {{-- Telegram --}}
                <div class="text-left">
                  <label for="phone"
                    class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
                    Telegram Username
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3 
                           border border-slate-200 bg-white 
                           focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                           focus-within:bg-sky-50/60 transition-colors">
                    <input type="text" id="telegram_username" name="telegram_username" value="{{ $customer->telegram_username }}"
                      placeholder="Enter Telegram Username"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      required aria-describedby="hs-validation-name-success-helper cursor-no-drop"  disabled>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>
                
                {{-- Terms checkbox --}}
                <div class="flex items-center justify-center gap-2 pt-2">
                  <input id="termsCheck" type="checkbox"
                        class=" w-4 h-4 rounded border-slate-300 text-sky-600 focus:ring-sky-300" required>
                  <label for="termsCheck" class="text-sm text-slate-700">
                    I have read and agree to the the details.
                
                  </label>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                  <button type="button" id="openPasswordModal"
                            class="px-5 py-2.5 mx-auto flex items-center justify-center  
                                   text-sm sm:text-base tracking-wide
                                   rounded-lg border border-[var(--theme-skky-500)] 
                                   bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)] 
                                   text-white font-semibold 
                                   
                                   hover:-translate-y-1 cursor-pointer 
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
                class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100">
              </div>
            </div>
          </div>
    </div>

    {{-- Password + referral box (hidden by default) --}}
        <div class="grid grid-cols-1 hidden gap-5 mt-5">
      <div
        class="relative p-4 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden 
               border border-slate-200 bg-white backdrop-blur-2xl 
               shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
               hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(15,23,42,0.20)]">

        {{-- bg glow --}}
        <div class="pointer-events-none absolute inset-0 opacity-60">
              <div class="absolute -top-24 -right-24 w-64 h-64 bg-[var(--theme-skky-300)]/20 rounded-full blur-3xl"></div>
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
                         focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                         focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
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
                         focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                         focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
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
                         focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                         focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
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
                        class="px-5 py-2.5 mx-auto flex items-center justify-center  
                     text-sm sm:text-base tracking-wide mt-4 
                               rounded-lg border border-[var(--theme-skky-500)] 
                               bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)] 
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

    {{-- ================= voting ================= --}}
    
      <div class="space-y-5 h-full max-h-[400px]">
         <h2 class="text-xl font-semibold mb-4 text-slate-900 text-center">
              Voting
            </h2>
        <div class="grid grid-cols-1 h-full">
          <div class="grid grid-cols-1 h-full">
           

            {{-- MAIN VOTING CARD --}}
            <div
              class="relative p-4 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden 
                     border border-slate-200 bg-white backdrop-blur-2xl 
                     shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
                     hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.20)] h-full">

              {{-- subtle gradient glow --}}
              <div class="pointer-events-none absolute inset-0 opacity-70">
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-[var(--theme-skky-300)]/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-blue-400/15 rounded-full blur-3xl"></div>
              </div>

              <form method="POST" action="{{ route('customer.vote.save') }}" enctype="multipart/form-data" class="w-full relative z-10">
                @csrf
                <div class="mx-auto w-full space-y-4">

                  {{-- User Id --}}
                  <div class="text-left">
                    <label for="voting_user_id"
                           class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                      User Id
                    </label>
                    <div
                      class="relative flex items-center p-3 rounded-lg gap-3 
                             border border-slate-200 bg-white 
                             focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])] 
                             focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                      <input type="text" id="voting_user_id" name="voting_user_id" value=""
                             placeholder="Enter User Id"
                             class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                             required aria-describedby="hs-validation-name-success-helper" autocomplete="off">
                      <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                          <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></polyline>
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="text-left">
                    <label class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                      <p id="userNameResult" class="mt-1 text-sm text-slate-600 hidden"></p>
                    </label>
                  </div>
               

                  {{-- LEADERSHIP CLUB --}}
                  <div class="text-left">
                    <label class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                      LEADERSHIP CLUB
                    </label>

                    <div class="relative">
                      {{-- IMPORTANT: type="button" added --}}
                      <button type="button"
                              onclick="toggleMultiSelect()"
                              id="multiSelectBtn"
                              class="w-full flex justify-between items-center p-3 rounded-lg border border-slate-200 bg-white 
                                    text-sm text-slate-900 cursor-pointer focus:ring-1 focus:ring-[var(--theme-skky-300)]">
                        <span id="multiSelectText">Select options</span>
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                      </button>

                      {{-- DROPDOWN --}}
                      <div id="multiSelectDropdown"
                          class="hidden absolute z-20 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg p-2">

                        <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                          <input type="checkbox" value="ACTIVE" class="multiSelectItem">
                          <span>ACTIVE</span>
                        </label>

                        <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                          <input type="checkbox" value="HELPFULL" class="multiSelectItem">
                          <span>HELPFULL</span>
                        </label>

                        <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                          <input type="checkbox" value="HONEST" class="multiSelectItem">
                          <span>HONEST</span>
                        </label>
                      </div>

                      {{-- Hidden input for backend (JSON string) --}}
                      <input type="hidden" name="leadership_club" id="leadership_club_input">
                    </div>
                  </div>



                  {{-- Submit --}}
                  <div class="pt-2">
                    <button type="submit"
                            class="px-5 py-2.5 mx-auto flex items-center justify-center  
                                   text-sm sm:text-base tracking-wide mt-4 
                                   rounded-lg border border-[var(--theme-skky-500)] 
                                   bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)] 
                                   text-white font-semibold 
                                   hover:-translate-y-1 cursor-pointer 
                                   active:scale-95 transition-all duration-300 ease-out">
                      <span>Vote</span>
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
                class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div> 

  </div>

{{-- PASSWORD POPUP --}}
<div id="passwordModal" class="hidden fixed inset-0 z-50">
  <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>

  <div class="relative min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md rounded-2xl bg-white border border-slate-200 shadow-[0_20px_60px_rgba(15,23,42,.25)] overflow-hidden">
      
      <div class="p-4 border-b border-slate-200 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-slate-900">Confirm Password</h3>
        <button type="button" id="closePasswordModal"
                class="w-9 h-9 rounded-full hover:bg-slate-100 flex items-center justify-center">
          <svg class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none">
            <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>

      <div class="p-4 space-y-3">
        <p class="text-sm text-slate-600">
          To update your profile information, please confirm your password below.
        </p>

        <div class="text-left">
          <label for="confirm_update_password"
                 class="block text-[11px] uppercase tracking-wide text-slate-700 font-medium mb-2">
            Password
          </label>

          <div class="relative flex items-center p-3 rounded-lg gap-3 border border-slate-200 bg-white
                      focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-skky-200)]
                      transition-colors">
            <input type="password" id="confirm_update_password" placeholder="Enter your password"
                   class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]" required>
          </div>

          <p id="passwordError" class="hidden text-sm text-red-600 mt-2"></p>
        </div>
      </div>

      <div class="p-4 border-t border-slate-200 flex items-center justify-end gap-2">
        <button type="button" id="cancelPasswordModal"
                class="px-4 py-2 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50">
          Cancel
        </button>

        <button type="button" id="confirmPasswordAndSubmit"
                class="px-4 py-2 rounded-lg bg-[var(--theme-skky-600)] text-white font-semibold hover:bg-sky-700 active:scale-95 transition">
          Confirm & Update
        </button>
      </div>
    </div>
  </div>
</div>
{{-- /PASSWORD POPUP --}}

</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  function updateMultiSelectState() {
    const checkedItems = Array.from(document.querySelectorAll(".multiSelectItem:checked"));
    const selected = checkedItems.map(i => i.value);

    // backend ke liye JSON (controller me json_decode kar lena)
    document.getElementById("leadership_club_input").value = JSON.stringify(selected);

    // button text update
    document.getElementById("multiSelectText").innerText =
      selected.length ? selected.join(", ") : "Select options";
  }

  window.toggleMultiSelect = function () {
    document.getElementById("multiSelectDropdown").classList.toggle("hidden");
  }

  // checkbox change listener
  document.querySelectorAll(".multiSelectItem").forEach(item => {
    item.addEventListener("change", updateMultiSelectState);
  });

  // page load pe bhi sync rakho (agar baad me old() / prefill karna ho)
  updateMultiSelectState();

  // click outside -> dropdown close
  document.addEventListener("click", (e) => {
    const btn = document.getElementById("multiSelectBtn");
    const dd  = document.getElementById("multiSelectDropdown");

    if (btn && dd && !btn.contains(e.target) && !dd.contains(e.target)) {
      dd.classList.add("hidden");
    }
  });

  // ===== Password popup for Update button =====
  const modal = document.getElementById('passwordModal');
  const openBtn = document.getElementById('openPasswordModal');
  const closeBtn = document.getElementById('closePasswordModal');
  const cancelBtn = document.getElementById('cancelPasswordModal');
  const confirmBtn = document.getElementById('confirmPasswordAndSubmit');
  const passInput = document.getElementById('confirm_update_password');
  const errorEl = document.getElementById('passwordError');
  const form = document.getElementById('profileForm');
  const termsBox  = document.getElementById('termsCheck');

  function openModal() {

    if (!termsBox.checked) {
        showToast('error', 'Please accept the terms & conditions.');
        termsBox.focus();
        return;
    }

    modal.classList.remove('hidden');
    errorEl.classList.add('hidden');
    errorEl.innerText = '';
    passInput.value = '';
    setTimeout(() => passInput.focus(), 50);
  }

  function closeModal() {
    modal.classList.add('hidden');
  }

  openBtn && openBtn.addEventListener('click', openModal);
  closeBtn && closeBtn.addEventListener('click', closeModal);
  cancelBtn && cancelBtn.addEventListener('click', closeModal);

  // click outside content to close
  modal && modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  // ESC to close
  document.addEventListener('keydown', (e) => {
    if (modal && !modal.classList.contains('hidden') && e.key === 'Escape') closeModal();
  });

  // Confirm -> add hidden password field -> submit
  confirmBtn && confirmBtn.addEventListener('click', () => {
    const pwd = (passInput.value || '').trim();

    if (!pwd) {
      errorEl.innerText = "Password required.";
      errorEl.classList.remove('hidden');
      passInput.focus();
      return;
    }

    let hidden = document.getElementById('update_password_hidden');
    if (!hidden) {
      hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = 'hdnpassword';
      hidden.id = 'update_password_hidden';
      form.appendChild(hidden);
    }

    hidden.value = pwd;
    form.submit();
  });
});


const userIdInput = document.getElementById('voting_user_id');
const resultEl = document.getElementById('userNameResult');


let timer;
const delay = 500;

userIdInput.addEventListener('input', () => {
    clearTimeout(timer);

    const userId = userIdInput.value.trim();

    if (userId.length < 4) {
        resultEl.classList.add('hidden');
        resultEl.innerText = '';
        return;
    }

    timer = setTimeout(() => {
        fetch("https://user.ordinarypeopleai.com/fetch-user-name", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(res => res.json())
        .then(data => {
            resultEl.classList.remove('hidden');

            if (data.status === 'success') {
                resultEl.textContent = `Name: ${data.name}`;
                resultEl.classList.remove('text-red-600');
                resultEl.classList.add('text-green-600');
            } else {
                resultEl.textContent = data.message;
                resultEl.classList.remove('text-green-600');
                resultEl.classList.add('text-red-600');
            }
        });
    }, delay);
});
</script>
@endpush
