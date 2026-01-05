@extends('app')

@section('title', 'Ranks')

@section('content')
<section class="min-h-screen py-8 bg-slate-50/50 px-4">
  <div class="mx-auto max-w-[1470px]">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
      <div>
        <h2 class="text-lg sm:text-2xl font-semibold text-slate-900">Circle Calculator</h2>
        <!-- <p class="text-xs sm:text-sm text-slate-500">Select a rank to see details.</p> -->
      </div>
    </div>

    @php
      $packages = collect($customer->appsLevelPackages ?? [])->sortBy('level')->values();
      $firstPanelId = $packages->first() ? 'panel-' . $packages->first()->level : null;
    @endphp

    {{-- TABS (same as your leaderboard tabs vibe) --}}
    <div class="relative mb-5">
      <div class="flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner">
        <div class="flex gap-2 flex-wrap" id="rankTabs">
          @forelse($packages as $pkg)
            <button
              class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
              type="button"
              data-target="panel-{{ $pkg->level }}"
              aria-selected="false"
            >
              <span class="relative z-[1]">L{{ $pkg->level }}</span>
              <span class="text-[10px] sm:text-xs text-white-500 group-[.is-active]:text-white/90">
                ({{ $pkg->directs }}C)
              </span>
            </button>
          @empty
            <div class="text-xs text-slate-500 px-3 py-2">No level packages found for your app.</div>
          @endforelse
        </div>

        <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
          <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
          <span>Click tabs to switch levels</span>
        </div>
      </div>
    </div>

    {{-- PANELS WRAP (glass card container) --}}
    <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] p-4 md:p-6">
      <div class="absolute inset-0 opacity-70 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
      </div>

      <div class="relative" id="rankPanels">
        @forelse($packages as $pkg)
          <div class="rank-panel hidden" id="panel-{{ $pkg->level }}">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

              {{-- Level Info --}}
              <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/10 via-transparent to-fuchsia-400/10 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h3 class="text-base font-semibold text-slate-900">Level L{{ $pkg->level }}</h3>
                  <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Active Cores Required: <b class="text-slate-900">{{ $pkg->directs }}</b>
                  </p>

                  <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Level</span>
                      <b class="font-mono text-sm text-slate-900">{{ $pkg->level }}</b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Active Cores Required</span>
                      <b class="font-mono text-sm text-slate-900">{{ $pkg->directs }}</b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Reward</span>
                      <b class="font-mono text-sm text-slate-900">{{ rtrim(rtrim(number_format((float)$pkg->reward, 2), '0'), '.') }}%</b>
                    </div>
                  </div>
                </div>

                @php
                  $achievedDirects = $customer->totalActiveDirectsCount; // TODO: replace with real achieved directs later
                  $requiredDirects = (int) $pkg->directs;

                  $percent = $requiredDirects > 0
                      ? round(($achievedDirects / $requiredDirects) * 100, 2)
                      : 0;

                  $percent = max(0, min(100, $percent)); // clamp 0..100
                @endphp

                <div class="mt-4">
                  <div class="flex items-center justify-between text-xs sm:text-sm mb-2">
                    <span class="text-slate-600">
                      Active Cores
                      <!-- <b class="text-slate-900">{{ $achievedDirects }}</b>
                      /
                      <b class="text-slate-900">{{ $requiredDirects }}</b> -->
                    </span>
                    <span class="font-mono text-slate-900">{{ $achievedDirects }}/{{ $requiredDirects }}</span>
                  </div>

                  <div class="w-full h-2.5 rounded-full overflow-hidden bg-slate-200">
                    <div
                      class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full"
                      style="width: {{ $percent }}%;"
                    ></div>
                  </div>

                  <div class="mt-2 text-[11px] text-slate-500">
                    @if($achievedDirects >= $requiredDirects && $requiredDirects > 0)
                      ✅ Requirement completed
                    @else
                      {{ max(0, $requiredDirects - $achievedDirects) }} active core/s remaining
                    @endif
                  </div>
                </div>
              </div>
              



              {{-- Rewards (keep your same card style, now dynamic) --}}
              <!-- <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-transparent to-[var(--theme-skky-400)]/15 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h4 class="text-sm font-semibold text-slate-900 mb-4">Reward Summary</h4>

                  <div class="space-y-3">
                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Reward Percentage</span>
                      <b class="font-mono text-sm text-slate-900">{{ rtrim(rtrim(number_format((float)$pkg->reward, 2), '0'), '.') }}%</b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">Applies On</span>
                      <b class="font-mono text-sm text-slate-900">Deposit</b>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                      <span class="text-xs sm:text-sm text-slate-600">App ID</span>
                      <b class="font-mono text-sm text-slate-900">{{ $pkg->app_id }}</b>
                    </div>
                  </div>
                </div>
              </div> -->

              {{-- Notes / Extra --}}
              <!-- <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/15 opacity-70 blur-xl"></div>
                <div class="relative">
                  <h4 class="text-sm font-semibold text-slate-900 mb-3">Notes</h4>
                  <p class="text-xs sm:text-sm text-slate-500">
                    This level unlocks when you have <b>{{ $pkg->directs }}</b> active directs.
                  </p>
                </div>
              </div> -->

            </div>
          </div>
        @empty
          <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md">
            <h3 class="text-base font-semibold text-slate-900">No Levels Found</h3>
            <p class="text-sm text-slate-500 mt-1">No level packages are configured for your app.</p>
          </div>
        @endforelse
      </div>
    </div>

  </div>
</section>

{{-- no big CSS needed; just tiny helper for active tab --}}
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

    document.getElementById('rankTabs')?.addEventListener('click', (e)=>{
      const btn = e.target.closest('.rank-tab');
      if(!btn) return;
      activate(btn.dataset.target);
    });

    const first = "{{ $firstPanelId ?? '' }}";
    if(first) activate(first);
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
