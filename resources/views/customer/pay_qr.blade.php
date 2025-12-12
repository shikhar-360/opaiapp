@extends('app')

@section('title', 'DApp Header (HTML)')

@section('content')
<section class="min-h-screen py-10 md:py-12 bg-slate-50/50">
  <div class="mx-auto max-w-[1400px] px-4">
    @php
    // var_dump($customer->QRs);
    $hasQR = !empty($customer->QRs);
    @endphp
    {{-- Network Choose (STEP 1) --}}
    <div id="networkChoose" style="display:{{ $hasQR ? 'none' : 'block' }}" class="max-w-2xl w-full mx-auto">
      <div
        class="relative p-5 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden
               border border-slate-200 bg-white backdrop-blur-2xl
               shadow-[0_15px_40px_rgba(15,23,42,.10)]
               transition-all duration-300 hover:-translate-y-1
               hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">

        {{-- soft glow --}}
        <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-sky-300/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div class="w-full relative z-10">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">
            Choose Network
          </h3>

          <div class="grid grid-cols-1 gap-5">
            {{-- POLYGON --}}
            <div onclick="chooseCoin('evm', 'polygon')" class="text-center cursor-pointer">
              <div
                class="p-4 rounded-xl border border-slate-200 bg-white
                       hover:border-sky-500 hover:bg-sky-50 transition-colors">
                <img src="/assets/images/coin-icon/polygone.png" width="64" height="48" alt="polygon"
                  class="w-12 sm:w-14 h-auto mx-auto">
              </div>
              <h3 class="text-base mt-4 text-slate-800 leading-none">
                POLYGON
              </h3>
            </div>

            {{-- other networks (commented) --}}
          </div>
        </div>
      </div>

      {{-- Disclaimer for Network --}}
      <div
        class="relative p-4 md:p-6 mt-5 rounded-2xl w-full mx-auto
               border border-slate-200 bg-white text-left
               shadow-[0_15px_40px_rgba(15,23,42,.08)] backdrop-blur-xl">
        <h3 class="text-lg font-semibold leading-none text-slate-900 mb-4">
          Disclaimer
        </h3>
        <div class="space-y-3 text-sm text-slate-600">
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or
              failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your
              package.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-sky-600" href="mailto:support@9pay.co">support@9pay.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- Coin Choose (STEP 2) --}}
    <div id="coinChoose" style="display:{{ $hasQR ? 'none' : 'none' }}" class="max-w-2xl w-full mx-auto">
      <div
        class="w-full relative p-5 md:p-6 rounded-2xl mx-auto group overflow-hidden
               border border-slate-200 bg-white text-left
               shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl
               transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">

        <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-sky-300/20 blur-3xl"></div>

        <form class="relative mt-2 space-y-4" method="post" action="{{ route('pay.qr.save') }}">
          @csrf
          <div class="w-full relative z-10">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-slate-900">
              <span onclick="backScreen('networkChoose', 'coinChoose');" class="inline-flex">
                <svg class="p-px w-5 h-5 cursor-pointer text-slate-500" viewBox="0 0 1024 1024" aria-hidden="true">
                  <path
                    d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z"
                    fill="currentColor"></path>
                </svg>
              </span>
              Choose Coin
            </h3>

            <div class="w-full flex-1 text-center mx-auto mt-6">
              <div class="space-y-4 max-w-md mx-auto">
                {{-- Select --}}
                <div class="text-left">
                  <label for="coinSelect"
                    class="block text-[11px] uppercase tracking-wide text-sky-700 font-medium mb-2">
                    Coin
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3
                          border border-slate-200 bg-white
                          focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100
                          focus-within:bg-sky-50/60 transition-colors">
                    <select id="coinSelect" name="coinSelect" onchange="selectCoinChain('USDT');"
                      class="w-full bg-transparent text-slate-900 text-sm outline-none cursor-pointer">
                      {{-- <option value="" disabled selected class="bg-white text-slate-900">
                        Select an option
                      </option> --}}
                      <option class="text-black" id="usdtToken" value="USDT">USDT</option>
                    </select>
                    <input type="hidden" id="network_type" name="network_type" value="evm">
                    <input type="hidden" id="network_name" name="network_name" value="polygon">
                  </div>
                </div>

                {{-- Amount --}}
                <div class="text-left">
                  <label for="coin_amount"
                    class="block text-[11px] uppercase tracking-wide text-sky-700 font-medium mb-2">
                    Amount
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3
                          border border-slate-200 bg-white
                          focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100
                          focus-within:bg-sky-50/60 transition-colors">
                    <input type="text" id="coin_amount" name="amount"
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      placeholder="Enter your amount" required>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-center mt-6">
                <button  type="submit"
                  class="px-5 py-2.5 cursor-pointer flex items-center justify-center gap-2
                        text-sm md:text-base capitalize tracking-wide rounded-full
                        border border-sky-500 bg-gradient-to-r from-sky-500 to-sky-600
                        text-white font-semibold
                        shadow-[0_8px_20px_rgba(56,189,248,.30)]
                        hover:shadow-[0_14px_28px_rgba(56,189,248,.45)]
                        active:scale-95 transition-all duration-300 ease-out group">
                  <span>Continue</span>
                  <svg id="svg1-icon"
                    class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                    </path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      {{-- Disclaimer for Coin --}}
      <div
        class="relative p-4 md:p-6 rounded-2xl w-full mx-auto mt-5
               border border-slate-200 bg-white text-left
               shadow-[0_15px_40px_rgba(15,23,42,.08)] backdrop-blur-xl">
        <h3 class="text-lg font-semibold leading-none text-slate-900 mb-4">
          Disclaimer
        </h3>
        <div class="space-y-3 text-sm text-slate-600">
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or
              failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your
              package.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-sky-600" href="mailto:support@9pay.co">support@9pay.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- Payment Choose (STEP 3) --}}
    <div id="paymentChoose" style="display:{{ $hasQR ? 'block' : 'none' }}" class="mt-5 max-w-3xl w-full mx-auto relative">
      <h3 class="text-2xl text-center font-semibold mb-4 text-slate-900">
        EVM QR Code
      </h3>

      {{-- Main QR + Info Card --}}
      <div
        class="relative p-5 md:p-6 rounded-2xl w-full mx-auto group overflow-hidden
               border border-slate-200 bg-white text-left
               shadow-[0_15px_40px_rgba(15,23,42,.10)] backdrop-blur-2xl
               transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.25)]">

        {{-- Top Header --}}
        <div class="flex items-center justify-between gap-3 pb-5 border-b border-slate-200">
          <div class="flex items-center gap-3">
            <img src="/assets/images/9logo.png" width="100" height="100" alt="Logo" class="h-8 w-auto">
            <div class="flex flex-col">
              <span class="text-xs uppercase tracking-[0.15em] text-slate-500">EVM Network</span>
              <h3 class="text-xl font-semibold text-slate-900 flex items-center gap-1">
                <span class="uppercase text-sky-600" id="chainSelected"></span>
                <span class="text-slate-800">Chain</span>
              </h3>
            </div>
          </div>

          <span id="transaction_status"
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wide
                   border border-amber-300 bg-amber-50 text-amber-700 uppercase absolute top-4 right-4">
            Pending
          </span>
        </div>

        {{-- Middle: QR + Details --}}
        <div class="pt-5 flex flex-col md:flex-row gap-6 items-stretch">
          {{-- Left: QR --}}
          <div class="w-full md:w-[260px] flex items-center justify-center">
            <div class="rounded-xl overflow-hidden bg-slate-100 p-3 w-full flex items-center justify-center">
              {{-- EVM QR --}}
              <div id="paymentEVM" class="w-full flex items-center justify-center">
                {{-- {!! '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="240" height="240" viewBox="0 0 240 240"><rect x="0" y="0" width="240" height="240" fill="#ffffff"></rect><g transform="scale(8.276)"><g transform="translate(0,0)"><path fill-rule="evenodd" d="M10 0L10 2L11 2L11 0ZM12 0L12 1L13 1L13 2L12 2L12 4L14 4L14 5L11 5L11 6L10 6L10 4L11 4L11 3L8 3L8 4L9 4L9 5L8 5L8 7L9 7L9 8L6 8L6 9L10 9L10 11L11 11L11 9L12 9L12 10L13 10L13 9L15 9L15 8L16 8L16 9L19 9L19 10L14 10L14 11L15 11L15 12L13 12L13 11L12 11L12 13L19 13L19 12L21 12L21 13L20 13L20 15L21 15L21 16L19 16L19 15L18 15L18 16L19 16L19 17L18 17L18 19L19 19L19 18L20 18L20 21L19 21L19 20L16 20L16 19L17 19L17 18L15 18L15 17L17 17L17 15L16 15L16 14L14 14L14 16L13 16L13 17L12 17L12 15L13 15L13 14L11 14L11 16L10 16L10 15L8 15L8 13L9 13L9 14L10 14L10 13L11 13L11 12L8 12L8 13L7 13L7 12L6 12L6 11L8 11L8 10L6 10L6 11L4 11L4 10L5 10L5 8L0 8L0 9L1 9L1 10L3 10L3 11L4 11L4 12L6 12L6 13L3 13L3 12L2 12L2 15L1 15L1 13L0 13L0 16L2 16L2 18L3 18L3 19L2 19L2 20L3 20L3 21L5 21L5 18L6 18L6 19L8 19L8 23L9 23L9 22L10 22L10 24L11 24L11 25L10 25L10 26L9 26L9 24L8 24L8 29L11 29L11 28L9 28L9 27L10 27L10 26L11 26L11 25L12 25L12 26L13 26L13 27L12 27L12 29L13 29L13 28L14 28L14 29L16 29L16 27L18 27L18 28L21 28L21 29L22 29L22 28L23 28L23 29L27 29L27 28L28 28L28 26L29 26L29 23L28 23L28 22L29 22L29 21L28 21L28 19L27 19L27 20L26 20L26 17L28 17L28 18L29 18L29 16L28 16L28 15L27 15L27 16L25 16L25 15L23 15L23 16L25 16L25 17L22 17L22 14L23 14L23 13L24 13L24 14L26 14L26 13L27 13L27 14L29 14L29 13L27 13L27 12L29 12L29 11L27 11L27 10L28 10L28 8L27 8L27 10L26 10L26 11L27 11L27 12L25 12L25 9L26 9L26 8L25 8L25 9L24 9L24 8L23 8L23 9L22 9L22 8L21 8L21 6L20 6L20 7L19 7L19 5L20 5L20 4L21 4L21 3L20 3L20 2L21 2L21 1L20 1L20 0L19 0L19 1L20 1L20 2L19 2L19 3L17 3L17 4L16 4L16 2L17 2L17 1L15 1L15 0L14 0L14 1L13 1L13 0ZM8 1L8 2L9 2L9 1ZM14 1L14 2L13 2L13 3L14 3L14 4L15 4L15 1ZM19 3L19 4L17 4L17 7L16 7L16 6L15 6L15 5L14 5L14 6L13 6L13 7L12 7L12 6L11 6L11 7L12 7L12 9L13 9L13 8L14 8L14 6L15 6L15 7L16 7L16 8L19 8L19 9L21 9L21 8L19 8L19 7L18 7L18 5L19 5L19 4L20 4L20 3ZM9 6L9 7L10 7L10 6ZM10 8L10 9L11 9L11 8ZM3 9L3 10L4 10L4 9ZM19 10L19 11L22 11L22 13L21 13L21 14L22 14L22 13L23 13L23 11L24 11L24 10ZM0 11L0 12L1 12L1 11ZM17 11L17 12L18 12L18 11ZM24 12L24 13L25 13L25 12ZM6 13L6 14L7 14L7 13ZM4 14L4 17L3 17L3 18L4 18L4 17L5 17L5 14ZM6 15L6 16L7 16L7 17L6 17L6 18L8 18L8 19L9 19L9 18L8 18L8 17L9 17L9 16L8 16L8 15ZM15 15L15 16L14 16L14 17L13 17L13 18L12 18L12 17L11 17L11 18L10 18L10 20L11 20L11 22L13 22L13 23L12 23L12 25L14 25L14 26L19 26L19 27L22 27L22 26L23 26L23 28L24 28L24 26L27 26L27 23L26 23L26 22L28 22L28 21L26 21L26 20L25 20L25 19L23 19L23 18L22 18L22 17L20 17L20 18L22 18L22 19L21 19L21 20L22 20L22 19L23 19L23 20L25 20L25 23L26 23L26 24L25 24L25 25L24 25L24 26L23 26L23 25L22 25L22 26L20 26L20 23L19 23L19 21L16 21L16 20L15 20L15 21L14 21L14 17L15 17L15 16L16 16L16 15ZM0 17L0 21L1 21L1 17ZM12 19L12 21L13 21L13 19ZM6 20L6 21L7 21L7 20ZM21 21L21 24L24 24L24 21ZM15 22L15 23L14 23L14 24L15 24L15 25L19 25L19 23L18 23L18 24L16 24L16 22ZM22 22L22 23L23 23L23 22ZM14 27L14 28L15 28L15 27ZM25 27L25 28L27 28L27 27ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z" fill="#000000"></path></g></g></svg>' !!} --}}
                <img src="{{$hasQR ? $customer->QRs['ethQrCode'] : '' }}" width="240" height="240" alt="ETH QR Code" class="qr-code">
              </div>

              {{-- TRC QR --}}
              <div id="paymentTRC" class="w-full flex items-center justify-center hidden">
                {{-- {!! '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="240" height="240" viewBox="0 0 240 240"><rect x="0" y="0" width="240" height="240" fill="#ffffff"></rect><g transform="scale(8.276)"><g transform="translate(0,0)"><path fill-rule="evenodd" d="M8 0L8 1L9 1L9 2L8 2L8 5L9 5L9 4L11 4L11 5L10 5L10 10L9 10L9 11L8 11L8 9L9 9L9 8L8 8L8 9L7 9L7 8L6 8L6 9L4 9L4 8L0 8L0 9L1 9L1 10L2 10L2 11L0 11L0 12L3 12L3 11L4 11L4 13L3 13L3 15L4 15L4 13L5 13L5 11L7 11L7 12L6 12L6 13L8 13L8 14L6 14L6 15L5 15L5 16L6 16L6 17L5 17L5 18L4 18L4 16L0 16L0 17L3 17L3 18L2 18L2 19L3 19L3 20L1 20L1 21L3 21L3 20L4 20L4 21L5 21L5 18L6 18L6 19L7 19L7 20L6 20L6 21L7 21L7 20L8 20L8 22L9 22L9 25L8 25L8 29L12 29L12 28L14 28L14 27L15 27L15 28L16 28L16 27L15 27L15 26L14 26L14 25L13 25L13 26L12 26L12 24L15 24L15 25L16 25L16 26L17 26L17 25L18 25L18 24L17 24L17 25L16 25L16 24L15 24L15 22L16 22L16 23L19 23L19 22L20 22L20 25L19 25L19 26L21 26L21 27L18 27L18 28L17 28L17 29L19 29L19 28L20 28L20 29L23 29L23 28L25 28L25 29L28 29L28 27L29 27L29 25L28 25L28 24L27 24L27 25L26 25L26 26L25 26L25 27L24 27L24 25L25 25L25 23L28 23L28 22L27 22L27 21L29 21L29 20L27 20L27 18L29 18L29 16L28 16L28 15L29 15L29 14L27 14L27 13L29 13L29 12L28 12L28 10L29 10L29 8L28 8L28 10L27 10L27 8L24 8L24 10L23 10L23 9L22 9L22 8L21 8L21 5L19 5L19 6L18 6L18 5L17 5L17 4L18 4L18 3L19 3L19 4L20 4L20 3L21 3L21 0L20 0L20 3L19 3L19 2L18 2L18 3L17 3L17 1L16 1L16 0L12 0L12 1L11 1L11 0L10 0L10 1L9 1L9 0ZM18 0L18 1L19 1L19 0ZM14 1L14 2L11 2L11 4L12 4L12 3L13 3L13 5L12 5L12 6L11 6L11 8L12 8L12 6L13 6L13 8L14 8L14 9L15 9L15 7L16 7L16 6L15 6L15 5L16 5L16 4L17 4L17 3L16 3L16 1ZM14 3L14 5L13 5L13 6L14 6L14 7L15 7L15 6L14 6L14 5L15 5L15 4L16 4L16 3ZM8 6L8 7L9 7L9 6ZM17 6L17 7L18 7L18 8L17 8L17 9L16 9L16 10L14 10L14 11L11 11L11 13L10 13L10 15L9 15L9 14L8 14L8 15L6 15L6 16L7 16L7 17L6 17L6 18L8 18L8 20L9 20L9 21L11 21L11 23L10 23L10 25L11 25L11 23L14 23L14 22L15 22L15 21L17 21L17 22L18 22L18 21L17 21L17 19L15 19L15 21L13 21L13 18L14 18L14 15L15 15L15 16L17 16L17 17L16 17L16 18L17 18L17 17L18 17L18 19L19 19L19 21L20 21L20 19L21 19L21 20L25 20L25 18L27 18L27 17L28 17L28 16L27 16L27 14L26 14L26 17L25 17L25 15L24 15L24 14L25 14L25 13L24 13L24 12L23 12L23 10L22 10L22 9L21 9L21 8L20 8L20 9L21 9L21 11L20 11L20 10L19 10L19 9L18 9L18 8L19 8L19 7L20 7L20 6L19 6L19 7L18 7L18 6ZM2 9L2 10L3 10L3 9ZM6 9L6 10L7 10L7 9ZM11 9L11 10L12 10L12 9ZM17 9L17 11L16 11L16 12L17 12L17 11L18 11L18 12L19 12L19 13L20 13L20 12L19 12L19 11L18 11L18 9ZM25 9L25 10L24 10L24 11L25 11L25 10L26 10L26 9ZM26 11L26 12L27 12L27 11ZM12 12L12 13L11 13L11 16L12 16L12 17L13 17L13 16L12 16L12 14L13 14L13 15L14 15L14 14L15 14L15 12L14 12L14 14L13 14L13 12ZM0 13L0 15L2 15L2 13ZM16 13L16 15L18 15L18 14L17 14L17 13ZM22 13L22 15L23 15L23 13ZM19 14L19 16L18 16L18 17L19 17L19 16L20 16L20 18L21 18L21 19L23 19L23 18L24 18L24 17L22 17L22 16L21 16L21 14ZM8 15L8 16L9 16L9 17L8 17L8 18L9 18L9 19L11 19L11 20L12 20L12 19L11 19L11 17L10 17L10 16L9 16L9 15ZM9 17L9 18L10 18L10 17ZM21 17L21 18L22 18L22 17ZM0 18L0 19L1 19L1 18ZM26 20L26 21L27 21L27 20ZM21 21L21 24L24 24L24 21ZM22 22L22 23L23 23L23 22ZM22 25L22 26L23 26L23 25ZM27 25L27 27L26 27L26 28L27 28L27 27L28 27L28 25ZM9 26L9 27L10 27L10 28L12 28L12 26L11 26L11 27L10 27L10 26ZM13 26L13 27L14 27L14 26ZM22 27L22 28L23 28L23 27ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z" fill="#000000"></path></g></g></svg>' !!} --}}
                <img src="{{$hasQR ? $customer->QRs['tronQrCode'] : '' }}" width="240" height="240" alt="TRON QR Code" class="qr-code">
              </div>
            </div>
          </div>

          {{-- Right: Address + Amounts --}}
          <div class="flex-1 space-y-4">
            {{-- Address --}}
            <div class="border border-slate-200 bg-slate-50 p-4 rounded-xl space-y-2">
              <h3 class="text-sm font-medium leading-none text-slate-900">Address :</h3>
              <div class="bg-white px-3 py-2 rounded-lg flex items-center justify-between gap-2 border border-slate-200">
                <div class="flex flex-col gap-1 text-left w-full">
                  <span id="copyOgEvmAddress" class="text-xs font-mono text-slate-800 truncate">
                    {{$hasQR ? $customer->QRs['ethAddress']:''}}
                  </span>
                </div>
                <button type="button"
                  onclick="copyOgEvmAddress(); showToast && showToast('success', 'Copied to clipboard!')"
                  class="ml-2 p-2 rounded-md border border-slate-200 text-slate-700
                         hover:border-sky-500 hover:bg-sky-50 transition
                         focus:outline-none focus:ring-2 focus:ring-sky-200">
                  <svg class="w-5 h-5" viewBox="0 0 1024 1024" aria-hidden="true">
                    <path fill="currentColor"
                      d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z">
                    </path>
                    <path fill="currentColor"
                      d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z">
                    </path>
                  </svg>
                </button>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
              <div class="border border-slate-200 bg-slate-50 p-4 rounded-xl space-y-2 w-full">
                <h3 class="text-sm font-medium leading-none text-slate-900">Amount :</h3>
                <div class="bg-white px-3 py-2 rounded-lg flex items-center justify-between gap-2 border border-slate-200">
                  <span id="copyAmount" class="text-xs font-mono text-slate-800 truncate">
                    <span id="coin-amount-text"></span><span id="coin-amount-text-trc">{{ $hasQR ? $customer->QRs['qrAmount'] :'' }}</span>
                  </span>
                  <button type="button"
                    onclick="copyAmount(); showToast && showToast('success', 'Copied to clipboard!')"
                    class="ml-2 p-2 rounded-md border border-slate-200 text-slate-700
                           hover:border-sky-500 hover:bg-sky-50 transition
                           focus:outline-none focus:ring-2 focus:ring-sky-200">
                    <svg class="w-5 h-5" viewBox="0 0 1024 1024" aria-hidden="true">
                      <path fill="currentColor"
                        d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z">
                      </path>
                      <path fill="currentColor"
                        d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>

              {{-- Pending Amount --}}
              <div class="border border-slate-200 bg-slate-50 p-4 rounded-xl space-y-2 w-full">
                <h3 class="text-sm font-medium leading-none text-slate-900">Pending Amount :</h3>
                <div class="bg-white px-3 py-2 rounded-lg flex items-center justify-between gap-2 border border-slate-200">
                  <span id="pendingAmount" class="text-xs font-mono text-slate-800 truncate">
                    {{ $hasQR ? $customer->QRs['qrAmount']-$customer->QRs['qrPendingAmount']:'' }}
                  </span>
                  <button type="button"
                    onclick="navigator.clipboard.writeText(document.getElementById('pendingAmount').innerText.trim()).catch(()=>{}); showToast && showToast('success', 'Copied to clipboard!')"
                    class="ml-2 p-2 rounded-md border border-slate-200 text-slate-700
                           hover:border-sky-500 hover:bg-sky-50 transition
                           focus:outline-none focus:ring-2 focus:ring-sky-200">
                    <svg class="w-5 h-5" viewBox="0 0 1024 1024" aria-hidden="true">
                      <path fill="currentColor"
                        d="M768 832a128 128 0 0 1-128 128H192A128 128 0 0 1 64 832V384a128 128 0 0 1 128-128v64a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64h64z">
                      </path>
                      <path fill="currentColor"
                        d="M384 128a64 64 0 0 0-64 64v448a64 64 0 0 0 64 64h448a64 64 0 0 0 64-64V192a64 64 0 0 0-64-64H384zm0-64h448a128 128 0 0 1 128 128v448a128 128 0 0 1-128 128H384a128 128 0 0 1-128-128V192A128 128 0 0 1 384 64z">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            {{-- <div class="flex justify-center pt-2">
              <button type="button" onclick="backScreen('coinChoose', 'paymentChoose')"
                class="px-5 py-2.5 mx-auto sm:mx-0 flex items-center justify-center gap-2
                       text-sm md:text-base capitalize tracking-wide rounded-full
                       border border-slate-300 bg-white text-slate-700
                       font-semibold shadow-sm hover:border-sky-500 hover:bg-sky-50
                       active:scale-95 transition-all duration-300 ease-out group">
                Cancel
              </button>
            </div> --}}

            <form method="POST" action="{{ route('pay.qr.cancel') }}">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $customer->QRs['transaction_id']??'' }} ">

                <button type="submit"
                    class="px-5 py-2.5 mx-auto sm:mx-0 flex items-center justify-center gap-2
                          text-sm md:text-base capitalize tracking-wide rounded-full
                          border border-slate-300 bg-white text-slate-700
                          font-semibold shadow-sm hover:border-sky-500 hover:bg-sky-50
                          active:scale-95 transition-all duration-300 ease-out group">
                    Cancel
                </button>

                {{-- <button type="button" onclick="backScreen('coinChoose', 'paymentChoose')"
                  class="px-5 py-2.5 mx-auto sm:mx-0 flex items-center justify-center gap-2
                        text-sm md:text-base capitalize tracking-wide rounded-full
                        border border-slate-300 bg-white text-slate-700
                        font-semibold shadow-sm hover:border-sky-500 hover:bg-sky-50
                        active:scale-95 transition-all duration-300 ease-out group">
                  Back
                </button> --}}
            </form>


          </div>
        </div>
      </div>

      {{-- Disclaimer bottom --}}
      <div
        class="mt-5 w-full mx-auto rounded-2xl p-5
               border border-slate-200 bg-white shadow-[0_15px_40px_rgba(15,23,42,.08)] backdrop-blur-xl">
        <h3 class="text-lg font-semibold leading-none text-slate-900 mb-4">
          Disclaimer
        </h3>
        <div class="space-y-3 text-sm text-slate-600">
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or
              failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your
              package.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-sky-400"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-sky-600" href="mailto:support@9pay.co">support@9pay.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

{{-- FLOW JS --}}
<script>
  let selectedNetworkType = null;   // 'evm' | 'trc'
  let selectedNetwork = null;       // 'polygon' | 'bsc' | etc
  let selectedCoin = null;          // 'USDT' etc

  

  // STEP 1: choose network -> show coinChoose
  function chooseCoin(type, network) {
    // alert(type+" "+network)
    selectedNetworkType = type;
    selectedNetwork = network;

    document.getElementById('network_type').value = type;
    document.getElementById('network_name').value = network;

    document.getElementById('networkChoose').style.display = 'none';
    document.getElementById('coinChoose').style.display = 'block';
    document.getElementById('paymentChoose').style.display = 'none';
    
    
  }

  // Back from coinChoose to networkChoose
  function backScreen(showId, hideId) {
    document.getElementById(showId).style.display = 'block';
    document.getElementById(hideId).style.display = 'none';
    document.getElementById('paymentChoose').style.display = 'none';
    
  }

  // Coin select change
  function selectCoinChain(defaultCoin) {
    const select = document.getElementById('coinSelect');
    selectedCoin = select.value || defaultCoin;
  }

  // STEP 2 -> STEP 3
  function choosePaymentOption() {
    const amountInput = document.getElementById('coin_amount');
    const select = document.getElementById('coinSelect');

    const amount = amountInput.value.trim();
    const coin = select.value;

    if (!selectedNetworkType || !selectedNetwork) {
      alert('Please select network first.');
      return;
    }
    if (!coin) {
      alert('Please select coin.');
      return;
    }
    if (!amount || isNaN(amount)) {
      alert('Please enter valid amount.');
      return;
    }

    selectedCoin = coin;

    // Chain label
    const chainSpan = document.getElementById('chainSelected');
    chainSpan.textContent = (selectedNetwork || '').toUpperCase();

    // Amount text
    const evmAmountSpan = document.getElementById('coin-amount-text');
    const trcAmountSpan = document.getElementById('coin-amount-text-trc');
    evmAmountSpan.textContent = '';
    trcAmountSpan.textContent = '';

    if (selectedNetworkType === 'evm') {
      evmAmountSpan.textContent = amount + ' ' + coin;
      trcAmountSpan.textContent = '';
      document.getElementById('paymentEVM').style.display = 'block';
      document.getElementById('paymentTRC').style.display = 'none';
    } else if (selectedNetworkType === 'trc') {
      trcAmountSpan.textContent = amount + ' ' + coin;
      evmAmountSpan.textContent = '';
      document.getElementById('paymentEVM').style.display = 'none';
      document.getElementById('paymentTRC').style.display = 'block';
    }

    // Show payment step
    document.getElementById('coinChoose').style.display = 'none';
    document.getElementById('paymentChoose').style.display = 'block';
  }

  // Copy helpers
  function copyOgEvmAddress() {
    const el = document.getElementById('copyOgEvmAddress');
    if (!el) return;
    navigator.clipboard.writeText(el.innerText.trim()).catch(() => { });
  }

  function copyAmount() {
    const el = document.getElementById('copyAmount');
    if (!el) return;
    navigator.clipboard.writeText(el.innerText.trim()).catch(() => { });
  }



</script>
@endsection
<script>
let txnId = "{{ $customer->QRs['transaction_id'] ?? '' }}"; // passed from controller

function checkPaymentStatus() {
  console.log(txnId);
    if (txnId !== '') {
        fetch(`/api/payment-status/${txnId}`)
            .then(response => response.json())
            .then(data => {

                if (data.status === "success") {

                    console.log("Payment Status:", data);

                    document.getElementById("coin-amount-text-trc").textContent = data.amount;
                    document.getElementById("pendingAmount").textContent = (data.amount - data.received_amount).toFixed(2);
                    document.getElementById("transaction_status").textContent = data.payment_status.toUpperCase();

                    // When payment is completed
                    if (data.is_paid === true) {
                        showToast("success", "Payment received!");
                        clearInterval(checkInterval);
                  
                    }
                }
            })
            .catch(err => console.error("Error:", err));
    }
}
// Auto-run every 3 seconds
let checkInterval = setInterval(checkPaymentStatus, 3000);
// window.checkPaymentStatus = checkPaymentStatus;
</script>
