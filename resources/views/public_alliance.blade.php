@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
  <section class="min-h-screen py-8">
    <div class="container mx-auto px-4">


      <div
        class="rounded-lg flex flex-col gap-4 border-none bg-tittlecard py-5 text-card-foreground shadow-sm rounded-base">
        <div class="flex items-center gap-3 px-4 sm:px-6">
          <header class="flex w-full flex-row">
            <div class="flex w-full flex-col items-start gap-1.5 sm:p-0">
              <div class="flex w-full flex-row items-center gap-3">
                <img alt="publicalliance" loading="lazy" width="50" height="50" decoding="async"
                  class="w-10 h-10 rounded-full invert" src="{{ asset('images/publicalliance.svg') }}" />
                <h1 class="text-xl font-bold tracking-normal sm:text-3xl">
                  RTX Public Alliance
                </h1>
              </div>
            </div>
          </header>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 h-full">
        <div class="md:col-span-1 h-full">
          <div
            class="rounded-lg flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm sm:rounded-inherit h-full ">
            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-4 sm:px-6">
              <div class="font-semibold leading-none flex items-center">Team Overview</div>
            </div>
            <div class="flex h-full flex-col justify-between px-4 sm:px-6">
              <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col items-start space-y-2">
                  <p class="text-sm text-muted">Team Members</p>
                  <p class="text-lg font-bold">0</p>
                </div>
                <div class="flex flex-col items-start space-y-2">
                  <p class="text-sm text-muted">Team TVL</p>
                  <p class="text-lg font-bold">0 USDT</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="md:col-span-2 h-full">
          <div
            class="rounded-lg flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm sm:rounded-inherit h-full ">
            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-4 sm:px-6">
              <div class="font-semibold leading-none flex items-center">Direct Referral</div>
            </div>
            <div class="flex h-full flex-col justify-between px-4 sm:px-6">
              <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col items-start space-y-2">
                  <p class="text-sm text-muted">Active Direct Referrals</p>
                  <p class="text-lg font-bold">0</p>
                </div>
                <div class="flex flex-col items-start space-y-2">
                  <p class="text-sm text-muted">Direct Referral Rewards</p>
                  <p class="text-lg font-bold">N/A</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <div
          class="rounded-lg flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm sm:rounded-inherit h-full">
          <div class="px-4 sm:px-6">
            <div class="grid grid-cols-2 gap-4 md:gap-12">
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Referral by</p>
                <div class="relative flex w-fit items-center rounded-full py-1 md:w-full">
                  <span class="z-10 truncate text-xs text-muted-foreground md:text-sm cursor-pointer hover:text-white/90"
                    title="0x0000000000000000000000000000000000000000">
                    0x0000...0000
                  </span>
                  <button
                    class="inline-flex items-center justify-center rounded-md gap-1.5 z-10 size-6 p-0 hover:bg-accent hover:text-accent-foreground ml-2"
                    title="Copy referrer address">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-copy">
                      <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                      <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">User Address</p>
                <div class="relative flex w-fit items-center rounded-full py-1 md:w-full">
                  <span class="z-10 truncate text-xs text-muted-foreground md:text-sm cursor-pointer hover:text-white/90"
                    title="0x0000000000000000000000000000000000000000">
                    0x0000...0000
                  </span>
                  <button
                    class="inline-flex items-center justify-center rounded-md gap-1.5 z-10 size-6 p-0 hover:bg-accent hover:text-accent-foreground ml-2"
                    title="Copy user address">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-copy">
                      <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                      <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                    </svg>
                  </button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>


      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 h-full">
        <div
          class="rounded-lg flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm sm:rounded-inherit h-full ">
          <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-4 sm:px-6">
            <div class="font-semibold leading-none flex flex-row items-center">
              <span class="mr-2">Guild Expansion Reward</span>
              <span
                class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 rounded-full border-primary/10 bg-primary/20 text-primary">
                Team Bonus
              </span>
            </div>
          </div>
          <div class="flex h-full flex-col px-4 sm:px-6">
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3">
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">My Rank</p>
                <p class="text-lg font-bold text-primary">N/A</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">My Staking</p>
                <p class="text-lg font-bold">0 USDT</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Direct Referrals</p>
                <p class="text-lg font-bold">0</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Minor Area Performance</p>
                <p class="text-lg font-bold">N/A</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Sharing Performance Reward</p>
                <p class="text-lg font-bold">0 RTX</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">VIP Level Reward</p>
                <p class="text-lg font-bold">0 RTX</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Same VIP Level Reward</p>
                <p class="text-lg font-bold">0 RTX</p>
              </div>
              <div class="flex flex-col items-start space-y-2">
                <p class="text-sm text-muted">Cross VIP Level Reward</p>
                <p class="text-lg font-bold">0 RTX</p>
              </div>
            </div>
          </div>
        </div>

        <div class="rounded-lg bg-card text-card-foreground shadow-sm h-full">
          <div class="flex items-center justify-between px-4 sm:px-6 py-4">
            <h3 class="text-base font-semibold">Next Rank Progress</h3>
            <span
              class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 rounded-full border-primary/10 bg-primary/20 text-primary">
              Next Level: <span class="ml-1 font-semibold">S1</span>
            </span>
          </div>
          <div class="px-4 sm:px-6 py-2">
            <div class="py-4">
              <div class="flex items-center justify-between text-sm mb-2">
                <h2 class="font-medium text-primary">User Capital Lock</h2>
                <span class="text-xs sm:text-sm font-semibold">0 / 100 USDT</span>
              </div>
              <div class="w-full h-2 rounded-full bg-zinc-800/80 overflow-hidden">
                <div class="h-full rounded-full bg-green-500 transition-all duration-300" style="width:0%"></div>
              </div>
              <div class="flex justify-between text-xs text-muted-foreground mt-2">
                <span>Current: <span class="font-medium">0 USDT</span></span>
                <span>Target: <span class="font-medium">100 USDT</span></span>
              </div>
            </div>
            <div class="py-4">
              <div class="flex items-center justify-between text-sm mb-2">
                <h2 class="font-medium text-primary">Minor Team Lock</h2>
                <span class="text-xs sm:text-sm font-semibold">0 / 5000 USDT</span>
              </div>
              <div class="w-full h-2 rounded-full bg-zinc-800/80 overflow-hidden">
                <div class="h-full rounded-full bg-green-500 transition-all duration-300" style="width:0%"></div>
              </div>
              <div class="flex justify-between text-xs text-muted-foreground mt-2">
                <span>Current: <span class="font-medium">0USDT</span></span>
                <span>Target: <span class="font-medium">5000USDT</span></span>
              </div>
            </div>
            <div class="py-4">
              <div class="flex items-center justify-between text-sm mb-2">
                <h2 class="font-medium text-primary">Direct Active Referral Count</h2>
                <span class="text-xs sm:text-sm font-semibold">0/2 direct active referrals</span>
              </div>
              <div class="w-full h-2 rounded-full bg-zinc-800/80 overflow-hidden">
                <div class="h-full rounded-full bg-green-500 transition-all duration-300" style="width:0%"></div>
              </div>
              <div class="flex justify-between text-xs text-muted-foreground mt-2">
                <span>Current: <span class="font-medium">0 direct active referrals</span></span>
                <span>Target: <span class="font-medium">2 direct active referrals</span></span>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="mt-6">
        <div
          class="rounded-base flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm px-2 sm:px-6">
          <div class="font-semibold text-lg mb-4">Referral Rewards Details</div>

          <div class="flex items-center gap-4">
            <img alt="avatar" loading="lazy" width="50" height="50" decoding="async" class="w-14 h-14 rounded-full"
              src="{{ asset('images/01.webp') }}" />
            <div>
              <div class="font-semibold">Account 1</div>
              <div class="text-sm text-muted-foreground">0x3fdd56...A16389</div>
            </div>
          </div>

          <hr class="my-4 border-b border-gray-700 border-white/10" />

          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="rounded border border-gray-500/30 p-4">
              <p class="text-sm text-muted-foreground mb-1">Personal Performance</p>
              <p class="text-lg font-bold text-primary">113.93 USDT</p>
            </div>
            <div class="rounded border border-gray-500/30 p-4">
              <p class="text-sm text-muted-foreground mb-1">Team Performance (w/o sARK)</p>
              <p class="text-lg font-bold text-primary">288.1 USDT</p>
            </div>
            <div class="rounded border border-gray-500/30 p-4">
              <p class="text-sm text-muted-foreground mb-1">Team Performance (w/ sARK)</p>
              <p class="text-lg font-bold text-primary">290.42 USDT</p>
            </div>
            <div class="rounded border border-gray-500/30 p-4">
              <p class="text-sm text-muted-foreground mb-1">Direct Referrals</p>
              <p class="text-lg font-bold text-primary">2</p>
            </div>
          </div>

          <hr class="my-4 border-gray-500/30" />

          <div>
            <div class="flex items-center gap-2 mb-3">
              <h2 class="font-semibold">Direct Referrals</h2>
              <span class="bg-card border-[#ccaa77] text-primary text-xs px-2 py-1 rounded-full flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-users size-3" aria-hidden="true">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                  <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                  <circle cx="9" cy="7" r="4" />
                </svg>
                2
              </span>
            </div>


            <div class="space-y-3">


              <details class="pb-4 rounded-lg">
                <summary class="flex items-center justify-between p-3 border-b border-gray-700 hover:bg-gray-800">
                  <div class="flex items-center gap-3">
                    <div
                      class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-primary font-semibold">
                      0X</div>
                    <div>
                      <p class="font-medium">0xE08...Dd4d9</p>
                      <p class="text-xs text-muted-foreground">Team: 75.92 USDT</p>
                    </div>
                  </div>
                  <span class="chev text-primary">▼</span>
                </summary>

                <div class="content">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Personal Performance</p>
                      <p class="text-lg font-bold text-primary">37.94 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Team Performance (w/o sARK)</p>
                      <p class="text-lg font-bold text-primary">75.92 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Team Performance (w/ sARK)</p>
                      <p class="text-lg font-bold text-primary">75.92 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Direct Referrals</p>
                      <p class="text-lg font-bold text-primary">1</p>
                    </div>
                  </div>
                </div>
              </details>

              <details class="pb-4 rounded-lg">
                <summary class="flex items-center justify-between p-3 border-b border-gray-700 hover:bg-gray-800">
                  <div class="flex items-center gap-3">
                    <div
                      class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-primary font-semibold">
                      0X</div>
                    <div>
                      <p class="font-medium">0x698...32339</p>
                      <p class="text-xs text-muted-foreground">Team: 98.54 USDT</p>
                    </div>
                  </div>
                  <span class="chev text-primary">▼</span>
                </summary>

                <div class="content">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Personal Performance</p>
                      <p class="text-lg font-bold text-primary">40.00 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Team Performance (w/o sARK)</p>
                      <p class="text-lg font-bold text-primary">98.54 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Team Performance (w/ sARK)</p>
                      <p class="text-lg font-bold text-primary">98.54 USDT</p>
                    </div>
                    <div class="rounded border bg-bordercard p-4">
                      <p class="text-sm text-muted-foreground mb-1">Direct Referrals</p>
                      <p class="text-lg font-bold text-primary">1</p>
                    </div>
                  </div>
                </div>
              </details>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <div id="toast"
     class="fixed bottom-6 right-6 hidden items-center gap-2 rounded-lg bg-[#0f0f11]/90 text-[#f8d36a] border border-[#c49d2b]/40 px-4 py-2 text-sm font-semibold shadow-lg backdrop-blur-md z-[9999]">
  ✅ Copied to clipboard!
</div>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('#direct-referrals .referral-row').forEach(function (row) {
        row.addEventListener('click', function () {
          const expanded = row.getAttribute('aria-expanded') === 'true';
          const detailsId = row.getAttribute('aria-controls');
          const detailsEl = document.getElementById(detailsId);
          const chev = row.querySelector('.chev');

          row.setAttribute('aria-expanded', String(!expanded));
          if (detailsEl) {
            detailsEl.classList.toggle('hidden', expanded);
          }

          if (chev) {
            chev.style.transform = expanded ? 'rotate(0deg)' : 'rotate(180deg)';
          }
        });
      });
    });
    document.addEventListener('DOMContentLoaded', () => {
      const toast = document.getElementById('toast');

      document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
          const text = btn.getAttribute('data-copy')?.trim();
          if (!text) return;
          try {
            await navigator.clipboard.writeText(text);
            showToast('✅ Copied to clipboard!');
          } catch (err) {
            showToast('❌ Failed to copy', true);
          }
        });
      });

      function showToast(message, error = false) {
        toast.textContent = message;
        toast.style.color = error ? '#ff7777' : '#f8d36a';
        toast.classList.remove('hidden');
        toast.style.opacity = '1';
        toast.style.transition = 'opacity 0.3s ease';
        toast.style.boxShadow = error
          ? '0 0 10px rgba(255, 80, 80, 0.4)'
          : '0 0 12px rgba(196, 157, 43, 0.4)';
        setTimeout(() => {
          toast.style.opacity = '0';
          setTimeout(() => toast.classList.add('hidden'), 300);
        }, 2000);
      }
    });
  </script>
@endpush