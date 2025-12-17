@extends('app')

@section('title', 'Ranks')

@section('content')
<section class="min-h-screen py-8 bg-slate-50/50 px-4">
  <div class="mx-auto max-w-[1470px]">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
      <div>
        <h2 class="text-lg sm:text-2xl font-semibold text-slate-900">Promotions</h2>
        <p class="text-xs sm:text-sm text-slate-500">Select a rank to see details.</p>
      </div>
    </div>

    {{-- TABS (same as your leaderboard tabs vibe) --}}
    <div class="relative mb-5">
      <div class="flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner">
        <div class="flex gap-2 flex-wrap" id="rankTabs">
          <button class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
                  type="button" data-target="panel-1" aria-selected="true">
            <span class="relative z-[1]">P1</span>
          </button>
          <button class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
                  type="button" data-target="panel-2" aria-selected="false">P2</button>
          <button class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
                  type="button" data-target="panel-3" aria-selected="false">P3</button>
          <button class="rank-tab group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition flex items-center gap-2"
                  type="button" data-target="panel-4" aria-selected="false">P4</button>
          
        </div>

        <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
          <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
          <span>Click tabs to switch ranks</span>
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

        {{-- ================= PANEL 1 ================= --}}
        <div class="rank-panel" id="panel-1">
          {{-- top row --}}
          <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 pb-4 mb-5 border-b border-slate-200">
            <div>
              <h3 class="text-base sm:text-lg font-semibold text-slate-900">HEAD START 1000</h3>

              <div class="flex flex-wrap gap-2 mt-2">
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                  Eligible: <span class="ml-1 font-semibold text-slate-900">100</span>
                </span>
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                  Half: <span class="ml-1 font-semibold text-slate-900">50</span>
                </span>
                <span class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
                  Active: <span class="ml-1 font-semibold">17-12-2025</span>
                </span>
              </div>
            </div>

            {{-- timer (glass) --}}
            <div class="timer flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50/70 backdrop-blur-md px-3 py-2 shadow-sm"
                 data-countdown="2025-12-31T23:59:59">
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
                    <span>Strong Business</span>
                    <span class="text-[var(--theme-skky-700)] font-semibold">25 / 50</span>
                  </div>
                  <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:50%"></div>
                  </div>
                </div>

                <div>
                  <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                    <span>Other Business</span>
                    <span class="text-[var(--theme-skky-700)] font-semibold">10 / 50</span>
                  </div>
                  <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:20%"></div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Rewards --}}
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-transparent to-[var(--theme-skky-400)]/15 opacity-70 blur-xl"></div>
              <div class="relative">
                <h4 class="text-sm font-semibold text-slate-900 mb-4">Rewards</h4>

                <div class="space-y-3">
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">One Time Reward</span>
                    <b class="font-mono text-sm text-slate-900">100 USDT</b>
                  </div>
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">Daily Income</span>
                    <b class="font-mono text-sm text-slate-900">5 USDT</b>
                  </div>
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">Duration</span>
                    <b class="font-mono text-sm text-slate-900">30 Days</b>
                  </div>
                </div>
              </div>
            </div>

            {{-- Notes --}}
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/10 via-transparent to-fuchsia-400/10 opacity-70 blur-xl"></div>
              <div class="relative">
                <h4 class="text-sm font-semibold text-slate-900 mb-3">Notes</h4>
                <p class="text-xs sm:text-sm text-slate-500 mb-4">
                  Rank details are static right now. You can later connect API/DB easily by replacing values.
                </p>
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

        {{-- ================= PANEL 2 ================= --}}
        <div class="rank-panel hidden" id="panel-2">
          <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 pb-4 mb-5 border-b border-slate-200">
            <div>
              <h3 class="text-base sm:text-lg font-semibold text-slate-900">HEAD START 500</h3>
              <div class="flex flex-wrap gap-2 mt-2">
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                  Eligible: <span class="ml-1 font-semibold text-slate-900">200</span>
                </span>
                <span class="inline-flex items-center rounded-full bg-white px-3 py-1 text-[11px] sm:text-xs font-medium text-slate-700 border border-slate-200">
                  Half: <span class="ml-1 font-semibold text-slate-900">100</span>
                </span>
                <span class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)] px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
                  Active: <span class="ml-1 font-semibold">17-12-2025</span>
                </span>
              </div>
            </div>

            <div class="timer flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50/70 backdrop-blur-md px-3 py-2 shadow-sm"
                 data-countdown="2026-01-10T18:00:00">
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

          <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/15 opacity-70 blur-xl"></div>
              <div class="relative">
                <h4 class="text-sm font-semibold text-slate-900 mb-4">Progress</h4>

                <div class="mb-4">
                  <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                    <span>Strong Business</span>
                    <span class="text-[var(--theme-skky-700)] font-semibold">70 / 100</span>
                  </div>
                  <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:70%"></div>
                  </div>
                </div>

                <div>
                  <div class="flex justify-between text-xs font-medium text-slate-700 mb-1">
                    <span>Other Business</span>
                    <span class="text-[var(--theme-skky-700)] font-semibold">40 / 100</span>
                  </div>
                  <div class="h-3 bg-slate-200 rounded-full overflow-hidden border border-slate-200">
                    <div class="h-full bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-bllue-500)] rounded-full" style="width:40%"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-transparent to-[var(--theme-skky-400)]/15 opacity-70 blur-xl"></div>
              <div class="relative">
                <h4 class="text-sm font-semibold text-slate-900 mb-4">Rewards</h4>

                <div class="space-y-3">
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">One Time Reward</span>
                    <b class="font-mono text-sm text-slate-900">250 USDT</b>
                  </div>
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">Daily Income</span>
                    <b class="font-mono text-sm text-slate-900">10 USDT</b>
                  </div>
                  <div class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                    <span class="text-xs sm:text-sm text-slate-600">Duration</span>
                    <b class="font-mono text-sm text-slate-900">45 Days</b>
                  </div>
                </div>
              </div>
            </div>

            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-indigo-400/10 via-transparent to-fuchsia-400/10 opacity-70 blur-xl"></div>
              <div class="relative">
                <h4 class="text-sm font-semibold text-slate-900 mb-3">Notes</h4>
                <p class="text-xs sm:text-sm text-slate-500 mb-4">This is static demo content for panel-2.</p>
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

        {{-- ================= PANELS 3-6 (short demo, themed) ================= --}}
        <div class="rank-panel hidden" id="panel-3">
          <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md">
            <h3 class="text-base font-semibold text-slate-900">HEAD START 10X</h3>
            <p class="text-sm text-slate-500 mt-1">Static content (add same structure like panel 1).</p>
          </div>
        </div>

        <div class="rank-panel hidden" id="panel-4">
          <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md">
            <h3 class="text-base font-semibold text-slate-900">FOUNDERS CLUB 5000</h3>
            <p class="text-sm text-slate-500 mt-1">Static content (add same structure like panel 1).</p>
          </div>
        </div>

       
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

    document.getElementById('rankTabs').addEventListener('click', (e)=>{
      const btn = e.target.closest('.rank-tab');
      if(!btn) return;
      activate(btn.dataset.target);
    });

    activate('panel-1');
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
