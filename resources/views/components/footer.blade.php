<footer class="text-black py-6 border-t border-slate-500 bg-[#F5F7FC] md:ml-64">
  <div class=" mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center text-center">

      <div class="text-center mb-4 md:mb-0">
        <p>&copy; {{ now()->year }} <span class="text-[var(--theme-high-text)] text-xl font-bold">OpAi</span> All rights reserved.</p>
      </div>

      <div class="flex gap-1 mx-auto sm:mx-0">
        <a href="#" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg opacity-85 hover:opacity-100">
          <img src="{{ asset('assets/images/instagram.svg') }}" alt="instagram"
               class="w-auto h-7 hover:-rotate-[25deg] transition-transform duration-300 ease-in-out invert">
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg opacity-85 hover:opacity-100">
          <img src="{{ asset('assets/images/telegram.svg') }}" alt="telegram"
               class="w-auto h-7 hover:-rotate-[25deg] transition-transform duration-300 ease-in-out invert">
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg opacity-85 hover:opacity-100">
          <img src="{{ asset('assets/images/facebook.svg') }}" alt="facebook"
               class="w-auto h-7 hover:-rotate-[25deg] transition-transform duration-300 ease-in-out ">
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="p-2 rounded-lg opacity-85 hover:opacity-100">
          <img src="{{ asset('assets/images/youtube.svg') }}" alt="youtube"
               class="w-auto h-8 hover:-rotate-[25deg] transition-transform duration-300 ease-in-out ">
        </a>
      </div>

    </div>
  </div>
</footer>
