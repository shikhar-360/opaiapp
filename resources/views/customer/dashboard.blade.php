@extends('app')

@push('styles')
  {{-- Swiper CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /* Page specific CSS yahan likh sakte ho (agar zarurat ho) */
  </style>
@endpush
@php
  // echo "<pre>"; var_dump($customer->myFinance); 
@endphp
@section('content')
  <section class="min-h-screen py-8 bg-slate-50/50 px-4">
    <div class="mx-auto ">

      {{-- TOP ROW : REFERRAL + PDF --}}
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-6">
        {{-- Referral Link Card --}}
        <div
          class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-[var(--theme-skkky-50)] backdrop-blur-xl shadow-lg hover:shadow-2xl transition-shadow">
          <div class="absolute inset-0 pointer-events-none opacity-60">
            <div class="absolute -top-20 -left-20 w-52 h-52 bg-[var(--theme-skky-400)]/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-[var(--theme-bllue-500)]/15 rounded-full blur-3xl"></div>
          </div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="relative">
              <div
                class="w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-white border border-[var(--theme-skky-200)] flex items-center justify-center shadow-md group-hover:border-[var(--theme-skky-400)] transition-colors">
                <!-- in opaiapphtml/assets/images/opai_7202.webp -->
                <img src="/assets/images/opai_7202.webp" width="64" height="48" alt="Logo"
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
                      https://user.ordinarypeopleai.com/register?sponsorcode={{ $customer->referral_code }}
                    </span>
                  </div>
                </div>

                {{-- actions --}}
                <div class="flex items-center gap-1 pr-1">
                  {{-- copy --}}
                  <button type="button"
                    onclick="copyReferral(); typeof showToast==='function' && showToast('success','Copied to clipboard!')"
                    class="rounded-full w-9 h-9 flex items-center justify-center bg-[var(--theme-skky-600)] text-white text-xs font-semibold hover:bg-sky-700 active:scale-95 transition-all border border-[var(--theme-skky-500)] shadow-md">
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
        {{-- VOTING  --}}

        <div class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-[var(--theme-skkky-50)] backdrop-blur-xl shadow-lg hover:shadow-2xl transition-shadow p-2">
          


                  <div class="absolute inset-0 pointer-events-none opacity-60">
                    <div class="absolute -top-20 -left-20 w-52 h-52 bg-indigo-400/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-blue-400/20 rounded-full blur-3xl"></div>
                  </div>


          <div class="relative grid grid-cols-3 gap-3 sm:gap-4 text-center">

           
            <div class="flex flex-col items-center">
              <div class="flex justify-center items-center">
                <img src="/assets/images/rank/active.webp" class="h-12 w-12 sm:h-14 sm:w-14 object-contain" />
              </div>
              <p class="mt-1 text-xs sm:text-sm font-medium text-slate-600">
                ACTIVE
              </p>
              <p class="text-sm sm:text-lg font-semibold text-slate-900">
                {{ $customer->myVoteSumamry['ACTIVE'] }}
              </p>
            </div>


            <div class="flex flex-col items-center">
              <div class="flex justify-center items-center">
                <img src="/assets/images/rank/helpfull.webp" class="h-12 w-12 sm:h-14 sm:w-14 object-contain" />
              </div>
              <p class="mt-1 text-xs sm:text-sm font-medium text-slate-600">
                HELPFUL
              </p>
              <p class="text-sm sm:text-lg font-semibold text-slate-900">
                {{ $customer->myVoteSumamry['HELPFULL'] }}
              </p>
            </div>


            <div class="flex flex-col items-center">
              <div class="flex justify-center items-center">
                <img src="/assets/images/rank/honest.webp" class="h-12 w-12 sm:h-14 sm:w-14 object-contain" />
              </div>
              <p class="mt-1 text-xs sm:text-sm font-medium text-slate-600">
                HONEST
              </p>
              <p class="text-sm sm:text-lg font-semibold text-slate-900">
                {{ $customer->myVoteSumamry['HONEST'] }}
              </p>
            </div>

          </div>


          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
        </div>

        {{-- Download PDF Card --}}
        <div
          class="relative group rounded-2xl overflow-hidden border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-[var(--theme-skkky-50)] backdrop-blur-xl shadow-lg hover:shadow-2xl transition-shadow">
          <div class="absolute inset-0 pointer-events-none opacity-60">
            <div class="absolute -top-20 -left-20 w-52 h-52 bg-indigo-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-blue-400/20 rounded-full blur-3xl"></div>
          </div>

          <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
            <div class="relative">
              <div
                class="w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-white border border-slate-200 flex items-center justify-center shadow-md group-hover:border-[var(--theme-skky-400)] transition-colors">
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
                  class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[var(--theme-skky-600)] text-white text-xs sm:text-sm font-semibold hover:bg-sky-700 active:scale-95 transition-all border border-[var(--theme-skky-500)] shadow-md">
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
      <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mt-6 justify-center items-center">
        <div class="grid grid-cols-1 gap-5  h-full">
          <div
            class="relative group rounded-2xl overflow-hidden border border-blue-300/60 bg-gradient-to-br from-white via-slate-50 to-[var(--theme-skkky-50)] backdrop-blur-xl shadow-lg ">

            
            <div class="absolute inset-0 pointer-events-none opacity-70">
              <div class="absolute -top-24 -left-24 w-52 h-52 bg-[var(--theme-skky-400)]/15 rounded-full blur-3xl"></div>
              <div class="absolute -bottom-28 -right-24 w-60 h-60 bg-indigo-500/15 rounded-full blur-3xl"></div>
            </div>
            <div class="relative z-10 px-4 md:px-6 pt-5 pb-6 sm:pb-7">
              <div class="flex flex-col items-start justify-start  gap-2">
                <h3
                  class="font-semibold text-lg md:text-xl text-[var(--theme-primary-text)] truncate">
                Badge Rank
                </h3>
                <span
                  class="inline-flex items-center gap-1 rounded-full bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)] px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)]">
                  Current Rank: <span class="font-semibold">{{ $customer->leadership_rank ? 'Star '.$customer->leadership_rank : '-' }} </span>
                </span>
              </div>
              <!-- stars row -->
              <div class="grid grid-cols-5 gap-0 w-full pt-4 sm:pt-5">
                <!-- Star 5 (inactive) -->
                @php
                    $diamond = $customer->leadership_rank == 5 ? '' : 'opacity-30';
                    $ruby = $customer->leadership_rank == 4 ? '' : 'opacity-30';
                    $emerald = $customer->leadership_rank == 3 ? '' : 'opacity-30';
                    $sapphire = $customer->leadership_rank == 2 ? '' : 'opacity-30';
                    $gold = $customer->leadership_rank == 1 ? '' : 'opacity-30';

                    $target_leaderrank = min((($customer->leadership_rank ?? 0) + 1), 5);
                    $plan = $customer->leadership_plans->firstWhere('id', $target_leaderrank);

                @endphp
                <div
                  class="gridbox {{ $diamond }} grayscale pointer-events-none relative bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-200)] text-slate-900 text-center py-3 px-1 border-t border-l border-slate-200 shadow-sm col-start-5 col-end-5"
                  data-rank="STAR" style="height:calc(100% + 1px)">
                  <img src="/assets/images/rank/diamond-rank.webp" width="60" height="60"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-16 md:-translate-y-20 w-auto h-14 md:h-20 object-contain object-bottom p-1.5"
                    alt="STAR">
                  <h3 class="text-xs sm:text-lg leading-none ">Diamond</h3>
                </div>
                <!-- Star 4 (inactive) -->
                <div
                  class="gridbox {{ $ruby }} grayscale pointer-events-none relative bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-200)] text-slate-900 text-center py-3 px-1 border-t border-l border-slate-200 shadow-sm col-start-4 col-end-4"
                  data-rank="STAR" style="height:calc(100% + 1px)">
                  <img src="/assets/images/rank/ruby-rank.webp" width="60" height="60"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-16 md:-translate-y-20 w-auto h-14 md:h-20 object-contain object-bottom p-1.5"
                    alt="STAR">
                  <h3 class="text-xs sm:text-lg leading-none ">Ruby</h3>
                </div>

                <!-- Star 3 (active) -->
                <div
                  class="gridbox {{ $emerald }} relative bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-200)] text-slate-900 text-center py-3 px-1 border-t border-l border-emerald-300 shadow-md col-start-3 col-end-3"
                  data-rank="STAR" style="height:calc(100% + 1px)">
                  <img src="/assets/images/rank/emerald-rank.webp" width="60" height="60"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-16 md:-translate-y-20 w-auto h-14 md:h-20 object-contain object-bottom p-1.5"
                    alt="STAR">
                  <h3 class="text-xs sm:text-lg leading-none ">Emerald</h3>
                </div>

                <!-- Star 2 (active) -->
                <div
                  class="gridbox {{ $sapphire }} relative bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-200)] text-slate-900 text-center py-3 px-1 border-t border-l border-emerald-200 shadow-md col-start-2 col-end-2"
                  data-rank="STAR" style="height:calc(100% + 1px)">
                  <img src="/assets/images/rank/sapphire-rank.webp" width="60" height="60"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-16 md:-translate-y-20 w-auto h-14 md:h-20 object-contain object-bottom p-1.5"
                    alt="STAR">
                  <h3 class="text-xs sm:text-lg leading-none ">Sapphire</h3>
                </div>

                <!-- Star 1 (active) -->
                <div
                  class="gridbox {{ $gold }} relative bg-gradient-to-r from-[var(--theme-skky-400)] to-[var(--theme-cyyan-200)] text-slate-900 text-center py-3 px-1 border-t border-l border-emerald-200 shadow-md col-start-1 col-end-1"
                  data-rank="STAR" style="height:calc(100% + 1px)">
                  <img src="/assets/images/rank/gold-rank.webp" width="60" height="60"
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-16 md:-translate-y-20 w-auto h-14 md:h-20 object-contain object-bottom p-1.5"
                    alt="STAR">
                  <h3 class="text-xs sm:text-lg leading-none ">Gold</h3>
                </div>
              </div>

     
    <div
        class="mt-7 border border-indigo-200/70 bg-gradient-to-r from-indigo-50 via-[var(--theme-skkky-50)] to-fuchsia-50 backdrop-blur-sm px-4 py-4 rounded-xl shadow-sm">

        <!-- Volume -->
        <div class="mb-4">
          <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
            <span>Volume</span>
            <span>{{ $customer->totalTeamInvestment??0 }} / {{ number_format($plan->team_volume, 0) }}</span>
          </div>
          @php
          $volume_reached = ( $customer->totalTeamInvestment / $plan->team_volume ) * 100 ;
          @endphp
          <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full"
              style="width: {{$volume_reached}}%;"></div>
          </div>
        </div>

        <!-- Points -->
        <div>
          <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
            <span>Points</span>
            <span>{{ $customer->leadership_points??0 }} / {{ number_format($plan->points, 0) }}</span>
          </div>
          @php
          $points_reached = ( $customer->leadership_points / $plan->points ) * 100 ;
          @endphp
          <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-emerald-500 to-green-500 rounded-full"
              style="width: {{$points_reached}}%;"></div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>      
    <div class="h-full">
       <x-level-grid :currentLevel="$customer->leadership_champions_rank" :totalLevels="5" />
    </div>
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
            @for ($i = 1; $i <= 20; $i++)
              @php
                $achieved_color = "text-slate-900";
                /* if($i == $customer->myLevel)*/
                if($i == $customer->level_id)
                {
                  $achieved_color = "text-white";
                }
              @endphp
              <div class="swiper-slide !w-[140px] sm:!w-[160px] md:!w-[200px]">
                <div
                  class=" level-card  p-4 rounded-xl mx-auto border border-blue-300/60 bg-gradient-to-t from-[var(--theme-skkky-50)] via-white to-[var(--theme-[var(--theme-skky-100)])] text-center text-slate-900 relative flex flex-col gap-1 items-center justify-center shadow-[0_10px_30px_rgba(59,130,246,.25)]">
                  <strong class="block uppercase text-[11px] tracking-[0.18em] text-slate-500">
                    Level
                  </strong>
                  <strong
                    class="w-10 h-10 border border-[var(--theme-skky-300)]/80 bg-gradient-to-t from-[var(--theme-skky-500)] to-[var(--theme-skky-400)] rounded-full flex items-center justify-center {{$achieved_color}} font-bold text-sm shadow-[0_8px_22px_rgba(56,189,248,.7)]">
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
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-[var(--theme-skky-400)]/20 shadow-[0_0_25px_rgba(56,189,248,0.35)]">
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
                {{ $customer->myReferralLevel }}
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100"></div>
        </div>

        {{-- Team --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(16,185,129,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/15 via-transparent to-[var(--theme-skky-400)]/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
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
                {{ $customer->totalTeamCount }} 
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-emerald-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Capping --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(245,158,11,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-amber-400/15 via-transparent to-[var(--theme-skky-400)]/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
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
              <p class="text-lg sm:text-2xl font-semibold text-slate-900 leading-none">5X
                <!-- {{ $customer->myFinance['capping_limit'] }} -->
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-amber-400/100 to-transparent opacity-60"></div>
        </div>

        {{-- Level Income --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(56,189,248,0.25)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-purple-400/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-[var(--theme-skky-400)]/20 shadow-[0_0_25px_rgba(56,189,248,0.35)]">
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
                {{ number_format($customer->myLevelEarning, 2, '.', '') }} {{ $customer->appData->currency }}
              </p>
            </div>
          </div>

          <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)]/100 to-transparent opacity-60"></div>
        </div>

        {{-- Total Income --}}
        <div
          class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 backdrop-blur-xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_45px_rgba(15,23,42,0.2)]">
          <div
            class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/15 via-transparent to-[var(--theme-skky-400)]/20 opacity-0 blur-xl transition-opacity duration-300 group-hover:opacity-100">
          </div>

          <div class="relative flex items-center gap-3 sm:gap-4">
            <div
              class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-xl bg-slate-50 ring-1 ring-slate-200 shadow-[0_0_18px_rgba(148,163,184,0.55)]">
              <img src="/assets/images/icons/income.webp" alt="Total Income"
                class="h-7 w-7 sm:h-8 sm:w-8 object-contain">
            </div>

            <div class="flex-1 min-w-0">
              <p class="text-sm sm:text-base font-semibold text-slate-900 truncate">
                  Total Points
              </p>
            </div>

            <div class="text-right">
              <p class="text-[11px] text-[var(--theme-primary-text)] mb-0.5">
                Overall
              </p>
              <p class="text-xl sm:text-3xl font-bold text-slate-900 leading-none">
                {{ $customer->totalPoints }}
                <!-- {{ $customer->myTotalEarning }} -->
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
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-300)]/30 rounded-full blur-3xl"></div>
          </div>

          <div class="relative overflow-x-auto">
            <table class="w-full text-left border-collapse pb-4 text-sm text-slate-900">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-[var(--theme-primary-text)] text-xs sm:text-sm">
                    Sr No.
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-[var(--theme-primary-text)] text-xs sm:text-sm">
                    Package
                  </th>
                  <th class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-[var(--theme-primary-text)] text-xs sm:text-sm">
                    Amount ({{ $customer->appData->currency }})
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-[var(--theme-primary-text)] text-xs sm:text-sm text-right">
                    Date
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200 text-xs sm:text-sm">
                @php
                  $sr=1;
                @endphp
                @foreach($customer->myPackageDetails as $myPkgs)
                <tr class="hover:bg-slate-200 transition-colors">
                  <td class="px-4 py-2">{{ $sr++ }}</td>
                  <td class="px-4 py-2">
                    <span
                      class="inline-block rounded-md border border-[var(--theme-skky-300)]/70 px-2 py-0.5 text-[11px] sm:text-xs bg-[var(--theme-skkky-50)] text-sky-800">
                      {{ $myPkgs->package_id }}
                    </span>
                  </td>
                  <td class="px-4 py-2">{{ number_format($myPkgs->amount, 2, '.', '') }} </td>
                  <td class="px-4 py-2 text-right">{{ $myPkgs->created_at->format('d-m-Y') }}</td>
                </tr>
                @endforeach
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
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/sponsor.webp" class="w-9" alt="Sponsor">
          </div>
          <div>
            <p class="text-sm text-slate-500">Sponsor</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">#{{ $customer->mySponsor }}</p>
          </div>
        </div>

        {{-- Total Directs --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/total-directs.webp" class="w-9" alt="Total Directs">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Directs</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ $customer->totalDirectsCount }}</p>
          </div>
        </div>

        {{-- Total Active Direct --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/total-active-direct.webp" class="w-9" alt="Total Active Direct">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Active Direct</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ $customer->totalActiveDirectsCount }}</p>
          </div>
        </div>

        {{-- Date of Activation --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/date-of-activation.webp" class="w-9" alt="Date of Activation">
          </div>
          <div>
            <p class="text-sm text-slate-500">Date of Activation</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">
              {{ optional($customer->myFirstDepositAt)->format('d-m-Y') ?? '-' }}
            </p>
          </div>
        </div>

        {{-- Self Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/self-investment.webp" class="w-9" alt="Self Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Self Investment</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ number_format($customer->myInvestment, 2, '.', '') }} {{ $customer->appData->currency }} </p>
          </div>
        </div>

        {{-- Direct Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/direct-investment.webp" class="w-9" alt="Direct Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Direct Investment</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ number_format($customer->totalDirectInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>

        {{-- Total Team Investment --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/total-team-investmnet.webp" class="w-9" alt="Total Team Investment">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Team Investment</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ number_format($customer->totalTeamInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>

        {{-- Total Withdraw --}}
        <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
          <div
            class="w-12 h-12 flex items-center justify-center rounded-lg bg-[var(--theme-skkky-50)] border border-[var(--theme-skky-200)]">
            <img src="/assets/images/icons/total-withdraw.webp" class="w-9" alt="Total Withdraw">
          </div>
          <div>
            <p class="text-sm text-slate-500">Total Withdraw</p>
            <p class="text-xl font-bold text-[var(--theme-high-text)]">{{ number_format($customer->myTotalWithdraws, 2, '.', '') }} {{ $customer->appData->currency }}</p>
          </div>
        </div>
      </div>

      {{-- Leaderboard --}}
  <h2 class="text-lg font-semibold mb-3 text-slate-900 mt-10">Leaderboard</h2>

<div
  class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] relative overflow-hidden text-left">

  <!-- soft glow background -->
  <div class="absolute inset-0 opacity-70 pointer-events-none">
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
  </div>

  <div class="relative mb-6">
    {{-- TABS --}}
    <div
      class="incomeOverview_tab flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner">
      <ul class="flex gap-2" data-tabs-toggle="#default-tab-content" role="tablist">
        {{-- DAILY TAB --}}
        <li role="presentation">
          <button id="tab-daily" data-tabs-target="#panel-daily" type="button" role="tab"
            aria-controls="panel-daily" aria-selected="true"
            class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                   transition flex items-center gap-2">
            <span class="relative z-[1]">Daily</span>
            <span
              class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
              5
            </span>
          </button>
        </li>

        {{-- WEEKLY TAB --}}
        <li role="presentation">
          <button id="tab-weekly" data-tabs-target="#panel-weekly" type="button" role="tab"
            aria-controls="panel-weekly" aria-selected="false"
            class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                   transition flex items-center gap-2">
            <span class="relative z-[1]">Weekly</span>
            <span
              class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-emerald-700 border border-emerald-200">
              3
            </span>
          </button>
        </li>

        {{-- MONTHLY TAB --}}
        <li role="presentation">
          <button id="tab-monthly" data-tabs-target="#panel-monthly" type="button" role="tab"
            aria-controls="panel-monthly" aria-selected="false"
            class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                   transition flex items-center gap-2">
            <span class="relative z-[1]">Monthly</span>
            <span
              class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-fuchsia-700 border border-fuchsia-200">
              3
            </span>
          </button>
        </li>
      </ul>

      {{-- Small hint text --}}
      <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
        <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
        <span>Click tabs to switch between Daily / Weekly / Monthly</span>
      </div>
    </div>
  </div>

  <div id="default-tab-content" class="relative">
    {{-- ================= DAILY (TABLE 1) ================= --}}
    <div id="panel-daily" role="tabpanel" aria-labelledby="tab-daily">
      <div class="overflow-x-auto">
        <div id="tabledata1_wrapper" class="dataTables_wrapper no-footer">

          {{-- TOP BAR: SHOW + SEARCH --}}
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3 relative z-10">
            <div class="dataTables_length" id="tabledata1_length">
              <label class="text-xs text-slate-600 flex items-center gap-2">
                <span>Show</span>
                <select name="tabledata1_length" aria-controls="tabledata1"
                  class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-[var(--theme-skky-400)]/80 focus:border-[var(--theme-skky-400)]/80">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
                <span>entries</span>
              </label>
            </div>

            <div id="tabledata1_filter" class="dataTables_filter w-full sm:w-auto">
              <label class="text-xs text-slate-600 w-full">
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
                    class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-[var(--theme-skky-400)]/80 focus:border-[var(--theme-skky-400)]/80"
                    placeholder="Search user / wallet / rank" aria-controls="tabledata1">
                </div>
              </label>
            </div>
          </div>

          <table id="tabledata1"
            class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
            style="padding-top: 15px;" aria-describedby="tabledata1_info">
            <thead>
              <tr class="bg-slate-100 text-slate-900">
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Sr.
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  User Id
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Rank
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px] !text-right">
                 VIP Level
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              {{-- DUMMY DATA: DAILY --}}
              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">1</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1001</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  {{-- DIAMOND --}}
                  <span
                    class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-2 py-0.5 text-[11px] text-[var(--theme-primary-text)] border border-[var(--theme-skky-300)]">
                    DIAMOND
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">1</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">2</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1002</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  {{-- EMERALD --}}
                  <span
                    class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] text-emerald-700 border border-emerald-300">
                    EMERALD
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">1</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">3</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1003</td>
                <td class="px-4 sm:px-5 py-3">
                  {{-- GOLD --}}
                  <span
                    class="inline-flex items-center rounded-full bg-amber-50 px-2 py-0.5 text-[11px] text-amber-700 border border-amber-300">
                    GOLD
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">2</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">4</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1004</td>
                <td class="px-4 sm:px-5 py-3">
                  {{-- RUBY --}}
                  <span
                    class="inline-flex items-center rounded-full bg-rose-50 px-2 py-0.5 text-[11px] text-rose-700 border border-rose-300">
                    RUBY
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">1</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">5</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1005</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  {{-- SAPPHIRE --}}
                  <span
                    class="inline-flex items-center rounded-full bg-indigo-50 px-2 py-0.5 text-[11px] text-indigo-700 border border-indigo-300">
                    SAPPHIRE
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">3</td>
              </tr>
            </tbody>
          </table>

          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
            <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata1_info" role="status"
              aria-live="polite">
              Showing 1 to 5 of 5 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata1_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata1" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata1_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata1" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata1_next">Next</a>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- ================= WEEKLY (TABLE 2) ================= --}}
    <div class="hidden" id="panel-weekly" role="tabpanel" aria-labelledby="tab-weekly">
      <div class="overflow-x-auto">
        <div id="tabledata2_wrapper" class="dataTables_wrapper no-footer">

          {{-- TOP BAR: SHOW + SEARCH --}}
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
            <div class="dataTables_length" id="tabledata2_length">
              <label class="text-xs text-slate-600 flex items-center gap-2">
                <span>Show</span>
                <select name="tabledata2_length" aria-controls="tabledata2"
                  class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
                <span>entries</span>
              </label>
            </div>

            <div id="tabledata2_filter" class="dataTables_filter w-full sm:w-auto">
              <label class="text-xs text-slate-600 w-full">
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
                    class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80"
                    placeholder="Search weekly directs" aria-controls="tabledata2">
                </div>
              </label>
            </div>
          </div>

          <table id="tabledata2"
            class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
            style="padding-top: 15px;" aria-describedby="tabledata2_info">
            <thead>
              <tr class="bg-slate-100 text-slate-900">
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Sr.
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  User Id
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Rank
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px] !text-right">
                  VIP Level
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              {{-- DUMMY DATA: WEEKLY --}}
              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">1</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1001</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  <span
                    class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] text-emerald-700 border border-emerald-300">
                    EMERALD
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right">1</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">2</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1003</td>
                <td class="px-4 sm:px-5 py-3">
                  <span
                    class="inline-flex items-center rounded-full bg-amber-50 px-2 py-0.5 text-[11px] text-amber-700 border border-amber-300">
                    GOLD
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">2</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">3</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER1005</td>
                <td class="px-4 sm:px-5 py-3">
                  <span
                    class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-2 py-0.5 text-[11px] text-[var(--theme-primary-text)] border border-[var(--theme-skky-300)]">
                    DIAMOND
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">3</td>
              </tr>
            </tbody>
          </table>

          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
            <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata2_info" role="status"
              aria-live="polite">
              Showing 1 to 3 of 3 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata2_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata2" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata2_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata2" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata2_next">Next</a>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- ================= MONTHLY (TABLE 3) ================= --}}
    <div class="hidden" id="panel-monthly" role="tabpanel" aria-labelledby="tab-monthly">
      <div class="overflow-x-auto">
        <div id="tabledata3_wrapper" class="dataTables_wrapper no-footer">

          {{-- TOP BAR: SHOW + SEARCH --}}
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
            <div class="dataTables_length" id="tabledata3_length">
              <label class="text-xs text-slate-600 flex items-center gap-2">
                <span>Show</span>
                <select name="tabledata3_length" aria-controls="tabledata3"
                  class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-fuchsia-400/80 focus:border-fuchsia-400/80">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
                <span>entries</span>
              </label>
            </div>

            <div id="tabledata3_filter" class="dataTables_filter w-full sm:w-auto">
              <label class="text-xs text-slate-600 w-full">
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
                    class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-fuchsia-400/80 focus:border-fuchsia-400/80"
                    placeholder="Search monthly directs" aria-controls="tabledata3">
                </div>
              </label>
            </div>
          </div>

          <table id="tabledata3"
            class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
            style="padding-top: 15px;" aria-describedby="tabledata3_info">
            <thead>
              <tr class="bg-slate-100 text-slate-900">
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Sr.
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  User Id
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px]">
                  Rank
                </th>
                <th
                  class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-xs sm:text-[13px] !text-right">
                 VIP Level
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              {{-- DUMMY DATA: MONTHLY --}}
              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">1</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER2001</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  <span
                    class="inline-flex items-center rounded-full bg-amber-50 px-2 py-0.5 text-[11px] text-amber-700 border border-amber-300">
                    GOLD
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">4</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">2</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER2002</td>
                <td class="px-4 sm:px-5 py-3 text-black">
                  <span
                    class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-2 py-0.5 text-[11px] text-[var(--theme-primary-text)] border border-[var(--theme-skky-300)]">
                    DIAMOND
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">5</td>
              </tr>

              <tr class="hover:bg-slate-200 transition">
                <td class="px-4 sm:px-5 py-3 text-black">3</td>
                <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">USER2003</td>
                <td class="px-4 sm:px-5 py-3">
                  <span
                    class="inline-flex items-center rounded-full bg-indigo-50 px-2 py-0.5 text-[11px] text-indigo-700 border border-indigo-300">
                    SAPPHIRE
                  </span>
                </td>
                <td class="px-4 sm:px-5 py-3 text-right text-black">2</td>
              </tr>
            </tbody>
          </table>

          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
            <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata3_info" role="status"
              aria-live="polite">
              Showing 1 to 3 of 3 entries
            </div>
            <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
              id="tabledata3_paginate">
              <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata3" aria-role="link" data-dt-idx="previous" tabindex="0"
                id="tabledata3_previous">Previous</a>
              <span class="text-xs text-slate-700">1</span>
              <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                aria-controls="tabledata3" aria-role="link" data-dt-idx="next" tabindex="0"
                id="tabledata3_next">Next</a>
            </div>
          </div>

        </div>
      </div>
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
      const ACTIVE = [
    'bg-gradient-to-b',
    'from-[var(--theme-skky-500)]',
    'to-[var(--theme-bllue-200)]'
  ];

  const INACTIVE = [
    'bg-gradient-to-t',
    'from-[var(--theme-skkky-50)]',
    'via-white',
    'to-[var(--theme-[var(--theme-skky-100)])]'
  ];

  function updateActive(sw) {
    sw.slides.forEach(slide => {
      const card = slide.querySelector('.level-card');
      if (!card) return;
      card.classList.remove(...ACTIVE);
      card.classList.add(...INACTIVE);
    });

    const activeSlide = sw.slides[sw.activeIndex];
    const activeCard = activeSlide?.querySelector('.level-card');
    if (activeCard) {
      activeCard.classList.remove(...INACTIVE);
      activeCard.classList.add(...ACTIVE);
    }
  }

  const swiper = new Swiper('.rankingsliderbox', {
    slidesPerView: 'auto',
    spaceBetween: 16,
    loop: false,
    grabCursor: true,
    navigation: {
      nextEl: '.ranking-next',
      prevEl: '.ranking-prev'
    },
    breakpoints: {
      320: { spaceBetween: 10 },
      640: { spaceBetween: 14 },
      1024: { spaceBetween: 18 }
    },
    on: {
      init() { updateActive(this); },
      slideChange() { updateActive(this); }
    }
  });

});
  </script>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const tabList = document.querySelector('[data-tabs-toggle="#default-tab-content"]');
    if (!tabList) return;

    const tabButtons = tabList.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('#default-tab-content [role="tabpanel"]');

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

        b.classList.remove(...activeClasses, ...inactiveClasses);

        b.classList.add(
          'group', 'relative', 'px-4', 'py-1.5',
          'rounded-full', 'text-xs', 'sm:text-sm',
          'font-semibold', 'transition', 'flex', 'items-center', 'gap-2'
        );

        if (isActive) {
          b.classList.add(...activeClasses);
        } else {
          b.classList.add(...inactiveClasses);
        }
      });
    }

    // initial
    tabButtons.forEach((btn) => {
      if (btn.getAttribute('aria-selected') === 'true') {
        setActiveTab(btn);
      }
    });

    // click
    tabButtons.forEach((btn) => {
      btn.addEventListener('click', () => setActiveTab(btn));
    });
  });
</script>
@endpush
