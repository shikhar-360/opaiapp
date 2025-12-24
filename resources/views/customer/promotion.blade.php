@extends('app')

@section('title', 'Promotions')

@section('content')
@php
    // Expected: $customer->promotionPackage = AppPromotionPackagesModel::where('app_id', $customer->app_id)->get();
    $packages = collect($customer->promotionPackage ?? []);

    $decode = function ($val) {
        if (is_array($val)) return $val;
        if (is_null($val)) return [];
        $val = trim((string) $val);
        if ($val === '') return [];

        // JSON array stored as string e.g. "[5,10]"
        $json = json_decode($val, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return is_array($json) ? $json : [];
        }

        // Fallback: "5,10"
        return array_values(array_filter(array_map('trim', explode(',', trim($val, '[]'))), fn($x)=>$x!==''));
    };

    $firstPanelId = $packages->isNotEmpty() ? ('panel-' . $packages->first()->id) : null;
@endphp

<section class="min-h-screen py-8 bg-slate-50/50 px-4">
  <div class="mx-auto max-w-[1470px]">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
      <div>
        <h2 class="text-lg sm:text-2xl font-semibold text-slate-900">Promotions</h2>
        <p class="text-xs sm:text-sm text-slate-500">Select a promotion package to see details.</p>
      </div>
    </div>

    {{-- TABS --}}
    <div class="relative mb-5">
      <div class="flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner">

        <div class="flex gap-2 flex-wrap" id="rankTabs">
          @forelse ($packages as $pkg)
            @php $panelId = 'panel-' . $pkg->id; @endphp
            <button
              class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
              type="button"
              data-target="{{ $panelId }}"
              aria-selected="{{ $loop->first ? 'true' : 'false' }}">
              <span class="relative z-[1]">
                {{ $pkg->name ?? ('P' . $loop->iteration) }}
              </span>
            </button>
          @empty
            <div class="px-3 py-2 text-xs text-slate-500">No promotion packages found.</div>
          @endforelse
        </div>

        <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
          <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
          <span>Click tabs to switch packages</span>
        </div>
      </div>
    </div>

    {{-- PANELS WRAP --}}
    <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] p-4 md:p-6">
      <div class="absolute inset-0 opacity-70 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
      </div>

      <div class="relative" id="rankPanels">

        @foreach ($packages as $pkg)
          @php
            $panelId = 'panel-' . $pkg->id;

            $total = (int) ($pkg->total_beneficiaries ?? 0);
            $half  = $total > 0 ? (int) ceil($total / 2) : 0;

            $directs = (int) ($pkg->directs ?? 0);

            $targets = $decode($pkg->package);
            $benefits = $decode($pkg->package_benefits);
            $levels = $decode($pkg->benefit_levels);

            // Timer: by default show expiry = created_at + 30 days
            $expiresAt = optional($pkg->created_at)->copy()->addDays(30);
            $expiresIso = $expiresAt ? $expiresAt->format('Y-m-d\TH:i:s') : now()->addDays(30)->format('Y-m-d\TH:i:s');

            // Progress (if you later have real progress, just replace these)
            $strongTarget = (float) ($targets[0] ?? 0);
            $otherTarget  = (float) ($targets[1] ?? 0);
            $strongDone   = 0;
            $otherDone    = 0;
            $strongPct = $strongTarget > 0 ? min(100, ($strongDone / $strongTarget) * 100) : 0;
            $otherPct  = $otherTarget > 0 ? min(100, ($otherDone / $otherTarget) * 100) : 0;
          @endphp

          <div class="rank-panel {{ $loop->first ? '' : 'hidden' }}" id="{{ $panelId }}">

            {{-- top row --}}
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 pb-4 mb-5 border-b border-slate-200">
              <div>
                <h3 class="text-base sm:text-lg font-semibold text-slate-900">{{ $pkg->name }}</h3>

                <div class="flex flex-wrap gap-2 mt-2">
                  <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                    Beneficiaries: <span class="ml-1 font-semibold text-slate-900">{{ $total }}</span>
                  </span>

                  <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                    Half: <span class="ml-1 font-semibold text-slate-900">{{ $half }}</span>
                  </span>

                  <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                    Directs: <span class="ml-1 font-semibold text-slate-900">{{ $directs }}</span>
                  </span>

                  <span class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
                    Active: <span class="ml-1 font-semibold">{{ optional($pkg->created_at)->format('d-m-Y') ?? now()->format('d-m-Y') }}</span>
                  </span>
                </div>

                {{-- Targets chips --}}
                <div class="flex flex-wrap gap-2 mt-3">
                  @if (!empty($targets))
                    @foreach ($targets as $t)
                      <span class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                        Target: <span class="ml-1 font-semibold text-slate-900">{{ $t }}</span>
                      </span>
                    @endforeach
                  @else
                    <span class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-500 border border-slate-200">
                      No targets configured
                    </span>
                  @endif
                </div>
              </div>

              {{-- timer --}}
              <div class="timer flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50/70 backdrop-blur-md px-3 py-2 shadow-sm"
                   data-countdown="{{ $expiresIso }}">
                <div class="tbox text-center min-w-[54px]">
                  <div class="days text-base sm:text-lg font-extrabold text-[var(--theme-skky-600)] leading-none">--</div>
                  <small class="block text-[10px] sm:text-[11px] text-slate-500 mt-1">Days</small>
                </div>
                <span class="colon font-extrabold text-slate-400">:</span>
                <div class="tbox text-center min-w-[54px]">
                  <div class="hours text-base sm:text-lg font-extrabold text-[var(--theme-skky-600)] leading-none">--</div>
                  <small class="block text-[10px] sm:text-[11px] text-slate-500 mt-1">Hours</small>
                </div>
                <span class="colon font-extrabold text-slate-400">:</span>
                <div class="tbox text-center min-w-[54px]">
                  <div class="minutes text-base sm:text-lg font-extrabold text-[var(--theme-skky-600)] leading-none">--</div>
                  <small class="block text-[10px] sm:text-[11px] text-slate-500 mt-1">Minutes</small>
                </div>
                <span class="colon font-extrabold text-slate-400">:</span>
                <div class="tbox text-center min-w-[54px]">
                  <div class="seconds text-base sm:text-lg font-extrabold text-[var(--theme-skky-600)] leading-none">--</div>
                  <small class="block text-[10px] sm:text-[11px] text-slate-500 mt-1">Seconds</small>
                </div>
              </div>
            </div>

            {{-- cards grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

              {{-- Progress --}}
              <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/15 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h4 class="text-sm font-semibold text-slate-900 mb-4">Progress</h4>

                  <div class="mb-4">
                    <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                      <span>Strong Target</span>
                      <span class="text-[var(--theme-skky-700)] font-semibold">{{ $strongDone }} / {{ $strongTarget }}</span>
                    </div>
                    <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                      <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:{{ $strongPct }}%"></div>
                    </div>
                  </div>

                  <div>
                    <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                      <span>Other Target</span>
                      <span class="text-[var(--theme-skky-700)] font-semibold">{{ $otherDone }} / {{ $otherTarget }}</span>
                    </div>
                    <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                      <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:{{ $otherPct }}%"></div>
                    </div>
                  </div>

                  <!-- <p class="text-[11px] text-slate-500 mt-3">
                    Note: Progress values are 0 right now (demo). If you have user progress, replace <b>$strongDone</b>/<b>$otherDone</b> with real values.
                  </p> -->
                </div>
              </div>

              {{-- Benefits --}}
              <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-transparent to-[var(--theme-skky-400)]/15 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h4 class="text-sm font-semibold text-slate-900 mb-4">Benefits</h4>

                  <div class="space-y-3">
                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Package</span>
                      <b class="font-mono text-sm text-slate-900">
                        {{ !empty($targets) ? implode(' , ', $targets) : '-' }}
                      </b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Package Benefits</span>
                      <b class="font-mono text-sm text-slate-900">
                        {{ !empty($benefits) ? implode(' , ', $benefits) : '-' }}
                      </b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Benefit Levels</span>
                      <b class="font-mono text-sm text-slate-900">
                        {{ is_array($levels) ? count($levels) : 0 }}
                      </b>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Notes --}}
              <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/10 via-transparent to-fuchsia-400/10 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h4 class="text-sm font-semibold text-slate-900 mb-3">Notes</h4>

                  @if (!empty($levels))
                    <p class="text-xs sm:text-sm text-slate-500 mb-3">Benefit will be distributed on these levels:</p>
                    <div class="flex flex-wrap gap-2 mb-4 max-h-[108px] overflow-auto pr-1">
                      @foreach ($levels as $lv)
                        <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">L{{ $lv }}</span>
                      @endforeach
                    </div>
                  @else
                    <p class="text-xs sm:text-sm text-slate-500 mb-4">No benefit levels configured for this package.</p>
                  @endif

                  <button class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full
                                 bg-[var(--theme-skky-600)] text-white text-xs sm:text-sm font-semibold
                                 hover:bg-[var(--theme-skky-500)] active:scale-95 transition-all border border-[var(--theme-skky-500)] shadow-md cursor-pointer"
                          type="button">
                    Claim (Demo)
                  </button>
                </div>
              </div>

            </div>
          </div>
        @endforeach

      </div>
    </div>

  </div>
</section>

<style>
  .rank-tab{
    border:1px solid #e2e8f0;
    background:#fff;
    color:#475569;
  }
  .rank-tab:hover{ background:#e2e8f0; color:#0f172a; }
  .rank-tab.is-active{
    background:linear-gradient(to right, var(--theme-skky-500), var(--theme-skky-600));
    color:#fff;
    border-color:var(--theme-skky-500);
    box-shadow:0 10px 25px rgba(59,130,246,.35);
  }
</style>

<script>
  (function () {
    const tabs = Array.from(document.querySelectorAll('.rank-tab'));
    const panels = Array.from(document.querySelectorAll('.rank-panel'));

    function activate(id){
      tabs.forEach(t=>{
        const on = t.dataset.target === id;
        t.classList.toggle('is-active', on);
        t.setAttribute('aria-selected', on ? 'true' : 'false');
      });
      panels.forEach(p=>p.classList.toggle('hidden', p.id !== id));
    }

    const tabsWrap = document.getElementById('rankTabs');
    if (tabsWrap) {
      tabsWrap.addEventListener('click', (e)=>{
        const btn = e.target.closest('.rank-tab');
        if(!btn) return;
        activate(btn.dataset.target);
      });
    }

    // default active = first tab
    const first = tabs[0];
    if (first) activate(first.dataset.target);
  })();

  (function () {
    const timers = Array.from(document.querySelectorAll('[data-countdown]'));
    const pad = (n) => String(n).padStart(2, '0');

    function setParts(block, d, h, m, s){
      block.querySelector('.days').textContent = d;
      block.querySelector('.hours').textContent = h;
      block.querySelector('.minutes').textContent = m;
      block.querySelector('.seconds').textContent = s;
    }

    function tick(){
      const now = Date.now();
      timers.forEach(block=>{
        const target = Date.parse(block.dataset.countdown);
        if(Number.isNaN(target)) return setParts(block,'--','--','--','--');
        let diff = target - now;
        if(diff <= 0) return setParts(block,'00','00','00','00');

        const days = Math.floor(diff / 86400000); diff -= days * 86400000;
        const hrs  = Math.floor(diff / 3600000); diff -= hrs  * 3600000;
        const mins = Math.floor(diff / 60000);   diff -= mins * 60000;
        const secs = Math.floor(diff / 1000);

        setParts(block, pad(days), pad(hrs), pad(mins), pad(secs));
      });
    }

    tick();
    setInterval(tick, 1000);
  })();
</script>
@endsection
