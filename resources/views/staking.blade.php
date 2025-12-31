@extends('app')

@section('content')
    <section class="min-h-screen py-8">
        <div class="container mx-auto px-4">

            <div class="rounded-lg bg-tittlecard py-6 shadow-sm border-none">
                <div class="flex w-full flex-col gap-4 px-6 sm:flex-row sm:justify-between">
                    <div class="flex w-full flex-col items-start gap-1.5">
                        <div class="flex w-full flex-row items-center gap-3">
                            <img alt="stake" loading="lazy" width="50" height="50" decoding="async"
                                class="w-10 h-10  invert" src="{{ asset('images/stake.svg') }}" />
                            <h1 class="text-xl text-white font-bold tracking-normal sm:text-3xl">Staking</h1>
                        </div>
                        <p class="text-subtext text-base text-muted">Earn reward when you stake your RTX</p>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="grid grid-cols-1 gap-0 sm:gap-3 md:grid-cols-3">
                    <div
                        class="rounded-lg flex flex-col gap-4 bg-card py-5 text-card-foreground shadow-sm col-span-1 pb-0 sm:py-5">
                        <div class="flex flex-col gap-2 px-3.5 sm:px-6">
                            <p class="text-xs font-medium text-muted sm:text-sm">Highest APY</p>
                            <div class="font-bold text-primary text-base sm:text-xl">3122.20%</div>
                        </div>
                    </div>
                    <div
                        class="rounded-lg flex flex-col gap-4 bg-card py-5 text-card-foreground shadow-sm col-span-1 sm:py-5 md:col-span-2">
                        <div class="grid grid-cols-2 px-4 sm:px-6 md:gap-2">
                            <div class="flex flex-col items-start gap-2 py-3 sm:gap-2 md:py-0">
                                <p class="text-xs font-medium text-muted sm:text-sm">Total staked RTX</p>
                                <div class="font-bold text-base sm:text-xl">865,543.42 RTX</div>
                            </div>
                            <div class="flex flex-col items-start gap-2 py-3 sm:gap-2 md:py-0">
                                <p class="text-xs font-medium text-muted sm:text-sm">Total Staked RTX Value</p>
                                <div class="font-bold text-base sm:text-xl">$33,372,647.62</div>
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
                                    class="h-10 rounded-2xl text-sm font-bold transition-colors px-3 py-1 border border-primary bg-primary/10 text-primary shadow-sm">
                                    Staking List
                                </button>
                                <button type="button" data-tab-btn="mine" aria-selected="false"
                                    class="h-10 rounded-2xl text-sm font-bold transition-colors px-3 py-1 border border-transparent text-white/70 hover:text-white">
                                    My Staking
                                </button>
                            </div>
                        </div>

                        <div data-tab-pane="list" class="relative w-full overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-700 border-white/10 text-sm font-normal text-white/60">
                                        <th class="px-2 py-3 text-left font-medium text-white">Staking:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Period:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">APY:</th>
                                        <th class="px-2 py-3 text-left font-medium text-white">Total Staked RTX:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-700 border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                    <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                        src="{{ asset('images/dexlogo.webp') }}">
                                                </span>
                                                <span class="font-semibold text-white">Staked RTX</span>
                                                <span
                                                    class="rounded-full bg-black-500/20 px-2 py-[1px] text-md font-semibold text-amber-300 ring-1 ring-amber-500/30">0</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">None</td>
                                        <td class="p-2 text-white">759.56%</td>
                                        <td class="p-2 text-white">39,073.790</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="759.56%" data-period="0 Days" data-badge="0">
                                                Stake
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-700 border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                    <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                        src="{{ asset('images/dexlogo.webp') }}">
                                                </span>
                                                <span class="font-semibold text-white">Staked RTX</span>
                                                <span
                                                    class="rounded-full bg-black-500/20 px-2 py-[1px] text-md font-semibold text-amber-300 ring-1 ring-amber-500/30">30</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">30</td>
                                        <td class="p-2 text-white">1,001.22%</td>
                                        <td class="p-2 text-white">57,246.520</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="1,001.22%" data-period="30 Days" data-badge="30">
                                                Stake
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b  border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                    <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                        src="{{ asset('images/dexlogo.webp') }}">
                                                </span>
                                                <span class="font-semibold text-white">Staked RTX</span>
                                                <span
                                                    class="rounded-full bg-black-500/20 px-2 py-[1px] text-md font-semibold text-amber-300 ring-1 ring-amber-500/30">90</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">90</td>
                                        <td class="p-2 text-white">1,505.09%</td>
                                        <td class="p-2 text-white">10,031.490</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="1,505.09%" data-period="90 Days" data-badge="90">
                                                Stake
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-700 border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                    <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                        src="{{ asset('images/dexlogo.webp') }}">
                                                </span>
                                                <span class="font-semibold text-white">Staked RTX</span>
                                                <span
                                                    class="rounded-full bg-black-500/20 px-2 py-[1px] text-md font-semibold text-amber-300 ring-1 ring-amber-500/30">180</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">180</td>
                                        <td class="p-2 text-white">2,091.05%</td>
                                        <td class="p-2 text-white">9,096.020</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="2,091.05%" data-period="180 Days" data-badge="180">
                                                Stake
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-gray-700 border-white/10">
                                        <td class="p-2 py-3">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                    <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                        src="{{ asset('images/dexlogo.webp') }}">
                                                </span>
                                                <span class="font-semibold text-white">Staked RTX</span>
                                                <span
                                                    class="rounded-full bg-black-500/20 px-2 py-[1px] text-md font-semibold text-amber-300 ring-1 ring-amber-500/30">360</span>
                                            </div>
                                        </td>
                                        <td class="p-2 text-white">360</td>
                                        <td class="p-2 text-white">3,119.24%</td>
                                        <td class="p-2 text-white">750,095.600</td>
                                        <td class="p-2 text-right">
                                            <button type="button"
                                                class="js-open-stake h-8 rounded-[12px] bg-primary px-4 text-md text-white shadow-xs transition hover:bg-primary/90"
                                                data-apy="3,119.24%" data-period="360 Days" data-badge="360">
                                                Stake
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div data-tab-pane="mine" class="hidden">
                            <div class="relative w-full overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-gray-700  text-white/60">
                                            <th></th>
                                            <th class="px-2 py-3 text-left text-white">Total Capital</th>
                                            <th class="px-2 py-3 text-left text-white">Total Reward</th>
                                            <th class="px-2 py-3 text-left text-white">Release Countdown</th>
                                            <th class="px-2 py-3 text-left text-white">Unstakable</th>
                                            <th class="px-2 py-3 text-left text-white">Claimable</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-700">
                                            <td class="px-2 py-3">
                                                <div class="flex items-center gap-3">
                                                    <span
                                                        class="inline-block h-6 w-6 overflow-hidden rounded-full ring-1 ring-white/10">
                                                        <img alt="RTX" width="24" height="24" class="h-6 w-6 object-cover"
                                                             src="{{ asset('images/dexlogo.webp') }}" >
                                                    </span>
                                                    <span class="font-semibold text-white">Staked RTX</span>
                                                    <span
                                                        class="rounded-full bg-amber-500/20 px-2 py-[2px] text-md font-semibold text-primary ring-1 ring-amber-500/30">0</span>
                                                </div>
                                            </td>
                                            <td class="px-2 py-3 text-white">2.587 RTX</td>
                                            <td class="px-2 py-3 text-white">0.000 RTX</td>
                                            <td class="px-2 py-3 text-white">
                                                <div class="flex items-center gap-2">
                                                    <span>11 hrs : 59 min</span>
                                                    <button
                                                        class="js-open-rebase inline-flex h-6 w-6 items-center justify-center rounded-md bg-white/10 hover:bg-white/20"
                                                        type="button" aria-label="Rebasing history">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                                            <path d="M3 3v18h18" stroke="currentColor" stroke-width="2">
                                                            </path>
                                                            <path d="M7 15l3-3 3 3 4-5" stroke="currentColor"
                                                                stroke-width="2"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-2 py-3 text-white">3.000 RTX</td>
                                            <td class="px-2 py-3 text-white">0.053 RTX</td>
                                            <td class="px-2 py-3 text-right">
                                                <div class="flex gap-2">
                                                    <button
                                                        class="js-open-redeem rounded-md bg-primary  opacity-80 px-4 py-2 text-md text-black hover:bg-amber-600"
                                                        data-redeemable="3.000">Redeem</button>
                                                    <button
                                                        class="js-open-claim rounded-md bg-primary px-4 py-2 text-md text-black hover:bg-amber-500"
                                                        data-claimable="0.053493">Claim</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div id="stake-backdrop" class="fixed inset-0 z-[59] hidden bg-black/60"></div>

    <div id="stake-modal" role="dialog" aria-modal="true" aria-labelledby="staking-modal-title"
        class="hidden fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-3xl border-none bg-popupbg text-white shadow-lg duration-200 flex max-h-[100vh] w-[calc(100vw-1rem)] max-w-md flex-col gap-0 p-0 sm:max-w-lg"
        tabindex="-1">
        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="staking-modal-title"
                class="flex items-center gap-3 border-b border-gray-700 border-white/10 px-8 pb-2 pt-6 text-lg font-semibold leading-none tracking-tight">
                <span class="relative flex size-4 shrink-0 overflow-hidden">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="8" r="7" stroke="white" stroke-width="1.5" />
                        <path d="M5 9l2-2 2 2 2-3" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <span class="text-xl font-bold">Staking</span>
                <span
                    class="js-badge rounded-full border border-amber-500/20 bg-amber-500/20 px-2.5 py-0.5 text-[11px] font-semibold text-amber-300">0</span>
            </h2>
        </div>

        <div class="flex h-full w-full flex-col gap-5 overflow-y-auto">
            <div class="mx-8 grid grid-cols-2 gap-6 border-b border-gray-700 border-white/10 py-5">
                <div>
                    <h3 class="mb-2 text-xs text-white/60">APY</h3>
                    <p class="js-apy text-base font-bold">759.56%</p>
                </div>
                <div>
                    <span
                        class="mb-2 inline-block rounded px-2 py-0.5 text-[11px] font-semibold text-blue-300 bg-blue-500/20 ring-1 ring-blue-500/30">Vesting
                        Period</span>
                    <p class="js-period text-base font-bold">0 Days</p>
                </div>
            </div>

            <div class="mx-8 border-b border-gray-700 border-white/10 pb-2">
                <div class="flex-1 overflow-y-auto">
                    <div class="mb-4 space-y-3">
                        <label class="text-sm font-bold leading-none">Stake Amount</label>
                        <div class="space-y-2">
                            <div
                                class="flex h-10 items-center gap-2 rounded-[16px] px-4 pr-[4px] transition-all bg-[#15181d] border border-white/10 focus-within:ring-1 focus-within:ring-primary">
                                <input
                                    class="js-amount-input flex h-10 flex-1 border-0 bg-transparent py-2 text-sm outline-none ring-0 ring-offset-0 placeholder:text-white/50"
                                    placeholder="RTX" type="text" inputmode="decimal">
                                <button type="button"
                                    class="h-[28px] w-[64px] rounded-[12px] border border-white/15 bg-white/5 px-3 text-xs transition hover:bg-white/10">Max</button>
                            </div>
                        </div>
                        <div class="text-xs">
                            <div class="flex justify-start text-white/80"><span>Your balance :</span><span>&nbsp;0
                                    RTX</span></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="button"
                            class="inline-flex h-9 w-full items-center justify-center gap-2 rounded-2xl bg-primary px-4 py-2 text-sm font-semibold text-black shadow-xs transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60"
                            disabled title="Please sign in to continue">Sign In Required</button>
                    </div>
                </div>
            </div>

            <div class="mx-8 pb-8">
                <h3 class="mb-3 text-sm font-bold">Attention:</h3>
                <div class="space-y-1 text-sm text-white/70">
                    <p>1. First-time staking requires signature authorization</p>
                    <p>2. Transactions execute automatically for RTX staking</p>
                    <p>3. New stakes require warmup period before earning rewards</p>
                    <p>4. Rewards distributed every 12 hours and can be claimed anytime</p>
                    <p>5. Only 0 day period stake will not contribute to the RTX quota balance on My Account page.</p>
                </div>
            </div>
        </div>

        <button type="button"
            class="js-close absolute right-5 top-5 flex size-8 opacity-70 transition-opacity hover:opacity-100"
            aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="size-7 rounded-lg border border-white/10 bg-white/5 p-1">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
        </button>
    </div>

    <div id="claim-modal" role="dialog" aria-modal="true" aria-labelledby="claim-title" aria-describedby="claim-desc"
        class="hidden fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-3xl border-none bg-popupbg text-white shadow-lg duration-200 flex max-h-[100vh] w-[calc(100vw-1rem)] max-w-md flex-col gap-0 p-0 sm:max-w-lg"
        tabindex="-1">

        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="claim-title"
                class="text-lg font-semibold leading-none tracking-tight flex items-center gap-3 border-b border-gray-700 px-8 pb-2 pt-6">
                <span class="relative flex items-center shrink-0 overflow-hidden size-4">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="text-white">
                        <g clip-path="url(#clip0)">
                            <path
                                d="M10 10c-.648 0-1.296-.115-1.8-.345L1.085 6.41C.759 6.262 0 5.83 0 5.012c0-.818.759-1.25 1.086-1.4L8.263.339c.989-.453 2.482-.453 3.471 0l7.181 3.272C19.241 3.76 20 4.193 20 5.012s-.759 1.25-1.086 1.4l-7.115 3.245c-.504.23-1.152.345-1.8.345Z"
                                fill="currentColor"></path>
                            <path
                                d="M18.912 8.597l-.726-.33-1.864.862-4.519 2.089c-.505.233-1.154.349-1.8.349s-1.295-.116-1.799-.349L3.68 9.129 1.817 8.267l-.732.332C.759 8.749 0 9.189 0 10.015c0 .826.759 1.267 1.085 1.417l7.116 3.285c.502.233 1.151.35 1.799.35s1.296-.117 1.8-.35l7.11-3.283C19.237 11.283 20 10.845 20 10.015c0-.83-.758-1.267-1.088-1.418Z"
                                fill="currentColor"></path>
                            <path
                                d="M18.912 13.657l-.726-.324-1.864.844-4.519 2.045c-.505.228-1.154.342-1.8.342s-1.295-.114-1.799-.342L3.68 14.175l-1.864-.842-.732.325C.759 13.806 0 14.238 0 15.047c0 .81.759 1.242 1.085 1.389l7.116 3.219c.502.227 1.153.346 1.799.346s1.296-.119 1.8-.346l7.112-3.217C19.236 16.289 20 15.86 20 15.047c0-.812-.758-1.241-1.088-1.39Z"
                                fill="currentColor"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="24" height="24" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                <span class="text-xl font-bold">Claim Reward</span>
            </h2>
        </div>

        <div class="flex h-full w-full flex-col gap-5 overflow-y-auto">
            <div>
                <div class="flex-1 overflow-y-auto px-8 py-5">
                    <div class="mb-4 space-y-3">
                        <label class="text-sm font-bold">Claim Amount</label>
                        <div
                            class="relative overflow-hidden flex h-10 items-center rounded-[16px] transition-all bg-[#15181d] border px-3 border-white/10 focus-within:ring-1 focus-within:ring-primary">
                            <input
                                class="js-claim-input min-w-0 flex-1 border-0 bg-transparent py-2 text-sm outline-none ring-0 ring-offset-0 placeholder:text-white/50 pr-[74px] sm:pr-[86px]"
                                placeholder="RTX" type="text" inputmode="decimal" value="">
                            <button type="button"
                                class="js-claim-max absolute right-1 top-1/2 -translate-y-1/2 h-[26px] sm:h-[28px] w-[56px] sm:w-[64px] rounded-[12px] border border-white/15 bg-white/5 px-3 text-xs transition hover:bg-white/10">Max</button>
                        </div>
                    </div>
                    <div id="claim-desc" class="text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-white/60">Claimable Reward</span>
                            <span class="js-claimable font-medium">0.000000 RTX</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 px-8 pb-1">
                    <button type="button" disabled
                        class="js-claim-submit inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all shadow-xs h-9 px-4 py-2 w-full rounded-2xl bg-white/10 text-white/40 cursor-not-allowed hover:bg-white/10"
                        title="Claim claim for this stake">Claim</button>
                </div>
            </div>

            <div class="mx-8 border-t border-white/10 pb-8 pt-5">
                <h3 class="mb-3 text-sm font-bold">Attention:</h3>
                <div class="text-sm text-white/70">
                    <div class="flex items-start gap-1.5"><span>1.</span><span>You can partially claim your available
                            amount.</span></div>
                    <div class="flex items-start gap-1.5"><span>2.</span><span>Claimed amounts will be transferred instantly
                            to your wallet.</span></div>
                    <div class="flex items-start gap-1.5"><span>3.</span><span>Remaining amounts will continue to vest until
                            maturity.</span></div>
                </div>
            </div>
        </div>

        <button type="button"
            class="js-claim-close absolute right-5 top-5 flex size-8 items-center justify-center opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-white/20 focus:ring-offset-2"
            aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="size-7 rounded-lg border border-white/10 bg-white/5 p-1">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
            <span class="sr-only">Close</span>
        </button>
    </div>

    <div id="redeem-modal" role="dialog" aria-modal="true" aria-labelledby="redeem-title" aria-describedby="redeem-desc"
        class="hidden fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-3xl border-none bg-popupbg text-white shadow-lg duration-200 flex max-h-[100vh] w-[calc(100vw-1rem)] max-w-md flex-col gap-0 p-0 sm:max-w-lg"
        tabindex="-1">

        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="redeem-title"
                class="text-lg font-semibold leading-none tracking-tight flex items-center gap-3 border-b border-gray-700 px-8 pb-2 pt-6">
                <span class="relative flex items-center shrink-0 overflow-hidden size-4">
                    <svg width="24" height="24" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="text-white">
                        <g clip-path="url(#clipRedeem)">
                            <path
                                d="M10 10c-.648 0-1.296-.115-1.8-.345L1.085 6.41C.759 6.262 0 5.83 0 5.012c0-.818.759-1.25 1.086-1.4L8.263.339c.989-.453 2.482-.453 3.471 0l7.181 3.272C19.241 3.76 20 4.193 20 5.012s-.759 1.25-1.086 1.4l-7.115 3.245c-.504.23-1.152.345-1.8.345Z"
                                fill="currentColor" />
                            <path
                                d="M18.912 8.597l-.726-.33-1.864.862-4.519 2.089c-.505.233-1.154.349-1.8.349s-1.295-.116-1.799-.349L3.68 9.129 1.817 8.267l-.732.332C.759 8.749 0 9.189 0 10.015c0 .826.759 1.267 1.085 1.417l7.116 3.285c.502.233 1.151.35 1.799.35s1.296-.117 1.8-.35l7.11-3.283C19.237 11.283 20 10.845 20 10.015c0-.83-.758-1.267-1.088-1.418Z"
                                fill="currentColor" />
                            <path
                                d="M18.912 13.657l-.726-.324-1.864.844-4.519 2.045c-.505.228-1.154.342-1.8.342s-1.295-.114-1.799-.342L3.68 14.175l-1.864-.842-.732.325C.759 13.806 0 14.238 0 15.047c0 .81.759 1.242 1.085 1.389l7.116 3.219c.502.227 1.153.346 1.799.346s1.296-.119 1.8-.346l7.112-3.217C19.236 16.289 20 15.86 20 15.047c0-.812-.758-1.241-1.088-1.39Z"
                                fill="currentColor" />
                        </g>
                        <defs>
                            <clipPath id="clipRedeem">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                <span class="text-xl font-bold">Redeem Capital</span>
            </h2>
        </div>

        <div class="flex h-full w-full flex-col gap-5 overflow-y-auto">
            <div>
                <div class="flex-1 overflow-y-auto px-8 py-5">
                    <div class="mb-4 space-y-3">
                        <label class="text-sm font-bold">Redeem Amount</label>
                        <div
                            class="relative overflow-hidden flex h-10 items-center rounded-[16px] transition-all bg-[#15181d] border px-3 border-white/10 focus-within:ring-1 focus-within:ring-primary">
                            <input
                                class="js-redeem-input min-w-0 flex-1 border-0 bg-transparent py-2 text-sm outline-none ring-0 ring-offset-0 placeholder:text-white/50 pr-[74px] sm:pr-[86px]"
                                placeholder="RTX" type="text" inputmode="decimal" value="">
                            <button type="button"
                                class="js-redeem-max absolute right-1 top-1/2 -translate-y-1/2 h-[26px] sm:h-[28px] w-[56px] sm:w-[64px] rounded-[12px] border border-white/15 bg-white/5 px-3 text-xs transition hover:bg-white/10">Max</button>
                        </div>
                    </div>
                    <div id="redeem-desc" class="text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-white/60">Redeemable Capital</span>
                            <span class="js-redeemable font-medium">0.000000 RTX</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 px-8 pb-1">
                    <button type="button" disabled
                        class="js-redeem-submit inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all shadow-xs h-9 px-4 py-2 w-full rounded-2xl bg-white/10 text-white/40 cursor-not-allowed hover:bg-white/10"
                        title="Redeem capital for this stake">Redeem</button>
                </div>
            </div>

            <div class="mx-8 border-t border-white/10 pb-8 pt-5">
                <h3 class="mb-3 text-sm font-bold">Attention:</h3>
                <div class="text-sm text-white/70">
                    <div class="flex items-start gap-1.5"><span>1.</span><span>You can partially claim your available
                            amount.</span></div>
                    <div class="flex items-start gap-1.5"><span>2.</span><span>Claimed amounts will be transferred instantly
                            to your wallet.</span></div>
                    <div class="flex items-start gap-1.5"><span>3.</span><span>Remaining amounts will continue to vest until
                            maturity.</span></div>
                </div>
            </div>
        </div>

        <button type="button"
            class="js-redeem-close absolute right-5 top-5 flex size-8 items-center justify-center opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-white/20 focus:ring-offset-2"
            aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="size-7 rounded-lg border border-white/10 bg-white/5 p-1">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
            <span class="sr-only">Close</span>
        </button>
    </div>

    <div id="rebase-modal"
        class="hidden fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-3xl bg-[#1f2125] text-white shadow-2xl ring-1 ring-white/10 w-[min(920px,92vw)]"
        role="dialog" aria-modal="true" aria-labelledby="rebase-title" tabindex="-1">
        <div class="relative flex items-center justify-center px-6 py-5 border-b border-white/10">
            <h3 id="rebase-title" class="text-xl font-semibold">Rebasing History</h3>
            <button
                class="js-rebase-close absolute right-4 inline-flex h-9 w-9 items-center justify-center rounded-md bg-white/5 hover:bg-white/10"
                aria-label="Close">✕</button>
        </div>
        <div class="max-h-[60vh] overflow-auto px-2 sm:px-4 py-2">
            <table class="w-full text-sm">
                <thead class="text-white/70">
                    <tr>
                        <th class="px-3 py-3 text-left font-medium">Date</th>
                        <th class="px-3 py-3 text-right font-medium">Current Asset</th>
                        <th class="px-3 py-3 text-right font-medium">Current Reward</th>
                    </tr>
                </thead>
                <tbody id="rebase-tbody">
                    <tr class="border-t border-white/10">
                        <td class="px-3 py-3">11 Sept 2025, 09:30</td>
                        <td class="px-3 py-3 text-right"><span class="font-semibold text-primary hover:underline">3.044512
                                RTX</span></td>
                        <td class="px-3 py-3 text-right">0.008981 RTX</td>
                    </tr>
                    <tr class="border-t border-white/10">
                        <td class="px-3 py-3">10 Sept 2025, 21:30</td>
                        <td class="px-3 py-3 text-right"><span class="font-semibold text-primary hover:underline">3.035557
                                RTX</span></td>
                        <td class="px-3 py-3 text-right">0.008955 RTX</td>
                    </tr>
                    <tr class="border-t border-white/10">
                        <td class="px-3 py-3">10 Sept 2025, 09:30</td>
                        <td class="px-3 py-3 text-right"><span class="font-semibold text-primary hover:underline">3.026628
                                RTX</span></td>
                        <td class="px-3 py-3 text-right">0.008929 RTX</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        (() => {
            const tabsRoot = document.getElementById('staking-tabs');
            if (tabsRoot) {
                const buttons = tabsRoot.querySelectorAll('[data-tab-btn]');
                const panes = tabsRoot.querySelectorAll('[data-tab-pane]');
                const active = ['border-primary', 'bg-primary/10', 'text-primary', 'shadow-sm'];
                const inactive = ['border-transparent', 'text-white/70'];
                const setActive = (name) => {
                    panes.forEach(p => p.classList.toggle('hidden', p.dataset.tabPane !== name));
                    buttons.forEach(btn => {
                        const on = btn.dataset.tabBtn === name;
                        btn.setAttribute('aria-selected', on ? 'true' : 'false');
                        active.forEach(c => btn.classList.toggle(c, on));
                        inactive.forEach(c => btn.classList.toggle(c, !on));
                    });
                };
                buttons.forEach(btn => btn.addEventListener('click', () => setActive(btn.dataset.tabBtn)));
                setActive('list');
            }

            const backd = document.getElementById('stake-backdrop');

            const utils = {
                fmt(n) { return !isFinite(n) ? '0.000000 RTX' : Number(n).toFixed(6) + ' RTX'; },
                sanitize(v) {
                    v = (v || '').toString().replace(/[^\d.]/g, '');
                    const parts = v.split('.');
                    if (parts.length > 2) v = parts[0] + '.' + parts.slice(1).join('');
                    return v;
                }
            };

            const stakeModal = document.getElementById('stake-modal');
            if (!backd || !stakeModal) return;

            const stakeOpeners = document.querySelectorAll('.js-open-stake');
            const stakeCloser = stakeModal.querySelector('.js-close');
            const apyEl = stakeModal.querySelector('.js-apy');
            const periodEl = stakeModal.querySelector('.js-period');
            const badgeEl = stakeModal.querySelector('.js-badge');
            let lastFocus = null;

            const openStake = ({ apy, period, badge }) => {
                lastFocus = document.activeElement;
                apyEl.textContent = apy || '—';
                periodEl.textContent = period || '—';
                badgeEl.textContent = badge || '—';
                backd.classList.remove('hidden');
                stakeModal.classList.remove('hidden');
                document.documentElement.classList.add('overflow-y-hidden');
                stakeModal.focus({ preventScroll: true });
            };
            const closeStake = () => {
                stakeModal.classList.add('hidden');
                backd.classList.add('hidden');
                document.documentElement.classList.remove('overflow-y-hidden');
                lastFocus?.focus?.();
            };

            stakeOpeners.forEach(btn => btn.addEventListener('click', () => {
                openStake({
                    apy: btn.getAttribute('data-apy'),
                    period: btn.getAttribute('data-period'),
                    badge: btn.getAttribute('data-badge')
                });
            }));
            stakeCloser.addEventListener('click', closeStake);

            const claimModal = document.getElementById('claim-modal');
            const claimOpeners = document.querySelectorAll('.js-open-claim');
            const claimClose = claimModal?.querySelector('.js-claim-close');
            const claimInput = claimModal?.querySelector('.js-claim-input');
            const claimMaxBtn = claimModal?.querySelector('.js-claim-max');
            const claimableEl = claimModal?.querySelector('.js-claimable');
            const claimSubmit = claimModal?.querySelector('.js-claim-submit');

            let claimLastFocus = null;
            let currentClaimable = 0;

            function validateClaim() {
                const raw = utils.sanitize(claimInput.value);
                const amt = parseFloat(raw);
                const ok = !isNaN(amt) && amt > 0 && amt <= currentClaimable;
                claimSubmit.disabled = !ok;
                claimSubmit.classList.toggle('cursor-not-allowed', !ok);
                claimSubmit.classList.toggle('bg-white/10', !ok);
                claimSubmit.classList.toggle('text-white/40', !ok);
                claimSubmit.classList.toggle('bg-primary', ok);
                claimSubmit.classList.toggle('text-black', ok);
                claimSubmit.title = ok ? 'Claim now' : 'Enter a valid amount';
            }
            function openClaim(claimable) {
                claimLastFocus = document.activeElement;
                currentClaimable = Number(claimable) || 0;
                claimableEl.textContent = utils.fmt(currentClaimable);
                claimInput.value = '';
                validateClaim();
                backd.classList.remove('hidden');
                claimModal.classList.remove('hidden');
                document.documentElement.classList.add('overflow-y-hidden');
                claimModal.focus({ preventScroll: true });
            }
            function closeClaim() {
                claimModal.classList.add('hidden');
                backd.classList.add('hidden');
                document.documentElement.classList.remove('overflow-y-hidden');
                claimLastFocus?.focus?.();
            }

            claimOpeners.forEach(btn => btn.addEventListener('click', () => openClaim(btn.getAttribute('data-claimable') || '0')));
            claimClose?.addEventListener('click', closeClaim);
            claimInput?.addEventListener('input', () => { claimInput.value = utils.sanitize(claimInput.value); validateClaim(); });
            claimMaxBtn?.addEventListener('click', () => { claimInput.value = currentClaimable ? String(currentClaimable) : ''; validateClaim(); });
            claimSubmit?.addEventListener('click', () => { if (claimSubmit.disabled) return; alert(`Claiming ${parseFloat(claimInput.value || '0')} RTX`); closeClaim(); });

            const redeemModal = document.getElementById('redeem-modal');
            const redeemOpeners = document.querySelectorAll('.js-open-redeem');
            const redeemClose = redeemModal?.querySelector('.js-redeem-close');
            const redeemInput = redeemModal?.querySelector('.js-redeem-input');
            const redeemMaxBtn = redeemModal?.querySelector('.js-redeem-max');
            const redeemableEl = redeemModal?.querySelector('.js-redeemable');
            const redeemSubmit = redeemModal?.querySelector('.js-redeem-submit');

            let redeemLastFocus = null;
            let currentRedeemable = 0;

            function validateRedeem() {
                const raw = utils.sanitize(redeemInput.value);
                const amt = parseFloat(raw);
                const ok = !isNaN(amt) && amt > 0 && amt <= currentRedeemable;
                redeemSubmit.disabled = !ok;
                redeemSubmit.classList.toggle('cursor-not-allowed', !ok);
                redeemSubmit.classList.toggle('bg-white/10', !ok);
                redeemSubmit.classList.toggle('text-white/40', !ok);
                redeemSubmit.classList.toggle('bg-primary', ok);
                redeemSubmit.classList.toggle('text-black', ok);
                redeemSubmit.title = ok ? 'Redeem now' : 'Enter a valid amount';
            }
            function openRedeem(redeemable) {
                redeemLastFocus = document.activeElement;
                currentRedeemable = Number(redeemable) || 0;
                redeemableEl.textContent = utils.fmt(currentRedeemable);
                redeemInput.value = '';
                validateRedeem();
                backd.classList.remove('hidden');
                redeemModal.classList.remove('hidden');
                document.documentElement.classList.add('overflow-y-hidden');
                redeemModal.focus({ preventScroll: true });
            }
            function closeRedeem() {
                redeemModal.classList.add('hidden');
                backd.classList.add('hidden');
                document.documentElement.classList.remove('overflow-y-hidden');
                redeemLastFocus?.focus?.();
            }

            redeemOpeners.forEach(btn => btn.addEventListener('click', () => openRedeem(btn.getAttribute('data-redeemable') || '0')));
            redeemClose?.addEventListener('click', closeRedeem);
            redeemInput?.addEventListener('input', () => { redeemInput.value = utils.sanitize(redeemInput.value); validateRedeem(); });
            redeemMaxBtn?.addEventListener('click', () => { redeemInput.value = currentRedeemable ? String(currentRedeemable) : ''; validateRedeem(); });
            redeemSubmit?.addEventListener('click', () => { if (redeemSubmit.disabled) return; alert(`Redeeming ${parseFloat(redeemInput.value || '0')} RTX`); closeRedeem(); });

            const rebaseModal = document.getElementById('rebase-modal');
            const rebaseOpeners = document.querySelectorAll('.js-open-rebase');
            const rebaseClose = rebaseModal?.querySelector('.js-rebase-close');
            let rebaseLastFocus = null;

            function openRebase() {
                rebaseLastFocus = document.activeElement;
                backd.classList.remove('hidden');
                rebaseModal.classList.remove('hidden');
                document.documentElement.classList.add('overflow-y-hidden');
                rebaseModal.focus({ preventScroll: true });
            }
            function closeRebase() {
                rebaseModal.classList.add('hidden');
                backd.classList.add('hidden');
                document.documentElement.classList.remove('overflow-y-hidden');
                rebaseLastFocus?.focus?.();
            }

            rebaseOpeners.forEach(btn => btn.addEventListener('click', openRebase));
            rebaseClose?.addEventListener('click', closeRebase);

            backd.addEventListener('click', () => {
                if (!stakeModal.classList.contains('hidden')) closeStake();
                if (!claimModal?.classList.contains('hidden')) closeClaim();
                if (!redeemModal?.classList.contains('hidden')) closeRedeem();
                if (!rebaseModal?.classList.contains('hidden')) closeRebase();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key !== 'Escape') return;
                if (!stakeModal.classList.contains('hidden')) closeStake();
                if (!claimModal?.classList.contains('hidden')) closeClaim();
                if (!redeemModal?.classList.contains('hidden')) closeRedeem();
                if (!rebaseModal?.classList.contains('hidden')) closeRebase();
            });
        })();
    </script>
@endsection