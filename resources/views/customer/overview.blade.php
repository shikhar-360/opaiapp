@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">

{{-- TOP INCOME CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 mb-8">

  <!-- <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
      <img src="{{ asset('assets/images/icons/roi-income.webp?v=1') }}"  class="w-9" alt="Direct Team Investment">
    </div>
    <div>
      <p class="text-sm text-slate-500">ROI Income</p>
      <p class="text-xl font-bold text-sky-600">$0</p>
    </div>
  </div> -->

  <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-sky-300 to-sky-500 border border-[var(--theme-skky-200)]">
      <img src="{{ asset('assets/images/icons/capping.webp?v=1') }}"  class="w-9" alt="Total Team Investment">
    </div>
    <div>
      <h3 class="text-base text-slate-600">Core Circle Credits</h3>
      <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->myLevelEarning }} {{ $customer->appData->currency }}</p>
    </div>
  </div>

  <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 border border-[var(--theme-skky-200)]">
      <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}"  class="w-9" alt="Total Team Investment">
    </div>
    <div>
      <h3 class="text-base text-slate-600">Total Credits</h3>
      <p class="text-lg font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->myLevelEarning }} {{ $customer->appData->currency }}</p>
    </div>
  </div>


  <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
      <img src="{{ asset('assets/images/rank/emerald-rank.webp?v=1') }}"  class="w-9" alt="Rank Points">
    </div>
    <div>
      <p class="text-sm text-slate-600">Earned Points</p>
      <p class="text-lg font-bold text-[var(--theme-high-text)]">{{ $customer->leadership_points??'-' }} </p>
    </div>
  </div>


  <!-- <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
      <img src="{{ asset('assets/images/icons/capping.webp?v=1') }}"  class="w-9" alt="Level Points">
    </div>
    <div>
      <p class="text-sm text-slate-500">Level Points</p>
      <p class="text-lg font-bold text-sky-600">{{ $customer->champions_point??'-' }} </p>
    </div>
  </div> -->

</div>



{{--   COMMENTED FANCY CARDS   --}}
{{-- ========================= --}}

{{-- ROI Income --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl
shadow-[0_15px_40px_rgba(15,23,42,.08)] hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-emerald-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-400)] opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]
      relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/roi-income.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">ROI Income</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)]/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Level Income --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-fuchsia-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-fuchsia-400 opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/capping.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Level Income</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0.000</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-fuchsia-400/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Direct Income --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-emerald-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-emerald-400 to-[var(--theme-skky-400)] opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/direct-investment.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Direct Income</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Royalty Bonus --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-amber-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-fuchsia-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-amber-400 to-fuchsia-400 opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/royalty-income.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Royalty Bonus</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-amber-400/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Star Bonus --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-emerald-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-emerald-400 opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/star-bonus.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Star Bonus</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)]/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Quick Start Bonus --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-emerald-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-[var(--theme-cyyan-200)]/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-emerald-400 to-[var(--theme-cyyan-400)] opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/quick-start-bonus.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Quick Start Bonus</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/90 to-transparent opacity-70"></div>
</div>
-->

{{-- Total Income --}}
<!--
<div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-white backdrop-blur-xl shadow-[0_15px_40px_rgba(15,23,42,.08)]
hover:shadow-[0_18px_45px_rgba(15,23,42,.14)] transition-shadow">

  <div class="absolute inset-0 pointer-events-none opacity-60">
    <div class="absolute -top-20 -left-20 w-52 h-52 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-amber-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 sm:p-5">
    <div class="relative">
      <div class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-[var(--theme-skky-400)] to-amber-400 opacity-40 blur 
      group-hover:opacity-70 transition-opacity"></div>

      <div class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] relative shadow-[0_10px_30px_rgba(15,23,42,.10)]">
        <img src="{{ asset('assets/images/icons/total-withdraw.webp?v=1') }}"  class="w-10 h-10 object-contain">
      </div>
    </div>

    <div class="w-full min-w-0">
      <h3 class="mb-1 text-sm sm:text-base font-semibold text-slate-900">Total Income</h3>
      <p class="text-sm">
        <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">$0.000</span>
      </p>
    </div>
  </div>

  <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)]/90 to-transparent opacity-70"></div>
</div>
-->

  {{-- DATE RANGE FILTER CARD --}}
  <div
    class="w-full mx-auto my-10 overflow-hidden rounded-2xl relative border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.08)]">
    {{-- soft glow background --}}
    <div class="absolute inset-0 opacity-70 pointer-events-none">
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <form method="POST" action="{{ route('overview.filter') }}" class="relative p-5 md:p-6">
      @csrf
      @method('POST')

      <div id="date-range-picker" date-rangepicker
        class="grid grid-cols-1 md:grid-cols-[1fr_auto_1fr_auto] items-center gap-3 text-slate-900">
        {{-- Start date --}}
        <label class="relative group w-full">
          <div
            class="flex items-center rounded-xl bg-white border border-slate-200 group-focus-within:border-[var(--theme-skky-400)]/80 group-focus-within:ring-1 group-focus-within:ring-[var(--theme-skky-400)]/60 transition">
            <span class="pl-3 pr-2 opacity-80 text-slate-400">
              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Z">
                </path>
              </svg>
            </span>
            <input id="datepicker-range-start" name="start_date" type="text" autocomplete="off" value="{{ $customer->levelIncomeDatefrom }}"
              placeholder="Select start date"
              class="w-full bg-transparent outline-none placeholder:text-slate-400 py-3 pr-3 border-l border-slate-200 pl-4 text-sm md:text-base text-slate-900 datepicker-input">
          </div>
        </label>

        {{-- TO badge --}}
        <div class="hidden md:flex items-center justify-center">
          <span
            class="w-8 h-8 grid place-items-center rounded-full bg-white border border-slate-200 text-[11px] font-semibold tracking-widest text-[var(--theme-high-text)]">
            TO
          </span>
        </div>

        {{-- End date --}}
        <label class="relative group w-full">
          <div
            class="flex items-center rounded-xl bg-white border border-slate-200 group-focus-within:border-[var(--theme-skky-400)]/80 group-focus-within:ring-1 group-focus-within:ring-[var(--theme-skky-400)]/60 transition">
            <span class="pl-3 pr-2 opacity-80 text-slate-400">
              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Z">
                </path>
              </svg>
            </span>
            <input id="datepicker-range-end" name="end_date" type="text" autocomplete="off" value="{{ $customer->levelIncomeDateto }}"
              placeholder="Select end date"
              class="w-full bg-transparent outline-none placeholder:text-slate-400 py-3 pr-3 border-l border-slate-200 pl-4 text-sm md:text-base text-slate-900 datepicker-input">
          </div>
        </label>
        
        {{-- CTA --}}
        <div class="md:pl-2">
          <button type="submit"
            class="px-5 py-2.5 mx-auto flex items-center justify-center gap-0 text-base capitalize tracking-wide mt-4 rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)] text-white font-semibold hover:-translate-y-1 transition-all duration-300 ease-out">
              <path
                d="M15.8 15.8L21 21M18 10.5A7.5 7.5 0 1 1 3 10.5a7.5 7.5 0 0 1 15 0Z"
                stroke="#020617" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>Filter</span>
          </button>
        </div>
      </div>
    </form>
  </div>

  {{-- INCOME TABS + TABLES (SAME TAB UI AS "MY DIRECTS") --}}
  <div
    class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.08)] relative overflow-hidden text-left">
    
    {{-- soft glow background --}}
    <div class="absolute inset-0 opacity-70 pointer-events-none">
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative mb-6">
      {{-- TABS --}}
      <div
        class="incomeOverview_tab flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner overflow-x-auto">
        <ul class="flex gap-2" data-tabs-toggle="#default-tab-content" role="tablist">
          <li class="hidden" role="presentation">
            <button id="table-income_all" data-tabs-target="#income_all" type="button" role="tab"
              aria-controls="income_all" aria-selected="false"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
              <span class="relative z-[1]">Level Points</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
                {{ $customer->levelIncomeCount }}
              </span>
            </button>
          </li>
          <li class="hidden" role="presentation">
            <button id="table-income_roi" data-tabs-target="#income_roi" type="button" role="tab"
              aria-controls="income_roi" aria-selected="false"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
              <span class="relative z-[1]">Rank Points</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-emerald-700 border border-emerald-200">
                {{ $customer->levelIncomeCount }}
              </span>
            </button>
          </li>
          <li role="presentation">
            <button id="table-income_direct" data-tabs-target="#income_direct" type="button" role="tab"
              aria-controls="income_direct" aria-selected="true"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
                     
              <span class="relative z-[1]">Circle Income</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-amber-700 border border-amber-200">
                {{ $customer->levelIncomeCount }}
              </span>
            </button>
          </li>
          <!-- <li role="presentation">
            <button id="table-income_bonus" data-tabs-target="#income_bonus" type="button" role="tab"
              aria-controls="income_bonus" aria-selected="false"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
              <span class="relative z-[1]">Bonuses</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-fuchsia-700 border border-fuchsia-200">
                3
              </span>
            </button>
          </li> -->
        </ul>

        {{-- Hint text --}}
        <!-- <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
          <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
          <span>Click tabs to switch income type</span>
        </div> -->
      </div>
    </div>

    <div id="default-tab-content" class="relative">
      {{-- TAB: ALL INCOME --}}
      <div class="hidden" id="income_all" role="tabpanel" aria-labelledby="table-income_all">
        <div class="overflow-x-auto">
          <div id="tabledata_all_wrapper" class="dataTables_wrapper no-footer">
            
            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
              {{-- <div class="dataTables_length" id="tabledata_all_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata_all_length" aria-controls="tabledata_all"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div> --}}

              {{-- <div id="tabledata_all_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      {{-- Search icon --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80"
                      placeholder="Search amount / tag / date" aria-controls="tabledata_all">
                  </div>
                </label>
              </div> --}}
            </div>

            <table id="tabledata_all"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px;" aria-describedby="tabledata_all_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Sr.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Amount 
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Tag
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px] !text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: ALL INCOME --}}
                @foreach($customer->levelIncomeDetails as $ovkey => $incomes)
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">1</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">{{ $incomes->amount_earned }}</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $incomes->earning_type }}-{{ $incomes->reference_level }}</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">{{ $incomes->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{-- <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
              <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata_all_info" role="status"
                aria-live="polite">
                Showing 1 to 8 of 8 entries
              </div>
              <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
                id="tabledata_all_paginate">
                <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata_all" aria-role="link" data-dt-idx="previous" tabindex="0"
                  id="tabledata_all_previous">Previous</a>
                <span class="text-xs text-slate-700">1</span>
                <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata_all" aria-role="link" data-dt-idx="next" tabindex="0"
                  id="tabledata_all_next">Next</a>
              </div>
            </div> --}}

          </div>
        </div>
      </div>

      {{-- TAB: ROI INCOME --}}
      <div class="hidden" id="income_roi" role="tabpanel" aria-labelledby="table-income_roi">
        <div class="overflow-x-auto">
          <div id="tabledata_roi_wrapper" class="dataTables_wrapper no-footer">

            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
              <div class="dataTables_length" id="tabledata_roi_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata_roi_length" aria-controls="tabledata_roi"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div>

              <div id="tabledata_roi_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      {{-- Search icon --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80"
                      placeholder="Search ROI income" aria-controls="tabledata_roi">
                  </div>
                </label>
              </div>
            </div>

            <table id="tabledata_roi"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px;" aria-describedby="tabledata_roi_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-emerald-700 text-xs sm:text-[13px]">
                    Sr.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-emerald-700 text-xs sm:text-[13px]">
                    Amount
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-emerald-700 text-xs sm:text-[13px]">
                    Tag
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-emerald-700 text-xs sm:text-[13px] !text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: ROI INCOME --}}
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">1</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$50.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Daily ROI</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-01 09:15:30</td>
                </tr>
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">2</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$35.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Daily ROI</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-02 09:18:44</td>
                </tr>
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">3</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$35.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Daily ROI</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-03 09:20:12</td>
                </tr>
              </tbody>
            </table>

            <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata_roi_info" role="status"
              aria-live="polite">
              Showing 1 to 3 of 3 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata_roi_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_roi" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata_roi_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_roi" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata_roi_next">Next</a>
            </div>

          </div>
        </div>
      </div>

      {{-- TAB: DIRECT INCOME --}}
      <div id="income_direct" role="tabpanel" aria-labelledby="table-income_direct">
        <div class="overflow-x-auto">
          <div id="tabledata_direct_wrapper" class="dataTables_wrapper no-footer">

            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
              {{-- <div class="dataTables_length" id="tabledata_direct_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata_direct_length" aria-controls="tabledata_direct"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-amber-400/80 focus:border-amber-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div> --}}

              {{-- <div id="tabledata_direct_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-amber-400/80 focus:border-amber-400/80"
                      placeholder="Search direct income" aria-controls="tabledata_direct">
                  </div>
                </label>
              </div> --}}
            </div>
            </div>

            <table id="tabledata_direct"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px;" aria-describedby="tabledata_direct_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-amber-700 text-xs sm:text-[13px]">
                    Sr.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-amber-700 text-xs sm:text-[13px]">
                    Amount ({{ $customer->appData->currency }})
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-amber-700 text-xs sm:text-[13px]">
                    Tag
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-amber-700 text-xs sm:text-[13px] !text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: DIRECT INCOME --}}
                @foreach($customer->levelIncomeDetails as $ovkey => $incomes)
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">{{ $loop->iteration }}</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">{{ $incomes->amount_earned }}</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $incomes->earning_type }}-{{ $incomes->reference_level }}</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">{{ $incomes->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
                
              </tbody>
            </table>

            {{-- <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata_direct_info" role="status"
              aria-live="polite">
              Showing 1 to 2 of 2 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata_direct_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_direct" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata_direct_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_direct" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata_direct_next">Next</a>
            </div> --}}

          </div>
        </div>
      </div>

      {{-- TAB: BONUSES (ROYALTY / STAR / QUICK START) --}}
      <div class="hidden" id="income_bonus" role="tabpanel" aria-labelledby="table-income_bonus">
        <div class="overflow-x-auto">
          <div id="tabledata_bonus_wrapper" class="dataTables_wrapper no-footer">

            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
              <div class="dataTables_length" id="tabledata_bonus_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata_bonus_length" aria-controls="tabledata_bonus"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-fuchsia-400/80 focus:border-fuchsia-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div>

              <div id="tabledata_bonus_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      {{-- Search icon --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-fuchsia-400/80 focus:border-fuchsia-400/80"
                      placeholder="Search bonuses" aria-controls="tabledata_bonus">
                  </div>
                </label>
              </div>
            </div>

            <table id="tabledata_bonus"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px;" aria-describedby="tabledata_bonus_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-fuchsia-700 text-xs sm:text-[13px]">
                    Sr.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-fuchsia-700 text-xs sm:text-[13px]">
                    Amount
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-fuchsia-700 text-xs sm:text-[13px]">
                    Tag
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-fuchsia-700 text-xs sm:text-[13px] !text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: BONUSES --}}
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">1</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$40.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Royalty Bonus</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-04 18:21:50</td>
                </tr>
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">2</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$15.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Star Bonus</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-05 12:10:09</td>
                </tr>
                <tr class="hover:bg-slate-100 transition">
                  <td class="px-4 sm:px-5 py-3 text-slate-900">3</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600 font-semibold">$30.00</td>
                  <td class="px-4 sm:px-5 py-3 text-slate-700">Quick Start Bonus</td>
                  <td class="px-4 sm:px-5 py-3 text-right text-slate-600">2025-09-06 16:44:33</td>
                </tr>
              </tbody>
            </table>

            <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata_bonus_info" role="status"
              aria-live="polite">
              Showing 1 to 3 of 3 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata_bonus_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_bonus" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata_bonus_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata_bonus" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata_bonus_next">Next</a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#tabledata_all').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
  $('#tabledata_direct').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
});
</script>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tabList = document.querySelector('[data-tabs-toggle="#default-tab-content"]');
    if (!tabList) return;

    const tabButtons = tabList.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('#default-tab-content [role="tabpanel"]');

    // Tailwind classes for active & inactive tabs (same as My Directs light theme)
    const activeClasses = [
      'bg-gradient-to-r', 'from-[var(--theme-skky-500)]', 'to-[var(--theme-skky-600)]',
      'text-white',
      'shadow-[0_10px_25px_rgba(59,130,246,.35)]',
      'border', 'border-[var(--theme-skky-500)]'
    ];

    const inactiveClasses = [
      'text-slate-600', 'hover:text-slate-900',
      'border', 'border-slate-200',
      'bg-white', 'hover:bg-slate-200'
    ];

    function setActiveTab(btn) {
      const targetSelector = btn.getAttribute('data-tabs-target');
      const targetPanel = document.querySelector(targetSelector);
      if (!targetPanel) return;

      // Hide all panels
      tabPanels.forEach(panel => panel.classList.add('hidden'));
      // Show selected
      targetPanel.classList.remove('hidden');

      // Update tab button states
      tabButtons.forEach(b => {
        const isActive = b === btn;
        b.setAttribute('aria-selected', isActive ? 'true' : 'false');

        // Clean old classes
        b.classList.remove(...activeClasses, ...inactiveClasses);

        // Base classes (common)
        b.classList.add(
          'group', 'relative', 'px-4', 'py-1.5',
          'rounded-full', 'text-xs', 'sm:text-sm',
          'font-semibold', 'transition', 'flex', 'items-center', 'gap-2'
        );

        // Add new classes
        if (isActive) {
          b.classList.add(...activeClasses);
        } else {
          b.classList.add(...inactiveClasses);
        }
      });
    }

    // Initial state (based on aria-selected)
    tabButtons.forEach((btn) => {
      if (btn.getAttribute('aria-selected') === 'true') {
        setActiveTab(btn);
      }
    });

    // On click
    tabButtons.forEach((btn) => {
      btn.addEventListener('click', () => setActiveTab(btn));
    });
  });
</script>

@endpush
