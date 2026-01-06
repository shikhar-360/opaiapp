@extends('app')

@section('title', 'Withdraw')

@section('content')
<script src="{{asset('assets/js/dialog.js')}}"></script>

<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 ">

  {{-- ALERT / INFO BANNER --}}
  <!-- <div
    class="hidden inline-flex items-center gap-2 px-4 py-2.5 mb-6 rounded-2xl border border-slate-200
           bg-white shadow-[0_10px_30px_rgba(15,23,42,.08)] relative overflow-hidden">
    {{-- soft glow --}}
    <div class="hidden absolute inset-0 opacity-60 pointer-events-none">
      <div class="absolute -left-10 -top-10 w-32 h-32 bg-[var(--theme-skky-200)]/40 rounded-full blur-3xl"></div>
      <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-rose-200/40 rounded-full blur-3xl"></div>
    </div>

    <span class="hidden relative inline-flex h-2.5 w-2.5 rounded-full bg-[var(--theme-skky-400)] animate-pulse"></span>
    <p class="hidden relative text-xs sm:text-sm md:text-base text-slate-800">
      Due to BSC congestion, withdrawals are being processed slowly.
    </p>
  </div> -->

  {{-- TOP WITHDRAW STATS (THEME SAME AS DIRECTS PAGE CARDS) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-3 sm:gap-5 mb-8">

    {{-- ROI Income --}}
    <!-- <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
        <img src="{{ asset('assets/images/icons/roi-income.webp?v=1') }}"  width="100" height="100" alt="ROI Income"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <h3 class="text-base text-slate-600">ROI Income</h3>
        <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">$0</p>
      </div>
    </div> -->

    {{-- Level Income --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-fuchsia-300 to-fuchsia-500 border border-fuchsia-200">
        <img src="{{ asset('assets/images/icons/level-income.webp?v=1') }}"  width="100" height="100" alt="Circle Credits"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <h3 class="text-base text-slate-600">Circle Credits</h3>
        <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->appData->currency }} {{ $customer->myLevelEarning }}</p>
      </div>
    </div>

    {{-- Total Income --}}
    <!-- <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 border border-amber-200">
        <img src="{{ asset('assets/images/icons/total-income.webp?v=1') }}"  width="100" height="100" alt="Total Credits"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <h3 class="text-base text-slate-600">Total Credits</h3>
        <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->appData->currency }} {{ $customer->myTotalEarning }}</p>
      </div>
    </div> -->

    {{-- Total Withdraw --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 border border-emerald-200">
        <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}"  width="100" height="100" alt="Total Withdraw"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <h3 class="text-base text-slate-600">Total Withdraw</h3>
        <p class="text-xl font-bold text-emerald-600 mt-1">{{ $customer->appData->currency }} {{ $customer->myTotalWithdraws }}</p>
      </div>
    </div>


    {{-- Wallet Balance --}}
<div class="hidden neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
  <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-700 border border-blue-200">
    <img src="{{ asset('assets/images/icons/wallet-balance.webp?v=1') }}"  width="100" height="100" alt="Wallet Balance"
         class="w-9 h-9 object-contain">
  </div>
  <div>
    <h3 class="text-base text-slate-600">Wallet Balance</h3>
    <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->appData->currency }} 0.000</p>
  </div>
</div>

{{-- Token Wallet --}}
<div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
  <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-purple-400 to-purple-700 border border-purple-200">
    <img src="{{ asset('assets/images/icons/token-wallet.webp?v=1') }}"  width="100" height="100" alt="Perks Wallet"
         class="w-9 h-9 object-contain">
  </div>
  <div>
    <h3 class="text-base text-slate-600">Perks Wallet</h3>
    <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">OPX</p>
  </div>
</div>

{{-- Token Balance --}}
<div class="hidden neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
  <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-700 border border-blue-200">
    <img src="{{ asset('assets/images/icons/token-balance.webp?v=1') }}"  width="100" height="100" alt="Perks Balance"
         class="w-9 h-9 object-contain">
  </div>
  <div>
    <h3 class="text-base text-slate-600">Perks Balance</h3>
    <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->appData->currency }} 0.000</p>
  </div>
</div>


  </div>

  {{-- WITHDRAW BUTTON --}}
  <div class="flex flex-wrap justify-center items-center gap-3 sm:gap-4 mb-8 max-w-xl mx-auto mt-4">
    <button data-dialog-target="p2p-dialog" type="submit"
      class="px-5 py-2.5 mx-auto flex items-center justify-center gap-0 text-base capitalize tracking-wide rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-cyyan-400)] text-white font-semibold hover:-translate-y-1 transition-all duration-300 ease-out cursor-pointer">
      <span>P2P Withdraw</span>
      <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
        aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">s
        <path clip-rule="evenodd" fill-rule="evenodd"
          d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
        </path>
      </svg>
    </button>
    <button data-dialog-target="dialog" type="submit"
      class="px-5 py-2.5 mx-auto flex items-center justify-center gap-0 text-base capitalize tracking-wide  rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-cyyan-400)] text-white font-semibold hover:-translate-y-1 transition-all duration-300 ease-out cursor-pointer">
      <span>Earning Withdraw</span>
      <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
        aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">s
        <path clip-rule="evenodd" fill-rule="evenodd"
          d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
        </path>
      </svg>
    </button>
      
          <button data-dialog-target="self-transfer-dialog" type="submit"
      class="px-5 py-2.5 mx-auto flex items-center justify-center gap-0 text-base capitalize tracking-wide  rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-cyyan-400)] text-white font-semibold hover:-translate-y-1 transition-all duration-300 ease-out cursor-pointer">
      <span>Self Transfer</span>
      <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
        aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">s
        <path clip-rule="evenodd" fill-rule="evenodd"
          d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
        </path>
      </svg>
    </button>
  </div>

  {{-- WITHDRAWALS TABLE CARD (SAME THEME AS DIRECTS TABLE) --}}
  <div
    class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] relative overflow-hidden text-left">

    {{-- soft glow background --}}
    <div class="absolute inset-0 opacity-70 pointer-events-none">
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative overflow-x-auto pb-1">
      <div id="withdrawalsTable_wrapper" class="dataTables_wrapper no-footer">

        {{-- TOP BAR: SHOW + SEARCH --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3 relative z-10">
          {{-- <div class="dataTables_length" id="withdrawalsTable_length">
            <label class="text-xs sm:text-sm text-slate-600 flex items-center gap-2">
              <span>Show</span>
              <select name="withdrawalsTable_length" aria-controls="withdrawalsTable"
                class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-[var(--theme-skky-400)]/80 focus:border-[var(--theme-skky-400)]/80">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
              <span>entries</span>
            </label>
          </div> --}}

          {{-- <div id="withdrawalsTable_filter" class="dataTables_filter w-full md:w-auto">
            <label class="text-xs sm:text-sm text-slate-600 w-full">
              <span class="sr-only">Search</span>
              <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                  
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                      clip-rule="evenodd" />
                    <path
                      d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                  </svg>
                </span>
                <input type="search"
                  class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-[var(--theme-skky-400)]/80 focus:border-[var(--theme-skky-400)]/80"
                  placeholder="Search amount / status / tx id" aria-controls="withdrawalsTable">
              </div>
            </label>
          </div> --}}
        </div>

        <table id="withdrawalsTable"
          class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
          style="padding-top: 15px;" aria-describedby="withdrawalsTable_info">
          <thead>
            <tr class="bg-slate-100 text-slate-900">
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Sr.
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Amount ({{ $customer->appData->currency }})
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Net Amount ({{ $customer->appData->currency }})
              </th>
              {{-- <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Status
              </th> --}}
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Transaction ID
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                Type
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px] !text-right">
                Date
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @php
            $sr = 1;
            @endphp
            @foreach($customer->myWithdraws as $wkey => $myW)
            <tr class="hover:bg-slate-200 transition">
              <td class="px-4 sm:px-5 py-3 text-black">{{  $sr++ }}</td>
              <td class="px-4 sm:px-5 py-3">
                <span
                  class="inline-flex items-center rounded-full bg-sky-50 px-2 py-0.5 text-[11px] text-sky-700 border border-sky-200">
                  {{ $myW->amount }}
                </span>
              </td>
              <td class="px-4 sm:px-5 py-3 text-emerald-600">{{ $myW->net_amount }}</td>
              {{-- <td class="px-4 sm:px-5 py-3 font-mono text-[11px] text-slate-500">{{ $myW->transaction_status }}</td> --}}
              <td class="px-4 sm:px-5 py-3 text-slate-800">{{ $myW->transaction_id }}</td>
              <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myW->transaction_status }}</td>
              <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myW->created_at->format('d-m-Y') }}</td>
              
            </tr>
            @endforeach
          </tbody>
        </table>

        {{-- <div
          class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mt-3 text-xs sm:text-sm text-slate-500">
          <div class="dataTables_info" id="withdrawalsTable_info" role="status" aria-live="polite">
            Showing 0 to 0 of 0 entries
          </div>
          <div class="dataTables_paginate paging_simple_numbers flex items-center gap-2"
            id="withdrawalsTable_paginate">
            <a
              class="paginate_button previous disabled px-3 py-1.5 rounded-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed"
              aria-controls="withdrawalsTable" aria-disabled="true" aria-role="link" data-dt-idx="previous"
              tabindex="-1" id="withdrawalsTable_previous">Previous</a>
            <span></span>
            <a
              class="paginate_button next disabled px-3 py-1.5 rounded-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed"
              aria-controls="withdrawalsTable" aria-disabled="true" aria-role="link" data-dt-idx="next"
              tabindex="-1" id="withdrawalsTable_next">Next</a>
          </div>
        </div> --}}

      </div>
    </div>
  </div>

  {{-- WITHDRAW DIALOG (POPUP – DARK THEME RAKH DIYA, JAISE PEHLE THA) --}}
  <div data-dialog-backdrop="dialog"
  class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center
         bg-black/60 opacity-0 backdrop-blur-sm transition-opacity duration-300 overflow-auto p-2">

  <div data-dialog="dialog" class="w-full max-w-xl" style="max-height: calc(100% - 0px);">
      <div
      class="relative p-5 md:p-7 rounded-2xl w-full mx-auto overflow-hidden text-left
             border border-slate-200 bg-white
             shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl
             transition-all duration-300 hover:-translate-y-1
             hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">

    
      <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

      <div class="relative flex items-center justify-between gap-3">
        <h2 class="flex shrink-0 items-center text-xl font-semibold text-slate-900 tracking-tight">
            Withdraw
          </h2>

          <button data-dialog-close="true"
          class="relative h-9 w-9 bg-white border border-slate-200 flex items-center justify-center
                 rounded-lg text-center hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)]
                 transition"
                  type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            class="h-5 w-5 text-slate-700">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

      <div class="relative pt-5 leading-normal">

      
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-5 mb-6">
          
            <div
            class="relative group rounded-2xl overflow-hidden
                   border border-slate-200 bg-white
                   shadow-[0_12px_32px_rgba(15,23,42,.08)]
                   transition-all duration-300 hover:-translate-y-0.5 hover:border-[var(--theme-skky-500)]/70
                   hover:shadow-[0_16px_38px_rgba(59,130,246,0.18)]">

            <div class="pointer-events-none absolute -top-10 -left-10 w-32 h-32 rounded-full blur-3xl bg-[var(--theme-cyyan-400)]/15"></div>
            <div class="pointer-events-none absolute -bottom-12 -right-12 w-36 h-36 rounded-full blur-3xl bg-emerald-400/15"></div>

            <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
              <div class="min-w-14 w-14 h-14 flex items-center justify-center rounded-2xl
                          bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
                <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}"  width="100" height="100" alt="Logo"
                  class="w-9 h-9 object-contain">
                </div>

                <div class="w-full min-w-0">
                <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium mb-1">
                    Available Balance
                </p>
                  <p class="text-sm">
                    <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-lg tabular-nums">{{ $customer->myAvailableBalance > 0 ? $customer->myAvailableBalance : 0 }}</span>
                  </p>
              </div>
            </div>
          </div>

        
            <!-- <div
            class="relative group rounded-2xl overflow-hidden
                   border border-slate-200 bg-white
                   shadow-[0_12px_32px_rgba(15,23,42,.08)]
                   transition-all duration-300 hover:-translate-y-0.5 hover:border-[var(--theme-skky-500)]/70
                   hover:shadow-[0_16px_38px_rgba(59,130,246,0.18)]">

            <div class="pointer-events-none absolute -top-10 -left-10 w-32 h-32 rounded-full blur-3xl bg-[var(--theme-skky-400)]/15"></div>
            <div class="pointer-events-none absolute -bottom-12 -right-12 w-36 h-36 rounded-full blur-3xl bg-amber-400/15"></div>

              <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
              <div class="min-w-14 w-14 h-14 flex items-center justify-center rounded-2xl
                          bg-gradient-to-br from-amber-400 to-amber-600 border border-[var(--theme-skky-200)]">
                <img src="{{ asset('assets/images/icons/pending.webp?v=1') }}"  width="100" height="100" alt="Logo"
                  class="w-9 h-9 object-contain">
                </div>

                <div class="w-full min-w-0">
                <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium mb-1">
                    Pending Balance
                </p>
                  <p class="text-sm">
                  <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-lg tabular-nums">
                    $0.000
                  </span>
                  </p>
                </div>
            </div>
          </div> -->
        </div>

          {{-- FORM (STATIC / NO ACTION) --}}
          <form class="relative space-y-4" id="withdraw-process-form" action="{{ route('withdraw.save') }}" method="POST">
            @csrf
            {{-- Amount --}}
            <div class="space-y-1.5">
              <label for="amount"
              class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
                Enter Amount
              </label>

              <div
              class="relative flex items-center p-3 rounded-lg gap-3
                     border border-slate-200 bg-white
                     focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-skky-200)]
                     focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5" />
                </svg>

                <input type="text" name="amount" id="amount" autocomplete="off"
                       placeholder="Enter Amount" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none
                       text-sm md:text-base [caret-color:#60a5fa] border-l border-slate-200 pl-4">
            </div>
            </div>
          

         
            <div class="space-y-1.5">
              <label for="adminFees"
              class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
                Admin Fees 5%
              </label>

              <div
              class="relative flex items-center p-3 rounded-lg gap-3
                     border border-slate-200 bg-white
                     focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-skky-200)]
                     focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5" />
                </svg>
                <input type="text" name="admin_charge" readonly id="admin_charge" placeholder="0" value="0"
                       class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none
                       text-sm md:text-base border-l border-slate-200 pl-4">
              </div>
            </div>

          
            <div class="space-y-1.5">
              <label for="yourfinalamount"
                class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
                  Your Final Amount
                </label>

                <div
                class="relative flex items-center p-3 rounded-lg gap-3
                       border border-slate-200 bg-white
                        focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-skky-200)]
                       focus-within:bg-[var(--theme-skkky-50)]/60">
                <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                    <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5" />
                  </svg>
                  <input type="text" readonly id="net_amount" name="net_amount" placeholder="Your final amount" value="0"
                         class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none
                         text-sm md:text-base border-l border-slate-200 pl-4">
                </div>
              </div>

              {{-- button --}}
              <div class="flex items-center justify-center pt-1">
                <button 
                      {{ $customer->myAvailableBalance < 10 ? '':'' }}
                        type="submit"
                        class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-0
                       text-sm md:text-base capitalize tracking-wide mt-2
                       rounded-lg border border-[var(--theme-skky-500)]
                       bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                       font-semibold
                       hover:-translate-y-1
                       active:scale-95 transition-all duration-300 ease-out group cursor-pointer">

                <span>Withdraw</span>
                <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1"
                    aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"></path>
                  </svg>
                </button>
              </div>

          </form>
        <!-- </div> -->

    </div>

  </div>
      <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100"></div>
    </div>
  </div>
</div>

<!-- WITHDRAW SUCCESS POPUP -->
<div data-dialog-backdrop="withdraw-success"
  class="fixed inset-0 z-[999] grid place-items-center
         bg-black/60 backdrop-blur-sm p-3
         pointer-events-none opacity-0 transition-opacity duration-300">

  <div data-dialog="withdraw-success" class="w-full max-w-md">
    <div
      class="relative p-5 md:p-6 rounded-2xl w-full mx-auto overflow-hidden
             border border-slate-200 bg-white
             shadow-[0_20px_50px_rgba(15,23,42,.20)]
             backdrop-blur-2xl">

      <!-- glow blobs -->
      <div class="pointer-events-none absolute -top-16 -right-16 w-48 h-48 bg-[var(--theme-skky-300)]/25 rounded-full blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-16 -left-16 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>

      <!-- close -->
      <button data-dialog-close="withdraw-success"
        class="h-9 w-9 flex items-center justify-center
               rounded-lg border border-slate-200 bg-white absolute top-3 right-3
               hover:bg-slate-100 transition"
        type="button">
        <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <!-- header -->
      <div class="relative text-center">
        <div class="mx-auto w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-200
                    flex items-center justify-center shadow-sm">
          <svg class="w-7 h-7 text-emerald-600" viewBox="0 0 24 24" fill="none">
            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h2 class="mt-4 text-lg sm:text-xl font-semibold text-slate-900">
          🎉 Congratulations!
        </h2>

        <p class="mt-1 text-sm text-slate-600">
          You have successfully withdrawn.
        </p>
      </div>

      <!-- amount card -->
      <div class="relative mt-6">
        <div
          class="flex items-center justify-between gap-3 p-4 rounded-2xl
                 border border-slate-200 bg-white
                 shadow-[0_12px_32px_rgba(15,23,42,.10)]
                 backdrop-blur-xl">

          <div class="min-w-0">
            <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Amount
            </p>
            <p class="text-xl sm:text-2xl font-extrabold text-slate-900 tabular-nums">
              <span id="withdrawAmountText">{{ session('withdraw_amount') }}</span>
            </p>
          </div>

          <span class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)]
                       border border-[var(--theme-skky-200)]
                       px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)]">
            USDT
          </span>
        </div>
      </div>

      <!-- actions -->
      <div class="mt-6 flex items-center justify-center gap-3">
        <button data-dialog-close="withdraw-success" type="button"
          class="px-4 py-2 rounded-lg border border-slate-200
                 bg-white text-slate-700 text-sm font-semibold
                 hover:bg-slate-100 transition">
          Close
        </button>

        <button data-dialog-close="withdraw-success" type="button"
          class="px-5 py-2 rounded-lg text-white font-semibold
                 bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                 shadow-[0_10px_25px_rgba(56,189,248,.40)]
                 hover:shadow-[0_16px_30px_rgba(56,189,248,.55)]
                 active:scale-95 transition">
          OK 🚀
        </button>
      </div>

      <div class="absolute inset-x-3 bottom-0 h-px
                  bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
    </div>
  </div>
</div>




<!-- P2P WITHDRAW POPUP -->
<div data-dialog-backdrop="p2p-dialog"
  class="fixed inset-0 z-[999] grid place-items-center
         bg-black/60 backdrop-blur-sm p-3
         pointer-events-none opacity-0 transition-opacity duration-300">

  <div data-dialog="p2p-dialog" class="w-full max-w-xl">
    <div
      class="relative p-5 md:p-7 rounded-2xl w-full mx-auto overflow-hidden text-left
             border border-slate-200 bg-white
             shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl">

      <!-- glow -->
      <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

      <!-- header -->
      <div class="relative flex items-center justify-between gap-3">
        <h2 class="flex shrink-0 items-center text-xl font-semibold text-slate-900 tracking-tight">
          P2P Withdraw
        </h2>

        <button data-dialog-close="p2p-dialog"
          class="relative h-9 w-9 bg-white border border-slate-200 flex items-center justify-center
                 rounded-lg text-center hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)]
                 transition"
          type="button">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            class="h-5 w-5 text-slate-700">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="relative pt-5 leading-normal">

        <!-- Available Balance Card -->
        <div
          class="relative group rounded-2xl overflow-hidden
                 border border-slate-200 bg-white
                 shadow-[0_12px_32px_rgba(15,23,42,.08)]
                 transition-all duration-300 hover:-translate-y-0.5 hover:border-[var(--theme-skky-500)]/70
                 hover:shadow-[0_16px_38px_rgba(59,130,246,0.18)] mb-6 h-20">

          <div class="pointer-events-none absolute -top-10 -left-10 w-32 h-32 rounded-full blur-3xl bg-[var(--theme-cyyan-400)]/15"></div>
          <div class="pointer-events-none absolute -bottom-12 -right-12 w-36 h-36 rounded-full blur-3xl bg-emerald-400/15"></div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="min-w-14 w-14 h-14 flex items-center justify-center rounded-2xl
                        bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
              <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}" width="100" height="100" alt="Logo"
                class="w-9 h-9 object-contain">
            </div>

            <div class="w-full min-w-0">
              <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium mb-1">
                Available Balance
              </p>
              <p class="text-sm">
                <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-lg tabular-nums">
                  {{ $customer->myAvailableBalance > 0 ? $customer->myAvailableBalance : 0 }}
                </span>
              </p>
            </div>
          </div>
        </div>

        <!-- P2P Form -->
        <form class="relative space-y-4" id="withdraw-p2ptransfer-form" action="{{ route('withdraw.p2ptransfer.save') }}" method="POST">
          @csrf

          {{-- Show Username --}}
          <div class="space-y-1.5">
            <p class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Username
            </p>

            <div
              class="relative flex items-center p-3 rounded-lg gap-3
                    border border-slate-200 bg-white
                    shadow-sm">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.5"/>
              </svg>

              <div class="w-full border-l border-slate-200 pl-4">
                <input type="text" id="team_user_id" name="team_user_id" value=""
                             placeholder="Enter User Id"
                             class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                             required aria-describedby="hs-validation-name-success-helper" autocomplete="off">
                <p class="text-slate-900 text-sm md:text-base font-semibold" id="teamUserNameResult">
                 
                </p>
                {{-- <p class="text-xs text-slate-500">
                  ID: N/A
                </p> --}}
              </div>
            </div>
          </div>

          {{-- Show Amount --}}
          <div class="space-y-1.5">
            <p class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Amount
            </p>

            <div
              class="relative flex items-center p-3 rounded-lg gap-3
                    border border-slate-200 bg-white
                    shadow-sm">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5" />
              </svg>

              <div class="w-full border-l border-slate-200 pl-4">
                <p class="text-slate-900 text-sm md:text-base font-extrabold tabular-nums">
                  <input type="text" id="p2p_amount" name="p2p_amount" value=""
                             placeholder="Enter Amount"
                             class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                             required aria-describedby="hs-validation-name-success-helper" autocomplete="off">
                </p>
              </div>
            </div>
          </div>
          {{-- Button --}}
          <div class="flex items-center justify-center pt-1">
            <button type="submit"
              class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-0
                    text-sm md:text-base capitalize tracking-wide mt-2
                    rounded-lg border border-[var(--theme-skky-500)]
                    bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                    font-semibold
                    hover:-translate-y-1 
                    active:scale-95 transition-all duration-300 ease-out group cursor-pointer">
              <span>Transfer</span>
              <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1"
                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"></path>
              </svg>
            </button>
          </div>
        </form>

      </div>

      <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
    </div>
  </div>
</div>


<!-- SELF TRANSFER POPUP -->
<div data-dialog-backdrop="self-transfer-dialog"
  class="fixed inset-0 z-[999] grid place-items-center
         bg-black/60 backdrop-blur-sm p-3
         pointer-events-none opacity-0 transition-opacity duration-300">

  <div data-dialog="self-transfer-dialog" class="w-full max-w-xl">
    <div
      class="relative p-5 md:p-7 rounded-2xl w-full mx-auto overflow-hidden text-left
             border border-slate-200 bg-white
             shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl">

      <!-- glow -->
      <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

      <!-- header -->
      <div class="relative flex items-center justify-between gap-3">
        <h2 class="flex shrink-0 items-center text-xl font-semibold text-slate-900 tracking-tight">
          Self Transfer
        </h2>

        <button data-dialog-close="self-transfer-dialog"
          class="relative h-9 w-9 bg-white border border-slate-200 flex items-center justify-center
                 rounded-lg text-center hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)]
                 transition"
          type="button">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            class="h-5 w-5 text-slate-700">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="relative pt-5 leading-normal">

        <!-- Available Balance Card -->
        <div
          class="relative group rounded-2xl overflow-hidden 
                 border border-slate-200 bg-white
                 shadow-[0_12px_32px_rgba(15,23,42,.08)]
                 transition-all duration-300 hover:-translate-y-0.5 hover:border-[var(--theme-skky-500)]/70
                 hover:shadow-[0_16px_38px_rgba(59,130,246,0.18)] mb-6 h-20">

          <div class="pointer-events-none absolute -top-10 -left-10 w-32 h-32 rounded-full blur-3xl bg-[var(--theme-cyyan-400)]/15"></div>
          <div class="pointer-events-none absolute -bottom-12 -right-12 w-36 h-36 rounded-full blur-3xl bg-emerald-400/15"></div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="min-w-14 w-14 h-14 flex items-center justify-center rounded-2xl
                        bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
              <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}" width="100" height="100" alt="Logo"
                class="w-9 h-9 object-contain">
            </div>

            <div class="w-full min-w-0">
              <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium mb-1">
                Available Balance
              </p>
              <p class="text-sm">
                <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-lg tabular-nums">
                  {{ $customer->myAvailableBalance > 0 ? $customer->myAvailableBalance : 0 }}
                </span>
              </p>
            </div>
          </div>
        </div>

        <!-- Self Transfer Form -->
        <form class="relative space-y-4" id="withdraw-selftransfer-form" action="{{ route('withdraw.selftransfer.save') }}" method="POST">
          @csrf

          <!-- Amount -->
          <div class="space-y-1.5">
            <label for="self_amount"
              class="block text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Enter Amount
            </label>

            <div
              class="relative flex items-center p-3 rounded-lg gap-3
                     border border-slate-200 bg-white
                     focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-skky-200)]
                     focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
              <svg class="w-6 h-6 min-w-6 min-h-6 text-[var(--theme-primary-text)]" viewBox="0 0 24 24" fill="none">
                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor" stroke-width="1.5" />
              </svg>

              <input type="number" step="0.01" name="self_amount" id="self_amount" autocomplete="off"
                placeholder="Enter Amount" required
                class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none
                       text-sm md:text-base [caret-color:#60a5fa] border-l border-slate-200 pl-4">
            </div>
          </div>

          <!-- Button -->
          <div class="flex items-center justify-center pt-1">
            <button type="submit"
              class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-0
                     text-sm md:text-base capitalize tracking-wide mt-2
                     rounded-lg border border-[var(--theme-skky-500)]
                     bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                     font-semibold
                     hover:-translate-y-1 cursor-pointer
                     active:scale-95 transition-all duration-300 ease-out group">
              <span>Self Transfer</span>
              <svg class="w-5 h-5 transition-transform duration-500 group-hover:translate-x-1"
                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"></path>
              </svg>
            </button>
          </div>

        </form>
      </div>

      <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
    </div>
  </div>
</div>


</section>
@endsection

@if (session('status_code') === 'success')
<script>
// document.addEventListener('DOMContentLoaded', function () {
//   const backdrop = document.querySelector('[data-dialog-backdrop="withdraw-success"]');
//   if (backdrop) {
//       backdrop.classList.remove('opacity-0', 'pointer-events-none');
//       backdrop.classList.add('opacity-100');
//   }
// });
</script>
@endif
<script>
document.addEventListener('click', function (e) {
    const closeBtn = e.target.closest('[data-dialog-close]');
    if (!closeBtn) return;

    const dialogName = closeBtn.getAttribute('data-dialog-close');


    const backdrop = document.querySelector(
        `[data-dialog-backdrop="${dialogName}"]`
    );

    if (backdrop) {
        backdrop.classList.add('opacity-0', 'pointer-events-none');
        backdrop.classList.remove('opacity-100');
    }
});

document.addEventListener("DOMContentLoaded", function () {  
  document.getElementById('amount').addEventListener('input', function () {
      let amount = parseFloat(this.value) || 0;

      // 5% admin charge
      let adminCharge = amount * 0.05;

      // final amount = amount - admin charge
      let finalAmount = amount - adminCharge;

      // Update fields
      document.getElementById('admin_charge').value = adminCharge.toFixed(2);
      document.getElementById('net_amount').value = finalAmount.toFixed(2);
  });

  const teamUserIdInput = document.getElementById('team_user_id');
  const resultEl = document.getElementById('teamUserNameResult');

  let timer;
  const delay = 500;

  teamUserIdInput.addEventListener('input', () => {
      clearTimeout(timer);

      const userId = teamUserIdInput.value.trim();

      if (userId.length < 4) {
          resultEl.classList.add('hidden');
          resultEl.innerText = '';
          return;
      }

      const fetchUserNameUrl = "https://user.ordinarypeopleai.com/fetch-teamuser-name";

      timer = setTimeout(() => {
          fetch(fetchUserNameUrl, {
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

});
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#withdrawalsTable').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
});
</script>