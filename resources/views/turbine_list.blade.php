@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
    <section class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="relative col-span-1">
                    <div class="relative flex flex-col gap-4 rounded-lg  bg-card py-5  shadow-sm  ">
                        <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                            <div class="z-10 flex flex-col items-center gap-3 font-semibold leading-none">
                                <button type="button"
                                    class="flex items-center justify-center gap-2 font-medium hover:opacity-90 focus:outline-none"
                                    aria-label="Open Turbine FAQs" title="Turbine FAQs">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.20004 15.9467C4.01337 15.9467 3.86671 15.88 3.74671 15.8C3.36004 15.5333 3.26671 15.0267 3.48004 14.4267L5.73337 8H4.32004C4.15779 8.00234 3.99746 7.96463 3.85326 7.89021C3.70907 7.81578 3.58545 7.70695 3.49337 7.57333C3.30671 7.29333 3.29337 6.93333 3.44004 6.58667L5.89337 0.88C6.10671 0.373333 6.65337 0 7.18671 0H12.1334C12.48 0 12.7867 0.16 12.96 0.426667C13.0478 0.574633 13.0986 0.741644 13.1078 0.913452C13.1171 1.08526 13.0847 1.25676 13.0134 1.41333L10.24 6.66667H11.6934C12.1334 6.66667 12.4667 6.88 12.6134 7.22667C12.68 7.42667 12.7867 7.93333 12.16 8.53333L5.13337 15.4933C4.76004 15.84 4.44004 15.9467 4.20004 15.9467Z"
                                            fill="#ffffff"></path>
                                    </svg>
                                    <span>Turbine</span>
                                </button>
                                <p class="text-2xl font-bold text-primary">0 RTX</p>
                            </div>
                        </div>

                        <div class="z-10 mt-4 flex w-full flex-col space-y-2 px-6">
                            <div
                                class="flex items-center rounded-[14px] px-4 pr-[4px] h-11 transition-all border bg-background bg-bordercard focus-within:ring-1 focus-within:ring-green-400 focus-within:border-green-400">
                                <input
                                    class="flex h-11 w-full bg-transparent py-2 text-sm ring-0 ring-offset-0 placeholder:text-[#8a8f98] focus-visible:shadow-none focus-visible:outline-none"
                                    placeholder="RTX" type="text" value="1" />
                                <div class="flex items-center justify-center text-sm">
                                    <button type="button"
                                        class="h-[28px] w-[64px] rounded-[12px] border bg-bordercard bg-white/5 px-3 text-xs transition-all hover:bg-white/10">
                                        Max
                                    </button>
                                </div>
                            </div>
                            <div class="rounded-md border border-red-500/30 bg-red-500/10 px-3 py-1 text-xs text-red-400">
                                Balance: 0 RTX
                            </div>
                        </div>

                        <div class="z-10 px-6">
                            <div class="rounded-lg border border-gray-700 bg-white/5 p-4">
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="text-white/70">USDT Required:</span>
                                    <span class="font-semibold">38.56 USDT</span>
                                </div>
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="text-white/70">Your USDT Balance:</span>
                                    <span class="font-semibold">0.00 USDT</span>
                                </div>
                                <div
                                    class="mt-1 rounded-lg border border-red-500/20 bg-red-500/10 p-2 text-sm text-red-400">
                                    Insufficient USDT balance. You need 38.56 USDT more to proceed.
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center px-6">
                            <button type="button" disabled
                                class="bg-primary  text-black z-10 flex-1 rounded-xl h-10 px-6 has-[>svg]:px-4 inline-flex items-center justify-center gap-2 text-sm font-medium opacity-60 cursor-not-allowed">
                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1045_262)">
                                        <path
                                            d="M12.8636 1.45468H4.13636C3.65883 1.45468 3.18597 1.54874 2.74479 1.73148C2.3036 1.91423 1.90273 2.18208 1.56507 2.51975C0.883116 3.2017 0.5 4.12662 0.5 5.09104V10.9092C0.5 11.8736 0.883116 12.7986 1.56507 13.4805C1.90273 13.8182 2.3036 14.086 2.74479 14.2688C3.18597 14.4515 3.65883 14.5456 4.13636 14.5456H12.8636C13.3412 14.5456 13.814 14.4515 14.2552 14.2688C14.6964 14.086 15.0973 13.8182 15.4349 13.4805C15.7726 13.1429 16.0404 12.742 16.2232 12.3008C16.4059 11.8596 16.5 11.3868 16.5 10.9092V5.09104C16.5 4.61351 16.4059 4.14065 16.2232 3.69947C16.0404 3.25828 15.7726 2.85741 15.4349 2.51975C15.0973 2.18208 14.6964 1.91423 14.2552 1.73148C13.814 1.54874 13.3412 1.45468 12.8636 1.45468ZM5.59091 5.81832H9.65636L9.43818 5.60741C9.30123 5.47046 9.22429 5.28472 9.22429 5.09104C9.22429 4.99515 9.24318 4.90019 9.27988 4.81159C9.31658 4.72299 9.37037 4.64249 9.43818 4.57468C9.50599 4.50687 9.58649 4.45308 9.67509 4.41638C9.76369 4.37968 9.85864 4.3608 9.95454 4.3608C10.1482 4.3608 10.334 4.43773 10.4709 4.57468L11.9254 6.02922C12.0264 6.1315 12.0947 6.26137 12.1219 6.40245C12.1491 6.54353 12.1339 6.68951 12.0782 6.82195C12.0236 6.95477 11.931 7.06846 11.8119 7.1487C11.6928 7.22894 11.5527 7.27214 11.4091 7.27286H5.59091C5.39802 7.27286 5.21304 7.19624 5.07665 7.05985C4.94026 6.92346 4.86363 6.73847 4.86363 6.54559C4.86363 6.3527 4.94026 6.16772 5.07665 6.03133C5.21304 5.89494 5.39802 5.81832 5.59091 5.81832ZM11.4091 10.1819H7.34363L7.56182 10.3929C7.62998 10.4605 7.68409 10.5409 7.72101 10.6295C7.75793 10.7182 7.77694 10.8132 7.77694 10.9092C7.77694 11.0052 7.75793 11.1003 7.72101 11.1889C7.68409 11.2775 7.62998 11.358 7.56182 11.4256C7.49421 11.4938 7.41377 11.5479 7.32514 11.5848C7.23652 11.6217 7.14146 11.6407 7.04545 11.6407C6.94944 11.6407 6.85438 11.6217 6.76576 11.5848C6.67713 11.5479 6.5967 11.4938 6.52909 11.4256L5.07454 9.97104C4.97363 9.86877 4.90527 9.7389 4.87809 9.59781C4.85091 9.45673 4.86612 9.31076 4.92182 9.17831C4.97638 9.0455 5.06903 8.93181 5.1881 8.85157C5.30717 8.77132 5.44733 8.72812 5.59091 8.72741H11.4091C11.602 8.72741 11.787 8.80403 11.9233 8.94042C12.0597 9.07681 12.1364 9.26179 12.1364 9.45468C12.1364 9.64756 12.0597 9.83255 11.9233 9.96894C11.787 10.1053 11.602 10.1819 11.4091 10.1819Z"
                                            fill="#11141B"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1045_262">
                                            <rect width="16" height="16" fill="white" transform="translate(0.5)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                Turbine and Withdraw
                            </button>
                        </div>
                    </div>

                    <div class="absolute right-10 top-10 z-10 lg:right-6 lg:top-6">
                        <button id="openFaq" class="cursor-pointer" aria-label="Open Turbine FAQs" title="Turbine FAQs">
                            <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" class="size-4 rounded-full text-primary">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="col-span-2 space-y-2 sm:space-y-6 md:space-y-8">
                    <div
                        class="rounded-lg flex flex-col gap-4 border-none bg-card py-5 text-card-foreground shadow-sm col-span-2 border-0 px-0 sm:rounded-md sm:border sm:px-0">
                        <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                            <div class="font-semibold leading-none flex items-center justify-between w-full">
                                Turbine List
                                <button id="openHistory"
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-primary shadow-xs hover:bg-primary/90 h-9 px-4 py-2 has-[>svg]:px-3 rounded-lg">
                                    <svg width="16" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1728_1392)">
                                            <path
                                                d="M15.376 3.97131C17.5689 7.76887 16.2675 12.6251 12.47 14.818C9.30686 16.6435 5.41326 16.0461 2.93222 13.6051C2.71773 13.3941 2.59583 13.1066 2.59335 12.8057C2.59087 12.5049 2.708 12.2154 2.91899 12.0009C3.12997 11.7864 3.41751 11.6645 3.71837 11.662C4.01922 11.6595 4.30874 11.7766 4.52323 11.9876C5.41621 12.8654 6.57458 13.423 7.81767 13.5734C9.06076 13.7238 10.3187 13.4586 11.3952 12.8191C12.4718 12.1797 13.3065 11.2019 13.7691 10.0383C14.2317 8.87476 14.2962 7.59081 13.9526 6.38672C13.609 5.18263 12.8765 4.12611 11.8695 3.38194C10.8625 2.63776 9.6375 2.24777 8.3856 2.27279C7.13369 2.29781 5.92526 2.73643 4.94878 3.52025C3.97229 4.30406 3.28265 5.389 2.98742 6.60586L3.37912 6.50453C4.53004 6.20357 5.37848 7.57075 4.59658 8.4691L2.89517 10.4253C2.27056 11.143 1.06293 10.8987 0.812631 9.93685C0.376235 8.25507 0.503539 6.47656 1.17502 4.87408C1.8465 3.27159 3.02509 1.9336 4.53004 1.06529C8.32836 -1.12765 13.1838 0.173743 15.376 3.97131ZM8.50001 3.02607C8.78198 3.02609 9.05384 3.13112 9.26256 3.3207C9.47129 3.51027 9.60193 3.7708 9.629 4.05146L9.63429 4.16035V7.47169L11.192 9.02943C11.3986 9.23482 11.5182 9.51179 11.5261 9.80295C11.534 10.0941 11.4295 10.3772 11.2345 10.5934C11.0394 10.8097 10.7685 10.9427 10.4781 10.9647C10.1877 10.9868 9.89989 10.8963 9.67437 10.7119L9.58816 10.6341L7.6977 8.74359C7.51227 8.55814 7.39683 8.31417 7.37103 8.05319L7.36573 7.94128V4.16035C7.36573 3.85952 7.48524 3.57102 7.69796 3.3583C7.91067 3.14558 8.19918 3.02607 8.50001 3.02607Z"
                                                fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1728_1392">
                                                <rect width="16" height="16" fill="currentColor"
                                                    transform="translate(0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    Turbine History
                                </button>
                            </div>
                        </div>

                        <div class="px-6">
                            <div
                                class="hidden md:grid grid-cols-3 gap-4 border-b border-gray-700 pb-2 text-sm font-medium text-muted">
                                <span>Amount in Turbine</span>
                                <span>Turbine Countdown Timer</span>
                                <span class="text-right">Operate</span>
                            </div>
                            <div class="divide-y divide-gray-800"></div>
                            <div class="py-12">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="mb-4 text-muted">
                                        <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" class="size-6">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z" />
                                        </svg>
                                    </div>
                                    <h3 class="mb-2 text-lg font-semibold">No turbine list available</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="faqBackdrop" class="fixed inset-0 bg-black/40 z-[59] hidden"></div>
            <div id="historyBackdrop" class="fixed inset-0 bg-black/40 z-[59] hidden"></div>

            <div id="faqPopup" role="dialog" aria-modal="true" aria-labelledby="turbine-faqs-title" aria-hidden="true"
                class="hidden data-[state=open]:animate-in px-4 data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-lg border-none bg-popupbg shadow-lg duration-200 sm:max-w-lg flex max-h-[90vh] w-[calc(100vw-1rem)] max-w-2xl flex-col gap-0 p-0 text-white sm:mx-4 sm:w-full">
                <div class="flex flex-col space-y-1.5 text-center sm:text-left">
                    <h2 id="turbine-faqs-title"
                        class="text-lg font-semibold leading-none tracking-tight flex items-center gap-3 border-b border-gray-700 px-8 pb-2 pt-6">
                        <span class="text-xl font-bold">Turbine FAQs</span>
                    </h2>
                </div>
                <div class="flex h-full w-full flex-col gap-5 overflow-y-auto">
                    <div class="mx-8 pb-5 pt-5">
                        <div
                            class="rounded-base flex flex-col gap-6 border-none bg-card py-5 text-card-foreground shadow-sm rounded-3xl">
                            <div
                                class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6">
                                <div class="font-semibold flex items-center gap-2 text-sm">
                                    <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" class="size-4 text-white">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z">
                                        </path>
                                    </svg>
                                    Instructions
                                </div>
                            </div>
                            <div class="px-6 space-y-4">
                                <ul class="ml-4 space-y-3">
                                    <li class="flex items-start text-muted">
                                        <span class="mr-3 mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>
                                        <span>To withdraw released tokens, you must first purchase equivalent amount</span>
                                    </li>
                                    <li class="flex items-start text-muted">
                                        <span class="mr-3 mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>
                                        <span>After purchase, you can unlock the current period's deserved tokens</span>
                                    </li>
                                    <li class="flex items-start text-muted">
                                        <span class="mr-3 mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>
                                        <span>Increases mRTXet trading depth while promoting price support and protocol
                                            value recovery</span>
                                    </li>
                                    <li class="flex items-start text-muted">
                                        <span class="mr-3 mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>
                                        <span>Each turbine withdrawal has a 12-hour cooldown period</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <button id="closeFaq" type="button"
                    class="absolute right-5 top-5 flex size-8 opacity-70 transition-opacity hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="size-7 rounded-lg border border-white/10 bg-white/5 p-1" aria-hidden="true">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>

            <div id="historyPopup" role="dialog" aria-modal="true" aria-labelledby="turbine-history-title" aria-hidden="true"
                class="hidden data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed left-1/2 top-1/2 z-[60] -translate-x-1/2 -translate-y-1/2 rounded-lg border-none bg-popupbg shadow-lg duration-200 flex  max-h-[900px] w-[92vw] max-w-lg md:max-w-xl lg:max-w-2xl h-auto flex-col p-0 text-white">
                <div class="bg-transparent p-8 pb-0 text-center sm:text-left">
                    <h2 id="turbine-history-title" class="text-lg font-semibold leading-none tracking-tight flex items-center justify-center gap-2">
                        <span class="text-xl font-bold">Turbine History</span>
                    </h2>
                </div>
                <div class="mb-4 flex h-full w-full flex-col overflow-y-auto p-4">
                    <div class="py-12">
                        <div class="flex flex-col items-center justify-center text-center">
                            <div class="mb-4 text-muted">
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="size-6">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4184 0 8 0ZM8 4C8.21217 4 8.41566 4.08429 8.56569 4.23431C8.71571 4.38434 8.8 4.58783 8.8 4.8V8.8C8.8 9.01217 8.71571 9.21566 8.56569 9.36569C8.41566 9.51571 8.21217 9.6 8 9.6C7.78783 9.6 7.58434 9.51571 7.43431 9.36569C7.28429 9.21566 7.2 9.01217 7.2 8.8V4.8C7.2 4.58783 7.28429 4.38434 7.43431 4.23431C7.58434 4.08429 7.78783 4 8 4ZM8.8 11.2C8.8 10.9878 8.71571 10.7843 8.56569 10.6343C8.41566 10.4843 8.21217 10.4 8 10.4C7.78783 10.4 7.58434 10.4843 7.43431 10.6343C7.28429 10.7843 7.2 10.9878 7.2 11.2C7.2 11.4122 7.28429 11.6157 7.43431 11.7657C7.58434 11.9157 7.78783 12 8 12C8.21217 12 8.41566 11.9157 8.56569 11.7657C8.71571 11.6157 8.8 11.4122 8.8 11.2Z"></path>
                                </svg>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold">Please Sign In</h3>
                            <p class="mb-6 max-w-sm text-sm text-muted">Please sign in to continue</p>
                        </div>
                    </div>
                </div>

                <button id="closeHistory" type="button" class="absolute right-5 top-5 flex size-8 opacity-70 transition-opacity hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-7 rounded-lg border border-white/10 bg-white/5 p-1" aria-hidden="true">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openFaqBtn = document.getElementById('openFaq');
            const faqPopup   = document.getElementById('faqPopup');
            const closeFaqBtn= document.getElementById('closeFaq');
            const faqBackdrop= document.getElementById('faqBackdrop');

            function openFaq() {
                faqPopup.classList.remove('hidden');
                faqPopup.setAttribute('data-state', 'open');
                faqPopup.setAttribute('aria-hidden', 'false');
                faqBackdrop.classList.remove('hidden');
                closeFaqBtn?.focus({ preventScroll: true });
            }
            function closeFaq() {
                faqPopup.setAttribute('data-state', 'closed');
                faqPopup.setAttribute('aria-hidden', 'true');
                faqPopup.classList.add('hidden');
                faqBackdrop.classList.add('hidden');
                openFaqBtn?.focus({ preventScroll: true });
            }

            openFaqBtn?.addEventListener('click', openFaq);
            closeFaqBtn?.addEventListener('click', closeFaq);
            faqBackdrop?.addEventListener('click', closeFaq);

            const openHistoryBtn = document.getElementById('openHistory');
            const historyPopup   = document.getElementById('historyPopup');
            const closeHistoryBtn= document.getElementById('closeHistory');
            const historyBackdrop= document.getElementById('historyBackdrop');

            function openHistory() {
                historyPopup.classList.remove('hidden');
                historyPopup.setAttribute('data-state', 'open');
                historyPopup.setAttribute('aria-hidden', 'false');
                historyBackdrop.classList.remove('hidden');
                closeHistoryBtn?.focus({ preventScroll: true });
            }
            function closeHistory() {
                historyPopup.setAttribute('data-state', 'closed');
                historyPopup.setAttribute('aria-hidden', 'true');
                historyPopup.classList.add('hidden');
                historyBackdrop.classList.add('hidden');
                openHistoryBtn?.focus({ preventScroll: true });
            }

            openHistoryBtn?.addEventListener('click', openHistory);
            closeHistoryBtn?.addEventListener('click', closeHistory);
            historyBackdrop?.addEventListener('click', closeHistory);

            window.addEventListener('keydown', (e) => {
                if (e.key !== 'Escape') return;

                if (!faqPopup.classList.contains('hidden')) {
                    closeFaq();
                }
                if (!historyPopup.classList.contains('hidden')) {
                    closeHistory();
                }
            });
        });
    </script>
@endsection
