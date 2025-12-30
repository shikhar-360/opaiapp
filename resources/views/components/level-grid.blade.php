@props([
  'currentLevel' => 0,
  'totalLevels' => 5,
  'vipTargetVolume'=>1000,
  'vipTargetDirects' => 10,
  'current_vipvolume' => 0,
  'current_vipdirects' => 0,
   'secondaryProgress' => 0.72 // 0 → 1 (example: 72%)
])

@php
  // ---------- Main VIP Progress ----------
  // $cl = max(0, min($currentLevel, $totalLevels));
  // $pad = str_pad($cl, 2, '0', STR_PAD_LEFT);

  // $r1 = 90;
  // $c1 = 2 * M_PI * $r1;
  // $progress1 = $cl / $totalLevels;
  // $dashOffset1 = $c1 * (1 - $progress1);

  $cl = max(0, min($currentLevel, $totalLevels));
  

  $cll = max(0, min($current_vipvolume, $vipTargetVolume));
  $pad = str_pad($cll, 2, '0', STR_PAD_LEFT);

  $r1 = 90;
  $c1 = 2 * M_PI * $r1;
  $progress1 = $cll / $vipTargetVolume;
  $dashOffset1 = $c1 * (1 - $progress1);

  // ---------- Secondary Progress ----------
  // $r2 = 68;
  // $c2 = 2 * M_PI * $r2;
  // $progress2 = max(0, min($secondaryProgress, 1));
  // $dashOffset2 = $c2 * (1 - $progress2);

  
  $clll = max(0, min($current_vipdirects, $vipTargetDirects));

  $r2 = 68;
  $c2 = 2 * M_PI * $r2;
  $progress2 = $clll / $vipTargetDirects;
  $dashOffset2 = $c2 * (1 - $progress2);

  $levels = range(1, $totalLevels);
@endphp

<div class="w-full p-px overflow-hidden">
  <div
    class="relative grid grid-cols-1 gap-4 w-full rounded-2xl
           border border-blue-300/60 bg-white
           shadow-[0_15px_40px_rgba(15,23,42,.08)]
            px-3 lg:px-4 xl:px-8 py-5 items-center overflow-hidden">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
        <h3 class="font-semibold text-md md:text-lg text-slate-900">
            VIP Rank Overview
        </h3>
          <p class="text-sm text-slate-500 mt-1">
          You’re on VIP <span class="font-semibold text-slate-800">{{ $currentLevel }}</span>
            of {{ str_pad($totalLevels, 2, '0', STR_PAD_LEFT) }}
          </p>
        </div>

        <div class="hidden sm:flex items-center gap-1 text-[11px] text-slate-500">
        <span class="inline-flex h-2 w-2 rounded-full bg-sky-400"></span>
        <span>Active VIP</span>
        </div>
      </div>

    {{-- ================= Circular Progress ================= --}}
    <div class="mx-auto grid place-items-center relative z-10">
      <div class="relative aspect-square w-56 sm:w-64">
        <svg class="absolute inset-0 h-full w-full" viewBox="0 0 220 220" fill="none">

          <defs>
            {{-- Outer VIP gradient --}}
            <linearGradient id="vipGrad" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#0f172a"/>
              <stop offset="50%" stop-color="#60a5fa"/>
              <stop offset="100%" stop-color="#1d4ed8"/>
            </linearGradient>

            {{-- Inner XP gradient --}}
            <linearGradient id="xpGrad" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#10b981"/>
              <stop offset="50%" stop-color="#34d399"/>
              <stop offset="100%" stop-color="#06b6d4"/>
            </linearGradient>
          </defs>

          {{-- Outer base --}}
          <circle cx="110" cy="110" r="{{ $r1 }}"
                  stroke="#e2e8f0" stroke-width="15"/>

          {{-- Outer progress --}}
          <circle cx="110" cy="110" r="{{ $r1 }}"
                  stroke="url(#vipGrad)"
                  stroke-width="15"
            stroke-linecap="round"
                  stroke-dasharray="{{ $c1 }}"
                  stroke-dashoffset="{{ $dashOffset1 }}"
                  transform="rotate(-90 110 110)"/>

          {{-- Inner base --}}
          <circle cx="110" cy="110" r="{{ $r2 }}"
                  stroke="#e2e8f0" stroke-width="12"/>

          {{-- Inner progress --}}
          <circle cx="110" cy="110" r="{{ $r2 }}"
                  stroke="url(#xpGrad)"
                  stroke-width="12"
                  stroke-linecap="round"
                  stroke-dasharray="{{ $c2 }}"
                  stroke-dashoffset="{{ $dashOffset2 }}"
                  transform="rotate(-90 110 110)"/>
        </svg>

        {{-- Center Content --}}
        <div class="absolute inset-0 grid place-items-center text-center">
          <div>
            <div class="text-xs tracking-[0.3em] text-slate-400">VIP</div>
            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900">
              {{ $cl }}
            </div>
            <div class="mt-1 text-[11px] uppercase tracking-[0.18em] text-slate-500">
              Level {{ round($progress1 * 100) }}%
            </div>
            <div class="mt-1 text-[11px] text-emerald-600 font-semibold">
              XP {{ round($progress2 * 100) }}%
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Levels grid --}}
<div class="relative z-10">
  <div
    class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3 p-2 sm:p-3
           rounded-2xl bg-[var(--theme-[var(--theme-skky-100)])]/70">
    
        @foreach ($levels as $n)
          @php
            $isActive = $n <= $cl;
          @endphp

          <div
        class="rounded-lg text-center py-2 sm:py-3 text-xs sm:text-[13px] transition flex items-center justify-center
                   {{ $isActive 
          ? 'bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-cyyan-400)] text-white font-semibold border border-[var(--theme-skky-400)]/80'
          : 'bg-white text-slate-600 border border-slate-200 hover:border-[var(--theme-skky-300)] hover:bg-[var(--theme-skkky-50)]/60'
        }}">
            VIP {{ str_pad($n, 2, '0', STR_PAD_LEFT) }}
          </div>
        @endforeach

    <div class="rounded-lg text-center  text-xs sm:text-[13px] transition col-span-2 sm:col-span-1 ">
          <div class=" border border-indigo-200/70 bg-gradient-to-r from-indigo-50 via-[var(--theme-skkky-50)] to-fuchsia-50 backdrop-blur-sm px-4 py-0.5 rounded-lg shadow-sm">
            <!-- Volume -->
            <div class="mb-1">
              <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                <span>Volume</span>
                <span>{{ (int) $current_vipvolume }} / {{ (int) $vipTargetVolume}}</span>
            </div>
            <!-- Points -->
            <div>
              <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                <span>Directs</span>
                <span>{{ (int) $current_vipdirects }} / {{ (int) $vipTargetDirects }}</span>
            </div>
          </div>
        </div>
          </div>
</div>

  </div>
</div>
