@props([
  'currentLevel' => 0,
  'totalLevels' => 5
])

@php

  $cl = max(0, min($currentLevel, $totalLevels));
  $pad = str_pad($cl, 2, '0', STR_PAD_LEFT);

  $r = 90;
  $c = 2 * M_PI * $r;
  $progress = $cl / $totalLevels;
  $dashOffset = $c * (1 - $progress);

  $levels = range(1, $totalLevels);
@endphp

<div class="w-full p-px overflow-hidden">
  <div
    class="relative grid grid-cols-1  gap-2 w-full rounded-2xl 
           border border-blue-300/60 bg-white backdrop-blur-2xl 
           shadow-[0_15px_40px_rgba(15,23,42,.08)] px-4 xl:px-8 py-5 items-center overflow-hidden">

    {{-- soft glow background --}}
    <!-- <div class="pointer-events-none absolute inset-0 opacity-70">
      <div class="absolute -top-24 -left-24 w-56 h-56 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-24 -right-24 w-56 h-56 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div> -->
      <div class="mb-3 flex items-center justify-between gap-2">
        <div>
          <h3
          class="font-semibold text-lg md:text-xl text-[var(--theme-primary-text)] truncate">
            VIP Rank Overview
        </h3>
          <p class="text-sm text-slate-500 mt-1">
            You’re on VIP <span class="font-semibold text-slate-800 ">{{ $pad }}</span>
            of {{ str_pad($totalLevels, 2, '0', STR_PAD_LEFT) }}
          </p>
        </div>
        <div class="hidden sm:flex items-center gap-1 text-[11px] text-slate-500">
          <span class="inline-flex h-2 w-2 rounded-full bg-[var(--theme-skky-400)]"></span>
          <span>Active VIP Rank</span>
        </div>
      </div>

    {{-- Circular Gradient Progress --}}
    <div class=" mx-auto grid place-items-center relative z-10">
      <div class="relative aspect-square w-56 sm:w-64 ">
        <svg class="absolute inset-0 h-full w-full" viewBox="0 0 220 220" fill="none">
          <defs>
            {{-- bright sky / cyan gradient --}}
            <linearGradient id="gradArc" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" stop-color="#38bdf8" />
              <stop offset="50%" stop-color="#22c55e" />
              <stop offset="100%" stop-color="#0ea5e9" />
            </linearGradient>
          </defs>

          {{-- light base ring --}}
          <circle
            cx="110" cy="110" r="{{ $r }}"
            stroke="#e2e8f0"
            stroke-width="20" />

          {{-- gradient arc --}}
          <circle
            cx="110" cy="110" r="{{ $r }}"
            stroke="url(#gradArc)"
            stroke-width="20"
            stroke-linecap="round"
            stroke-dasharray="{{ $c }}"
            stroke-dashoffset="{{ $dashOffset }}"
            transform="rotate(-90 110 110)" />
        </svg>

        {{-- inner subtle glow --}}
        <div class="absolute inset-6 rounded-full bg-gradient-to-b from-white/70 via-white/40 to-[var(--theme-skkky-50)]/30"></div>

        {{-- center text --}}
        <div class="absolute inset-0 grid place-items-center">
          <div class="text-center">
            <div class="text-xs sm:text-sm tracking-[0.3em] text-slate-400">
              VIP
            </div>
            <div class="text-4xl sm:text-5xl font-extrabold text-slate-900">
              {{ $pad }}
            </div>
            <div class="mt-1 text-[11px] uppercase tracking-[0.18em] text-slate-500">
              Progress {{ round($progress * 100) }}%
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Levels grid --}}
    <div class=" relative z-10">
    

      <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3 p-2 sm:p-3 rounded-2xl bg-[var(--theme-[var(--theme-skky-100)])]/70">
        @foreach ($levels as $n)
          @php
            $isActive = $n <= $cl;
          @endphp
          <div
            class="rounded-lg text-center py-2 sm:py-3 text-xs sm:text-[13px] transition 
                   {{ $isActive 
                      ? 'bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-cyyan-400)] text-white font-semibold shadow-[0_10px_25px_rgba(56,189,248,.35)] border border-[var(--theme-skky-400)]/80' 
                      : 'bg-white text-slate-600 border border-slate-200 hover:border-[var(--theme-skky-300)] hover:bg-[var(--theme-skkky-50)]/60' }}">
            VIP {{ str_pad($n, 2, '0', STR_PAD_LEFT) }}
          </div>
        @endforeach
      </div>
    </div>

    {{-- decorative pills (light theme) --}}
    <span
      class="absolute -bottom-4 -left-4 w-10 h-10 rounded-full border border-slate-200 bg-white shadow-[0_8px_20px_rgba(15,23,42,.08)] z-10">
    </span>
    <span
      class="absolute -top-4 -right-4 w-10 h-10 rounded-full border border-slate-200 bg-white shadow-[0_8px_20px_rgba(15,23,42,.08)] z-10">
    </span>

    {{-- top right accent svg --}}
    <!-- <div class="absolute w-14 h-14 -top-[1px] left-14 pointer-events-none z-[1] opacity-80">
      <svg xmlns="http://www.w3.org/2000/svg" width="70" height="38" viewBox="0 0 40 27" fill="none">
        <path
          d="M40 -0.5V0.5C31.7964 0.5 24.2101 10.5927 28.8057 23.8359L29.4043 25.5635L28.0098 24.3818L-0.323242 0.381836L-1.36426 -0.5H40Z"
          fill="white" stroke="#e2e8f0" />
      </svg>
    </div> -->

    {{-- bottom left accent svg (mirrored) --}}
    <!-- <div class="absolute w-14 h-14 -bottom-[19px] right-14 pointer-events-none z-[1] opacity-80">
      <svg class="scale-[-1]" xmlns="http://www.w3.org/2000/svg" width="70" height="38" viewBox="0 0 40 27" fill="none">
        <path
          d="M40 -0.5V0.5C31.7964 0.5 24.2101 10.5927 28.8057 23.8359L29.4043 25.5635L28.0098 24.3818L-0.323242 0.381836L-1.36426 -0.5H40Z"
          fill="white" stroke="#e2e8f0" />
      </svg>
    </div> -->
  </div>
</div>
