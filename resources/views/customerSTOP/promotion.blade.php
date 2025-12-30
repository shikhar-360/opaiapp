@extends('app')

@section('title', 'Educare')

@section('content')
<section class="min-h-screen py-8 bg-slate-50/50 px-4">
  <div class="mx-auto max-w-[1470px]">

    
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
      <div>
        <h2 class="text-lg sm:text-2xl font-semibold text-slate-900">Promotion</h2>
        <p class="text-xs sm:text-sm text-slate-500">Promotion will be available here.</p>
      </div>
    </div>

  
    <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] p-4 md:p-6">
      <div class="absolute inset-0 opacity-70 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
      </div>

   
      <div class="relative">
        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 sm:p-10 shadow-md backdrop-blur-xl">
          <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--theme-skky-400)]/15 via-transparent to-fuchsia-400/15 opacity-70 blur-xl"></div>

          <div class="relative flex flex-col items-center text-center">
            
            <span class="inline-flex items-center gap-2 rounded-full bg-[var(--theme-skkky-50)] px-4 py-1.5 text-xs font-semibold text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]">
              <span class="inline-flex h-2 w-2 rounded-full bg-amber-400"></span>
              Promotion
            </span>

            <h3 class="mt-4 text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
              Coming Soon
            </h3>

            <p class="mt-2 text-sm sm:text-base text-slate-500 max-w-xl">
              We are building this section for Promotions. Stay tuned!
            </p>

           
            <div class="mt-6 h-[2px] w-40 rounded-full bg-gradient-to-r from-transparent via-[var(--theme-skky-500)] to-transparent opacity-70"></div>

           
            <div class="mt-6 flex flex-col sm:flex-row gap-3">
              <!-- <a href="{{ url()->previous() }}"
                 class="inline-flex items-center justify-center px-5 py-2.5 rounded-full
                             bg-[var(--theme-skky-600)] text-white text-sm font-semibold
                             hover:bg-[var(--theme-skky-500)] active:scale-95 transition-all
                             border border-[var(--theme-skky-500)] shadow-md cursor-pointer">
                Go Back
              </a> -->

             
            </div>

           
          
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
@endsection
