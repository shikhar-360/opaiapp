@props(['customer'])
<div data-dialog-backdrop="withdraw-success"
  class="fixed inset-0 z-[999] grid place-items-center
         bg-black/60 backdrop-blur-sm p-3
         pointer-events-none opacity-0 transition-opacity duration-300">

  <div data-dialog="withdraw-success" class="w-full max-w-md">
    <div
      class="relative p-5 md:p-6 rounded-2xl w-full mx-auto overflow-hidden
             border border-slate-200 bg-white
             shadow-[0_20px_50px_rgba(15,23,42,.20)]
             backdrop-blur-2xl">

      <!-- glow blobs -->
      <div class="pointer-events-none absolute -top-16 -right-16 w-48 h-48 bg-[var(--theme-skky-300)]/25 rounded-full blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-16 -left-16 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>

      <!-- close -->
      <button data-dialog-close="withdraw-success"
        class="h-9 w-9 flex items-center justify-center
               rounded-lg border border-slate-200 bg-white absolute top-3 right-3
               hover:bg-slate-100 transition"
        type="button">
        <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <!-- header -->
      <div class="relative text-center">
        <div class="mx-auto w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-200
                    flex items-center justify-center shadow-sm">
          <svg class="w-7 h-7 text-emerald-600" viewBox="0 0 24 24" fill="none">
            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h2 class="mt-4 text-lg sm:text-xl font-semibold text-slate-900">
          🎉 Congratulations!
        </h2>

        <p class="mt-1 text-sm text-slate-600">
          You have successfully withdrawn.
        </p>
      </div>

      <!-- amount card -->
      <div class="relative mt-6">
        <div
          class="flex items-center justify-between gap-3 p-4 rounded-2xl
                 border border-slate-200 bg-white
                 shadow-[0_12px_32px_rgba(15,23,42,.10)]
                 backdrop-blur-xl">

          <div class="min-w-0">
            <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--theme-primary-text)] font-medium">
              Amount
            </p>
            <p class="text-xl sm:text-2xl font-extrabold text-slate-900 tabular-nums">
              <span id="withdrawAmountText">{{ $customer->latest_withdraw_amount }}</span>
            </p>
          </div>

          <span class="inline-flex items-center rounded-full bg-[var(--theme-skkky-50)]
                       border border-[var(--theme-skky-200)]
                       px-3 py-1 text-[11px] sm:text-xs font-medium text-[var(--theme-primary-text)]">
            USDT
          </span>
        </div>
      </div>

      <!-- actions -->
      <div class="mt-6 flex items-center justify-center gap-3">
        <button data-dialog-close="withdraw-success" 
          onclick="closeWithdrawPopup()"
          type="button"
          class="px-4 py-2 rounded-lg border border-slate-200
                 bg-white text-slate-700 text-sm font-semibold
                 hover:bg-slate-100 transition">
          Close
        </button>

        <button data-dialog-close="withdraw-success" type="button"
          class="px-5 py-2 rounded-lg text-white font-semibold
                 bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                 shadow-[0_10px_25px_rgba(56,189,248,.40)]
                 hover:shadow-[0_16px_30px_rgba(56,189,248,.55)]
                 active:scale-95 transition">
          OK 🚀
        </button>
      </div>

      <div class="absolute inset-x-3 bottom-0 h-px
                  bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
    </div>
  </div>
</div>
<script>
function openWithdrawPopup() {
  const popup = document.querySelector('[data-dialog-backdrop="withdraw-success"]');
  if (!popup) return;

  popup.classList.remove('pointer-events-none', 'opacity-0');
  popup.classList.add('opacity-100');
}
openWithdrawPopup();
function closeWithdrawPopup() {

  const popup = document.querySelector('[data-dialog-backdrop="withdraw-success"]');
  if (!popup) return;

  popup.classList.add('pointer-events-none', 'opacity-0');
  popup.classList.remove('opacity-100');

  const stopWithdrawPopupUrl = "https://user.ordinarypeopleai.com/stop-withdrawpopup";

  fetch(stopWithdrawPopupUrl, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
          'Accept': 'application/json'
      },
      body: JSON.stringify({ user_id: {{ $customer->id }} })
  });
  /*.then(res => res.json())
  .then(data => {
      
      console.log(data);

      
  });*/
}
</script>

