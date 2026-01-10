@extends('app')

@section('title', 'DApp Header (HTML)')

@php
  //var_dump($customer->myPackages); 
@endphp

@section('content')
<section class="min-h-screen w-full py-10 md:py-12 mx-auto max-w-[1400px] ">
  <div class="grid grid-cols-1 gap-5 relative z-10 px-4">

    {{-- CARD 1: Membership History + Topup Form --}}
    <div class="grid grid-cols-1 gap-5 max-w-2xl mx-auto w-full">
      <div
        class="relative p-5 md:p-7 rounded-2xl w-full mx-auto group overflow-hidden
               border border-slate-200 bg-white
               shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl
               transition-all duration-300 hover:-translate-y-1
               hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">

        {{-- soft glow blobs --}}
        <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 relative z-10">
          <h2 class="text-xl md:text-2xl font-semibold text-slate-900 tracking-tight">
            Membership History
          </h2>

          {{-- ✅ Toggle: Free Membership ON/OFF (Only added this; baki kuch change nahi) --}}
          <div class="flex items-center gap-2 self-end sm:self-auto">
            <span class="text-[10px] sm:text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
            {{--  @if($customer->isFreePackage > 0)
              Free Membership Available
            @else
              Free Membership (Non-Repeatable)
            @endif --}}
            @if($customer->customer_settings->isFreePackage)
            Free Membership Available
            @else
              Free Membership (Non-Repeatable)
            @endif
            </span>
            <button type="button"
              {{-- @if($customer->isFreePackage > 0) --}}
              @if($customer->customer_settings->isFreePackage)
                  onclick="toggleFreePackage()"
              @endif
              class="relative inline-flex h-7 w-14 items-center rounded-full border border-slate-200 bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-[var(--theme-skky-300)]"
              aria-label="Toggle Free Package">
              <span id="freePkgTrack"
                class="absolute inset-0 rounded-full transition-colors"></span>

              <span id="freePkgDot"
                class="inline-block h-6 w-6 transform rounded-full bg-white border border-slate-200 shadow transition-transform translate-x-1"></span>
            </button>

           <span id="freePkgStatus" class="text-[10px] sm:text-[11px] text-slate-500 min-w-[28px] text-right">
  OFF
</span>

          </div>
        </div>

        {{-- Sponsor / Copy referral --}}
        <!-- <div class="mb-6 space-y-2 relative z-10">
          <div class="flex items-center justify-between gap-2">
            <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              My Sponsor
            </p>
            <span class="text-[11px] text-slate-500">Tap to copy</span>
          </div>

          <div
            class="relative flex items-center p-3 rounded-lg gap-3
                   border border-slate-200 bg-white
                   focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])]
                   focus-within:bg-[var(--theme-skkky-50)]/60
                   transition-colors">
            <div class="flex items-center gap-2 min-w-0">
              <div
                class="flex items-center justify-center w-8 h-8 rounded-full
                       bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
                <svg class="w-4 h-4 text-[var(--theme-high-text)]" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24">
                  <path d="M5 20h14M5 4h14M8 4v16M16 4v16" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round"></path>
                </svg>
              </div>
              <span id="copyYourReferral"
                class="text-sm md:text-base truncate text-ellipsis overflow-hidden text-slate-900 font-medium">
                {{ $customer->mySponsor }}
              </span>
            </div>

            <button type="button"
              onclick="copyYourReferral(); typeof showToast==='function' && showToast('success', 'Copied to clipboard!')"
              class="ml-auto inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium cursor-pointer
                     border border-slate-200 text-slate-700
                     hover:text-slate-900 hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)]
                     transition-colors">
              <svg class="w-4 h-4" viewBox="0 0 1024 1024">
                <path fill="currentColor"
                  d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z"></path>
                <path fill="currentColor"
                  d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z"></path>
              </svg>
              <span>Copy</span>
            </button>
          </div>

          
        </div> -->

        {{-- Active Packages --}}
        <div class="w-full flex-1 mb-6 text-slate-900 relative z-10">
          <div class="flex items-center justify-between mb-3">
            <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Active / Purchased Membership
            </p>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            {{-- Example single package (yahan loop laga sakte ho) --}}
            @foreach($customer->myPackageDetails as $pkg)
            <div
              class="flex items-center w-full gap-2.5 rounded-full h-full
                     border border-slate-200 bg-white px-0 pr-4
                     hover:border-[var(--theme-skky-500)]/70 hover:bg-[var(--theme-skkky-50)]
                     transition-colors max-w-fit">
              <div
                class="text-xs sm:text-sm font-semibold flex items-center justify-center
                       w-9 h-9 sm:w-10 sm:h-10 min-w-9 min-h-9
                       rounded-full border border-slate-200
                       bg-slate-50 text-[var(--theme-primary-text)] shadow-inner">
                {{ $loop->iteration }}
              </div>
              <div class="flex flex-col items-start">
                <h3 class="text-xs font-semibold tracking-wide text-slate-900 tabular-nums">
                  @if($pkg->package_id == 1)
                  OP5
                  @elseif($pkg->package_id == 2)
                  OP10
                  @elseif($pkg->package_id == 3)
                  OP25
                  @elseif($pkg->package_id == 4)
                  OP50
                  @elseif($pkg->package_id == 5)
                  FREE
                  @endif
                  {{-- {{ number_format($pkg->amount, 2, '.', '') }} --}}
                </h3>
                <span class="text-[10px] text-slate-500 uppercase tracking-[0.18em]">
                  Membership
                </span>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        
        {{-- Divider --}}
        <div class="relative my-4">
          <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-300 to-transparent"></div>
        </div>

        {{-- Activate Package by Topup Balance --}}
        <h2 class="text-lg md:text-xl font-semibold mb-3 text-slate-900 relative z-10">
          Activate Membership By TOPUP Balance
        </h2>

        <div
          class="bg-[var(--theme-skkky-50)] border border-slate-200
                 rounded-xl px-4 py-3 mb-4 flex items-center justify-between relative z-10">
          <p class="text-sm text-slate-700">Topup Balance</p>
          <span class="text-sm font-semibold text-[var(--theme-primary-text)]">{{ number_format($customer->myFinance['total_topup'], 2, '.', '') }}</span>
        </div>
        
        <form id="depositForm" class="relative mt-2 space-y-4" method="post" action="{{ route('pay.topup.save') }}">
          @csrf

          <div class="space-y-1.5 relative z-10">
            <label for="amount" class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Membership Amount
            </label>

            <div class="relative flex items-center p-3 rounded-lg gap-3
                     border border-slate-200 bg-white
                     focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])]
                     focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">

              <div class="flex items-center justify-center w-9 h-9 rounded-full
                       bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
                <svg class="w-5 h-5 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5"></ellipse>
                  <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5"></path>
                  <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5"></path>
                  <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5"></path>
                </svg>
              </div>

              
              <input type="text" name="amount" id="amount" value="0" placeholder="0.0" required="required" readonly="" class="w-full bg-transparent text-slate-900 placeholder:text-slate-400
                       outline-none text-sm md:text-base [caret-color:#60a5fa]">
              
            </div>

            
            <div class="flex flex-wrap gap-2 mt-3">
              <button type="button" onclick="setAmount(5, this)" class="amount-btn">OP 5</button>
              <button type="button" onclick="setAmount(10, this)" class="amount-btn">OP 10</button>
              <button type="button" onclick="setAmount(25, this)" class="amount-btn">OP 25</button>
              <button type="button" onclick="setAmount(50, this)" class="amount-btn">OP 50</button>
            </div>
          </div>


          

          {{-- Button --}}
          <div class="flex items-center justify-center pt-1 relative z-10">
            <button
              class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-2 cursor-pointer 
                     text-sm md:text-base capitalize tracking-wide mt-4
                     rounded-lg border border-[var(--theme-skky-500)]
                     bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                     font-semibold
                     shadow-[0_8px_20px_rgba(56,189,248,.30)]
                     hover:shadow-[0_14px_28px_rgba(56,189,248,.45)]
                     active:scale-95 transition-all duration-300 ease-out group"
              type="submit">
              <span>Process</span>
              <svg id="svg1-icon"
                class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1"
                data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"></path>
              </svg>
            </button>
          </div>
        </form>

        <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100">
        </div>
        {{-- ✅ Button Style + JS --}}
        <style>
          .amount-btn {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #0f172a;
            transition: all 0.2s ease;
          }
          .amount-btn:hover {
            border-color: var(--theme-skky-500);
            background: var(--theme-skkky-50);
          }
          .amount-btn.active {
            background: linear-gradient(to right, var(--theme-skky-500), var(--theme-skky-600));
            color: #fff;
            border-color: var(--theme-skky-500);
          }
        </style>
<script>
            /*function copyYourReferral() {
              const linkElement = document.getElementById("copyYourReferral");
              if (!linkElement) {
                console.error("Referral code element not found!");
                return;
              }
              const link = linkElement.innerText;
              navigator.clipboard.writeText(link).catch(() => {
                console.error("Failed to copy text!");
              });
            }*/

            // ✅ Free Package Toggle (ON/OFF)
            {{--@if($customer->isFreePackage > 0)--}}
            @if($customer->customer_settings->isFreePackage)
            let isFreePackageOn = 1;
            @else
            let isFreePackageOn = 0;
            @endif

            function toggleFreePackage() 
            {
              isFreePackageOn = !isFreePackageOn;

              if(isFreePackageOn == true)
              {
                const freePackageUrl = "{{ route('pay.freetopup.save') }}";
                fetch(freePackageUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    // location.reload(true);
                });
              }

              const statusEl = document.getElementById('freePkgStatus');
              const dotEl = document.getElementById('freePkgDot');
              const trackEl = document.getElementById('freePkgTrack');
              

              if (isFreePackageOn) {
                statusEl.innerText = 'ON';
                statusEl.classList.remove('text-slate-500');
                statusEl.classList.add('text-[var(--theme-primary-text)]');

                dotEl.classList.remove('translate-x-1');
                dotEl.classList.add('translate-x-7');

                trackEl.classList.add('bg-[var(--theme-skky-500)]');
                trackEl.classList.remove('bg-transparent');

                
                typeof showToast === 'function' && showToast('success', 'Free Package: ON');

              } else {
                statusEl.innerText = 'OFF';
                statusEl.classList.add('text-slate-500');
                statusEl.classList.remove('text-[var(--theme-primary-text)]');

                dotEl.classList.remove('translate-x-7');
                dotEl.classList.add('translate-x-1');

                trackEl.classList.remove('bg-[var(--theme-skky-500)]');
                trackEl.classList.add('bg-transparent');

                
                typeof showToast === 'function' && showToast('info', 'Free Package: OFF');
              }
            }

            toggleFreePackage();

            function setAmount(value, el) {
              const amountInput = document.getElementById('amount');
              amountInput.value = value;

              // active highlight
              document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
              el.classList.add('active');

              typeof showToast === 'function' && showToast('success', `Amount Selected: ${value}`);
            }
          </script>

      </div>
    </div>

    {{-- CARD 2: Disclaimer --}}
    <div class="grid grid-cols-1 gap-5 max-w-2xl mx-auto w-full">
      <div
        class="p-5 md:p-6 rounded-2xl w-full mx-auto
               border border-slate-200 bg-white
               relative overflow-hidden text-left
               shadow-[0_15px_40px_rgba(15,23,42,.08)] backdrop-blur-2xl">

        <div class="pointer-events-none absolute -top-16 -left-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-16 -right-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <h3 class="text-lg md:text-xl font-semibold text-slate-900 mb-5 relative z-10">
          Disclaimer
        </h3>

        <div class="space-y-4 relative z-10">

          <div class="flex items-start gap-3">
            <div class="mt-[6px] w-2.5 h-2.5 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-400)]"></div>
            <p class="text-sm leading-relaxed text-slate-600">
              <span class="text-slate-900 font-medium">Free Membership:</span>
              The Free Membership can be activated only once per account. Once utilized, this option will no longer be available.
            </p>
          </div>

          <div class="flex items-start gap-3">
            <div class="mt-[6px] w-2.5 h-2.5 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-400)]"></div>
            <p class="text-sm leading-relaxed text-slate-600">
              <span class="text-slate-900 font-medium">Top-Up Wallet Usage:</span>
              Funds added via QR are credited to the Top-Up Wallet and can be used only for package
              activation, not for any other purpose.
            </p>
          </div>

          <div class="flex items-start gap-3">
            <div class="mt-[6px] w-2.5 h-2.5 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-400)]"></div>
            <p class="text-sm leading-relaxed text-slate-600">
              <span class="text-slate-900 font-medium">Exclusive Use of Top-Up Balance:</span>
              The top-up balance is not applicable for any other purposes.
            </p>
          </div>
          
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
