@extends('app')

@section('title', 'Withdraw')

@section('content')
<script src="{{asset('assets/js/dialog.js')}}"></script>

<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">

  {{-- ALERT / INFO BANNER --}}
  <div
    class="inline-flex items-center gap-2 px-4 py-2.5 mb-6 rounded-2xl border border-slate-200
           bg-white shadow-[0_10px_30px_rgba(15,23,42,.08)] relative overflow-hidden">
    {{-- soft glow --}}
    <div class="absolute inset-0 opacity-60 pointer-events-none">
      <div class="absolute -left-10 -top-10 w-32 h-32 bg-sky-200/40 rounded-full blur-3xl"></div>
      <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-rose-200/40 rounded-full blur-3xl"></div>
    </div>

    <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-sky-400 animate-pulse"></span>
    <p class="relative text-xs sm:text-sm md:text-base text-slate-800">
      Due to Polygon congestion, withdrawals are being processed slowly.
    </p>
  </div>

  {{-- TOP WITHDRAW STATS (THEME SAME AS DIRECTS PAGE CARDS) --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-3 sm:gap-5 mb-8">

    {{-- ROI Income --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
        <img src="/assets/images/icons/roi-income.webp" width="100" height="100" alt="ROI Income"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <p class="text-sm text-slate-500">ROI Income</p>
        <p class="text-xl font-bold text-sky-600">$0</p>
      </div>
    </div>

    {{-- Level Income --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-fuchsia-50 border border-fuchsia-200">
        <img src="/assets/images/icons/capping.webp" width="100" height="100" alt="Level Income"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <p class="text-sm text-slate-500">Level Income</p>
        <p class="text-xl font-bold text-fuchsia-600">{{ $customer->myLevelEarning }}</p>
      </div>
    </div>

    {{-- Total Income --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-amber-50 border border-amber-200">
        <img src="/assets/images/icons/total-withdraw.webp" width="100" height="100" alt="Total Income"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <p class="text-sm text-slate-500">Total Income</p>
        <p class="text-xl font-bold text-amber-600">{{ $customer->myTotalEarning }}</p>
      </div>
    </div>

    {{-- Total Withdraw --}}
    <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
      <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-emerald-50 border border-emerald-200">
        <img src="/assets/images/icons/income.webp" width="100" height="100" alt="Total Withdraw"
             class="w-9 h-9 object-contain">
      </div>
      <div>
        <p class="text-sm text-slate-500">Total Withdraw</p>
        <p class="text-xl font-bold text-emerald-600">{{ $customer->myTotalWithdraws }}</p>
      </div>
    </div>

  </div>

  {{-- WITHDRAW BUTTON --}}
  <div class="flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-4 mb-8">
    <button data-dialog-target="dialog" type="submit"
      class="px-5 py-2.5 mx-auto flex items-center justify-center gap-0 text-base capitalize tracking-wide mt-4 rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-primary-text)] to-[var(--theme-primary-bg)] text-black font-semibold shadow-[0_8px_20px_rgba(56,189,248,.30)] hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] transition-all duration-300 ease-out">
      <span>Earning Withdraw</span>
      <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
        aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
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
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-sky-200/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative overflow-x-auto">
      <div id="withdrawalsTable_wrapper" class="dataTables_wrapper no-footer">

        {{-- TOP BAR: SHOW + SEARCH --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-3 relative z-10">
          <div class="dataTables_length" id="withdrawalsTable_length">
            <label class="text-xs sm:text-sm text-slate-600 flex items-center gap-2">
              <span>Show</span>
              <select name="withdrawalsTable_length" aria-controls="withdrawalsTable"
                class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
              <span>entries</span>
            </label>
          </div>

          <div id="withdrawalsTable_filter" class="dataTables_filter w-full md:w-auto">
            <label class="text-xs sm:text-sm text-slate-600 w-full">
              <span class="sr-only">Search</span>
              <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                  {{-- Search icon --}}
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
                  class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80"
                  placeholder="Search amount / status / tx id" aria-controls="withdrawalsTable">
              </div>
            </label>
          </div>
        </div>

        <table id="withdrawalsTable"
          class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
          style="padding-top: 15px;" aria-describedby="withdrawalsTable_info">
          <thead>
            <tr class="bg-slate-100 text-slate-900">
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Sr.
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Amount
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Net Amount
              </th>
              {{-- <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Status
              </th> --}}
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Transaction ID
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Type
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] !text-right">
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
              {{-- <td class="px-4 sm:px-5 py-3 font-mono text-[11px] text-slate-500">{{ $myW->transaction_type }}</td> --}}
              <td class="px-4 sm:px-5 py-3 text-slate-800">{{ $myW->transaction_id }}</td>
              <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myW->transaction_type }}</td>
              <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myW->created_at->format('d-m-Y') }}</td>
              
            </tr>
            @endforeach
          </tbody>
        </table>

        <div
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
        </div>

      </div>
    </div>
  </div>

  {{-- WITHDRAW DIALOG (POPUP – DARK THEME RAKH DIYA, JAISE PEHLE THA) --}}
  <div data-dialog-backdrop="dialog"
     class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black/70 opacity-0 backdrop-blur-sm transition-opacity duration-300 overflow-auto p-2">
    <div data-dialog="dialog" class="text-white w-full max-w-[600px]" style="max-height: calc(100% - 0px);">
      <div
        class="p-4 md:p-6 text-white rounded-2xl w-full mx-auto border border-slate-700/70 bg-slate-900/70 shadow-xl backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(15,23,42,0.9)] relative overflow-hidden text-left">

        {{-- soft glow background --}}
        <div class="absolute inset-0 opacity-50 pointer-events-none">
          <div class="absolute -top-24 -right-24 w-72 h-72 bg-cyan-500/25 rounded-full blur-3xl"></div>
          <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative flex items-start justify-between">
          <h2 class="flex shrink-0 items-center text-xl font-semibold text-slate-50">
            Withdraw
          </h2>
          <button data-dialog-close="true"
                  class="relative h-8 w-8 bg-slate-900/80 border border-slate-700/70 flex items-center justify-center select-none rounded-lg text-center hover:bg-slate-800/80 transition"
                  type="button">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                  class="h-5 w-5 text-slate-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <div class="relative pt-4 leading-normal font-light">

          {{-- TOP CARDS: Available + Pending --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-3 sm:gap-5 mb-5">
            {{-- Available Balance --}}
            <div
              class="relative group rounded-2xl overflow-hidden border border-slate-700/70 bg-gradient-to-br from-slate-900 via-slate-900/95 to-slate-900/90 backdrop-blur-xl shadow-xl hover:shadow-2xl transition-shadow">
              <div class="absolute inset-0 pointer-events-none opacity-40">
                <div class="absolute -top-20 -left-20 w-52 h-52 bg-emerald-400/15 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-sky-400/15 rounded-full blur-3xl"></div>
              </div>

              <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
                <div class="relative">
                  <div
                    class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-emerald-400 to-sky-400 opacity-40 blur group-hover:opacity-70 transition-opacity">
                  </div>
                  <div
                    class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-slate-950/80 border border-slate-700/70 relative shadow-[0_10px_30px_rgba(15,23,42,.9)]">
                    <img src="/assets/images/icons/total-withdraw.webp" width="100" height="100" alt="Available Balance"
                      class="w-10 h-10 object-contain">
                  </div>
                </div>

                <div class="w-full min-w-0">
                  <h3 class="mb-1 text-sm sm:text-base leading-none font-semibold text-slate-50">
                    Available Balance
                  </h3>
                  <p class="text-sm">
                    <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">{{ $customer->myAvailableBalance > 0 ? $customer->myAvailableBalance : 0 }}</span>
                  </p>
                </div>
              </div>

              <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/100 to-transparent opacity-60"></div>
            </div>

            {{-- Pending Balance --}}
            <div
              class="relative group rounded-2xl overflow-hidden border border-slate-700/70 bg-gradient-to-br from-slate-900 via-slate-900/95 to-slate-900/90 backdrop-blur-xl shadow-xl hover:shadow-2xl transition-shadow">
              <div class="absolute inset-0 pointer-events-none opacity-40">
                <div class="absolute -top-20 -left-20 w-52 h-52 bg-amber-400/15 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-fuchsia-400/15 rounded-full blur-3xl"></div>
              </div>

              <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
                <div class="relative">
                  <div
                    class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-amber-400 to-fuchsia-400 opacity-40 blur group-hover:opacity-70 transition-opacity">
                  </div>
                  <div
                    class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-slate-950/80 border border-slate-700/70 relative shadow-[0_10px_30px_rgba(15,23,42,.9)]">
                    <img src="/assets/images/icons/total-withdraw.webp" width="100" height="100" alt="Pending Balance"
                      class="w-10 h-10 object-contain">
                  </div>
                </div>

                <div class="w-full min-w-0">
                  <h3 class="mb-1 text-sm sm:text-base leading-none font-semibold text-slate-50">
                    Pending Balance
                  </h3>
                  <p class="text-sm">
                    <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
                  </p>
                </div>
              </div>

              <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-amber-400/100 to-transparent opacity-60"></div>
            </div>
          </div>

          {{-- FORM (STATIC / NO ACTION) --}}
          <form class="relative" id="withdraw-process-form" action="{{ route('withdraw.save') }}" method="POST">
            @csrf
            {{-- Amount --}}
            <div class="relative">
              <label for="amount" class="block text-xs text-slate-300 font-medium mb-2">
                Enter Amount
              </label>
              <div
                class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-cyan-400/80 focus-within:ring-1 focus-within:ring-cyan-400/60 transition-colors mb-3">
                <svg class="w-7 h-7 min-w-7 min-h-7 text-cyan-300" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                        stroke-width="1.5" />
                </svg>
                <input type="text" name="amount" id="amount" autocomplete="off"
                       placeholder="Enter Amount (min withdraw 10)" required
                       class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100 placeholder:text-slate-500">
              </div>
            </div>

            {{-- Admin Fees --}}
            <div class="relative">
              <label for="adminFees" class="block text-xs text-slate-300 font-medium mb-2">
                Admin Fees 5%
              </label>
              <div
                class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-cyan-400/80 focus-within:ring-1 focus-within:ring-cyan-400/60 transition-colors mb-3">
                <svg class="w-7 h-7 min-w-7 min-h-7 text-cyan-300" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                        stroke-width="1.5" />
                </svg>
                <input type="text" name="admin_charge" readonly id="admin_charge" placeholder="0" value="0"
                       class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100">
              </div>
            </div>

            {{-- Final Amount --}}
            <div class="relative">
              <label for="yourfinalamount" class="block text-xs text-slate-300 font-medium mb-2">
                Your Final Amount
              </label>
              <div
                class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-cyan-400/80 focus-within:ring-1 focus-within:ring-cyan-400/60 transition-colors mb-3">
                <svg class="w-7 h-7 min-w-7 min-h-7 text-cyan-300" viewBox="0 0 24 24" fill="none">
                  <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                  <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                        stroke-width="1.5" />
                  <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                        stroke-width="1.5" />
                </svg>
                <input type="text" readonly id="net_amount" name="net_amount" placeholder="Your final amount" value="0"
                       class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100">
              </div>
            </div>

            {{-- button --}}
            <div class="flex items-center justify-center mt-0 relative group max-w-fit mx-auto">
              <button {{ $customer->myAvailableBalance < 10 ? '':'' }}
                      type="submit"
                      class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-2 text-base capitalize tracking-wide mt-4 rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-primary-text)] to-[var(--theme-primary-bg)] text-black font-semibold shadow-[0_8px_20px_rgba(56,189,248,.30)] hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] transition-all duration-300 ease-out">
                <span class="text-black">Withdraw</span>
                <svg
                  class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-1"
                  aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path clip-rule="evenodd"
                        d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                        fill-rule="evenodd"></path>
                </svg>
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

</section>
@endsection

<script>
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
});
</script>