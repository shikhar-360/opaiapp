@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section
  class="w-full py-10 md:py-12 px-4 mx-auto min-h-[calc(90vh-50px)] flex items-center justify-center bg-slate-50/50 relative overflow-hidden">

  <div class="w-full max-w-xl mx-auto">
    <div class="relative rounded-2xl">

      <div
        class="relative p-6 md:p-8 rounded-2xl w-full mx-auto group overflow-hidden neo-card
               transition-all duration-300 
               hover:-translate-y-1.5 ">

        {{-- soft glow background --}}
        <div class="pointer-events-none absolute inset-0 opacity-70">
          <div class="absolute -top-24 -left-24 h-40 w-40 rounded-full bg-sky-200/60 blur-3xl group-hover:translate-y-3 transition-transform duration-300"></div>
          <div class="absolute -bottom-24 -right-24 h-44 w-44 rounded-full bg-indigo-200/60 blur-3xl group-hover:-translate-y-1 transition-transform duration-300"></div>
        </div>

        {{-- Logo --}}
        <div class="pb-4 text-center relative z-10">
          <div
            class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.10)] px-4 py-3">
            <img src="/assets/images/opai.webp" width="64" height="48" alt="Logo"
                 class="w-full max-w-32 mx-auto">
          </div>
        </div>

        <div class="mt-4 flex flex-col items-center relative z-10">
          <h1 class="text-2xl xl:text-3xl font-semibold text-slate-900 text-center tracking-tight">
            Welcome to
            <span class="bg-gradient-to-r from-sky-500 via-cyan-500 to-sky-400 bg-clip-text text-transparent">
              OpAi
            </span>
          </h1>

          <div class="w-full flex-1 mt-3 text-center">

            <p class="mb-4 leading-relaxed mx-auto max-w-sm text-slate-600 text-sm">
              Connect your wallet securely to access your dashboard, earnings and staking panel.
            </p>

            {{-- Connect Wallet Button --}}
            <div class="mx-auto max-w-sm mt-8">
              <button
                id="btnLogin"
                class="relative w-full mx-auto max-w-52 px-5 py-3 cursor-pointer 
                       flex items-center justify-center gap-2 text-base capitalize tracking-wide mt-4 
                       rounded-lg border border-sky-500 
                       bg-gradient-to-r from-sky-500 via-cyan-400 to-sky-300 
                       text-white font-semibold 
                       transition-all duration-300 ease-out group 
                       hover:-translate-y-0.5 
                       focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-100">

                <span
                  class="pointer-events-none absolute inset-0 rounded-full bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.65),_transparent_55%)] opacity-70 group-hover:opacity-90 transition-opacity duration-300 mix-blend-screen"></span>

                <span class="relative z-10 flex items-center justify-center">
                  <span class="font-semibold text-[15px]">
                    Connect Wallet
                  </span>

                  {{-- arrow icon --}}
                  <svg id="svg1-icon"
                       class="w-5 h-5 ml-1 transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-0.5"
                       data-slot="icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                          d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                    </path>
                  </svg>

                  {{-- loader icon (hidden by default, show via JS when needed) --}}
                  <svg id="svg2-icon"
                       class="w-6 h-6 ml-1 transition-transform duration-500 group-hover:translate-x-1 hidden"
                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                    <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="40" cy="65">
                      <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                               keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate>
                    </circle>
                    <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="100" cy="65">
                      <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                               keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate>
                    </circle>
                    <circle fill="#ffffff" stroke="#ffffff" stroke-width="15" r="15" cx="160" cy="65">
                      <animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;"
                               keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate>
                    </circle>
                  </svg>
                </span>
              </button>

              {{-- Sign up link --}}
              <div class="text-sm font-medium text-slate-600 mt-6 text-center">
                New here?
                <a href="https://dapp.OpAi.farm/register"
                   class="text-sky-600 underline underline-offset-4 decoration-sky-400/80 hover:text-sky-500 hover:decoration-sky-500 transition">
                  Sign Up
                </a>
              </div>

              {{-- Divider --}}
              <div class="flex items-center gap-3 my-5">
                <span class="h-px flex-1 bg-slate-200"></span>
                <span class="text-[11px] uppercase tracking-[0.2em] text-slate-500">
                  Community
                </span>
                <span class="h-px flex-1 bg-slate-200"></span>
              </div>

              {{-- Social / community links --}}
              <div
                class="relative flex items-center justify-center rounded-xl p-3 gap-4 leading-none mx-auto w-full max-w-fit 
                       border border-slate-200 bg-white shadow-[0_16px_45px_rgba(15,23,42,0.08)]">

                <a href="#"
                   type="button" target="_blank"
                   class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-sky-600 transition-transform duration-200 hover:-translate-y-0.5">
                  <span class="[&>svg]:h-6 [&>svg]:w-8 relative z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                         viewBox="0 0 448 512">
                      <path
                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8z">
                      </path>
                    </svg>
                  </span>
                </a>

                <a href="#"
                   type="button" target="_blank"
                   class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-sky-600 transition-transform duration-200 hover:-translate-y-0.5">
                  <span class="relative z-20">
                    <img src="/assets/images/facebook.svg" width="28" height="28" alt="facebook">
                  </span>
                </a>

                <a href="#"
                   type="button" target="_blank"
                   class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-sky-600 transition-transform duration-200 hover:-translate-y-0.5">
                  <span class="relative z-20">
                    <img src="/assets/images/youtube.svg" width="28" height="28" alt="youtube">
                  </span>
                </a>

                <a href="#"
                   type="button" target="_blank"
                   class="inline-flex items-center justify-center text-xs text-slate-600 hover:text-sky-600 transition-transform duration-200 hover:-translate-y-0.5">
                  <span class="relative z-20">
                    <img src="/assets/images/telegram.svg" width="24" height="24" alt="telegram">
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div
          class="absolute inset-x-6 bottom-0 h-px bg-gradient-to-r from-transparent via-sky-400/70 to-transparent opacity-100">
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
