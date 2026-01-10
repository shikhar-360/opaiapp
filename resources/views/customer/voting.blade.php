@extends('app')

@section('title', 'Voting')

@section('content')
<section class="min-h-screen pt-10 pb-16 lg:pb-8 bg-slate-50/50">
  <div class="mx-auto max-w-[1400px] px-4">

    <div class="space-y-5 h-full max-w-xl mx-auto">
      <h2 class="text-xl font-semibold mb-4 text-slate-900 text-center">
        Voting
      </h2>

    
        <div class="grid grid-cols-1 h-full">

          {{-- MAIN VOTING CARD --}}
          <div
            class="relative p-4 md:p-6 rounded-2xl w-full min-h-[350px] mx-auto group overflow-hidden
                   border border-slate-200 bg-white backdrop-blur-2xl
                   shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300
                   hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.20)] h-full">

            {{-- subtle gradient glow --}}
            <div class="pointer-events-none absolute inset-0 opacity-70">
              <div class="absolute -top-24 -left-24 w-64 h-64 bg-[var(--theme-skky-300)]/20 rounded-full blur-3xl"></div>
              <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-blue-400/15 rounded-full blur-3xl"></div>
            </div>

            <form method="POST" action="#" enctype="multipart/form-data" class="w-full relative z-10">
              @csrf
              <div class="mx-auto w-full space-y-4">

                {{-- User Id --}}
                <div class="text-left">
                  <label for="voting_user_id"
                         class="block text-[11px] uppercase tracking-wide text-[var(--theme-high-text)] font-medium mb-2">
                    User Id
                  </label>
                  <div
                    class="relative flex items-center p-3 rounded-lg gap-3
                           border border-slate-200 bg-white
                           focus-within:border-[var(--theme-skky-400)] focus-within:ring-1 focus-within:ring-[var(--theme-[var(--theme-skky-100)])]
                           focus-within:bg-[var(--theme-skkky-50)]/60 transition-colors">
                    <input type="text" id="voting_user_id" name="voting_user_id" value=""
                           placeholder="Enter User Id"
                           class="w-full bg-transparent text-slate-900 placeholder:text-slate-400 outline-none text-base [caret-color:#60a5fa]"
                           required aria-describedby="hs-validation-name-success-helper" autocomplete="off">
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                      <svg class="shrink-0 size-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                           viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="text-left">
                  <label class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                    <p id="userNameResult" class="mt-1 text-sm text-slate-600 hidden"></p>
                  </label>
                </div>

                {{-- LEADERSHIP CLUB --}}
                <div class="text-left">
                  <label class="block text-[11px] uppercase tracking-wide text-[var(--theme-primary-text)] font-medium mb-2">
                    LEADERSHIP CLUB
                  </label>

                  <div class="relative">
                    <button type="button"
                            onclick="toggleMultiSelect()"
                            id="multiSelectBtn"
                            class="w-full flex justify-between items-center p-3 rounded-lg border border-slate-200 bg-white
                                   text-sm text-slate-900 cursor-pointer focus:ring-1 focus:ring-[var(--theme-skky-300)]">
                      <span id="multiSelectText">Select options</span>
                      <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7" />
                      </svg>
                    </button>

                    {{-- DROPDOWN --}}
                    <div id="multiSelectDropdown"
                         class="hidden absolute z-20 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg p-2">

                      <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                        <input type="checkbox" value="ACTIVE" class="multiSelectItem">
                        <span>ACTIVE</span>
                      </label>

                      <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                        <input type="checkbox" value="HELPFULL" class="multiSelectItem">
                        <span>HELPFULL</span>
                      </label>

                      <label class="flex items-center gap-2 p-2 cursor-pointer hover:bg-slate-100 rounded">
                        <input type="checkbox" value="HONEST" class="multiSelectItem">
                        <span>HONEST</span>
                      </label>
                    </div>

                    {{-- Hidden input for backend (JSON string) --}}
                    <input type="hidden" name="leadership_club" id="leadership_club_input">
                  </div>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                  <button type="submit"
                          class="px-5 py-2.5 mx-auto flex items-center justify-center
                                 text-sm sm:text-base tracking-wide mt-4
                                 rounded-lg border border-[var(--theme-skky-500)]
                                 bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                                 text-white font-semibold
                                 hover:-translate-y-1 cursor-pointer
                                 active:scale-95 transition-all duration-300 ease-out">
                    <span>Vote</span>
                    <svg id="svg1-icon"
                         class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                         aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z">
                      </path>
                    </svg>
                  </button>
                </div>

              </div>
            </form>

            <div class="absolute inset-x-3 bottom-0 h-px bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent opacity-100"></div>
          </div>
        </div>
      
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  function updateMultiSelectState() {
    const checkedItems = Array.from(document.querySelectorAll(".multiSelectItem:checked"));
    const selected = checkedItems.map(i => i.value);

    // backend ke liye JSON (controller me json_decode kar lena)
    document.getElementById("leadership_club_input").value = JSON.stringify(selected);

    // button text update
    document.getElementById("multiSelectText").innerText =
      selected.length ? selected.join(", ") : "Select options";
  }

  window.toggleMultiSelect = function () {
    document.getElementById("multiSelectDropdown").classList.toggle("hidden");
  }

  document.querySelectorAll(".multiSelectItem").forEach(item => {
    item.addEventListener("change", updateMultiSelectState);
  });

  updateMultiSelectState();

  // click outside -> dropdown close
  document.addEventListener("click", (e) => {
    const btn = document.getElementById("multiSelectBtn");
    const dd  = document.getElementById("multiSelectDropdown");

    if (btn && dd && !btn.contains(e.target) && !dd.contains(e.target)) {
      dd.classList.add("hidden");
    }
  });

  // ===== UserId -> fetch user name =====
  const userIdInput = document.getElementById('voting_user_id');
  const resultEl = document.getElementById('userNameResult');

  let timer;
  const delay = 500;

  userIdInput.addEventListener('input', () => {
    clearTimeout(timer);

    const userId = userIdInput.value.trim();

    if (userId.length < 4) {
      resultEl.classList.add('hidden');
      resultEl.innerText = '';
      return;
    }

    timer = setTimeout(() => {
      const userNameUrl = "{{ route('fetch.user.name') }}";
      fetch(userNameUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ user_id: userId })
      })
      .then(res => res.json())
      .then(data => {
        resultEl.classList.remove('hidden');

        if (data.status === 'success') {
          resultEl.textContent = `Name: ${data.name}`;
          resultEl.classList.remove('text-red-600');
          resultEl.classList.add('text-green-600');
        } else {
          resultEl.textContent = data.message;
          resultEl.classList.remove('text-green-600');
          resultEl.classList.add('text-red-600');
        }
      });
    }, delay);
  });

});
</script>
@endpush
