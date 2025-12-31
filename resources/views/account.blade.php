@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
    <section class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="md:col-span-1">
                    <div class="flex flex-col items-center justify-center bg-card shadow-md rounded-md p-6 h-full">
                        <span class="relative flex shrink-0 overflow-hidden rounded-full border size-24 border-white/10">
                            <div aria-hidden="true"
                                class="mx-auto grid h-24 w-24 place-items-center rounded-full ring-2 ring-slate-800 shadow-[0_0px_14px_rgba(211,234,251)]">
                                <img alt="avatar" loading="lazy" width="50" height="50" decoding="async"
                                    src="{{ asset('images/01.webp') }}" />
                            </div>
                        </span>
                        <h1 class="mt-4 text-2xl font-bold">Guest</h1>
                    </div>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 auto-rows-fr">
                    <div class="h-full">
                        <div
                            class="rounded-lg flex flex-col border-none bg-card text-card-foreground shadow-sm col-span-1 h-full gap-3  border-0 py-4 sm:rounded-md sm:border sm:py-6 md:col-span-3">
                            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                <h3 class="text-subtext text-lg text-muted flex items-center">Reward Information</h3>
                            </div>
                            <div class="px-6 flex flex-col gap-3">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col items-start space-y-2 ">
                                        <p class="text-sm text-muted">Static Balance</p>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-2xl font-bold">0</p>
                                            <span
                                                class="inline-flex items-center justify-center  border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 border-primary/10 bg-primary/20 text-primary rounded-full">RTX</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-start space-y-2">
                                        <p class="text-sm text-muted">Dynamic Balance</p>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-2xl font-bold">0</p>
                                            <span
                                                class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 border-primary/10 bg-primary/20 text-primary rounded-full">RTX</span>
                                        </div>
                                    </div>

                                    <a data-open-modal="releaseModal"
                                        class="bg-[#ccaa77] hover:bg-[#d8ac6a] text-black col-span-2 w-full inline-flex items-center justify-center gap-2 h-9 rounded-2xl">
                                        <span class="mr-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="black"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.21739 3.19999H6.17391V0.533332C6.17391 0.391884 6.22888 0.256229 6.32673 0.156209C6.42457 0.0561902 6.55728 0 6.69565 0C6.83403 0 6.96673 0.0561902 7.06458 0.156209C7.16242 0.256229 7.21739 0.391884 7.21739 0.533332V3.19999ZM11.3913 7.70798V4.26666C11.3913 3.98376 11.2814 3.71245 11.0857 3.51241C10.89 3.31237 10.6246 3.19999 10.3478 3.19999H7.21739V7.24599L8.41348 6.02265C8.46195 5.9731 8.5195 5.93379 8.58284 5.90698C8.64617 5.88016 8.71405 5.86636 8.78261 5.86636C8.85116 5.86636 8.91904 5.88016 8.98238 5.90698C9.04572 5.93379 9.10326 5.9731 9.15174 6.02265C9.20021 6.07221 9.23867 6.13103 9.2649 6.19578C9.29113 6.26052 9.30464 6.32991 9.30464 6.39999C9.30464 6.47006 9.29113 6.53945 9.2649 6.6042C9.23867 6.66894 9.20021 6.72777 9.15174 6.77732L7.06478 8.91065C7.01633 8.96024 6.95879 8.99957 6.89545 9.02641C6.83211 9.05325 6.76422 9.06707 6.69565 9.06707C6.62709 9.06707 6.5592 9.05325 6.49586 9.02641C6.43252 8.99957 6.37498 8.96024 6.32652 8.91065L4.23956 6.77732C4.14167 6.67724 4.08667 6.54151 4.08667 6.39999C4.08667 6.25846 4.14167 6.12273 4.23956 6.02265C4.33746 5.92258 4.47024 5.86636 4.6087 5.86636C4.74715 5.86636 4.87993 5.92258 4.97783 6.02265L6.17391 7.24599V3.19999H3.04348C2.76673 3.19999 2.50132 3.31237 2.30563 3.51241C2.10994 3.71245 2 3.98376 2 4.26666V12.8C2 12.9414 2.05497 13.0771 2.15281 13.1771C2.25066 13.2771 2.38337 13.3333 2.52174 13.3333H7.39348C7.41435 13.378 7.43717 13.4226 7.46196 13.4666L7.47761 13.492L8.92935 15.7586C9.00511 15.877 9.12377 15.9598 9.25922 15.9887C9.39467 16.0177 9.53583 15.9904 9.65163 15.913C9.76743 15.8355 9.8484 15.7142 9.87671 15.5758C9.90502 15.4373 9.87837 15.293 9.80261 15.1746L8.35935 12.922C8.25704 12.7373 8.23069 12.5186 8.28609 12.3141C8.3415 12.1096 8.47412 11.9359 8.65478 11.8313C8.83545 11.7267 9.04935 11.6998 9.24945 11.7564C9.44954 11.8131 9.61943 11.9486 9.72174 12.1333C9.7263 12.142 9.73152 12.1506 9.73674 12.1586L10.4333 13.246C10.4948 13.342 10.585 13.4151 10.6905 13.4545C10.796 13.4939 10.911 13.4974 11.0186 13.4646C11.1262 13.4318 11.2206 13.3644 11.2878 13.2724C11.3549 13.1804 11.3912 13.0687 11.3913 12.954V9.06665C11.8831 9.53198 12.2758 10.0959 12.5451 10.7231C12.8144 11.3504 12.9544 12.0276 12.9565 12.7126V15.4666C12.9565 15.6081 13.0115 15.7437 13.1093 15.8438C13.2072 15.9438 13.3399 16 13.4783 16C13.6166 16 13.7493 15.9438 13.8472 15.8438C13.945 15.7437 14 15.6081 14 15.4666V12.71C13.997 11.722 13.7578 10.7497 13.3031 9.87793C12.8484 9.0061 12.1921 8.26116 11.3913 7.70798Z">
                                                </path>
                                            </svg>
                                        </span>
                                        Release
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-full">
                        <div
                            class="rounded-lg flex flex-col border-none bg-card text-card-foreground shadow-sm col-span-1 h-full gap-3   border-0 py-4 sm:rounded-md sm:border sm:py-6 md:col-span-2">
                            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                <h3 class=" text-subtext text-lg text-muted flex items-center">Balance Information</h3>
                            </div>
                            <div class="px-6 flex flex-col gap-4">
                                <div class="flex flex-col items-start space-y-2">
                                    <p class="text-sm text-muted">Released Balance</p>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="text-2xl font-bold">0</p>
                                        <span
                                            class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&>svg]:size-3 gap-1 [&>svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-[color,box-shadow] overflow-hidden border-primary/10 bg-primary/20 text-primary [a&]:hover:bg-primary/10 dRTX:border-primary/10 dRTX:bg-zinc-800 dRTX:text-primary dRTX:[a&]:hover:bg-zinc-700 rounded-full">RTX</span>
                                    </div>
                                </div>
                                <a href="{{ route('turbine-list') }}"
                                    class="bg-[#1ce968] hover:bg-[#16a34a] text-black inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dRTX:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-primary  shadow-xs hover:bg-primary/90 h-9 px-4 py-2 has-[>svg]:px-3 w-full rounded-2xl md:my-auto">
                                    <span class="mr-2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="16" height="16" id="icon-bound" fill="none"></rect>
                                            <path d="M10,1L3,9h4.5L6,15l7-8H8.5L10,1z"></path>
                                        </svg>
                                    </span>
                                    Turbine Entry
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <div
                            class="rounded-lg flex flex-col border-none bg-card text-card-foreground shadow-sm col-span-1 h-full gap-3  border-0 py-4 sm:rounded-md sm:border sm:py-6 md:col-span-5">
                            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                <h3 class=" text-subtext text-lg text-muted flex items-center gap-2">Release Quota Balance
                                </h3>
                            </div>
                            <div class="px-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col items-start space-y-2">
                                        <p class="text-sm text-muted">USDT Quota Balance</p>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-2xl font-bold">0</p>
                                            <span
                                                class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&>svg]:size-3 gap-1 [&>svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-[color,box-shadow] overflow-hidden border-primary/10 bg-primary/20 text-primary [a&]:hover:bg-primary/10 dRTX:border-primary/10 dRTX:bg-zinc-800 dRTX:text-primary dRTX:[a&]:hover:bg-zinc-700 rounded-full">USDT</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-start space-y-2">
                                        <p class="text-sm text-muted">RTX Quota Balance</p>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-2xl font-bold">0</p>
                                            <span
                                                class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&>svg]:size-3 gap-1 [&>svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-[color,box-shadow] overflow-hidden border-primary/10 bg-primary/20 text-primary [a&]:hover:bg-primary/10 dRTX:border-primary/10 dRTX:bg-zinc-800 dRTX:text-primary dRTX:[a&]:hover:bg-zinc-700 rounded-full">RTX</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="md:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div class="h-full">
                            <div
                                class="rounded-lg flex flex-col gap-4 border-none bg-card text-card-foreground shadow-sm col-span-1 h-fit  border-0 py-4 sm:rounded-md sm:border sm:py-6 md:col-span-3">
                                <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                    <h3 class="text-subtext text-lg flex items-center">Revenue Source Details</h3>
                                </div>
                                <div class="px-6">
                                    <div class="py-12">
                                        <div class="flex flex-col items-center justify-center text-center">
                                            <div class="mb-4 text-muted">
                                                <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                                    class="size-6" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z" />
                                                </svg>
                                            </div>
                                            <h3 class="mb-2 text-lg font-semibold">No revenue details available</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="h-full">
                            <div
                                class="rounded-base flex flex-col gap-4 bg-card text-card-foreground shadow-sm col-span-1 rounded-md  py-4 sm:py-6 md:col-span-3">
                                <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold">Release History</h3>
                                    </div>
                                </div>
                                <div class="px-6">
                                    <div class="space-y-4">
                                        <div class="rounded-lg border border-b border-gray-700 p-4">
                                            <div class="py-12">
                                                <div class="flex flex-col items-center justify-center text-center">
                                                    <div class="mb-4 text-muted">
                                                        <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                                            class="size-6" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z" />
                                                        </svg>
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-semibold">No release history available</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="releaseBackdrop" class="fixed inset-0 z-[60] bg-black/60 backdrop-blur-sm hidden"></div>

    <div id="releaseModalWrapper" class="fixed inset-0 z-[70] grid place-items-center pointer-events-none hidden"
        aria-hidden="true">
        <div id="releaseModal" role="dialog" aria-modal="true" aria-labelledby="release-modal-title" tabindex="-1"
            data-state="closed"
            class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0  max-h-[90vh] overflow-y-auto data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rounded-2xl border-none bg-popupbg shadow-lg duration-200 sm:max-w-lg flex w-[calc(100vw-1rem)] max-w-md flex-col gap-0 p-0 text-white sm:mx-4 pointer-events-auto">

            <div class="flex flex-col space-y-1.5 text-center sm:text-left">
                <h2 id="release-modal-title"
                    class="text-lg font-semibold leading-none tracking-tight flex items-center gap-3 border-b border-gray-700 px-8 pb-2 pt-6">
                    <span class="text-xl font-bold">Release</span>
                    <span
                        class="inline-flex items-center justify-center border px-3 py-0.5 text-xs font-medium w-fit whitespace-nowrap rounded-full border-primary/10 bg-zinc-800 text-primary hover:bg-zinc-700"
                        data-balance-chip>RTX • Static</span>
                </h2>
            </div>

            <div class="flex h-full w-full flex-col gap-5 overflow-y-auto">
                <div class="mx-8 grid grid-cols-2 gap-6 border-b border-gray-700  py-5">
                    <div>
                        <h3 class="mb-2 text-xs text-muted">Static Balance</h3>
                        <p class="text-base font-bold">0 RTX</p>
                    </div>
                    <div>
                        <h3 class="mb-2 text-xs text-muted">Dynamic Balance</h3>
                        <p class="text-base font-bold">0 RTX</p>
                    </div>
                </div>

                <div class="mx-8 border-b border-gray-700  pb-5">
                    <div class="mb-4">
                        <label class="flex select-none items-center gap-2 text-sm font-bold">Select Balance Type</label>
                        <div class="mt-2 flex gap-3" role="radiogroup" aria-label="Balance Type">
                            <button type="button" role="radio" aria-checked="true"
                                class="flex flex-col sm:flex-row items-center leading-none justify-center text-sm font-medium h-8 px-3 py-5 sm:py-2 flex-1 rounded-xl transition-all bg-primary text-black hover:bg-primary"
                                data-balance-type="static">Static
                                Balance <span class="ml-2 text-xs opacity-80">(0 RTX)</span></button>
                            <button type="button" role="radio" aria-checked="false"
                                class="flex flex-col sm:flex-row items-center leading-none justify-center text-sm font-medium h-8 px-3 py-5 sm:py-2 flex-1 rounded-xl transition-all border border-gray-600 bg-transparent text-white/90 hover:bg-zinc-800"
                                data-balance-type="dynamic">Dynamic
                                Balance <span class="ml-2 text-xs opacity-80">(0 RTX)</span></button>
                        </div>
                    </div>

                    <div class="mb-3 text-xs text-white/60" data-show-when="static">Using <strong>Static</strong> balance.
                    </div>
                    <div class="mb-3 text-xs text-white/60 hidden" data-show-when="dynamic">Using <strong>Dynamic</strong>
                        balance.</div>

                    <div class="mb-4">
                        <label class="flex select-none items-center gap-2 text-sm font-bold">Release Amount</label>
                        <div class="mt-2">
                            <div class="space-y-2">
                                <div
                                    class="flex items-center border ring-offset-background transition-all duration-300 ease-in-out h-10 px-4 gap-2 rounded-[16px] bg-background pr-[4px] border-b border-gray-700 focus-within:ring-1 focus-within:ring-[gray] focus-within:border-[gray] ">
                                    <input id="releaseAmountInput"
                                        class="flex w-full bg-transparent transition-colors file:border-0 file:bg-transparent file:font-medium placeholder:text-[#6f7972] focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50 h-10 text-sm flex-1 border-0 px-0 shadow-none ring-0 ring-offset-0 focus-visible:ring-0 focus-visible:shadow-none py-2"
                                        placeholder="RTX (Static)" type="number" value="">
                                    <div class="flex items-center justify-center text-sm">
                                        <button type="button"
                                            class="inline-flex items-center justify-center font-medium transition-all border border-gray-600 bg-input/30 hover:bg-input/50 gap-1.5 px-3 h-[28px] w-[64px] rounded-[12px] text-xs hover:text-white">Max</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="flex select-none items-center gap-2 text-sm font-bold">Release Period <span
                                class="text-xs font-normal">(Choose one)</span></label>
                        <div id="releasePeriodGroup" class="mt-2 flex flex-wrap gap-3">
                            <button type="button"
                                class="period-option rounded-2xl px-4 py-2 text-sm border border-[#ccaa77] text-green-300 bg-green-400/10"
                                data-period="0" aria-checked="true">0 day(s) <div class="text-xs opacity-90">(20% Burn)
                                </div></button>
                            <button type="button"
                                class="period-option rounded-2xl px-4 py-2 text-sm border border-gray-600 text-white/90 hover:bg-zinc-800"
                                data-period="10">10 day(s) <div class="te   xt-xs opacity-90">(15% Burn)</div></button>
                            <button type="button"
                                class="period-option rounded-2xl px-4 py-2 text-sm border border-gray-600 text-white/90 hover:bg-zinc-800"
                                data-period="20">20 day(s) <div class="text-xs opacity-90">(10% Burn)</div></button>
                            <button type="button"
                                class="period-option rounded-2xl px-4 py-2 text-sm border border-gray-600 text-white/90 hover:bg-zinc-800"
                                data-period="30">30 day(s) <div class="text-xs opacity-90">(5% Burn)</div></button>
                            <button type="button"
                                class="period-option rounded-2xl px-4 py-2 text-sm border border-gray-600 text-white/90 hover:bg-zinc-800"
                                data-period="60">60 day(s) <div class="text-xs opacity-90">(no Burn)</div></button>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm leading-relaxed text-muted" data-show-when="static">
                                *Once a withdrawal is initiated, the smart contract will purchase the equivalent of RTX
                                required for burning from the mRTXet and proceed to burn it. Please ensure you have an
                                equivalent amount of USDT in your wallet; otherwise, the transaction will fail.
                            </p>
                            <p class="text-sm leading-relaxed text-muted hidden" data-show-when="dynamic">
                                *Once a withdrawal is initiated, the smart contract will purchase the equivalent of BETH
                                required for burning from the mRTXet and proceed to burn it. Please ensure you have an
                                equivalent amount of USDT in your wallet; otherwise, the transaction will fail.
                            </p>
                        </div>

                        <div class="mb-4 rounded-lg border border-red-500/20 bg-red-500/10 p-3">
                            <p class="text-sm text-red-400">Wallet not found</p>
                        </div>

                        <div class="flex space-x-4 ">
                            <button
                                class="inline-flex items-center justify-center gap-2 text-sm font-medium transition-all disabled:pointer-events-none bg-primary text-black shadow-xs hover:bg-primary h-10 px-6 flex-1 rounded-xl"
                                disabled>
                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1039_163)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.5 7.99999C0.5 5.00924 0.5 3.51385 1.14308 2.40001C1.56437 1.67031 2.1703 1.06437 2.9 0.643076C4.01384 4.76838e-08 5.50923 0 8.5 0C11.4908 0 12.9862 4.76838e-08 14.1 0.643076C14.8297 1.06437 15.4356 1.67031 15.857 2.40001C16.5 3.51385 16.5 5.00924 16.5 7.99999C16.5 10.9908 16.5 12.4862 15.857 13.6C15.4356 14.3298 14.8297 14.9357 14.1 15.357C12.9862 16 11.4908 16 8.5 16C5.50923 16 4.01384 16 2.9 15.357C2.1703 14.9357 1.56437 14.3298 1.14308 13.6C0.5 12.4862 0.5 10.9908 0.5 7.99999ZM7.10232 9.35399L6.12426 8.37591C5.88995 8.14159 5.51005 8.14159 5.27574 8.37591C5.04142 8.61023 5.04142 8.99015 5.27574 9.22447L6.87574 10.8245C7.01835 10.967 7.22307 11.0285 7.42064 10.9879C7.61821 10.9474 7.78218 10.8103 7.85709 10.623C8.6224 8.70975 9.56736 7.58847 10.2951 6.95172C10.6602 6.6322 10.9742 6.43158 11.1891 6.31341C11.2966 6.25427 11.3795 6.21571 11.4316 6.1932C11.4577 6.18194 11.4761 6.17471 11.486 6.17093L11.4938 6.16801C11.8053 6.06148 11.9735 5.72329 11.8692 5.41044C11.7644 5.09607 11.4246 4.92617 11.1102 5.03096L11.1087 5.03148L11.107 5.03208L11.1027 5.03352L11.0917 5.0374C11.0831 5.04044 11.0723 5.0444 11.0593 5.04934C11.0333 5.05923 10.9986 5.07309 10.9559 5.09152C10.8705 5.12839 10.7534 5.18357 10.6109 5.26194C10.3258 5.41877 9.93976 5.66815 9.50488 6.04863C8.75376 6.70587 7.8671 7.74543 7.10232 9.35399Z"
                                            fill="#11141B"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1039_163">
                                            <rect width="16" height="16" fill="white" transform="translate(0.5)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Confirm Release
                            </button>

                            <button data-close-modal
                                class="inline-flex items-center justify-center gap-2 text-sm font-medium h-10 px-6 w-1/3 rounded-xl bg-white/5 hover:bg-white/10">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1039_167)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.643078 2.4C0 3.51385 0 5.00924 0 7.99999C0 10.9908 0 12.4862 0.643078 13.6C1.06437 14.3297 1.6703 14.9357 2.4 15.357C3.51384 16 5.00923 16 8 16C10.9908 16 12.4862 16 13.6 15.357C14.3297 14.9357 14.9356 14.3297 15.357 13.6C16 12.4862 16 10.9908 16 7.99999C16 5.00924 16 3.51385 15.357 2.4C14.9356 1.67031 14.3297 1.06437 13.6 0.643082C12.4862 -4.76838e-08 10.9908 0 8 0C5.00923 0 3.51384 -4.76838e-08 2.4 0.643082C1.6703 1.06437 1.06437 1.67031 0.643078 2.4ZM10.8567 6.04843C11.091 5.81411 11.091 5.43421 10.8567 5.1999C10.6224 4.96558 10.2426 4.96558 10.0082 5.1999L8 7.20807L5.99182 5.19986C5.75751 4.96554 5.37761 4.96554 5.1433 5.19986C4.90898 5.43418 4.90898 5.81407 5.1433 6.04839L7.1515 8.05663L5.19989 10.0082C4.96557 10.2426 4.96557 10.6225 5.19989 10.8568C5.4342 11.091 5.8141 11.091 6.04842 10.8568L8 8.90511L9.9516 10.8567C10.1859 11.091 10.5658 11.091 10.8002 10.8567C11.0345 10.6224 11.0345 10.2425 10.8002 10.0082L8.84856 8.05663L10.8567 6.04843Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1039_167">
                                            <rect width="16" height="16" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" data-close-modal
                    class="absolute right-5 top-5 flex size-8 opacity-70 hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        class="size-7 rounded-lg border border-white/10 bg-white/5 p-1" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        aria-hidden="true">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>

        <script>
            (function () {
                function els() {
                    return {
                        backdrop: document.getElementById('releaseBackdrop'),
                        wrapper: document.getElementById('releaseModalWrapper'),
                        modal: document.getElementById('releaseModal')
                    };
                }

                function openModal() {
                    const { backdrop, wrapper, modal } = els();
                    if (!backdrop || !wrapper || !modal) return;

                    modal.setAttribute('data-state', 'open');
                    wrapper.classList.remove('hidden');
                    backdrop.classList.remove('hidden');
                    wrapper.removeAttribute('aria-hidden');
                    document.body.style.overflow = 'hidden';

                    const first = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    (first || modal).focus();
                }

                function closeModal() {
                    const { backdrop, wrapper, modal } = els();
                    if (!backdrop || !wrapper || !modal) return;

                    modal.setAttribute('data-state', 'closed');
                    backdrop.classList.add('hidden');
                    wrapper.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                    setTimeout(() => wrapper.classList.add('hidden'), 200);
                }

                document.addEventListener('click', function (e) {
                    const openBtn = e.target.closest('[data-open-modal="releaseModal"]');
                    const closeBtn = e.target.closest('[data-close-modal]');
                    const { backdrop } = els();

                    if (openBtn) openModal();
                    if (closeBtn) closeModal();
                    if (backdrop && e.target === backdrop) closeModal();
                });

                document.addEventListener('keydown', function (e) {
                    const { wrapper } = els();
                    if (!wrapper || wrapper.classList.contains('hidden')) return;
                    if (e.key === 'Escape') {
                        e.preventDefault();
                        closeModal();
                    }
                });
            })();

            function setActivePeriod(targetBtn) {
                const all = document.querySelectorAll('.period-option');
                all.forEach(btn => {
                    const isActive = btn === targetBtn;
                    btn.setAttribute('aria-checked', isActive ? 'true' : 'false');
                    btn.classList.remove(
                        'border-green-400', 'text-green-300', 'bg-green-400/10',
                        'border-gray-600', 'text-white/90', 'hover:bg-zinc-800'
                    );
                    if (isActive) {
                        btn.classList.add('border-[#ccaa77]', 'text-primary', 'bg-black/10');
                    } else {
                        btn.classList.add('border-gray-600', 'text-white/90', 'hover:bg-zinc-800');
                    }
                });
            }

            (function initPeriodDefault() {
                const first = document.querySelector('.period-option[aria-checked="true"]')
                    || document.querySelector('.period-option');
                if (first) setActivePeriod(first);
            })();

            document.addEventListener('click', function (e) {
                const periodBtn = e.target.closest('.period-option');
                if (periodBtn) {
                    setActivePeriod(periodBtn);
                }
            });

            function setActiveBalanceType(targetBtn) {
                const group = document.querySelector('[role="radiogroup"][aria-label="Balance Type"]');
                if (!group) return;

                const buttons = group.querySelectorAll('[role="radio"]');
                const type = targetBtn?.dataset?.balanceType === 'dynamic' ? 'dynamic' : 'static';

                buttons.forEach(btn => {
                    const active = btn === targetBtn;
                    btn.setAttribute('aria-checked', active ? 'true' : 'false');
                    btn.classList.remove(
                        'bg-primary', 'text-black', 'hover:bg-primary',
                        'border', 'border-gray-600', 'bg-transparent', 'text-white/90', 'hover:bg-zinc-800'
                    );
                    if (active) {
                        btn.classList.add('bg-primary', 'text-black', 'hover:bg-primary');
                    } else {
                        btn.classList.add('border', 'border-gray-600', 'bg-transparent', 'text-white/90', 'hover:bg-zinc-800');
                    }
                });

                const modal = document.getElementById('releaseModal');
                if (modal) modal.dataset.balance = type;

                document.querySelectorAll('[data-show-when]').forEach(node => {
                    node.classList.toggle('hidden', node.getAttribute('data-show-when') !== type);
                });

                const chip = document.querySelector('[data-balance-chip]');
                if (chip) chip.textContent = `RTX • ${type.charAt(0).toUpperCase() + type.slice(1)}`;
                const amt = document.getElementById('releaseAmountInput');
                if (amt) amt.placeholder = `RTX (${type.charAt(0).toUpperCase() + type.slice(1)})`;
            }

            (function initBalanceTypeDefault() {
                const current = document.querySelector('[role="radiogroup"][aria-label="Balance Type"] [role="radio"][aria-checked="true"]')
                    || document.querySelector('[role="radiogroup"][aria-label="Balance Type"] [role="radio"]');
                if (current) setActiveBalanceType(current);
            })();

            document.addEventListener('click', (e) => {
                const btn = e.target.closest('[role="radiogroup"][aria-label="Balance Type"] [role="radio"]');
                if (btn) {
                    e.preventDefault();
                    setActiveBalanceType(btn);
                }
            });
        </script>
@endsection