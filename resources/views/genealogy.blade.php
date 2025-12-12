@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">
    <h2 class="text-lg font-semibold mb-4 text-slate-900 mt-1">Genealogy</h2>

    <div
        class="relative p-4 md:p-6 rounded-2xl w-full mx-auto border border-slate-200 bg-white shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl overflow-hidden text-left transition-all duration-300 hover:shadow-[0_18px_45px_rgba(15,23,42,0.15)]"
    >
        {{-- soft glow background (same style as other cards) --}}
        <div class="absolute inset-0 opacity-70 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-sky-200/60 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
        </div>

        <div class="relative overflow-x-auto">
            <div class="min-w-[900px]">

                {{-- Header Row --}}
                <div class="border-b border-slate-200 pb-2 mb-3">
                    <div class="flex items-center gap-2 text-[10px] md:text-xs uppercase tracking-[0.16em] text-slate-500">
                        <div class="w-32 md:w-44 shrink-0  text-sky-700 font-semibold tracking-wide">ID</div>
                        {{-- <div class="flex-1 text-center shrink-0 whitespace-nowrap text-sky-700 font-semibold tracking-wide">Rank </div> --}}
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-sky-700 font-semibold tracking-wide">Level</div>
                        <div class="flex-1 text-center text-sky-700 font-semibold tracking-wide">Date of Activation</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-sky-700 font-semibold tracking-wide">Total Team</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-sky-700 font-semibold tracking-wide">Total Directs</div>
                        <div class="flex-1 text-center text-sky-700 font-semibold tracking-wide">Total Team Investment</div>
                        <div class="flex-1 text-center text-sky-700 font-semibold tracking-wide">Direct Team Investment</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-sky-700 font-semibold tracking-wide">Self Investment</div>
                    </div>
                </div>

                {{-- Tree --}}
                <ul class="space-y-3 text-xs md:text-sm">
                    {{-- 1st root user (no children) --}}
                    <li class="flex items-start gap-2">
                        <span class="mt-1 inline-flex h-5 w-5"></span> {{-- placeholder, no toggle --}}
                        <div class="flex-1">
                            <div
                                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                            >
                                <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                    <img src="/assets/images/opai.webp" alt=""
                                         class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                    <span class="font-medium text-slate-900 whitespace-nowrap">ee9970</span>
                                </div>
                                {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">1</div>
                                <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">-</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                            </div>
                        </div>
                    </li>

                    {{-- 2nd root user (has 3 children) --}}
                    <li class="flex items-start gap-2">
                        {{-- Toggle button --}}
                        <button
                            type="button"
                            class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full border border-sky-300 text-base md:text-lg leading-none bg-white text-sky-600 hover:bg-sky-50 flex-none shrink-0 shadow-sm"
                            data-toggle-node="node-d1ad93"
                        >
                            <span data-icon>-</span>
                        </button>

                        <div class="flex-1">
                            {{-- Main row --}}
                            <div
                                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                            >
                                <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                    <img src="/assets/images/opai.webp" alt=""
                                         class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                    <span class="font-medium text-slate-900 whitespace-nowrap">d1ad93</span>
                                </div>
                                {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">1</div>
                                <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">19-11-2025</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">5</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">3</div>
                                <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$4,000.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$1,100.00</div>
                            </div>

                            {{-- Children of d1ad93 --}}
                            <div id="node-d1ad93" class="mt-1 space-y-3 pl-4 border-l border-slate-200">

                                {{-- Child 1: 19d289 (has 2 children) --}}
                                <div class="flex items-start gap-2">
                                    <button
                                        type="button"
                                        class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full border border-sky-300 text-base md:text-lg leading-none bg-white text-sky-600 hover:bg-sky-50 flex-none shrink-0 shadow-sm"
                                        data-toggle-node="node-19d289"
                                    >
                                        <span data-icon>-</span>
                                    </button>

                                    <div class="flex-1">
                                        <div
                                            class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                                        >
                                            <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                                <img src="/assets/images/opai.webp" alt=""
                                                     class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                                <span class="font-medium text-slate-900 whitespace-nowrap">19d289</span>
                                            </div>
                                            {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">2</div>
                                            <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">2025-11-09 03:20:44</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">2</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">2</div>
                                            <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$2,000.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$1,000.00</div>
                                        </div>

                                        {{-- Grand-children of 19d289 (2 users) --}}
                                        <div id="node-19d289" class="mt-1 space-y-3 pl-4 border-l border-slate-200">
                                            {{-- 64fc68 --}}
                                            <div class="flex items-start gap-2">
                                                <span class="mt-1 inline-flex h-5 w-5"></span>
                                                <div class="flex-1">
                                                    <div
                                                        class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                                                    >
                                                        <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                                            <img src="/assets/images/opai.webp" alt=""
                                                                 class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                                            <span class="font-medium text-slate-900 whitespace-nowrap">64fc68</span>
                                                        </div>
                                                        {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">3</div>
                                                        <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">2025-11-09 03:26:22</div>
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                                        <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                                        <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                                        <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$1,000.00</div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Fce343 --}}
                                            <div class="flex items-start gap-2">
                                                <span class="mt-1 inline-flex h-5 w-5"></span>
                                                <div class="flex-1">
                                                    <div
                                                        class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                                                    >
                                                        <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                                            <img src="/assets/images/opai.webp" alt=""
                                                                 class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                                            <span class="font-medium text-slate-900 whitespace-nowrap">Fce343</span>
                                                        </div>
                                                        {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">3</div>
                                                        <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">2025-11-09 03:35:17</div>
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                                        <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                                        <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                                        <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                                        <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$1,000.00</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Child 2: 4e3d6c (no children) --}}
                                <div class="flex items-start gap-2">
                                    <span class="mt-1 inline-flex h-5 w-5"></span>
                                    <div class="flex-1">
                                        <div
                                            class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                                        >
                                            <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                                <img src="/assets/images/opai.webp" alt=""
                                                     class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                                <span class="font-medium text-slate-900 whitespace-nowrap">4e3d6c</span>
                                            </div>
                                            {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">2</div>
                                            <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">2025-11-09 03:37:05</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                            <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$1,000.00</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Child 3: EFC33d (no children) --}}
                                <div class="flex items-start gap-2">
                                    <span class="mt-1 inline-flex h-5 w-5"></span>
                                    <div class="flex-1">
                                        <div
                                            class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                                        >
                                            <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                                <img src="/assets/images/opai.webp" alt=""
                                                     class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                                <span class="font-medium text-slate-900 whitespace-nowrap">EFC33d</span>
                                            </div>
                                            {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">2</div>
                                            <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">2025-11-09 03:39:25</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                            <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$2,000.00</div>
                                        </div>
                                    </div>
                                </div>

                            </div> {{-- /#node-d1ad93 --}}
                        </div>
                    </li>

                    {{-- 3rd root user (no children) --}}
                    <li class="flex items-start gap-2">
                        <span class="mt-1 inline-flex h-5 w-5"></span>
                        <div class="flex-1">
                            <div
                                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
                            >
                                <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                                    <img src="/assets/images/opai.webp" alt=""
                                         class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                                    <span class="font-medium text-slate-900 whitespace-nowrap">d98ec4</span>
                                </div>
                                {{-- <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">No Rank</div> --}}
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">1</div>
                                <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">09-11-2025</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">0</div>
                                <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap">$0.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$0.00</div>
                                <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap">$2,000.00</div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-sky-300 to-transparent opacity-100"></div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-toggle-node]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetId = btn.getAttribute('data-toggle-node');
                const container = document.getElementById(targetId);
                if (!container) return;

                container.classList.toggle('hidden');

                const icon = btn.querySelector('[data-icon]');
                if (icon) {
                    icon.textContent = container.classList.contains('hidden') ? '+' : '-';
                }
            });
        });
    });
</script>
@endpush
