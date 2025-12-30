@extends('app')

@push('styles')
  <style>
    /* add your custom css here if needed */
  </style>
@endpush

@section('content')
  <section class="min-h-screen py-8 bg-slate-50/50 px-4 xl:px-20 2xl:px-40">
    <div class="mx-auto">
      {{-- HEADER --}}
      <div class=" items-center  mb-3 mt-8">
        <h2 class="text-base sm:text-xl font-semibold text-slate-900">Stats</h2>
        <p class="text-sm text-slate-600">Performance snapshot across referrals, volume, and rewards.</p>
      </div>

      {{-- METRIC CARDS ROW 1 --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-5">
        {{-- Referral level --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="relative flex items-center gap-2 sm:gap-3">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 ring-1 ring-[var(--theme-skky-400)]/20">
              <img src="/assets/images/icons/referral.webp" alt="Core Circle" class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <h3 class="text-sm sm:text-base font-medium text-sky-900 truncate">Core Circle</h3>
              <div class="text-start mt-1">
                <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">{{ $customer->myReferralLevel }}</p>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100"></div>
        </div>

        {{-- Team --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/15 via-transparent to-[var(--theme-skky-400)]/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="relative flex items-center gap-2 sm:gap-3">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 ring-1 ring-emerald-400/20">
              <img src="/assets/images/icons/team.webp" alt="Extended Circle" class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <h3 class="text-sm sm:text-base font-medium text-emerald-900 truncate">Extended Circle</h3>
              <div class="text-start mt-1">
                <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">{{ $customer->totalTeamCount }} </p>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Capping / Potential --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-amber-400/15 via-transparent to-orange-500/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100"></div>

        <div class="relative flex items-center gap-4 w-full">
  <div class="flex items-center gap-3 w-full">
    
    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-amber-600">
      <img src="/assets/images/icons/cappingnew.webp" class="h-7 w-7">
    </div>

    <div class="flex-1">
      <h3 class="text-sm font-medium text-amber-900">Potential</h3>
       @php
      $earned = (float) ($customer->myLevelEarning ?? 0);

      $rawCapping = (float) ($customer->myFinance['capping_limit'] ?? 0);
      $cappingLimit = max(0, $rawCapping - 2500); // never negative

      if ($cappingLimit > 0) {
          $percentUsed = ($earned / $cappingLimit) * 100;
          $scaleOf10   = ($earned / $cappingLimit) * 10;
      } else {
          $percentUsed = 0;
          $scaleOf10   = 0;
      }

      // Clamp values
      $percentUsed = min(100, round($percentUsed, 2));
      $scaleOf10   = min(10, round($scaleOf10, 2));
      @endphp
      <div class="flex justify-between mb-1">
        <span class="text-xs">{{ $scaleOf10 }} / 10</span>
        <span class="text-xs">{{ $percentUsed }}%</span>
      </div>

      <div class="w-full bg-slate-200 rounded-full h-2.5">
        <div class="bg-gradient-to-r from-amber-400 to-orange-500 h-2.5" style="width:{{ $percentUsed }}%"></div>
      </div>
    </div>

  </div>
</div>


          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent opacity-60"></div>
        </div>

        {{-- Level Income --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-purple-400/15 via-transparent to-purple-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="relative flex items-center gap-2 sm:gap-3">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-gradient-to-br from-purple-400 to-purple-700 ring-1 ring-[var(--theme-skky-400)]/20">
              <img src="/assets/images/icons/level-income.webp" alt="Level Income" class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <h3 class="text-sm sm:text-base font-medium text-sky-900 truncate">Level Income</h3>
              <div class="text-start mt-1">
                <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">{{ number_format($customer->myLevelEarning, 2, '.', '') }} {{ $customer->appData->currency }}</p>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-purple-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Total Income --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/15 via-transparent to-[var(--theme-skky-400)]/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100"></div>

          <div class="relative flex items-center gap-2 sm:gap-3">
            <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-400 to-sky-500 ring-1 ring-slate-200">
              <img src="/assets/images/icons/total-income.webp" alt="Total Income" class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <h3 class="text-sm sm:text-base text-fuchsia-900 truncate">Total Points</h3>
              <div class="text-start mt-1">
                <p class="text-xl sm:text-3xl font-bold text-slate-900 leading-none">{{ $customer->leadership_points+$customer->champions_point }} {{ $customer->appData->currency }}</p>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent"></div>
        </div>
      </div>

      {{-- INFO GRID : SPONSOR / DIRECTS / INVESTMENTS etc --}}
       <div class="flex items-center justify-between mb-3 mt-8">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900">Account Overview</h2>
      </div>
      <div class=" grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        {{-- Mentor --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-purple-400 to-purple-700 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/mentor.webp" class="w-9" alt="Mentor">
          </div>
          <div>
            <h3 class="text-base text-slate-600">Mentor</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">#{{ $customer->mySponsor }}</p>
          </div>
        </div>

        {{-- My Circle --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/my-circle.webp" class="w-9" alt="My Circle">
          </div>
          <div>
            <h3 class="text-base text-slate-600">My Circle</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{  $customer->totalDirectsCount }}</p>
          </div>
        </div>

        {{-- My Circle Count --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-700 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/my-circle-count.webp" class="w-8" alt="My Circle Count">
          </div>
          <div>
            <h3 class="text-base text-slate-600">My Circle Count</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{  $customer->totalActiveDirectsCount }}</p>
          </div>
        </div>

        {{-- Date of Activation --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 border border-[var(--theme-skky-200)] p-2">
            <img src="/assets/images/icons/date-of-activation.webp" class="w-9" alt="Date of Activation">
          </div>
          <div>
            <h3 class="text-base text-slate-600">Date of Activation</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->myFirstDepositAt?date('d-m-Y', strtotime($customer->myFirstDepositAt)):'-' }}</p>
          </div>
        </div>

        {{-- Personal Journey --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-blue-400 to-blue-700 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/self-investment.webp" class="w-9" alt="Personal Journey">
          </div>
          <div>
            <h3 class="text-base text-slate-600">Personal Journey</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ number_format($customer->myInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>

        {{-- My Circle Growth --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-purple-400 to-purple-700 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/my-circle-growth.webp" class="w-9" alt="My Circle Growth">
          </div>
          <div>
            <h3 class="text-base text-slate-600">My Circle Growth</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ number_format($customer->totalDirectInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>

        {{-- Extended Growth --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/extended-growth.webp" class="w-8" alt="Extended Growth">
          </div>
          <div>
            <h3 class="text-base text-slate-600">Extended Growth</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ $customer->totalTeamInvestment??0 }}  {{ $customer->appData->currency }}</p>
          </div>
        </div>

        {{-- Total Withdraw --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/total-withdraw.webp" class="w-9" alt="Total Withdraw">
          </div>
          <div>
            <h3 class="text-base text-slate-600">Total Withdraw</h3>
            <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ number_format($customer->myTotalWithdraws, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  {{-- scripts removed as requested --}}
@endpush
