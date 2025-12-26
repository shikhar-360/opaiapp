@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">
    <h2 class="text-lg font-semibold mb-4 text-slate-900 mt-1">Genealogy here</h2>

    <div
        class="relative p-4 md:p-6 rounded-2xl w-full mx-auto border border-slate-200 bg-white shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl overflow-hidden text-left transition-all duration-300 hover:shadow-[0_18px_45px_rgba(15,23,42,0.15)]"
    >
        {{-- soft glow background (same style as other cards) --}}
        <div class="absolute inset-0 opacity-70 pointer-events-none">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
        </div>

        <div class="relative overflow-x-auto">
            <div class="min-w-[900px]">

                {{-- Header Row --}}
                <div class="border-b border-slate-200 pb-2 mb-3">
                    <div class="flex items-center gap-2 text-[10px] md:text-xs uppercase tracking-[0.16em] text-slate-500">
                        <div class="w-32 md:w-44 shrink-0  text-[var(--theme-primary-text)] font-semibold tracking-wide">ID</div>
                        {{-- <div class="flex-1 text-center shrink-0 whitespace-nowrap text-[var(--theme-primary-text)] font-semibold tracking-wide">Rank </div> --}}
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-[var(--theme-primary-text)] font-semibold tracking-wide">Level</div>
                        <div class="flex-1 text-center text-[var(--theme-primary-text)] font-semibold tracking-wide">Date of Activation</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-[var(--theme-primary-text)] font-semibold tracking-wide">Total Team</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-[var(--theme-primary-text)] font-semibold tracking-wide">Total Directs</div>
                        <div class="flex-1 text-center text-[var(--theme-primary-text)] font-semibold tracking-wide">Total Team Investment ({{ $customer->appData->currency }})</div>
                        <div class="flex-1 text-center text-[var(--theme-primary-text)] font-semibold tracking-wide">Direct Team Investment ({{ $customer->appData->currency }})</div>
                        <div class="flex-1 text-center shrink-0 whitespace-nowrap text-[var(--theme-primary-text)] font-semibold tracking-wide">Self Investment</div>
                    </div>
                </div>

                {{-- Tree --}}
                <ul class="space-y-3 text-xs md:text-sm">
                    {{-- Start the recursive loop here --}}
                    @foreach($genealogyData as $rootUser)
                        @include('customer._tree_node', ['userNode' => $rootUser])
                    @endforeach
                </ul>

            </div>
        </div>

        <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-300)] to-transparent opacity-100"></div>
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
