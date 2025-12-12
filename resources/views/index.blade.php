@extends('app')

@push('styles')
  {{-- Swiper CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /* Page specific CSS yahan likh sakte ho (agar zarurat ho) */
  </style>
@endpush

@section('content')
  <section class="min-h-screen py-8 bg-slate-50/50 px-4">
    <div class="mx-auto ">

      {{-- TOP ROW : REFERRAL + PDF --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-6">
        {{-- Referral Link Card --}}
        <div
          class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-sky-50 backdrop-blur-xl shadow-lg hover:shadow-2xl transition-shadow">
          <div class="absolute inset-0 pointer-events-none opacity-60">
            <div class="absolute -top-20 -left-20 w-52 h-52 bg-sky-400/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-blue-500/15 rounded-full blur-3xl"></div>
          </div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="relative">
              <div
                class="w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-white border border-sky-200 flex items-center justify-center shadow-md group-hover:border-sky-400 transition-colors">
                <img src="/assets/images/opai.webp" width="64" height="48" alt="Logo"
                  class="w-8 h-8 sm:w-10 sm:h-10 object-contain">
              </div>
            </div>

            <div class="w-full min-w-0">
              <h3 class="text-sm sm:text-base text-slate-900 leading-none mb-2 font-semibold">
                OpAi Referral Link
              </h3>

              <div class="flex items-stretch gap-2 bg-slate-50 rounded-xl border border-slate-200 p-1.5">
                {{-- link block --}}
                <div class="flex-1 min-w-0">
                  <div
                    class="px-3 py-2 rounded-lg bg-white border border-slate-200 text-slate-800 font-mono text-[11px] md:text-xs tracking-tight whitespace-nowrap overflow-x-auto scrollbar-thin cursor-text"
                    onclick="selectReferralText()" title="Click to select">
                    <span id="referral-link" class="inline-block">
                      https://OpAi.farm/register?sponser_code=E50C95
                    </span>
                  </div>
                </div>

                {{-- actions --}}
                <div class="flex items-center gap-1 pr-1">
                  {{-- copy --}}
                  <button type="button"
                    onclick="copyReferral(); typeof showToast==='function' && showToast('success','Copied to clipboard!')"
                    class="rounded-full w-9 h-9 flex items-center justify-center bg-sky-600 text-white text-xs font-semibold hover:bg-sky-700 active:scale-95 transition-all border border-sky-500 shadow-md">
                    <svg class="w-4.5 h-4.5" viewBox="0 0 1024 1024" aria-hidden="true">
                      <path fill="currentColor"
                        d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z">
                      </path>
                      <path fill="currentColor"
                        d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z">
                      </path>
                    </svg>
                  </button>

                  {{-- share --}}
                  <button type="button" onclick="shareReferral()"
                    class="rounded-full w-9 h-9 flex items-center justify-center bg-slate-100 text-slate-800 text-xs font-semibold hover:bg-slate-200 active:scale-95 transition-all border border-slate-300">
                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none">
                      <path
                        d="M9 12C9 13.3807 7.88071 14.5 6.5 14.5C5.11929 14.5 4 13.3807 4 12C4 10.6193 5.11929 9.5 6.5 9.5C7.88071 9.5 9 10.6193 9 12Z"
                        stroke="currentColor" stroke-width="1.5"></path>
                      <path d="M14 6.5L9 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                      <path d="M14 17.5L9 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                      <path
                        d="M19 18.5C19 19.8807 17.8807 21 16.5 21C15.1193 21 14 19.8807 14 18.5C14 17.1193 15.1193 16 16.5 16C17.8807 16 19 17.1193 19 18.5Z"
                        stroke="currentColor" stroke-width="1.5"></path>
                      <path
                        d="M19 5.5C19 6.88071 17.8807 8 16.5 8C15.1193 8 14 6.88071 14 5.5C14 4.11929 15.1193 3 16.5 3C17.8807 3 19 4.11929 19 5.5Z"
                        stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Download PDF Card --}}
        <div
          class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-sky-50 backdrop-blur-xl shadow-lg hover:shadow-2xl transition-shadow">
          <div class="absolute inset-0 pointer-events-none opacity-60">
            <div class="absolute -top-20 -left-20 w-52 h-52 bg-indigo-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-blue-400/20 rounded-full blur-3xl"></div>
          </div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="relative">
              <div
                class="w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-white border border-slate-200 flex items-center justify-center shadow-md group-hover:border-sky-400 transition-colors">
                <img src="/assets/images/icons/download-pdf.webp" width="64" height="48" alt="Logo"
                  class="w-8 h-8 object-contain">
              </div>
            </div>

            <div class="w-full min-w-0 flex flex-wrap justify-between items-center">
              <div>
                <h3 class="text-sm sm:text-base text-slate-900 leading-none mb-1.5 font-semibold">
                  OpAi PDF
                </h3>
                <p class="text-xs text-slate-500 mb-3">
                  Presentation PDF – share with your prospects.
                </p>
              </div>

              <div class="mt-1 flex flex-wrap items-stretch gap-2">
                {{-- View --}}
                <a href="/assets/images/pdf/OpAi_pdf.pdf" target="_blank"
                  class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white text-slate-800 text-[11px] sm:text-xs font-medium hover:bg-slate-200 transition-all border border-slate-200">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                    <path
                      d="M14 3h7v7M21 3l-8.5 8.5M21 14v4a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h4"
                      stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                  View
                </a>

                {{-- Download --}}
                <a href="/assets/images/pdf/OpAi_pdf.pdf" download="OpAi-Presentation.pdf"
                  onclick="typeof showToast==='function' && showToast('success', 'PDF downloaded successfully!')"
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sky-600 text-white text-xs sm:text-sm font-semibold hover:bg-sky-700 active:scale-95 transition-all border border-sky-500 shadow-md">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                    <path
                      d="M12 3v11m0 0l3.5-3.5M12 14L8.5 10.5M4 15v3a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-3"
                      stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                  Download
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-6">
   
   <x-level-grid :currentLevel="2" />
        </div>

    </div>
    </div>
   </div>
      {{-- RANKING SLIDER --}}
      <div class="mt-4">
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-base sm:text-lg font-semibold text-slate-900">
            Level
          </h2>
          <div class="flex items-center gap-2">
            <button type="button"
              class="ranking-prev w-8 h-8 rounded-full border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100 active:scale-95 transition">
              <span class="-translate-x-[1px]">&larr;</span>
            </button>
            <button type="button"
              class="ranking-next w-8 h-8 rounded-full border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100 active:scale-95 transition">
              <span class="translate-x-[1px]">&rarr;</span>
            </button>
          </div>
        </div>

        <div
          class="swiper rankingsliderbox overflow-hidden rounded-2xl border border-slate-200 bg-white backdrop-blur-2xl px-3 py-4 shadow-sm">
          <div class="swiper-wrapper flex">
            @for ($i = 1; $i <= 15; $i++)
              <div class="swiper-slide !w-[140px] sm:!w-[160px] md:!w-[200px]">
                <div
                  class="p-4 rounded-xl mx-auto border border-blue-300/60 bg-gradient-to-t from-sky-50 via-white to-sky-100 text-center text-slate-900 relative flex flex-col gap-1 items-center justify-center shadow-[0_10px_30px_rgba(59,130,246,.25)]">
                  <strong class="block uppercase text-[11px] tracking-[0.18em] text-slate-500">
                    Level
                  </strong>
                  <strong
                    class="w-10 h-10 border border-sky-300/80 bg-gradient-to-t from-sky-500 to-sky-400 rounded-full flex items-center justify-center text-slate-900 font-bold text-sm shadow-[0_8px_22px_rgba(56,189,248,.7)]">
                    {{ $i }}
                  </strong>
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>

      {{-- METRIC CARDS ROW 1 --}}
      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-5">

        {{-- Referral level --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-sky-400/15 via-transparent to-fuchsia-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-sky-400/20 shadow-[0_0_25px_rgba(56,189,248,0.35)]">
              <img src="/assets/images/icons/capping.webp" alt="Referral level"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-medium text-sky-900 truncate">
                Referral level
              </p>
            </div>

            <div class="text-right">
              <p class="text-[11px] text-slate-500 mb-0.5">
                Current
              </p>
              <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">
                —
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-sky-400/70 to-transparent opacity-100"></div>
        </div>

        {{-- Team --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(16,185,129,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/15 via-transparent to-sky-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-emerald-400/20 shadow-[0_0_25px_rgba(16,185,129,0.35)]">
              <img src="/assets/images/icons/team.webp" alt="Team"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-medium text-emerald-900 truncate">
                Team
              </p>
            </div>

            <div class="text-right">
              <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">
                8
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Capping --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(245,158,11,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-amber-400/15 via-transparent to-sky-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-amber-400/20 shadow-[0_0_25px_rgba(245,158,11,0.35)]">
              <img src="/assets/images/icons/daily-income.webp" alt="Capping"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-medium text-amber-900 truncate">
                Capping
              </p>
            </div>

            <div class="text-right">
              <p class="text-[11px] text-slate-500 mb-0.5">
                Slots
              </p>
              <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">
                5
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-amber-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Level Income --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(56,189,248,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-sky-400/15 via-transparent to-purple-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-sky-400/20 shadow-[0_0_25px_rgba(56,189,248,0.35)]">
              <img src="/assets/images/icons/level-income.webp" alt="Level Income"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-medium text-sky-900 truncate">
                Level Income
              </p>
            </div>

            <div class="text-right">
              <p class="text-[11px] text-slate-500 mb-0.5">
                Earned
              </p>
              <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">
                0.000
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-sky-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Total Income --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_45px_rgba(15,23,42,0.2)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/15 via-transparent to-sky-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-slate-200 shadow-[0_0_18px_rgba(148,163,184,0.55)]">
              <img src="/assets/images/icons/income.webp" alt="Total Income"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-semibold text-slate-900 truncate">
                Total Income
              </p>
            </div>

            <div class="text-right">
              <p class="text-[11px] text-sky-700 mb-0.5">
                Overall
              </p>
              <p class="text-xl sm:text-3xl font-bold text-slate-900 leading-none">
                235
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent"></div>
        </div>
      </div>

      {{-- MY PACKAGES TABLE --}}
      <div class="mt-10">
        <h2 class="text-lg font-semibold mb-3 text-slate-900">My Packages</h2>
        <div
          class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.12)] relative overflow-hidden text-left">
          <div class="absolute inset-0 opacity-80 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-sky-300/30 rounded-full blur-3xl"></div>
          </div>

          <div class="relative overflow-x-auto">
            <table class="w-full text-left border-collapse pb-4 text-sm text-slate-900">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-sky-700 text-xs sm:text-sm">
                    Sr No.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-sky-700 text-xs sm:text-sm">
                    Amount
                  </t h>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-sky-700 text-xs sm:text-sm">
                    ROI
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-sky-700 text-xs sm:text-sm text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200 text-xs sm:text-sm">
                <tr class="hover:bg-slate-200 transition-colors">
                  <td class="px-4 py-2">1</td>
                  <td class="px-4 py-2">100</td>
                  <td class="px-4 py-2">
                    <span
                      class="inline-block rounded-md border border-sky-300/70 px-2 py-0.5 text-[11px] sm:text-xs bg-sky-50 text-sky-800">
                      0.30
                    </span>
                  </td>
                  <td class="px-4 py-2 text-right">2025-10-11 09:18:29</td>
                </tr>
                <tr class="hover:bg-slate-200 transition-colors">
                  <td class="px-4 py-2">2</td>
                  <td class="px-4 py-2">100</td>
                  <td class="px-4 py-2">
                    <span
                      class="inline-block rounded-md border border-sky-300/70 px-2 py-0.5 text-[11px] sm:text-xs bg-sky-50 text-sky-800">
                      0.30
                    </span>
                  </td>
                  <td class="px-4 py-2 text-right">2025-10-11 09:18:29</td>
                </tr>
                <tr class="hover:bg-slate-200 transition-colors">
                  <td class="px-4 py-2">3</td>
                  <td class="px-4 py-2">100</td>
                  <td class="px-4 py-2">
                    <span
                      class="inline-block rounded-md border border-sky-300/70 px-2 py-0.5 text-[11px] sm:text-xs bg-sky-50 text-sky-800">
                      0.30
                    </span>
                  </td>
                  <td class="px-4 py-2 text-right">2025-10-11 09:18:29</td>
                </tr>
                <tr class="hover:bg-slate-200 transition-colors">
                  <td class="px-4 py-2">4</td>
                  <td class="px-4 py-2">100</td>
                  <td class="px-4 py-2">
                    <span
                      class="inline-block rounded-md border border-sky-300/70 px-2 py-0.5 text-[11px] sm:text-xs bg-sky-50 text-sky-800">
                      0.30
                    </span>
                  </td>
                  <td class="px-4 py-2 text-right">2025-10-11 09:18:29</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- INFO GRID : SPONSOR / DIRECTS / INVESTMENTS etc --}}
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        {{-- Sponsor --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/sponsor.webp" class="w-9" alt="Sponsor">
          </div>
          <div>
            <p class="text-sm text-slate-500">Sponsor</p>
            <p class="text-xl font-bold text-sky-600">000000</p>
          </div>
        </div>

        {{-- Total Directs --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/total-directs.webp" class="w-9" alt="Total Directs">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Directs</p>
            <p class="text-xl font-bold text-sky-600">3</p>
          </div>
        </div>

        {{-- Total Active Direct --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/total-active-direct.webp" class="w-9" alt="Total Active Direct">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Active Direct</p>
            <p class="text-xl font-bold text-sky-600">2</p>
          </div>
        </div>

        {{-- Date of Activation --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/date-of-activation.webp" class="w-9" alt="Date of Activation">
          </div>
          <div>
            <p class="text-sm text-slate-500">Date of Activation</p>
            <p class="text-xl font-bold text-sky-600">03-02-2025</p>
          </div>
        </div>

        {{-- Self Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/self-investment.webp" class="w-9" alt="Self Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Self Investment</p>
            <p class="text-xl font-bold text-sky-600">$100</p>
          </div>
        </div>

        {{-- Direct Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/direct-investment.webp" class="w-9" alt="Direct Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Direct Investment</p>
            <p class="text-xl font-bold text-sky-600">$3,100.00</p>
          </div>
        </div>

        {{-- Total Team Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/total-team-investmnet.webp" class="w-9" alt="Total Team Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Team Investment</p>
            <p class="text-xl font-bold text-sky-600">$0.00</p>
          </div>
        </div>

        {{-- Total Withdraw --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-sky-50 border border-sky-200">
            <img src="/assets/images/icons/total-withdraw.webp" class="w-9" alt="Total Withdraw">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Withdraw</p>
            <p class="text-xl font-bold text-sky-600">$0</p>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection

@push('scripts')
  {{-- Swiper JS --}}
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    // Select the text quickly on click
    function selectReferralText() {
      const el = document.getElementById('referral-link');
      if (!el) return;
      const range = document.createRange();
      range.selectNodeContents(el);
      const sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
    }

    // Copy referral link
    function copyReferral() {
      const linkElement = document.getElementById('referral-link');
      if (!linkElement) {
        console.error("Referral link element not found!");
        return;
      }
      const link = linkElement.innerText.trim();
      navigator.clipboard.writeText(link).catch(() => {
        console.error("Failed to copy text!");
      });
    }

    // Share referral link
    function shareReferral() {
      const text = document.getElementById('referral-link')?.innerText?.trim() || '';
      if (navigator.share) {
        navigator.share({
          title: 'Join OpAi',
          text: 'Use my referral link to register on OpAi:',
          url: text
        }).catch(() => {});
      } else {
        copyReferral();
        if (typeof showToast === 'function') {
          showToast('success', 'Link copied! Share it anywhere.');
        }
      }
    }

    // RANKING SLIDER INIT
    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.rankingsliderbox', {
        slidesPerView: 'auto',
        spaceBetween: 16,
        loop: false,
        grabCursor: true,
        navigation: {
          nextEl: '.ranking-next',
          prevEl: '.ranking-prev'
        },
        breakpoints: {
          320: {
            spaceBetween: 10
          },
          640: {
            spaceBetween: 14
          },
          1024: {
            spaceBetween: 18
          }
        }
      });
    });
  </script>
@endpush
