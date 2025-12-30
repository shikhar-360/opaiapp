{{-- resources/views/genealogy/_tree_node.blade.php --}}

@props(['userNode'])

<li class="flex items-start gap-2">
    
    {{-- Toggle button: Only show if there are children --}}
    @if(!empty($userNode['children']))
        <button
            type="button"
            class="mt-1 inline-flex h-7 w-7 items-center justify-center rounded-full border border-sky-300 text-base md:text-lg leading-none bg-white text-sky-600 hover:bg-sky-50 flex-none shrink-0 shadow-sm"
            {{-- Use the referral code as a unique ID for the JS toggle (e.g., node-A001) --}}
            data-toggle-node="node-{{ $userNode['refferal_code'] }}"
        >
            <span data-icon>-</span>
        </button>
    @else
        {{-- Placeholder for alignment if no children exist --}}
        <span class="mt-1 inline-flex h-5 w-5"></span>
    @endif

    <div class="flex-1">
        {{-- Main Row/Card (matches your HTML structure) --}}
        <div
            class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 md:px-3 md:py-2 hover:border-sky-400/70 hover:bg-slate-50 transition-colors duration-200 min-w-[900px]"
        >
            <div class="flex items-center gap-2 w-32 md:w-44 shrink-0">
                <img src="/assets/images/opai.webp" alt=""
                     class="w-7 h-7 rounded-full bg-slate-100 p-0.5 object-contain border border-slate-200">
                <span class="font-medium text-slate-900 whitespace-nowrap">{{ $userNode['refferal_code'] }}</span>
            </div>

            
            {{-- Map your data fields to the correct divs --}}
            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">{{ $userNode['level_id'] }}</div>
            <div class="flex-1 text-center text-slate-600 shrink-0 whitespace-nowrap">{{ $userNode['currentPackageDate'] }}</div>
            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">{{ $userNode['my_team'] }}</div>
            <div class="flex-1 text-center text-slate-700 shrink-0 whitespace-nowrap">{{ $userNode['my_direct'] }}</div>
            <div class="flex-1 text-center text-emerald-600 shrink-0 whitespace-nowrap"> {{ number_format($userNode['team_investment'], 2) }}</div>
            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap"> {{ number_format($userNode['direct_investment'], 2) }}</div>
            <div class="flex-1 text-center text-sky-600 shrink-0 whitespace-nowrap"> {{ number_format($userNode['totalInvestment'], 2) }}</div>
        </div>

        {{-- Children Container: Only rendered if children exist --}}
        @if(!empty($userNode['children']))
            <div id="node-{{ $userNode['refferal_code'] }}" class="mt-1 space-y-3 pl-4 border-l border-slate-200">
                <ul class="space-y-3">
                    {{-- RECURSION HAPPENS HERE --}}
                    @foreach($userNode['children'] as $childNode)
                        {{-- Include the same partial view again for each child --}}
                        @include('customer._tree_node', ['userNode' => $childNode])
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</li>
