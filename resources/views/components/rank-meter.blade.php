 @props([
'rank' => 1,
'max' => 10,
'sizePx' => 360,
'showTicks' => true,
'my_monthly_business' => 0,
'my_monthly_business_target' => 1000,

// optional wiggle controls
'wiggle' => true, // on/off
'wiggleDeg' => 2.2, // +/- degrees
'wiggleDur' => '1.8s', // duration of a full left→right→left
])

@php
$min = 0;
$max = (int) $max ?: 10;
$clamped = max($min, min((int) $rank, $max));
$pct = $max > 0 ? $clamped / $max : 0;

$width = 320; $height = 180;
$cx = 160; $cy = 160; $r = 130;
$startX = $cx - $r; $endX = $cx + $r;

$arcLen = M_PI * $r;
$dashArray = $arcLen;
$dashOffset = $arcLen * (1 - $pct);

$angleDeg = -180 + ($pct * 180);

// ticks
$ticks = [];
for ($i = 0; $i <= $max; $i++) {
    $tp=$i / $max;
    $a=-M_PI + ($tp * M_PI);
    $outerX=$cx + cos($a) * $r;
    $outerY=$cy + sin($a) * $r;
    $innerX=$cx + cos($a) * ($r - 12);
    $innerY=$cy + sin($a) * ($r - 12);
    $labelX=$cx + cos($a) * ($r - 28);
    $labelY=$cy + sin($a) * ($r - 28);
    $val=$i;
    $ticks[]=compact('outerX','outerY','innerX','innerY','labelX','labelY','val');
    }

    $minorTicks=[];
    for ($i=0; $i < $max * 2 - 1; $i++) {
    $tp=($i + 1) / ($max * 2);
    $a=-M_PI + ($tp * M_PI);
    $outerX=$cx + cos($a) * $r;
    $outerY=$cy + sin($a) * $r;
    $innerX=$cx + cos($a) * ($r - 6);
    $innerY=$cy + sin($a) * ($r - 6);
    $minorTicks[]=compact('outerX','outerY','innerX','innerY');
    }
    @endphp

    <div class="w-full rounded-2xl bg-[#151515] border border-[#333333] px-5 pt-5 pb-5 shadow-[inset_0_0_20px_-6px_#ffffff14] text-white">
    <!-- style="width: {{ (int) $sizePx }}px" -->

    <div class="mb-2 flex items-center justify-between text-slate-200 text-sm">
        <span class="text-lg font-semibold">Rank Meter</span>
        <span class="text-lg text-slate-400">P: {{ $clamped }} / {{ $max }}</span>
    </div>

    <div class="relative">
        <svg viewBox="0 0 {{ $width }} {{ $height }}" class="block h-auto w-full" role="img"
            aria-label="Rank speedometer at Rank {{ $clamped }}">
            <defs>
                <linearGradient id="g-track" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#0ea5e9" />
                    <stop offset="50%" stop-color="#ce9aff" />
                    <stop offset="100%" stop-color="#ff9917" />
                </linearGradient>
                <filter id="softGlow" x="-50%" y="-50%" width="200%" height="200%">
                    <feGaussianBlur stdDeviation="6" result="blur" />
                    <feMerge>
                        <feMergeNode in="blur" />
                        <feMergeNode in="SourceGraphic" />
                    </feMerge>
                </filter>
            </defs>

            {{-- background track --}}
            <path d="M {{ $startX }} {{ $cy }} A {{ $r }} {{ $r }} 0 0 1 {{ $endX }} {{ $cy }}"
                fill="none" stroke="#1f2937" stroke-width="16" stroke-linecap="round" />

            {{-- progress --}}
            <path d="M {{ $startX }} {{ $cy }} A {{ $r }} {{ $r }} 0 0 1 {{ $endX }} {{ $cy }}"
                fill="none" stroke="url(#g-track)" stroke-width="16" stroke-linecap="round"
                stroke-dasharray="{{ $dashArray }}" stroke-dashoffset="{{ $dashOffset }}"
                filter="url(#softGlow)" />

            {{-- ticks --}}
            @if($showTicks)
            @foreach($minorTicks as $t)
            <line x1="{{ $t['outerX'] }}" y1="{{ $t['outerY'] }}"
                x2="{{ $t['innerX'] }}" y2="{{ $t['innerY'] }}"
                stroke="#64748b" stroke-width="2" opacity="0.4" />
            @endforeach

            @foreach($ticks as $t)
            <line x1="{{ $t['outerX'] }}" y1="{{ $t['outerY'] }}"
                x2="{{ $t['innerX'] }}" y2="{{ $t['innerY'] }}"
                stroke="#e5e7eb" stroke-width="3" />
            @if($t['val'] !== 0)
            <text x="{{ $t['labelX'] }}" y="{{ $t['labelY'] }}"
                text-anchor="middle" dominant-baseline="central"
                class="fill-slate-300" style="font-size:10px;">
               <tspan style="font-size:7px;">P-</tspan>{{ $t['val'] }}
            </text>
            @endif
            @endforeach
            @endif

            {{-- hub --}}
            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="8" fill="#e5e7eb" />
            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="14" fill="#0f172a" stroke="#ce9aff" stroke-width="2" />

            {{-- needle base rotation to target angle --}}
            <g transform="rotate({{ $angleDeg }} {{ $cx }} {{ $cy }})">
                {{-- inner group adds tiny left-right wiggle --}}
                <g>
                    @if($wiggle)
                    <animateTransform attributeName="transform"
                        type="rotate"
                        values="-{{ $wiggleDeg }} {{ $cx }} {{ $cy }};
                                      {{ $wiggleDeg }} {{ $cx }} {{ $cy }};
                                      -{{ $wiggleDeg }} {{ $cx }} {{ $cy }}"
                        dur="{{ $wiggleDur }}"
                        repeatCount="indefinite" />
                    @endif

                    {{-- needle graphics --}}
                    <line x1="{{ $cx }}" y1="{{ $cy }}" x2="{{ $cx + $r - 22 }}" y2="{{ $cy }}"
                        stroke="#ce9aff" stroke-width="4" stroke-linecap="round" />
                    <circle cx="{{ $cx }}" cy="{{ $cy }}" r="5" fill="#ce9aff" />
                </g>
            </g>
        </svg>

        <div class="mt-5 text-center flex items-center justify-center max-w-full w-full mx-auto gap-2">
            <!-- <span class="text-xl">Your Current Rank :</span>
            <span class="text-xl font-semibold text-white tabular-nums">{{ $clamped }}</span> -->
            @php
            $progress = 0;
            if (!empty($my_monthly_business_target) && $my_monthly_business_target > 0) {
            $progress = min(100, round(($my_monthly_business / $my_monthly_business_target) * 100, 2));
            }
            @endphp

            @if($rank > 0)
                <div class="space-y-1 w-full">
                    <h2 class="mb-1 text-base w-full text-left flex items-center justify-between gap-2">
                        Monthly Business
                            <span class="text-[#c88cff] text-lg">
                                <span class="text-white">{{ number_format($my_monthly_business, 2) }}</span> / {{ $my_monthly_business_target }}
                            </span>
                    </h2>
                    <div class="flex w-full h-7 border border-white/5 bg-[#1f2937] px-0 overflow-hidden"
                        role="progressbar"
                        aria-valuenow="{{ $progress }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                        <div class="flex flex-col justify-center bg-[#ba70ff] text-xl font-semibold text-white text-center transition duration-500 py-2"
                            style="width: {{ $progress }}%">
                            {{ $progress }}%
                        </div>
                    </div>
                </div>
            @endif