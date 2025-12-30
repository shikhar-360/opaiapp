@props(['customer'])
<div data-dialog-backdrop="rank-dialog"
  class="fixed inset-0 z-[999] grid place-items-center
         bg-black/60 backdrop-blur-sm p-3">

  <div data-dialog="rank-dialog" class="w-full max-w-md">
    <div
      id="rankCaptureBox"
      class="relative p-5 md:p-6 rounded-2xl w-full mx-auto overflow-hidden
             border border-slate-200 bg-white
             shadow-[0_20px_50px_rgba(15,23,42,.20)]
             backdrop-blur-2xl">

      <!-- glow blobs -->
      <div class="pointer-events-none absolute -top-16 -right-16 w-48 h-48 bg-[var(--theme-skky-300)]/25 rounded-full blur-3xl"></div>
      <div class="pointer-events-none absolute -bottom-16 -left-16 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>

      <!-- header -->
      <div class="relative flex items-center justify-center mb-4">
        <h2 class="text-lg sm:text-xl font-semibold text-slate-900">
          🎉 Congratulations
        </h2>

        
      </div>
      <button data-capture-exclude data-dialog-close
          onclick="closeRankPopup()"
          class="h-9 w-9 flex items-center justify-center
                 rounded-lg border border-slate-200 bg-white absolute top-2 right-2
                 hover:bg-slate-100 transition">
          <svg class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

      <!-- content -->
      <div class="relative text-center space-y-5">

        <p class="text-sm text-slate-600">
          You have successfully achieved a new rank!
        </p>

        <!-- Rank Card -->
        <div
          class="flex items-center gap-4 p-4 rounded-2xl
                 border border-slate-200 bg-white
                 shadow-[0_12px_32px_rgba(15,23,42,.10)]
                 backdrop-blur-xl justify-center">

          <!-- Rank Image -->
          <div
            class="w-18 h-18 sm:w-20 sm:h-20 rounded-2xl
                   bg-[var(--theme-skkky-50)]
                   border border-[var(--theme-skky-200)]
                   flex items-center justify-center">
            @php
            $rank='';
            @endphp
            @if($customer->leadership_rank == 1 || $customer->leadership_rank == 'gold')
                <img crossorigin="anonymous" src="{{ asset('assets/images/rank/gold-rank.webp?v=1') }}"
                alt="Rank"
                class="w-6 h-6 object-contain">
            @elseif($customer->leadership_rank == 2 || $customer->leadership_rank == 'sapphire')
                <img crossorigin="anonymous" src="{{ asset('assets/images/rank/sapphire-rank.webp?v=1') }}" 
                alt="Rank"
                class="w-6 h-6 object-contain">
            @elseif($customer->leadership_rank == 3 || $customer->leadership_rank == 'emerald')
                <img crossorigin="anonymous" src="{{ asset('assets/images/rank/emerald-rank.webp?v=1') }}" 
                alt="Rank"
                class="w-6 h-6 object-contain">
            @elseif($customer->leadership_rank == 4 || $customer->leadership_rank == 'ruby')
                <img crossorigin="anonymous" src="{{ asset('assets/images/rank/ruby-rank.webp?v=1') }}" 
                alt="Rank"
                class="w-6 h-6 object-contain">
            @elseif($customer->leadership_rank == 5 || $customer->leadership_rank == 'diamond')
                <img crossorigin="anonymous" src="{{ asset('assets/images/rank/diamond-rank.webp?v=1') }}" 
                alt="Rank"
                class="w-8 h-8 object-contain">
            @endif
            <!-- <img src="/assets/images/rank/emerald-rank.webp"
                 alt="Rank"
                 class="w-14 h-14 sm:w-16 sm:h-16 object-contain"> -->
          </div>

          <!-- Rank Info -->
          <div class="text-left">
            <p class="text-[11px] uppercase tracking-[0.18em]
                      text-[var(--theme-primary-text)] font-medium">
              Achieved Rank
            </p>

            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">
            @if($customer->leadership_rank == 1 || $customer->leadership_rank == 'gold')
                Gold
            @elseif($customer->leadership_rank == 2 || $customer->leadership_rank == 'sapphire')
                Sapphire
            @elseif($customer->leadership_rank == 3 || $customer->leadership_rank == 'emerald')
                Emerald
            @elseif($customer->leadership_rank == 4 || $customer->leadership_rank == 'ruby')
                Ruby
            @elseif($customer->leadership_rank == 5 || $customer->leadership_rank == 'diamond')
                Diamond
            @endif
            </h3>

            <span
              class="inline-flex items-center gap-1 mt-2
                     rounded-full bg-[var(--theme-skkky-50)]
                     border border-[var(--theme-skky-200)]
                     px-3 py-1 text-[11px] sm:text-xs
                     font-medium text-[var(--theme-primary-text)]">
              Vip Level:
              <span class="font-semibold">{{ $customer->leadership_champions_rank }}</span>
            </span>
          </div>

          

        </div>

        
        <!-- Actions -->
        <div data-capture-exclude class="flex items-center justify-center gap-3 pt-2">

         
          <button
            id="rankShareBtn"
            onclick="downloadRankCard()"
            class="px-4 py-2 rounded-lg border border-slate-200
                   bg-white text-slate-700 text-sm font-semibold
                   hover:bg-slate-100 transition">
            Share
          </button>

         
          <button
            class="px-5 py-2 rounded-lg text-white font-semibold
                   bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                   shadow-[0_10px_25px_rgba(56,189,248,.40)]
                   hover:shadow-[0_16px_30px_rgba(56,189,248,.55)]
                   active:scale-95 transition">
            Awesome 🚀
          </button>

          <button
            onclick="closeRankPopup()"
            class="px-5 py-2 rounded-lg text-white font-semibold
                   bg-gradient-to-r from-[var(--theme-skky-500)] to-[var(--theme-skky-600)]
                   shadow-[0_10px_25px_rgba(56,189,248,.40)]
                   hover:shadow-[0_16px_30px_rgba(56,189,248,.55)]
                   active:scale-95 transition">
            Close 
          </button>
          

        </div>

      </div>

      <div class="absolute inset-x-3 bottom-0 h-px
                  bg-gradient-to-r from-transparent via-[var(--theme-skky-400)] to-transparent"></div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js"></script>
<script>
  function openRankPopup() {
    const popup = document.querySelector('[data-dialog-backdrop="rank-dialog"]');
    if (!popup) return;

    popup.classList.remove('pointer-events-none', 'opacity-0');
    popup.classList.add('opacity-100');
}

function closeRankPopup() {

  const popup = document.querySelector('[data-dialog-backdrop="rank-dialog"]');
  if (!popup) return;

  popup.classList.add('pointer-events-none', 'opacity-0');
  popup.classList.remove('opacity-100');

  fetch("https://user.ordinarypeopleai.com/stop-rankpopup", {
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


function isDesktopDevice() {
    // Best check: userAgentData (new browsers)
    if (navigator.userAgentData && typeof navigator.userAgentData.mobile === "boolean") {
      return !navigator.userAgentData.mobile;
    }
    // Fallback check
    return window.matchMedia("(pointer:fine)").matches && !/Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
  }

  function downloadBlob(blob, filename = "rank-achievement.png") {
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    a.remove();
    setTimeout(() => URL.revokeObjectURL(url), 1500);
  }

  function withTimeout(promise, ms = 8000) {
    return Promise.race([
      promise,
      new Promise((_, reject) => setTimeout(() => reject(new Error("share_timeout")), ms)),
    ]);
  }

async function shareOrDownloadRankCard() {
    const node = document.getElementById("rankCaptureBox");
    if (!node) return;

    // ✅ detect mobile only (share only on mobile)
    const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

    // Optional loading state
    const btn = document.getElementById("rankShareBtn");
    const oldText = btn?.innerHTML;
    if (btn) {
      btn.disabled = true;
      btn.innerHTML = "Processing...";
    }

    try {
      // ✅ wait images
      const imgs = node.querySelectorAll("img");
      await Promise.all([...imgs].map((img) => {
        if (img.complete) return Promise.resolve();
        return new Promise((res) => {
          img.onload = img.onerror = res;
        });
      }));

      // ✅ wait fonts (fixes alignment)
      if (document.fonts && document.fonts.ready) {
        await document.fonts.ready;
      }

      const blob = await window.htmlToImage.toBlob(node, {
        pixelRatio: 2,
        backgroundColor: "#ffffff",
        cacheBust: true,

        // ✅ remove buttons or anything marked exclude
        filter: (el) => {
          if (!el) return true;
          if (el.closest && el.closest("[data-capture-exclude]")) return false;
          return true;
        },

        onClone: (clonedDoc) => {
          // remove cross-origin stylesheets to avoid cssRules errors
          clonedDoc.querySelectorAll('link[rel="stylesheet"]').forEach((l) => {
            const href = l.getAttribute("href") || "";
            if (href.startsWith("http") && !href.includes(location.host)) l.remove();
          });
        },
      });

      if (!blob) throw new Error("Blob not generated");

      const file = new File([blob], "rank-achievement.png", { type: "image/png" });

      // ✅ SHARE ONLY ON MOBILE (prevents Windows Runtime Broker / Shell Experience)
      if (isMobile && navigator.canShare && navigator.canShare({ files: [file] })) {
        try {
          await navigator.share({
            title: "My New Rank 🎉",
            text: "I just achieved a new rank!",
            files: [file],
          });
          return;
        } catch (e) {
          // cancelled -> fallback download
        }
      }

      // ✅ Always download on desktop OR fallback
      const url = URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = "rank-achievement.png";
      document.body.appendChild(a);
      a.click();
      a.remove();
      setTimeout(() => URL.revokeObjectURL(url), 1000);

    } catch (e) {
      console.error("Capture failed:", e);
      alert("Share failed. Please try again.");
    } finally {
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = oldText || "Share";
      }
    }
  }

  // ✅ keep it global
  window.downloadRankCard = function () {
    return shareOrDownloadRankCard();
  };
</script>