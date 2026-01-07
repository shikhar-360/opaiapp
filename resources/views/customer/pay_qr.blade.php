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
        <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-14 -left-10 w-40 h-40 rounded-full bg-cyan-300/20 blur-3xl"></div>

        <div class="w-full relative z-10">
          <h3 class="text-lg font-semibold text-slate-900 mb-4">
            Choose Network
          </h3>

          <div class="grid grid-cols-2 gap-5">
            {{-- POLYGON --}}
            <div onclick="chooseCoin('evm', 'polygon')" class=" text-center cursor-pointer">
              <div
                class="p-4 rounded-xl border border-slate-200 bg-white
                       hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)] transition-colors">
                <img src="/assets/images/coin-icon/polygone.png" width="64" height="48" alt="polygon"
                  class="w-12 sm:w-14 h-auto mx-auto">
              </div>
              <h3 class="text-base mt-4 text-slate-800 leading-none">
                POLYGON
              </h3>
            </div>

            {{-- BSC --}}
            <div onclick="chooseCoin('evm', 'bsc')" class="text-center cursor-pointer">
              <div
                class="p-4 rounded-xl border border-slate-200 bg-white
                       hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)] transition-colors">
                <img src="/assets/images/coin-icon/bsc.png" width="64" height="48" alt="bsc"
                  class="w-12 sm:w-14 h-auto mx-auto">
              </div>
              <h3 class="text-base mt-4 text-slate-800 leading-none">
                BSC
              </h3>
            </div>

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
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon, BSC) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your membership.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-[var(--theme-high-text)]" href="mailto:support@9pay.co">support@9pay.co</a>
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

        <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-[var(--theme-skky-300)]/20 blur-3xl"></div>

        <form id="qrpayForm" class="relative mt-2 space-y-4" method="post" action="{{ route('pay.qr.save') }}">
          @csrf
          <div class="w-full relative z-10">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-slate-900">
              <span onclick="backScreen('networkChoose', 'coinChoose');" class="inline-flex">
                <svg class="p-px w-5 h-5 cursor-pointer text-slate-500" viewBox="0 0 1024 1024" aria-hidden="true">
                <path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="currentColor"></path>
                </svg>
              </span>
              Choose Coin (<span id="selected_network" class="uppercase"></span>)
            </h3>

            <div class="w-full flex-1 text-center mx-auto mt-6">
              <div class="space-y-4 max-w-md mx-auto">
                {{-- Select --}}
                <div class="text-left">
                  <label for="coinSelect"
                  class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                    Coin
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3
                         border border-slate-200 bg-white
                         focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])]
                         focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                    <select id="coinSelect" name="coinSelect" onchange="selectCoinChain('USDT');"
                      class="w-full bg-transparent text-slate-900 text-sm outline-none cursor-pointer">
                    <option value="" disabled selected class="bg-white text-slate-900">
                        Select an option
                      </option> 
                      <option class="text-black" id="usdtToken" value="USDT">USDT</option>
                    </select>
                    <input type="hidden" id="network_type" name="network_type" value="evm">
                    <input type="hidden" id="network_name" name="network_name" value="polygon">
                  </div>
                </div>

                {{-- Amount --}}
                <div class="text-left">
                  <label for="coin_amount"
                  class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                    Amount
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3
                         border border-slate-200 bg-white
                         focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])]
                         focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                         {{-- ✅ AB MANUAL INPUT NAHI: READONLY --}}
                    {{-- <input type="text" id="amount" name="amount" value=""
                      class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                      placeholder="Select amount below" readonly required> --}}
                      <input type="text" id="coin_amount" name="coin_amount" readonly value=""
                    class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                    placeholder="Select amount below">
                  </div>
                    {{-- <select id="amount" name="amount" onchange="selectCoinChain('USDT');"
                      class="w-full bg-transparent text-slate-900 text-sm outline-none cursor-pointer">
                      <option value="" disabled selected class="bg-white text-slate-900">
                        Select Amount
                      </option>
                      <option class="text-black" value="5"> 5 </option>
                       <option class="text-black" value="10"> 10 </option>
                       <option class="text-black" value="25"> 25 </option>
                       <option class="text-black" value="50"> 50 </option>
                    </select> --}}
                  {{-- ✅ QUICK AMOUNT BUTTONS --}}
                  <div class="flex flex-wrap gap-2 mt-3">
                    <button type="button" class="amount-btn" onclick="setCoinAmount(5, this)">OP 5</button>
                    <button type="button" class="amount-btn" onclick="setCoinAmount(10, this)">OP 10</button>
                    <button type="button" class="amount-btn" onclick="setCoinAmount(25, this)">OP 25</button>
                    <button type="button" class="amount-btn" onclick="setCoinAmount(50, this)">OP 50</button>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-center mt-6">
                <button  type="submit"
                  class="px-5 py-2.5 cursor-pointer flex items-center justify-center gap-2
                       text-sm md:text-base capitalize tracking-wide rounded-full
                       border border-[var(--theme-skky-500)] bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                       text-white font-semibold
                       
                       hover:translate-y-[-4px]
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
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon, BSC) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your membership.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-[var(--theme-high-text)]" href="mailto:support@9pay.co">support@9pay.co</a>
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
            <img src="/assets/images/9logo.png" width="100" height="100" alt="Logo" class="h-8 w-auto invert">
            <div class="flex flex-col">
              <!-- <span class="text-xs uppercase tracking-[0.15em] text-slate-500">EVM Network</span> -->
              <h3 class="text-md sm:text-xl font-semibold text-slate-900 flex items-center gap-1">
                <span class="uppercase text-[var(--theme-high-text)]" id="chainSelected"></span>
                <span class="text-slate-800 uppercase" id="selected_network2">{{ $customer->QRs['network_name'] ?? '' }}</span>
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
          <div class="w-full md:w-[260px] flex items-start justify-center">
            <div class="rounded-xl overflow-hidden bg-slate-100 p-3 w-full flex items-center justify-center">
              {{-- EVM QR --}}
              <div id="paymentEVM" class="w-full flex items-center justify-center">
                <img src="{{$hasQR ? $customer->QRs['ethQrCode'] : '' }}" width="240" height="240" alt="ETH QR Code" class="qr-code">
              </div>

              {{-- TRC QR --}}
              <div id="paymentTRC" class="w-full flex items-center justify-center hidden">
                
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
                    {{$hasQR ? substr($customer->QRs['ethAddress'], 0, 10) . '...' . substr($customer->QRs['ethAddress'], -10):''}}
                  </span>
                </div>
                <button type="button"
                  onclick="copyOgEvmAddress(); showToast && showToast('success', 'Copied to clipboard!')"
                  class="ml-2 p-2 rounded-md border border-slate-200 text-slate-700
                         hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)] transition
                         focus:outline-none focus:ring-2 focus:ring-[var(--theme-skky-200)]">
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
                           hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)] transition
                           focus:outline-none focus:ring-2 focus:ring-[var(--theme-skky-200)]">
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
                    {{ $hasQR ? $customer->QRs['qrPendingAmount']:'0' }}
                  </span>
                  <button type="button"
                    onclick="navigator.clipboard.writeText(document.getElementById('pendingAmount').innerText.trim()).catch(()=>{}); showToast && showToast('success', 'Copied to clipboard!')"
                    class="ml-2 p-2 rounded-md border border-slate-200 text-slate-700
                           hover:border-[var(--theme-skky-500)] hover:bg-[var(--theme-skkky-50)] transition
                           focus:outline-none focus:ring-2 focus:ring-[var(--theme-skky-200)]">
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
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Exact Payment Requirement : Send the exact amount displayed, including fees, to avoid extra charges or failed credit.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>Network Verification : Only use the selected blockchain network (Polygon, BSC) while making payment.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>QR to Top-Up Transfer : Amount paid via QR is added to Top-Up Balance. Use Pay by Top-Up to activate your membership.</p>
          </div>
          <div class="flex items-start gap-2">
            <span class="mt-1 w-2 h-2 rounded-full bg-[var(--theme-skky-400)]"></span>
            <p>
              Transaction Support : For any payment related assistance, contact
              <a class="underline text-[var(--theme-high-text)]" href="mailto:support@9pay.co">support@9pay.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

{{-- ✅ BUTTON STYLE (same premium look) --}}
<style>
  .amount-btn{
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.85rem;
    font-weight: 700;
    border: 1px solid #e2e8f0;
    background: #fff;
    color: #0f172a;
    transition: all .2s ease;
  }
  .amount-btn:hover{
    border-color: var(--theme-skky-500);
    background: var(--theme-skkky-50);
  }
  .amount-btn.active{
    background: linear-gradient(to right, var(--theme-skky-500), var(--theme-skky-600));
    color: #fff;
    border-color: var(--theme-skky-500);
  }
</style>

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

    // reset amount when entering coin step
    document.getElementById('coin_amount').value = '';
    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));

    document.getElementById('network_type').value = type;
    document.getElementById('network_name').value = network;
    
    document.getElementById('networkChoose').style.display = 'none';
    document.getElementById('coinChoose').style.display = 'block';
    document.getElementById('paymentChoose').style.display = 'none';
    
    document.getElementById('selected_network').textContent = network;
    document.getElementById('selected_network2').textContent = network;
    
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


  function setCoinAmount(value, el){
    const input = document.getElementById('coin_amount');
    input.value = value;

    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
    el.classList.add('active');

    typeof showToast === 'function' && showToast('success', `Amount Selected: ${value}`);
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
      alert('Please select valid amount.');
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
    navigator.clipboard.writeText(el.innerText.trim()).catch(() => {});
  }

  function copyAmount() {
    const el = document.getElementById('copyAmount');
    if (!el) return;
    navigator.clipboard.writeText(el.innerText.trim()).catch(() => {});
  }



</script>
@endsection
<script>
let txnId = "{{ $customer->QRs['transaction_id'] ?? '' }}"; // passed from controller

function checkPaymentStatus() {
  console.log(txnId, "hello");
    if (txnId !== '') {
        fetch(`/api/payment-status/${txnId}`)
            .then(response => response.json())
            .then(data => {

                if (data.status === "success") {
                    // console.log("Payment Status:", data);
                    document.getElementById("coin-amount-text-trc").textContent = Number(data.amount).toFixed(2);
                    document.getElementById("pendingAmount").textContent = Number(data.pending_amount).toFixed(2);
                    document.getElementById("transaction_status").textContent = data.payment_status.toUpperCase();
                    // When payment is completed
                    if (Boolean(data.is_paid)) 
                    {
                        // showToast("success", "Payment received!");
                        // clearInterval(checkInterval);
                        window.location.href = "/pay-topup";
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