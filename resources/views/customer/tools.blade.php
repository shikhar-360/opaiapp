@extends('app')

@section('title', 'Tools')

@section('content')
<section class="min-h-screen py-8 bg-slate-50/50 px-4">
  <div class="mx-auto max-w-[1470px]">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
      <div>
        <h2 class="text-lg sm:text-2xl font-semibold text-slate-900">Tools & Tutorials</h2>
        <p class="text-xs sm:text-sm text-slate-500">Tutorial video links can be placed here (IFrame).</p>
      </div>
    </div>

    {{-- MAIN GLASS CONTAINER --}}
    <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] p-4 md:p-6">
      <div class="absolute inset-0 opacity-70 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
      </div>

      @php
        /**
         * Client yaha sirf title + embed link paste kare
         * (YouTube: https://www.youtube-nocookie.com/embed/VIDEO_ID)
         * (Vimeo:   https://player.vimeo.com/video/VIDEO_ID)
         */
        $videos = $customer->tutorials;

        // [
        //   [
        //     'title' => 'Getting Started',
        //     'embed' => 'https://www.youtube-nocookie.com/embed/ysz5S6PUM-U',
        //     'note'  => 'Account setup & basic overview',
        //   ],
        //   [
        //     'title' => 'How Promotions Work',
        //     'embed' => 'https://www.youtube-nocookie.com/embed/jfKfPfyJRdk',
        //     'note'  => 'Promotion / tools explanation',
        //   ],
        //   [
        //     'title' => 'Support & Help',
        //     'embed' => 'https://player.vimeo.com/video/76979871',
        //     'note'  => 'How to raise a ticket',
        //   ],
        // ];

        // Security: allowlist only these iframe hosts
        $allowedHosts = ['youtube.com','www.youtube.com','youtube-nocookie.com','www.youtube-nocookie.com','player.vimeo.com'];
        $isAllowed = function($url) use ($allowedHosts) {
          $host = parse_url($url, PHP_URL_HOST);
          return $host && in_array($host, $allowedHosts, true);
        };
      @endphp

      <div class="relative">
        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
          @foreach($videos as $v)
            @php
              $src = $v['url'] ?? '';
              $ok  = $isAllowed($src);
            @endphp

            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-md backdrop-blur-xl">
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/15 opacity-70 blur-xl"></div>

              <div class="relative">
                <div class="mb-3">
                  <h4 class="text-sm font-semibold text-slate-900">{{ $v['title'] ?? 'Tutorial' }}</h4>
                  @if(!empty($v['sub_title']))
                    <p class="text-xs text-slate-500 mt-1">{{ $v['sub_title'] }}</p>
                  @endif
                </div>

                <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                  @if($ok)
                    {{-- Responsive 16:9 --}}
                    <div class="relative w-full" style="padding-top:56.25%;">
                      <iframe
                        class="absolute inset-0 w-full h-full"
                        src="{{ $src }}"
                        title="{{ $v['title'] ?? 'Tutorial Video' }}"
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                      ></iframe>
                    </div>
                  @else
                    <div class="p-4">
                      <p class="text-sm text-slate-700 font-semibold">Invalid / not allowed embed link</p>
                      <p class="text-xs text-slate-500 mt-1 break-all">{{ $src }}</p>
                      <p class="text-xs text-slate-500 mt-2">
                        Allowed: YouTube embed / YouTube-nocookie / Vimeo player links.
                      </p>
                    </div>
                  @endif
                </div>

              </div>
            </div>
          @endforeach
        </div>

        {{-- EMPTY STATE (optional) --}}
        @if(empty($videos))
          <div class="text-center py-10">
            <p class="text-sm text-slate-600">No tutorial videos added yet.</p>
          </div>
        @endif
      </div>
    </div>

  </div>
</section>
@endsection
