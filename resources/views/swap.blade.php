@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section class="min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="mx-auto my-auto h-full w-full md:max-w-[500px]">
            <div class="overflow-hidden rounded-2xl border border-b border-[#ccaa7781] bg-tittlecard sm:rounded-4xl">
                <div class="z-50 p-6 sm:p-8">
                    <div class="mb-6 flex items-center justify-between sm:mb-8">
                        <div class="flex-1"></div>
                        <h2 class="text-lg font-semibold tracking-wide text-white">Swap</h2>
                        <div class="flex flex-1 justify-end">
                            <button
                                id="openSettingsBtn"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-md p-2 text-white/60 hover:bg-gray-900"
                                aria-label="Open settings"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="h-4 w-4">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- From -->
                    <div class="space-y-3 sm:space-y-4">
                        <label class="text-md font-medium text-white/60">From</label>
                        <div class="relative rounded-xl border border-[#ccaa7781] bg-card p-3 sm:rounded-2xl sm:p-4">
                            <div class="flex items-center justify-between">
                                <button class="flex items-center gap-3 rounded-xl transition-opacity hover:opacity-80" id="fromTokenBtn" type="button">
                                    <img src="{{ asset('images/usdt.svg') }}" id="fromIcon" alt="USDT" width="24" height="24" class="rounded-full" />
                                    <div class="flex items-center gap-1">
                                        <span id="fromSymbol" class="text-base font-semibold text-white">USDT</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="h-3 w-3 text-primary">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </div>
                                </button>

                                <input
                                    id="fromAmount"
                                    class="w-0 flex-1 bg-transparent text-right text-lg font-medium text-white placeholder:text-white/30 focus:outline-none sm:text-xl"
                                    type="number"
                                    inputmode="decimal"
                                    placeholder="0.0"
                                />
                            </div>

                            <div class="mt-3 flex items-center gap-2 text-md text-white/50">
                                <span>BSC Chain</span>
                                <button id="copyFromBtn" class="size-6 rounded-md p-0 hover:bg-accent" aria-label="Copy" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Middle swap button -->
                    <div class="my-6 flex items-center gap-3">
                        <div class="h-[1px] flex-1 bg-gray-600"></div>
                        <button
                            id="swapBtn"
                            class="group relative flex h-10 w-10 items-center justify-center rounded-full bg-[#11141B] transition-transform hover:scale-110"
                            aria-label="Swap tokens"
                            type="button"
                        >
                            <div class="absolute inset-0 rounded-full border border-white/10"></div>
                            <svg id="swapIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="h-4 w-4 text-primary transition-transform duration-300">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <div class="h-[1px] flex-1 bg-gray-600"></div>
                    </div>

                    <!-- To -->
                    <div class="space-y-3 sm:space-y-4">
                        <label class="text-md font-medium text-white/60">To</label>
                        <div class="rounded-xl border border-[#ccaa7781] bg-card p-3 sm:rounded-2xl sm:p-4">
                            <div class="flex items-center justify-between">
                                <button class="flex items-center gap-3 rounded-xl transition-opacity hover:opacity-80" id="toTokenBtn" type="button">
                                    <img id="toIcon" alt="RTX" src="{{ asset('images/dexlogo.webp') }}" width="24" height="24" class="rounded-full" />
                                    <div class="flex items-center gap-1">
                                        <span id="toSymbol" class="text-base font-semibold text-white">RTX</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="h-3 w-3 text-primary">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </div>
                                </button>

                                <input
                                    id="toAmount"
                                    class="w-0 flex-1 bg-transparent text-right text-lg font-medium text-white placeholder:text-white/30 focus:outline-none sm:text-xl"
                                    type="number"
                                    inputmode="decimal"
                                    placeholder="0.0"
                                />
                            </div>

                            <div class="mt-3 flex items-center gap-2 text-md text-white/50">
                                <span>BSC Chain</span>
                                <button id="copyToBtn" class="size-6 rounded-md p-0 hover:bg-accent" aria-label="Copy" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Connect -->
                    <div class="mt-8 space-y-3">
                        <div class="flex h-[48px]">
                            <button
                                id="connectBtn"
                                class="inline-flex h-full w-full items-center justify-center gap-2 rounded-2xl bg-primary px-4 py-2 font-bold text-black transition-all hover:scale-105 hover:bg-primary/90"
                                type="button"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="h-4 w-4">
                                    <path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/>
                                    <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/>
                                </svg>
                                <span>Connect</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== Settings (Slippage) Modal ===== -->
        <div id="slipBackdrop" class="fixed inset-0 z-[60] bg-black/60 backdrop-blur-sm hidden px-4"></div>

        <div id="slipWrapper" class="fixed inset-0 z-[70] grid place-items-center pointer-events-none hidden px-4" aria-hidden="true">
            <div id="slipModal"
                 role="dialog" aria-modal="true"
                 aria-labelledby="slip-title" aria-describedby="slip-desc" tabindex="-1"
                 data-state="closed"
                 class=" data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 w-full max-w-md sm:max-w-lg rounded-lg border-none bg-popupbg p-6 sm:p-8 text-white shadow-lg duration-200 relative pointer-events-auto">
                <div class="flex flex-col space-y-1.5 text-center sm:text-left">
                    <h2 id="slip-title" class="text-lg font-semibold leading-none tracking-tight">Slippage Settings</h2>
                    <p id="slip-desc" class="text-sm text-white/60">Adjust slippage tolerance for your swap</p>
                </div>

                <div class="mt-6 space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-white/60">Current Slippage:</span>
                        <div class="flex items-center gap-2">
                            <span id="slipCurrent" class="font-medium">0.5%</span>
                        </div>
                    </div>

                    <div class="h-px w-full bg-white/10"></div>

                    <div class="space-y-3">
                        <label class="text-sm font-medium text-white">Quick Select</label>
                        <div class="grid grid-cols-4 gap-2">
                            <button type="button" data-slip="0.1" class="slip-btn h-10 rounded-md px-3 text-sm font-medium transition border border-white/20 bg-white/10 text-white hover:bg-white/20">0.1%</button>
                            <button type="button" data-slip="0.25" class="slip-btn h-10 rounded-md px-3 text-sm font-medium transition border border-white/20 bg-white/10 text-white hover:bg-white/20">0.25%</button>
                            <button type="button" data-slip="0.5" class="slip-btn h-10 rounded-md px-3 text-sm font-medium transition bg-primary text-black">0.5%</button>
                            <button type="button" data-slip="1" class="slip-btn h-10 rounded-md px-3 text-sm font-medium transition border border-white/20 bg-white/10 text-white hover:bg-white/20">1%</button>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="custom-slippage" class="text-sm font-medium text-white">Custom Slippage (%)</label>
                        <div class="relative">
                            <input id="custom-slippage" min="0.1" max="5" step="0.01" placeholder="Enter custom slippage"
                                   class="h-9 w-full rounded-md border border-white/20 bg-white/5 px-2.5 py-2 pr-7 text-sm text-white placeholder:text-white/40 outline-none focus:ring-1 focus:ring-primary"
                                   type="number" value="">
                            <span class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 transform text-sm text-white/60">%</span>
                        </div>
                        <p class="text-xs text-white/50">Valid range: 0.1% - 5.0%. Higher values may result in unfavorable trades.</p>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" id="slipResetBtn" class="flex-1 h-9 rounded-md border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15">Reset to Default</button>
                        <button type="button" id="slipDoneBtn" class="flex-1 h-9 rounded-md bg-primary px-4 py-2 text-sm font-medium text-black transition hover:bg-primary/90 disabled:opacity-60">Done</button>
                    </div>
                </div>

                <button type="button" id="slipCloseBtn" class="absolute right-5 top-5 flex size-8 items-center justify-center opacity-70 transition-opacity hover:opacity-100" aria-label="Close slippage settings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-7 rounded-lg border border-white/10 bg-white/5 p-1" aria-hidden="true">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- ===== /Settings Modal ===== -->

    </div>
</section>

<script>
    // ---- State ----
    let slippage = 0.5;
    let flipped = false;

    const from = {
        symbolEl: document.getElementById('fromSymbol'),
        iconEl: document.getElementById('fromIcon'),
        amountEl: document.getElementById('fromAmount')
    };
    const to = {
        symbolEl: document.getElementById('toSymbol'),
        iconEl: document.getElementById('toIcon'),
        amountEl: document.getElementById('toAmount')
    };

    // default tokens (use asset() URLs)
    let fromToken = { symbol: 'USDT', icon: '{{ asset("images/usdt.svg") }}' };
    let toToken   = { symbol: 'RTX',  icon: '{{ asset("images/dexlogo.webp") }}' };

    // ---- Helpers ----
    const toaster = document.getElementById('toaster');
    function toast({ type = 'success', message = '' }) {
        const div = document.createElement('div');
        div.className = 'toast-enter rounded-lg border px-3 py-2 shadow-lg ' +
            (type === 'success' ? 'border-emerald-700 bg-emerald-900/40 text-emerald-200' :
                type === 'error' ? 'border-red-700 bg-red-900/40 text-red-200' :
                    'border-slate-700 bg-slate-800/60 text-slate-200');
        div.textContent = message;
        toaster?.appendChild(div);
        setTimeout(() => {
            div.style.opacity = '0';
            div.style.transform = 'translateY(-6px)';
            setTimeout(() => div.remove(), 150);
        }, 1800);
    }

    function render() {
        from.symbolEl.textContent = fromToken.symbol;
        from.iconEl.alt = fromToken.symbol;
        from.iconEl.src = fromToken.icon;

        to.symbolEl.textContent = toToken.symbol;
        to.iconEl.alt = toToken.symbol;
        to.iconEl.src = toToken.icon;

        const swapIcon = document.getElementById('swapIcon');
        swapIcon.style.transform = flipped ? 'rotate(180deg)' : 'rotate(0deg)';
    }

    async function copy(text) {
        try {
            await navigator.clipboard.writeText(text);
            toast({ type: 'success', message: 'Copied to clipboard ✓' });
        } catch {
            toast({ type: 'error', message: 'Copy failed. Try again.' });
        }
    }

    // ---- Events: swap, copy, connect ----
    document.getElementById('swapBtn').addEventListener('click', () => {
        flipped = !flipped;
        // swap tokens
        [fromToken, toToken] = [toToken, fromToken];
        // swap amounts
        [from.amountEl.value, to.amountEl.value] = [to.amountEl.value, from.amountEl.value];
        render();
    });

    document.getElementById('copyFromBtn').addEventListener('click', () => copy(fromToken.symbol + ' · BSC'));
    document.getElementById('copyToBtn').addEventListener('click', () => copy(toToken.symbol + ' · BSC'));

    document.getElementById('connectBtn').addEventListener('click', () => toast({ type: 'info', message: 'Wallet connect coming soon' }));

    // ---- Initial render ----
    render();

    // =======================
    // Slippage Modal Logic
    // =======================
    const slipBackdrop = document.getElementById('slipBackdrop');
    const slipWrapper  = document.getElementById('slipWrapper');
    const slipModal    = document.getElementById('slipModal');
    const slipCurrent  = document.getElementById('slipCurrent');
    const slipBtns     = () => Array.from(document.querySelectorAll('.slip-btn'));
    const slipCustom   = document.getElementById('custom-slippage');
    const slipResetBtn = document.getElementById('slipResetBtn');
    const slipDoneBtn  = document.getElementById('slipDoneBtn');
    const slipCloseBtn = document.getElementById('slipCloseBtn');

    function openSlip() {
        slipModal.setAttribute('data-state', 'open');
        slipWrapper.classList.remove('hidden');
        slipBackdrop.classList.remove('hidden');
        slipWrapper.removeAttribute('aria-hidden');
        document.body.style.overflow = 'hidden';
        syncSlipUI();
        // focus first
        (slipCustom || slipModal).focus();
    }

    function closeSlip() {
        slipModal.setAttribute('data-state', 'closed');
        slipBackdrop.classList.add('hidden');
        slipWrapper.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        setTimeout(() => slipWrapper.classList.add('hidden'), 150);
    }

    function clamp(n, min, max) {
        return Math.max(min, Math.min(max, n));
    }

    function setSlippage(value, {fromCustom=false} = {}) {
        let v = Number(value);
        if (Number.isNaN(v)) return;
        v = clamp(v, 0.1, 5);
        slippage = Number(v.toFixed(2));
        syncSlipUI({fromCustom});
    }

    function syncSlipUI({fromCustom=false} = {}) {
        // Current text
        slipCurrent.textContent = slippage + '%';

        // Highlight quick buttons
        const activeVal = slippage;
        slipBtns().forEach(btn => {
            const val = Number(btn.dataset.slip);
            btn.classList.remove('bg-primary','text-black');
            btn.classList.remove('border','border-white/20','bg-white/10','text-white','hover:bg-white/20');
            // default style
            btn.classList.add('border','border-white/20','bg-white/10','text-white','hover:bg-white/20');
            if (Math.abs(val - activeVal) < 0.001) {
                btn.classList.remove('border','border-white/20','bg-white/10','text-white','hover:bg-white/20');
                btn.classList.add('bg-primary','text-black');
            }
        });

        // Custom field
        if (fromCustom) {
            // keep user's typed value visible (already set)
        } else {
            // if slippage not one of quick options, show in input; else clear it
            const isQuick = slipBtns().some(b => Math.abs(Number(b.dataset.slip) - activeVal) < 0.001);
            slipCustom.value = isQuick ? '' : String(activeVal);
        }
    }

    // Open/Close handlers
    document.getElementById('openSettingsBtn').addEventListener('click', openSlip);
    slipCloseBtn.addEventListener('click', closeSlip);
    slipBackdrop.addEventListener('click', closeSlip);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !slipWrapper.classList.contains('hidden')) {
            e.preventDefault();
            closeSlip();
        }
    });

    // Quick select
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.slip-btn');
        if (!btn) return;
        const val = Number(btn.dataset.slip);
        setSlippage(val);
    });

    // Custom input
    slipCustom.addEventListener('input', (e) => {
        const val = e.target.value;
        if (val === '') return; // ignore blank
        setSlippage(val, {fromCustom:true});
    });

    // Reset & Done
    slipResetBtn.addEventListener('click', () => {
        setSlippage(0.5);
        toast({ type: 'success', message: 'Slippage reset to 0.5%' });
    });

    slipDoneBtn.addEventListener('click', () => {
        toast({ type: 'success', message: `Slippage set to ${slippage}%` });
        closeSlip();
    });
</script>
@endsection
