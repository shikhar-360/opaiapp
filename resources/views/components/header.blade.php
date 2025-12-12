<header class="fixed top-0 left-0 right-0 z-40">

    <div
        class="flex items-center justify-between px-4 md:px-8 py-4 sm:py-3 relative z-20
               bg-[#d8ebff]
               backdrop-blur-xl border-b border-slate-500 text-slate-900">

        {{-- LOGO + BRAND --}}
        <div class="flex items-center gap-2.5">
            <a href="{{ route('index') }}" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/opai.webp') }}" alt="OpAI Logo" class="w-12 md:w-12 h-auto">
                <span class="hidden sm:inline font-semibold text-sm md:text-2xl tracking-wide text-slate-900">
                    OpAi
                </span>
            </a>
        </div>

        {{-- RIGHT SIDE ACTIONS --}}
        <div class="flex items-center gap-2 md:gap-4">

            {{-- Connect Wallet --}}
            <button id="connectBtn"
                class="px-3 sm:px-5 py-2 flex items-center justify-center gap-2 text-base capitalize tracking-wide rounded-lg
                       border border-sky-200 bg-gradient-to-r from-sky-500 to-cyan-400
                       text-white font-semibold shadow-[0_8px_20px_rgba(56,189,248,.30)]
                       hover:shadow-[0_14px_28px_rgba(56,189,248,.45)]
                       transition-all duration-300 ease-out group">
                <span>Connect Wallet</span>
            </button>

            {{-- Mobile Menu Toggle --}}
            <button id="menuToggle"
                class="md:hidden p-2 rounded-lg bg-[#bfe7ff] hover:bg-slate-200
                       focus:outline-none focus:ring-2 focus:ring-slate-300 text-slate-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- SIDEBAR (Desktop + Mobile) --}}
 <aside id="sidebar"
    class="fixed top-[82px] md:top-[74px] left-0 bottom-0 w-60 md:w-64 aside-bg
           bg-[#F5F7FC] z-20 backdrop-blur-2xl border-r border-slate-500 text-black
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300 ease-out flex flex-col shadow-lg md:shadow-none">

    @php
        $baseItemClass = 'flex items-center gap-2.5 px-3 py-2 rounded-xl transition';
        $activeClass = 'bg-blue-50 text-sky-700 border border-blue-300 shadow-sm border-l-4 border-l-blue-500';
        $inactiveClass = 'text-slate-700 border border-transparent hover:bg-slate-300 hover:text-sky-600 hover:border-blue-100';
    @endphp

    <nav class="flex flex-col gap-0.5 w-full px-2.5 pt-6 text-sm md:text-[15px]">
        <p class="px-3 pb-1 text-[11px] uppercase tracking-[0.18em] text-slate-400">
            Menu
        </p>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="{{ $baseItemClass }} {{ Route::is('index') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('index') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1.5 rounded-lg">
                <img src="/assets/images/menu/dashboard.webp" width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Dashboard</span>
        </a>

        {{-- Profile --}}
        <a href="{{ route('profile') }}"
           class="{{ $baseItemClass }} {{ Route::is('profile') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('profile') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/profile.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Profile</span>
        </a>

        {{-- Pay By Dapp --}}
        {{-- <a href="{{ route('pay.dapp') }}"
           class="{{ $baseItemClass }} {{ Route::is('pay.dapp') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('pay.dapp') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/pay-by-dapp.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Pay By Dapp</span>
        </a> --}}

        {{-- Pay By QR --}}
        <a href="{{ route('pay.qr') }}"
           class="{{ $baseItemClass }} {{ Route::is('pay.qr') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('pay.qr') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1.5 rounded-lg">
                <img src="/assets/images/menu/pay-by-qr.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Pay By QR</span>
        </a>

        {{-- Pay By Topup --}}
        <a href="{{ route('pay.topup') }}"
           class="{{ $baseItemClass }} {{ Route::is('pay.topup') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('pay.topup') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/pay-by-topup.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Pay By Topup</span>
        </a>

        {{-- Directs --}}
        <a href="{{ route('directs') }}"
           class="{{ $baseItemClass }} {{ Route::is('directs') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('directs') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/directs.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Directs</span>
        </a>

        {{-- Team --}}
        <a href="{{ route('team') }}"
           class="{{ $baseItemClass }} {{ Route::is('team') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('team') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/team.webp" width="64" height="48" alt="Logo"
                     class="w-8 h-8 object-contain">
            </span>
            <span>Team</span>
        </a>

        {{-- Genealogy --}}
        <a href="{{ route('genealogy') }}"
           class="{{ $baseItemClass }} {{ Route::is('genealogy') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('genealogy') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/genealogy.webp" width="64" height="48" alt="Logo"
                     class="w-8 h-8 object-contain">
            </span>
            <span>Genealogy</span>
        </a>

        {{-- Overview --}}
        <a href="{{ route('overview') }}"
           class="{{ $baseItemClass }} {{ Route::is('overview') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('overview') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/overview.webp" width="64" height="48" alt="Logo"
                     class="w-8 h-8 object-contain">
            </span>
            <span>Overview</span>
        </a>

        {{-- Withdraw --}}
        <a href="{{ route('withdraw') }}"
           class="{{ $baseItemClass }} {{ Route::is('withdraw') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('withdraw') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/withdraw.webp" width="64" height="48" alt="Logo"
                     class="w-8 h-8 object-contain">
            </span>
            <span>Withdraw</span>
        </a>

        {{-- Tickets --}}
        <a href="{{ route('tickets') }}"
           class="{{ $baseItemClass }} {{ Route::is('tickets') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center {{ Route::is('tickets') ? 'bg-blue-100' : 'bg-[#bfe7ff]' }} p-1 rounded-lg">
                <img src="/assets/images/menu/tickets.webp" width="64" height="48" alt="Logo"
                     class="w-8 h-8 object-contain">
            </span>
            <span>Tickets</span>
        </a>

        {{-- Logout --}}
        <a href="{{ route('login') }}"
           class="{{ $baseItemClass }} text-red-500 hover:bg-red-50 hover:text-red-600 border border-transparent">
            <span class="inline-flex items-center justify-center bg-[#bfe7ff] p-1 rounded-lg">
                <img src="/assets/images/menu/logout.webp" width="64" height="48" alt="Logo"
                     class="w-7 h-7 object-contain">
            </span>
            <span>Logout</span>
        </a>
    </nav>
</aside>


    {{-- Overlay (Mobile) --}}
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden z-10">
    </div>

</header>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const menuToggle = document.getElementById('menuToggle');
    const closeOnClickEls = [sidebarOverlay, ...sidebar.querySelectorAll('a')];

    const openSidebar = () => {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('pointer-events-none');
        sidebarOverlay.classList.add('opacity-100');
    };

    const closeSidebar = () => {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('pointer-events-none');
        sidebarOverlay.classList.remove('opacity-100');
    };

    if (menuToggle) {
        menuToggle.addEventListener('click', openSidebar);
    }

    closeOnClickEls.forEach(el => {
        if (!el) return;
        el.addEventListener('click', closeSidebar);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
});
</script>
@endpush
