@extends('app')

@section('content')
    <section class="min-h-screen py-8">
        <div class="container mx-auto px-4">

            <div class="rounded-lg bg-tittlecard py-6 shadow-sm border-none">
                <div class="flex w-full flex-col gap-4 px-6 sm:flex-row sm:justify-between">
                    <div class="flex w-full flex-col items-start gap-1.5">
                        <div class="flex w-full flex-row items-center gap-3">
                             <img alt="bond" loading="lazy" width="50" height="50" decoding="async"
                                    class="w-10 h-10  invert" src="{{ asset('images/bond.svg') }}" />
                            <h1 class="text-xl text-white font-bold tracking-normal sm:text-3xl">Bonding</h1>
                        </div>
                        <p class="text-subtext text-base text-muted">Bond your LP tokens to earn RTX rewards over time at a
                            discount.</p>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div
                    class="rounded-lg mt-5 flex flex-col gap-3 overflow-hidden bg-card px-3.5 py-4 text-card-foreground shadow-sm sm:px-6 sm:py-5">
                    <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 p-0">
                        <h3 class="text-subtext text-lg text-muted sm:text-base font-semibold">EM Model Informations</h3>
                    </div>
                    <div class="grid grid-cols-1 gap-5 p-0 sm:grid-cols-3">
                        <div class="min-w-0 flex flex-col items-start gap-1 sm:gap-2">
                            <p class="text-md font-medium text-muted">Premium Index</p>
                            <div class="text-base sm:text-lg font-bold">478.55 %</div>
                        </div>
                        <div class="min-w-0 flex flex-col items-start gap-1 sm:gap-2">
                            <p class="text-md font-medium text-muted">Epoch</p>
                            <div class="text-base sm:text-lg font-bold">12 hours</div>
                        </div>
                        <div class="min-w-0 flex flex-col items-start sm:items-end gap-1 sm:gap-2">
                            <p class="text-md font-medium text-muted">Next Rebase</p>
                            <div class="text-lg font-bold sm:text-xl lg:text-2xl">
                                <div class="flex min-w-0 flex-wrap items-center gap-0.5 lg:flex-row">
                                    <div class="flex items-baseline">
                                        <span class="tabular-nums text-white font-bold text-sm sm:text-base">08</span>
                                        <span class="text-white text-xs sm:text-[10px] font-medium uppercase tracking-wider">&nbsp;HRS</span>
                                    </div>
                                    <div class="text-white font-bold text-sm sm:text-base">:</div>
                                    <div class="flex items-baseline">
                                        <span class="tabular-nums text-white font-bold text-sm sm:text-base">42</span>
                                        <span class="text-white text-xs sm:text-[10px] font-medium uppercase tracking-wider">&nbsp;MIN</span>
                                    </div>
                                    <div class="text-white font-bold text-sm sm:text-base">:</div>
                                    <div class="flex items-baseline">
                                        <span class="tabular-nums text-white font-bold text-sm sm:text-base">26</span>
                                        <span class="text-white text-xs sm:text-[10px] font-medium uppercase tracking-wider">&nbsp;SEC</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="staking-tabs" class="mt-5 flex w-full flex-col gap-2">
                    <div class="rounded-lg bg-card px-3.5 py-4 text-card-foreground shadow-sm sm:px-6 sm:py-5">

                        <div class="mb-4 flex w-full justify-center">
                            <div
                                class="grid h-[42px] w-full max-w-[500px] grid-cols-2 items-center rounded-2xl border border-white/5 bg-white/5 backdrop-blur-md">
                                <button type="button" data-tab-btn="list" aria-selected="true"
                                    class="h-10 rounded-2xl text-sm font-bold transition-colors px-3 py-1 border border-primary bg-primary/10 text-primary  shadow-sm">
                                    Bond Listings
                                </button>
                                <button type="button" data-tab-btn="mine" aria-selected="false"
                                    class="h-10 rounded-2xl text-sm font-bold transition-colors px-3 py-1 border border-transparent text-white/70 hover:text-white">
                                    My Bonds
                                </button>
                            </div>
                        </div>

                        <div data-tab-pane="list" class="relative w-full overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-white/10 text-sm font-normal text-white/60">
                                        <th class="px-2 py-3 text-left font-medium text-white">Bond:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Period:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Bond Price:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Discount Rate:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">APY:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Purchased Bond:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative h-[30px] w-[30px]">
                                                    <span class="absolute left-0 top-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="RTX" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/dexlogo.webp') }}" style="color: transparent;">
                                                    </span>
                                                    <span class="absolute bottom-0 right-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="USDT" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/usdt.svg') }}" style="color: transparent;">
                                                    </span>
                                                </div>
                                                <span class="font-semibold text-white">RTX-USDT LP</span>
                                                <span class="rounded-full bg-black-500/20 px-2 py-[2px] text-md font-semibold text-primary ring-1 ring-green-500/30">30</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">30 day(s)</td>
                                        <td class="p-2 text-white">$37.91</td>
                                        <td class="p-2 text-white">1.69%</td>
                                        <td class="p-2 text-white">1,006.36%</td>
                                        <td class="p-2 text-white">$3,189,695.19</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="1,006.36%" data-period="30 day(s)" data-badge="30">
                                                Bond
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative h-[30px] w-[30px]">
                                                    <span class="absolute left-0 top-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="RTX" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/dexlogo.webp') }}" style="color: transparent;">
                                                    </span>
                                                    <span class="absolute bottom-0 right-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="USDT" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/usdt.svg') }}" style="color: transparent;">
                                                    </span>
                                                </div>
                                                <span class="font-semibold text-white">RTX-USDT LP</span>
                                                <span class="rounded-full bg-black-500/20 px-2 py-[2px] text-md font-semibold text-primary ring-1 ring-green-500/30">90</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">90 day(s)</td>
                                        <td class="p-2 text-white">$37.77</td>
                                        <td class="p-2 text-white">2.03%</td>
                                        <td class="p-2 text-white">1,490.91%</td>
                                        <td class="p-2 text-white">$2,178,704.10</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="1,490.91%" data-period="90 day(s)" data-badge="90">
                                                Bond
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative h-[30px] w-[30px]">
                                                    <span class="absolute left-0 top-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="RTX" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/dexlogo.webp') }}" style="color: transparent;">
                                                    </span>
                                                    <span class="absolute bottom-0 right-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="USDT" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/usdt.svg') }}" style="color: transparent;">
                                                    </span>
                                                </div>
                                                <span class="font-semibold text-white">RTX-USDT LP</span>
                                                <span class="rounded-full bg-black-500/20 px-2 py-[2px] text-md font-semibold text-primary ring-1 ring-green-500/30">180</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">180 day(s)</td>
                                        <td class="p-2 text-white">$37.30</td>
                                        <td class="p-2 text-white">3.25%</td>
                                        <td class="p-2 text-white">2,114.91%</td>
                                        <td class="p-2 text-white">$4,169,984.11</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="2,114.91%" data-period="180 day(s)" data-badge="180">
                                                Bond
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative h-[30px] w-[30px]">
                                                    <span class="absolute left-0 top-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="RTX" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/dexlogo.webp') }}" style="color: transparent;">
                                                    </span>
                                                    <span class="absolute bottom-0 right-0 block h-[20px] w-[20px] overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="USDT" loading="lazy" width="20" height="20" decoding="async"
                                                             class="h-full w-full object-cover"
                                                             src="{{ asset('images/usdt.svg') }}" style="color: transparent;">
                                                    </span>
                                                </div>
                                                <span class="font-semibold text-white">RTX-USDT LP</span>
                                                <span class="rounded-full bg-black-500/20 px-2 py-[2px] text-md font-semibold text-primary ring-1 ring-green-500/30">360</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">360 day(s)</td>
                                        <td class="p-2 text-white">$37.10</td>
                                        <td class="p-2 text-white">3.79%</td>
                                        <td class="p-2 text-white">3,109.66%</td>
                                        <td class="p-2 text-white">$32,231,878.98</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="3,109.66%" data-period="360 day(s)" data-badge="360">
                                                Bond
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div data-tab-pane="mine" class="hidden">
                            <div class="relative w-full overflow-x-auto">
                                <div class="py-12 text-center">
                                    <div class="mb-4 text-white/60">
                                        <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" class="mx-auto size-6">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold">No bonds found</h3>
                                    <p class="mt-1 text-sm text-white/60">
                                        You don’t have any active bonds yet.
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div id="stake-backdrop" class="fixed inset-0 z-[59] hidden bg-black/60"></div>

    <div id="stake-modal" role="dialog" aria-modal="true" aria-labelledby="bonding-modal-title"
        class="hidden fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-3xl border-none bg-popupbg text-white shadow-lg duration-200 flex max-h-[100vh] w-[calc(100vw-1rem)] max-w-md flex-col p-0 sm:max-w-lg"
        tabindex="-1">

        <div class="flex items-center justify-between border-b border-white/10 px-8 pt-6 pb-3">
            <div class="flex items-center gap-3">
                <span class="relative flex items-center justify-center size-6 rounded-md bg-white/5 ring-1 ring-white/10">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <circle cx="10" cy="10" r="8" stroke="currentColor"></circle>
                        <path d="M6 11l2-2 2 2 3-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <h2 id="bonding-modal-title" class="text-lg sm:text-xl font-extrabold tracking-wide">BONDING</h2>
                <span class="js-badge text-[11px] font-semibold rounded-full px-2.5 py-0.5 bg-green-500/20 text-primary ring-1 ring-green-500/30">30</span>
            </div>
            <button type="button" class="js-close size-8 opacity-70 hover:opacity-100 transition" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="size-7 rounded-lg border border-white/10 bg-white/5 p-1">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>

        <div class="flex h-full w-full flex-col gap-6 overflow-y-auto">

            <div class="px-8 pt-2">
                <div class="grid grid-cols-2 gap-6 border-b border-white/10 pb-4">
                    <div>
                        <p class="text-[11px] uppercase tracking-wide text-white/60 font-semibold">Bond Price</p>
                        <p class="js-bond-price text-md font-bold mt-1">$37.91</p>
                    </div>
                    <div>
                        <p class="text-[11px] uppercase tracking-wide text-white/60 font-semibold">Market Price of a Bond</p>
                        <p class="js-market-price text-md font-bold mt-1">$38.56</p>
                    </div>
                </div>
            </div>

            <div class="px-8">
                <div class="flex items-center justify-between mb-2">
                    <label class="text-sm font-bold">Purchase Amount</label>
                </div>

                <div class="relative overflow-hidden flex h-10 items-center rounded-[16px] bg-[#15181d] border px-3 border-white/10 focus-within:ring-1 focus-within:ring-primary">
                    <input class="min-w-0 flex-1 border-0 bg-transparent py-2 text-sm outline-none ring-0 ring-offset-0 placeholder:text-white/50 pr-[74px] sm:pr-[86px]"
                           placeholder="USDT" type="text" inputmode="decimal">
                    <button type="button"
                        class="absolute right-1 top-1/2 -translate-y-1/2 h-[26px] sm:h-[28px] w-[56px] sm:w-[64px] rounded-[12px] border border-white/15 bg-white/5 px-3 text-xs transition hover:bg-white/10">
                        Max
                    </button>
                </div>

                <div class="mt-3 text-xs space-y-1">
                    <div class="text-white/80">Your balance : <span class="font-medium">0 USDT</span></div>
                    <div class="text-white/60">Slippage: <span class="font-medium">0.5%</span></div>
                </div>

                <button type="button"
                    class="mt-5 inline-flex h-10 w-full items-center justify-center rounded-2xl bg-primary px-4 text-sm font-semibold text-black shadow-xs transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60"
                    disabled title="Sign in required">
                    Sign In Required
                </button>
            </div>

            <div class="px-8 pb-8">
                <div class="border-t border-white/10 pt-5">
                    <h3 class="mb-3 text-sm font-bold tracking-wide">Attention:</h3>
                    <ol class="list-decimal list-inside space-y-1 text-sm text-white/70">
                        <li>First-time use requires a signature to authorize the transaction.</li>
                        <li>When creating an LP Bond with USDT, the contract will automatically execute the transaction.</li>
                        <li>Upon successful purchase, the tokens will be automatically staked.</li>
                        <li>The purchased tokens will be linearly vested based on the selected purchase cycle and can be
                            claimed at any time.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <script>
 (() => {
  const tabsRoot = document.getElementById('staking-tabs');
  if (tabsRoot) {
    const buttons = tabsRoot.querySelectorAll('[data-tab-btn]');
    const panes = tabsRoot.querySelectorAll('[data-tab-pane]');
    const activeClasses   = ['border-primary', 'bg-primary/10', 'text-primary', 'shadow-sm']; // fixed
    const inactiveClasses = ['border-transparent', 'text-white/70'];

    const setActive = (name) => {
      panes.forEach(p => p.classList.toggle('hidden', p.dataset.tabPane !== name));
      buttons.forEach(btn => {
        const on = btn.dataset.tabBtn === name;
        btn.setAttribute('aria-selected', on ? 'true' : 'false');
        activeClasses.forEach(c => btn.classList.toggle(c, on));
        inactiveClasses.forEach(c => btn.classList.toggle(c, !on));
      });
    };
    buttons.forEach(btn => btn.addEventListener('click', () => setActive(btn.dataset.tabBtn)));
    setActive('list');
  }

  const modal = document.getElementById('stake-modal');
  const backd = document.getElementById('stake-backdrop');
  if (!modal || !backd) return;

  const openers = document.querySelectorAll('.js-open-stake');
  const closer  = modal.querySelector('.js-close');
  const badgeEl = modal.querySelector('.js-badge');
  let lastFocus = null;

  const openModal = ({ apy, period, badge }) => {
    lastFocus = document.activeElement;
    if (badgeEl) badgeEl.textContent = badge || '—';
    backd.classList.remove('hidden');
    modal.classList.remove('hidden');
    document.documentElement.classList.add('overflow-y-hidden');
    modal.focus({ preventScroll: true });
  };

  const closeModal = () => {
    modal.classList.add('hidden');
    backd.classList.add('hidden');
    document.documentElement.classList.remove('overflow-y-hidden');
    if (lastFocus && lastFocus.focus) lastFocus.focus();
  };

  openers.forEach(btn => {
    btn.addEventListener('click', () => openModal({
      apy: btn.getAttribute('data-apy'),
      period: btn.getAttribute('data-period'),
      badge: btn.getAttribute('data-badge')
    })); 
  });

  closer.addEventListener('click', closeModal);
  backd.addEventListener('click', closeModal);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
  });
})();
    </script>
@endsection
