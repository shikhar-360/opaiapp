<div data-dialog-backdrop="dialog"
     class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black/70 opacity-0 backdrop-blur-sm transition-opacity duration-300 overflow-auto p-2">
  <div data-dialog="dialog" class="text-white w-full max-w-xl" style="max-height: calc(100% - 0px);">
    <div
      class="p-4 md:p-6 text-white rounded-2xl w-full mx-auto border border-slate-700/80 bg-slate-900/90 backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.9)] relative overflow-hidden text-left">

      <!-- soft glow background -->
      <div class="absolute inset-0 opacity-50 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-cyan-500/25 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl"></div>
      </div>

      <div class="relative flex items-start justify-between">
        <h2 class="flex shrink-0 items-center text-xl font-semibold text-slate-50">
          Withdraw
        </h2>
        <button data-dialog-close="true"
                class="relative h-8 w-8 bg-slate-900/80 border border-slate-700/70 flex items-center justify-center select-none rounded-lg text-center hover:bg-slate-800/80 transition"
                type="button">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
               class="h-5 w-5 text-slate-200">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div class="relative pt-4 leading-normal font-light">

        <!-- TOP CARDS: Available + Pending -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-3 sm:gap-5 mb-5">
          <!-- Available balance -->
          <div
            class="relative group rounded-2xl overflow-hidden border border-slate-700/70 bg-gradient-to-br from-slate-900 via-slate-900/95 to-slate-900/90 shadow-[0_10px_30px_rgba(15,23,42,.9)]">
            <div class="pointer-events-none absolute inset-0 opacity-40">
              <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full blur-3xl bg-cyan-400/20"></div>
              <div class="absolute -bottom-28 -right-28 w-80 h-80 rounded-full blur-3xl bg-emerald-400/20"></div>
            </div>
            <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
              <!-- icon -->
              <div class="relative">
                <div
                  class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-cyan-400 to-emerald-400 opacity-40 blur group-hover:opacity-70 transition-opacity">
                </div>
                <div
                  class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-slate-950/80 border border-slate-700/70 relative">
                  <img src="/assets/images/icons/total-withdraw.webp" width="100" height="100" alt="Logo"
                       class="w-10 h-10 object-contain">
                </div>
              </div>
              <div class="w-full min-w-0">
                <h3 class="mb-1 text-sm sm:text-base leading-none font-semibold text-slate-50">
                  Available Balance
                </h3>
                <p class="text-sm">
                  <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">
                    $0.000
                  </span>
                </p>
              </div>
            </div>
          </div>

          <!-- Pending balance -->
          <div
            class="relative group rounded-2xl overflow-hidden border border-slate-700/70 bg-gradient-to-br from-slate-900 via-slate-900/95 to-slate-900/90 shadow-[0_10px_30px_rgba(15,23,42,.9)]">
            <div class="pointer-events-none absolute inset-0 opacity-40">
              <div class="absolute -top-24 -left-24 w-72 h-72 rounded-full blur-3xl bg-sky-400/20"></div>
              <div class="absolute -bottom-28 -right-28 w-80 h-80 rounded-full blur-3xl bg-amber-400/20"></div>
            </div>
            <div class="relative z-10 flex items-center gap-3 w-full h-full p-4 md:p-5">
              <!-- icon -->
              <div class="relative">
                <div
                  class="absolute inset-0 -m-1 rounded-full bg-gradient-to-r from-sky-400 to-amber-400 opacity-40 blur group-hover:opacity-70 transition-opacity">
                </div>
                <div
                  class="min-w-16 w-16 h-16 flex items-center justify-center rounded-2xl bg-slate-950/80 border border-slate-700/70 relative">
                  <img src="/assets/images/icons/total-withdraw.webp" width="100" height="100" alt="Logo"
                       class="w-10 h-10 object-contain">
                </div>
              </div>
              <div class="w-full min-w-0">
                <h3 class="mb-1 text-sm sm:text-base leading-none font-semibold text-slate-50">
                  Pending Balance
                </h3>
                <p class="text-sm">
                  <span class="text-[var(--theme-high-text)] font-extrabold text-lg sm:text-xl">
                    $0.000
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- FORM (STATIC / NO ACTION) -->
        <form class="relative" id="withdraw-process-form">
          <!-- Amount -->
          <div class="relative">
            <label for="amount" class="block text-xs text-slate-300 font-medium mb-2">
              Enter Amount
            </label>
            <div
              class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-cyan-400/80 focus-within:ring-1 focus-within:ring-cyan-400/60 transition-colors mb-3">
              <svg class="w-7 h-7 min-w-7 min-h-7 text-cyan-300" viewBox="0 0 24 24" fill="none">
                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                      stroke-width="1.5" />
              </svg>
              <input type="text" name="amount" id="amount" autocomplete="off"
                     placeholder="Enter Amount (min withdraw 10)" required
                     class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100 placeholder:text-slate-500">
            </div>
          </div>

          <!-- Admin Fees -->
          <div class="relative">
            <label for="adminFees" class="block text-xs text-slate-300 font-medium mb-2">
              Admin Fees 5%
            </label>
            <div
              class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-cyan-400/80 focus-within:ring-1 focus-within:ring-cyan-400/60 transition-colors mb-3">
              <svg class="w-7 h-7 min-w-7 min-h-7 text-cyan-300" viewBox="0 0 24 24" fill="none">
                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                      stroke-width="1.5" />
              </svg>
              <input type="text" name="admin_charge" readonly id="adminFees" placeholder="0" value="0"
                     class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100">
            </div>
          </div>

          <!-- Final Amount -->
          <div class="relative">
            <label for="yourfinalamount" class="block text-xs text-slate-300 font-medium mb-2">
              Your Final Amount
            </label>
            <div
              class="relative flex items-center p-3 rounded-xl gap-3 border border-slate-700/80 bg-slate-950/70 focus-within:border-emerald-400/80 focus-within:ring-1 focus-within:ring-emerald-400/60 transition-colors mb-3">
              <svg class="w-7 h-7 min-w-7 min-h-7 text-emerald-300" viewBox="0 0 24 24" fill="none">
                <ellipse cx="12" cy="5" rx="9" ry="3" stroke="currentColor" stroke-width="1.5" />
                <path d="M3 5V9C3 10.6569 7.02944 12 12 12C16.9706 12 21 10.6569 21 9V5" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 9V13C3 14.6569 7.02944 16 12 16C16.9706 16 21 14.6569 21 13V9" stroke="currentColor"
                      stroke-width="1.5" />
                <path d="M3 13V17C3 18.6569 7.02944 20 12 20C16.9706 20 21 18.6569 21 17V13" stroke="currentColor"
                      stroke-width="1.5" />
              </svg>
              <input type="text" readonly id="yourfinalamount" placeholder="Your final amount" value="0"
                     class="border-l pl-4 border-slate-700/70 outline-none shadow-none bg-transparent w-full block text-sm md:text-base text-slate-100">
            </div>
          </div>

          <!-- button -->
          <div class="flex items-center justify-center mt-0 relative group max-w-fit mx-auto">
            <button type="button"
                    class="px-5 py-2.5 text-white mx-auto flex items-center justify-center gap-2 text-base capitalize tracking-wide mt-4 rounded-lg border border-[var(--theme-secondary-border)] bg-gradient-to-r from-[var(--theme-primary-text)] to-[var(--theme-primary-bg)] text-black font-semibold shadow-[0_8px_20px_rgba(56,189,248,.30)] hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] transition-all duration-300 ease-out">
              <span class="text-black">Withdraw</span>
              <svg
                class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-1"
                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path clip-rule="evenodd"
                      d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                      fill-rule="evenodd"></path>
              </svg>
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
