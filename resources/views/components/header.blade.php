<header class="fixed top-0 left-0 right-0 z-40">

    <div
        class="flex items-center justify-between px-4 md:px-8 py-4 sm:py-3 relative z-20
               bg-[var(--theme-header-bg)]
               backdrop-blur-xl border-b border-slate-500 text-slate-900">

        {{-- LOGO + BRAND --}}
        <div class="flex items-center gap-2.5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/opai.webp') }}" alt="OpAI Logo" class="w-12 md:w-12 h-auto">
                <span class="hidden sm:inline font-semibold text-sm md:text-2xl tracking-wide text-slate-900">
                                 <img src="{{ asset('assets/images/opai-text.webp') }}" alt="OpAI Logo" class="w-12 md:w-12 h-auto">
                </span>
            </a>
        </div>

        {{-- RIGHT SIDE ACTIONS --}}
        <div class="flex items-center gap-2 md:gap-4">
            <!-- @php
               $truncated_wa = '';
                $fullAddress = $customer->wallet_address??$genealogyData[0]['wallet_address']??''; // Define a local variable for clarity
                if (strlen($fullAddress) > 10) {
                    $start = substr($fullAddress, 0, 4);
                    $end = substr($fullAddress, -6); // Fix: use $fullAddress here
                    $truncated_wa = $start . '...' . $end;
                } else {
                    $truncated_wa = $fullAddress; // Use the full address if short
                } 
            @endphp -->
            {{-- Connect Wallet --}}
            <button id="connectBtn"
                class="px-3 sm:px-5 py-2 flex items-center justify-center gap-2 text-base capitalize tracking-wide rounded-lg cursor-pointer
                       border border-[var(--theme-skky-200)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                       text-white font-semibold 
                       hover:translate-y-[-4px]
                       transition-all duration-300 ease-out group">
                <span>#{{ $customer->referral_code }}</span>
            </button>

            {{-- Mobile Menu Toggle --}}
            <button id="menuToggle"
                class="md:hidden p-2 rounded-lg bg-[#bfdcff] hover:bg-slate-200
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
    class="fixed top-[82px] md:top-[74px] left-0 bottom-0 w-60 md:w-64 aside-bg overflow-y-auto
           bg-[var(--theme-bg)] z-20 backdrop-blur-2xl border-r border-slate-500 text-black
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300 ease-out flex flex-col shadow-lg md:shadow-none">

    @php
            $baseItemClass = 'flex items-center gap-2.5 px-2 py-2 rounded-xl transition font-semibold ';
            $activeClass = 'bg-blue-50 text-[var(--theme-primary-text)] border border-blue-300 shadow-sm border-l-4 border-l-[var(--theme-bllue-500)] ';
            $inactiveClass = 'text-slate-600 border border-transparent hover:bg-slate-300 hover:text-[var(--theme-high-text)] hover:border-blue-100';

            // Submenu open when any child active
            $isActivateOpen = Route::is('pay.topup') || Route::is('pay.qr') || Route::is('pay.dapp');
            $isCircleOpen   = Route::is('directs') || Route::is('team') || Route::is('genealogy');
            $isToolsOpen    = Route::is('promotion') || Route::is('levelcalculator') || Route::is('educare') || Route::is('tools');
    @endphp

        <nav class="flex flex-col gap-1 w-full px-2.5 pb-6 pt-6 text-sm md:text-[15px]">

<div class="flex flex-col items-start text-center gap-2 mb-2">

            <div class="flex  items-center gap-2 ">
                <div class="relative">
                    <div
      class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg overflow-hidden bg-white border border-slate-200 shadow-md
                            ring-1 ring-[var(--theme-skky-400)]/20">
                        <!-- <img id="profilePreview"
                            src="{{ asset('storage/' . $customer->profile_image) }}"
                            alt="Profile"
                            class="w-full h-full object-cover"> -->

                        @if ($customer->profile_image)
                            <img id="profilePreview" src="{{ asset('storage/' . $customer->profile_image) }}"
                            alt="Profile" class="w-full h-full object-cover">
                        @else
                            <img id="profilePreview" src="/assets/images/default-avatar.png" alt="Profile"
                            class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                <!-- Name -->
   <div>
 <h3 class="text-base sm:text-xl font-semibold text-slate-900 leading-tight text-left">
                    <span id="profileNameText">{{ $customer->name??'-' }}</span>
                </h3>
    <div class="flex items-center gap-2 justify-center mt-1">
            <span
    class="inline-flex items-center gap-2 rounded-xl bg-[var(--theme-skkky-50)]
                                       border border-[var(--theme-skky-200)] px-1 py-1 text-[11px] text-xs
                    font-medium text-[var(--theme-primary-text)]"> 
                @if($customer->leadership_rank == 1 || $customer->leadership_rank == 'gold')
                    <img src="{{ asset('assets/images/rank/gold-rank.webp?v=1') }}"
                    alt="Rank"
                    class="w-6 h-6 object-contain">
                @elseif($customer->leadership_rank == 2 || $customer->leadership_rank == 'sapphire')
                    <img src="{{ asset('assets/images/rank/sapphire-rank.webp?v=1') }}" 
                    alt="Rank"
                    class="w-6 h-6 object-contain">
                @elseif($customer->leadership_rank == 3 || $customer->leadership_rank == 'emerald')
                    <img src="{{ asset('assets/images/rank/emerald-rank.webp?v=1') }}" 
                    alt="Rank"
                    class="w-6 h-6 object-contain">
                @elseif($customer->leadership_rank == 4 || $customer->leadership_rank == 'ruby')
                    <img src="{{ asset('assets/images/rank/ruby-rank.webp?v=1') }}" 
                    alt="Rank"
                    class="w-6 h-6 object-contain">
                @elseif($customer->leadership_rank == 5 || $customer->leadership_rank == 'diamond')
                    <img src="{{ asset('assets/images/rank/diamond-rank.webp?v=1') }}" 
                    alt="Rank"
                    class="w-6 h-6 object-contain">
                @endif
       {{-- Rank: <span class="font-semibold">{{ $customer->leadership_rank??'-' }}</span>
            </span> --}}
  </span>

            <!-- VIP -->
            <span
    class="inline-flex items-center gap-2 rounded-xl bg-emerald-50 px-3 py-1
                                       text-[11px] text-xs font-medium text-emerald-700 border border-emerald-300">
                <span class="font-semibold text-slate-900">VIP {{ $customer->leadership_champions_rank??'-' }}</span>
            </span>
    </div>
                    </div>
   </div>

        </div>

        <p class="px-3 pb-1 text-[11px] uppercase tracking-[0.18em] text-slate-400">
            Menu
        </p>

        {{-- Profile --}}
        <a href="{{ route('profile') }}"
           class="{{ $baseItemClass }} {{ Route::is('profile') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/profile.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Profile</span>
        </a>

       {{-- Voting (Coming Soon) --}}
<a href="javascript:void(0)"
   class="{{ $baseItemClass }} {{ $inactiveClass }} cursor-not-allowed opacity-80 relative">

    <span class="inline-flex items-center justify-center rounded-lg">
        <img src="{{ asset('assets/images/menu/voting.webp?v=1') }}"
             width="64" height="48" alt="Logo"
             class="w-6 h-6 object-contain">
    </span>

    <span>My Voice</span>

    {{-- Coming Soon Badge --}}
    <span
        class="absolute top-3 right-4 bg-blue-500 text-white text-[10px] px-2 py-0.5 rounded-full">
        Coming Soon
    </span>
</a>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="{{ $baseItemClass }} {{ Route::is('dashboard') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/dashboard.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Dashboard</span>
        </a>
        {{-- Stats --}}
        <a href="{{ route('stats') }}"
            class="{{ $baseItemClass }} {{ Route::is('stats') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/stats.webp?v=1') }}" width="64" height="48" alt="Logo"
                        class="w-6 h-6 object-contain">
            </span>
            <span>Stats</span>
        </a>

        {{-- Activate Package (submenu) --}}
        <button type="button"
            class="{{ $baseItemClass }} {{ $isActivateOpen ? $activeClass : $inactiveClass }} w-full justify-between"
            data-submenu-toggle="activateMenu">
            <span class="flex items-center gap-2.5">
                <span class="inline-flex items-center justify-center  rounded-lg">
                    <img src="/assets/images/menu/pay-by-topup.webp" width="64" height="48" alt="Logo"
                            class="w-6 h-6 object-contain">
                </span>
                <span class="bank-g">Activate Membership</span>
            </span>

            <svg class="w-4 h-4 transition-transform {{ $isActivateOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
            </svg>
        </button>

        <div id="activateMenu" class="ml-4 mt-1 flex flex-col gap-1 {{ $isActivateOpen ? '' : 'hidden' }}">
            {{-- Pay By Topup --}}
            <a href="{{ route('pay.topup') }}"
                class="{{ $baseItemClass }} {{ Route::is('pay.topup') ? $activeClass : $inactiveClass }} px-2">
                <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/pay-by-topup.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
            </span>
                    <span class="text-xs font-semibold">Pay By Topup</span>
            </a>

            {{-- Pay By QR --}}
            <a href="{{ route('pay.qr') }}"
                class="{{ $baseItemClass }} {{ Route::is('pay.qr') ? $activeClass : $inactiveClass }} px-2">
                <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/pay-by-qr.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
            </span>
                <span class="text-xs font-semibold">Pay By QR</span>
            </a>
        </div>











            {{-- My Circle (submenu) --}}
            <button type="button"
                class="{{ $baseItemClass }} {{ $isCircleOpen ? $activeClass : $inactiveClass }} w-full justify-between"
                data-submenu-toggle="circleMenu">
                <span class="flex items-center gap-2.5">
                    <span class="inline-flex items-center justify-center   rounded-lg">
                        <img src="/assets/images/menu/directs.webp" width="64" height="48" alt="Logo"
                             class="w-6 h-6 object-contain">
                    </span>
                    <span class="bank-g">My Circle</span>
                </span>

                <svg class="w-4 h-4 transition-transform {{ $isCircleOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                </svg>
            </button>

            <div id="circleMenu" class="ml-4 mt-1 flex flex-col gap-1 {{ $isCircleOpen ? '' : 'hidden' }}">
                {{-- Core Circle --}}
                <a href="{{ route('directs') }}"
                   class="{{ $baseItemClass }} {{ Route::is('directs') ? $activeClass : $inactiveClass }} px-2">
                    <span class="inline-flex items-center justify-center   rounded-lg">
                        <img src="{{ asset('assets/images/menu/core-circle.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
                    </span>
                    <span class="text-xs font-semibold">Core Circle</span>
                </a>

                {{-- Team --}}
                <a href="{{ route('team') }}"
                   class="{{ $baseItemClass }} {{ Route::is('team') ? $activeClass : $inactiveClass }} px-2">
                   <span class="inline-flex items-center justify-center   rounded-lg">
                        <img src="{{ asset('assets/images/menu/team.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
                    </span>
                    <span class="text-xs font-semibold">Extended Circle</span>
                </a>

                {{-- Genealogy --}}
                <a href="{{ route('genealogy') }}"
                   class="{{ $baseItemClass }} {{ Route::is('genealogy') ? $activeClass : $inactiveClass }} px-2">
                   <span class="inline-flex items-center justify-center   rounded-lg">
                        <img src="{{ asset('assets/images/menu/genealogy.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
                    </span>
                    <span class="text-xs font-semibold">Genealogy</span>
                </a>

            </div>
        {{-- Pay By QR --}}
        


        {{-- Overview --}}
        <a href="{{ route('overview') }}"
           class="{{ $baseItemClass }} {{ Route::is('overview') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center   rounded-lg">
                <img src="{{ asset('assets/images/menu/overview.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Overview</span>
        </a>

        {{-- Withdraw --}}
        <a href="{{ route('withdraw') }}"
           class="{{ $baseItemClass }} {{ Route::is('withdraw') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/withdraw.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Withdraw</span>
        </a>

            {{-- Tools (submenu) --}}
            <button type="button"
                class="{{ $baseItemClass }} {{ $isToolsOpen ? $activeClass : $inactiveClass }} w-full justify-between"
                data-submenu-toggle="toolsMenu">
                <span class="flex items-center gap-2.5">
                    <span class="inline-flex items-center justify-center  rounded-lg">
                        <img src="/assets/images/menu/tool.webp" width="64" height="48" alt="Logo"
                                    class="w-6 h-6 object-contain">
                    </span>
                    <span class="bank-g">Tools</span>
                </span>

                <svg class="w-4 h-4 transition-transform {{ $isToolsOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                </svg>
            </button>

        <div id="toolsMenu" class="ml-4 mt-1 flex flex-col gap-1 {{ $isToolsOpen ? '' : 'hidden' }}">
        {{-- Tickets --}}
        {{-- <a href="{{ route('tickets') }}"
           class="{{ $baseItemClass }} {{ Route::is('tickets') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center  rounded-lg">
                <img src="{{ asset('assets/images/menu/tickets.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Tickets</span>
        </a> --}}
        {{-- Promotion --}}
        <a href="{{ route('promotion') }}"
           class="{{ $baseItemClass }} {{ Route::is('promotion') ? $activeClass : $inactiveClass }} px-2">
            <span class="inline-flex items-center justify-center   rounded-lg">
                <img src="{{ asset('assets/images/menu/promotion.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
            </span>
                    <span class="text-xs font-semibold">Promotion</span>
        </a>
        
                {{-- Circle Guide --}}
        <a href="{{ route('levelcalculator') }}"
           class="{{ $baseItemClass }} {{ Route::is('levelcalculator') ? $activeClass : $inactiveClass }} px-2">
            <span class="inline-flex items-center justify-center   rounded-lg">
                <img src="{{ asset('assets/images/menu/level-calculator.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-5 h-5 object-contain">
            </span>
                    <span class="text-xs font-semibold">Circle Guide</span>
        </a>

                {{-- Educare --}}
        <a href="{{ route('educare') }}"
           class="{{ $baseItemClass }} {{ Route::is('educare') ? $activeClass : $inactiveClass }} px-2">
            <span class="inline-flex items-center justify-center   rounded-lg">
                <img src="/assets/images/menu/educare.webp" width="64" height="48" alt="Logo"
                             class="w-5 h-5 object-contain">
            </span>
                    <span class="text-xs font-semibold">Educare</span>
        </a>
        
                {{-- Tutorials --}}
                <a href="{{ route('tools') }}"
                   class="{{ $baseItemClass }} {{ Route::is('tools') ? $activeClass : $inactiveClass }} px-2">
                    <span class="inline-flex items-center justify-center   rounded-lg">
                        <img src="/assets/images/menu/tutorial.webp" width="64" height="48" alt="Logo"
                             class="w-5 h-5 object-contain">
                    </span>
                    <span class="text-xs font-semibold">Tutorials</span>
                </a>
            </div>
        
        {{-- Tickets --}}
        <a href="{{ route('tickets') }}"
           class="{{ $baseItemClass }} {{ Route::is('tickets') ? $activeClass : $inactiveClass }}">
            <span class="inline-flex items-center justify-center rounded-lg">
                <img src="{{ asset('assets/images/menu/tickets.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Tickets</span>
        </a>

        {{-- Logout --}}    
        <!-- <a href="{{ route('logout') }}"
           class="{{ $baseItemClass }} text-red-500 hover:bg-red-50 hover:text-red-600 border border-transparent">
            <span class="inline-flex items-center justify-center bg-[#bfdcff] p-1 rounded-lg">
                <img src="{{ asset('assets/images/menu/logout.webp?v=1') }}"  width="64" height="48" alt="Logo"
                     class="w-6 h-6 object-contain">
            </span>
            <span>Logout</span>
        </a> -->
    
        @php
            $stack = session('impersonation_stack', []);
            $last  = end($stack);
        @endphp

        @if(Auth::guard('customer')->check() && $last && $last['guard'] === 'admin')
            {{-- Customer → Admin --}}
            <a href="{{ route('customer.logoutascustomer') }}"
               class="{{ $baseItemClass }} text-red-500 hover:bg-red-50 hover:text-red-600 border border-transparent">
                <span class="inline-flex items-center justify-center bg-[#bfdcff] p-1 rounded-lg">
                    <img src="{{ asset('assets/images/menu/logout.webp?v=1') }}"  width="64" height="48" alt="Logo"
                         class="w-6 h-6 object-contain">
                </span>
                <span>Logout As Customer</span>
            </a>
        @else
            {{-- Normal logout --}}
            <a href="{{ route('logout') }}"
               class="{{ $baseItemClass }} text-red-500 hover:bg-red-50 hover:text-red-600 border border-transparent">
                <span class="inline-flex items-center justify-center  rounded-lg">
                    <img src="{{ asset('assets/images/menu/logout.webp?v=1') }}"  width="64" height="48" alt="Logo"
                         class="w-6 h-6 object-contain">
                </span>
                <span>Logout</span>
            </a>
        @endif

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

    // ✅ Submenu toggles (added)
    document.querySelectorAll('[data-submenu-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-submenu-toggle');
            const menu = document.getElementById(id);
            if (!menu) return;

            menu.classList.toggle('hidden');

            const arrow = btn.querySelector('svg');
            if (arrow) arrow.classList.toggle('rotate-180');
        });
    });
});
</script>
@endpush
