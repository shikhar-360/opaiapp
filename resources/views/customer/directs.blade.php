@extends('app')

@section('title', 'DApp Header (HTML)')


<style>
  /* 9th column hide as in original */
  #tabledata1 th:nth-child(9),
  #tabledata1 td:nth-child(9) {
    display: none !important;
  }

  #tabledata2 th:nth-child(9),
  #tabledata2 td:nth-child(9) {
    display: none !important;
  }
</style>


@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">

<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-5 mb-5">

  <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-sky-300 to-sky-500 border border-[var(--theme-skky-200)]">
      <img src="{{ asset('assets/images/icons/direct-team-investment.webp?v=1') }}"  class="w-9" alt="Core Circle Contribution">
    </div>
    <div>
      <h3 class=" text-base text-slate-600">Core Circle Contribution</h3>
      <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ number_format($customer->totalDirectInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
    </div>
  </div>

  {{-- Total Team Investment --}}
  <div class="neo-card gap-4 flex items-center bg-white border border-slate-200 rounded-2xl shadow-md">
    <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-gradient-to-br from-emerald-300 to-emerald-500 border border-[var(--theme-skky-200)]">
      <img src="{{ asset('assets/images/icons/total-team-investment.webp?v=1') }}"  class="w-9" alt="Extended Circle Contribution">
    </div>
    <div>
      <h3 class="text-base text-slate-600">Extended Circle Contribution</h3>
      <p class="text-xl font-bold text-[var(--theme-high-text)] mt-1">{{ number_format($customer->totalTeamInvestment, 2, '.', '') }} {{ $customer->appData->currency }}</p>
    </div>
  </div>

</div> 


@php
  // print_r($customer->activeDirectsData);
@endphp
  
  {{-- MY DIRECTS TABLE CARD --}}
  <h2 class="text-lg font-semibold mb-3 text-slate-900">Core Circle</h2>

  <div
    class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] relative overflow-hidden text-left">

    <!-- soft glow background -->
    <div class="absolute inset-0 opacity-70 pointer-events-none">
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-[var(--theme-skky-200)]/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative mb-6">
      {{-- TABS --}}
      <div
        class="incomeOverview_tab flex items-center justify-between gap-3 flex-wrap p-1.5 rounded-2xl bg-slate-100/80 backdrop-blur-md border border-slate-200 shadow-inner">
        <ul class="flex gap-2" data-tabs-toggle="#default-tab-content" role="tablist">
          <li role="presentation">
            <button id="table-total_directs" data-tabs-target="#total_directs" type="button" role="tab"
              aria-controls="total_directs" aria-selected="true"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
              <span class="relative z-[1]">Total Core Circle</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-[var(--theme-primary-text)] border border-[var(--theme-skky-200)]"> 
                {{ $customer->totalDirectsCount }}
              </span>
            </button>
          </li>
          <li role="presentation">
            <button id="table-active_directs" data-tabs-target="#active_directs" type="button" role="tab"
              aria-controls="active_directs" aria-selected="false"
              class="group relative px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold
                     transition flex items-center gap-2">
              <span class="relative z-[1]">Active Core Circle</span>
              <span
                class="inline-flex items-center justify-center text-[10px] px-2 py-0.5 rounded-full bg-white text-emerald-700 border border-emerald-200">
                {{ $customer->totalActiveDirectsCount }}
              </span>
            </button>
          </li>
        </ul>

        {{-- Small hint text --}}
        <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-500 pr-2">
          <span class="inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
          <span>Click tabs to switch between Total / Active Core Circle</span>
        </div>
      </div>
    </div>

    <div id="default-tab-content" class="relative">
      {{-- TOTAL DIRECTS TAB --}}
      <div id="total_directs" role="tabpanel" aria-labelledby="table-total_directs">
        <div class="overflow-x-auto">
          <div id="tabledata1_wrapper" class="dataTables_wrapper no-footer">

            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3 relative z-10">
              {{-- <div class="dataTables_length" id="tabledata1_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata1_length" aria-controls="tabledata1"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div> --}}

              {{-- <div id="tabledata1_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80"
                      placeholder="Search user / wallet / rank" aria-controls="tabledata1">
                  </div>
                </label>
              </div> --}}
            </div>

            <table id="tabledata1"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px;" aria-describedby="tabledata1_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Sr.
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    User Id
                  </th>
                  <!-- <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Wallet Address
                  </th> -->
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Direct
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Team
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Package
                  </th>
                  <!-- <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                    Registration Date
                  </th> -->
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Activation Date
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Team Volume
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Rank
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px] !text-right">
                    Level
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: TOTAL DIRECTS --}}
                @php
                $sr = 1;
                @endphp
                @foreach($customer->allDirectsData as $ackey => $activeDirect)
                <tr class="hover:bg-slate-200 transition">
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $sr++ }}</td>
                  <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">{{ $activeDirect->name }}</td>
                  <!-- <td class="px-4 sm:px-5 py-3 font-mono text-[11px] text-slate-500">{{ $activeDirect->wallet_address }}</td> -->
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalDirectsCount }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalTeamCount }}</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600">{{ number_format($activeDirect->totaldeposit, 2, '.', '') }}</td>
                  <!-- <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->registration_date }}</td> -->
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->activation_date ? \Carbon\Carbon::parse($activeDirect->activation_date)->format('d-m-Y'): '-' }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalTeamInvestment }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">
                    <span
                      class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[11px] text-slate-700 border border-slate-300 ">
                      {{ $activeDirect->leadership_champions_rank??'-' }} 
                    </span>
                  </td>
                  <td class="px-4 sm:px-5 py-3 text-right text-black">{{ $activeDirect->level_id ?? 1 }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{-- <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
              <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata1_info" role="status"
                aria-live="polite">
                Showing 1 to 5 of 5 entries
              </div>
              <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
                id="tabledata1_paginate">
                <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata1" aria-role="link" data-dt-idx="previous" tabindex="0"
                  id="tabledata1_previous">Previous</a>
                <span class="text-xs text-slate-700">1</span>
                <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata1" aria-role="link" data-dt-idx="next" tabindex="0"
                  id="tabledata1_next">Next</a>
              </div>
            </div> --}}

          </div>
        </div>
      </div>

      {{-- ACTIVE DIRECTS TAB --}}
      <div class="hidden" id="active_directs" role="tabpanel" aria-labelledby="table-active_directs">
        <div class="overflow-x-auto">
          <div id="tabledata2_wrapper" class="dataTables_wrapper no-footer">

            {{-- TOP BAR: SHOW + SEARCH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
              <!-- <div class="dataTables_length" id="tabledata2_length">
                <label class="text-xs text-slate-600 flex items-center gap-2">
                  <span>Show</span>
                  <select name="tabledata2_length" aria-controls="tabledata2"
                    class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  <span>entries</span>
                </label>
              </div> -->

              <!-- <div id="tabledata2_filter" class="dataTables_filter w-full sm:w-auto">
                <label class="text-xs text-slate-600 w-full">
                  <span class="sr-only">Search</span>
                  <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                      {{-- Search icon --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 104.384 2.384.75.75 0 011.232-.848A7 7 0 1110 3.5a.75.75 0 010 1.5z"
                          clip-rule="evenodd" />
                        <path
                          d="M12.743 11.243a.75.75 0 011.06 0l2.97 2.97a.75.75 0 11-1.06 1.06l-2.97-2.97a.75.75 0 010-1.06z" />
                      </svg>
                    </span>
                    <input type="search"
                      class="block w-full bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-emerald-400/80 focus:border-emerald-400/80"
                      placeholder="Search active directs" aria-controls="tabledata2">
                  </div>
                </label>
              </div> -->
            </div>

            <table id="tabledata2"
              class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
              style="padding-top: 15px; width:100%;" aria-describedby="tabledata2_info">
              <thead>
                <tr class="bg-slate-100 text-slate-900">
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Sr.
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    User Id
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Wallet Address
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Direct
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Team
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Package
                  </th>
                  <!-- <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                    Registration Date
                  </th> -->
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Activation Date
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Team Volume
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px]">
                    Rank
                  </th>
                  <th
                    class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-[var(--theme-primary-text)] text-[14px] sm:text-[16px] !text-right">
                    Level
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                {{-- DUMMY DATA: ACTIVE DIRECTS --}}
                @php
                $sr = 1;
                @endphp
                @foreach($customer->activeDirectsData as $ackey => $activeDirect)
                
                <tr class="hover:bg-slate-200 transition">
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $sr++ }}</td>
                  <td class="px-4 sm:px-5 py-3 font-medium text-slate-900">{{ $activeDirect->name }}</td>
                  <td class="px-4 sm:px-5 py-3 font-mono text-[11px] text-slate-500">{{ $activeDirect->wallet_address }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalDirectsCount }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalTeamCount }}</td>
                  <td class="px-4 sm:px-5 py-3 text-emerald-600">{{ number_format($activeDirect->totaldeposit, 2, '.', '') }}</td>
                  <!-- <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->registration_date }}</td> -->
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->activation_date ? \Carbon\Carbon::parse($activeDirect->activation_date)->format('d-m-Y'): '-' }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">{{ $activeDirect->totalTeamInvestment??0 }}</td>
                  <td class="px-4 sm:px-5 py-3 text-black">
                    <span
                      class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[11px] text-slate-700 border border-slate-300 ">
                      {{ $activeDirect->leadership_champions_rank??'-' }} 
                    </span>
                  </td>
                  <td class="px-4 sm:px-5 py-3 text-right text-black">{{ $activeDirect->level_id ?? 1 }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

             <!-- <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
              <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata1_info" role="status"
                aria-live="polite">
                Showing 1 to 5 of 5 entries
              </div>
              <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
                id="tabledata1_paginate">
                <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata1" aria-role="link" data-dt-idx="previous" tabindex="0"
                  id="tabledata1_previous">Previous</a>
                <span class="text-xs text-slate-700">1</span>
                <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white hover:bg-slate-200"
                  aria-controls="tabledata1" aria-role="link" data-dt-idx="next" tabindex="0"
                  id="tabledata1_next">Next</a>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
  $('#tabledata1').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
  $('#tabledata2').DataTable({
      pageLength: 5,
      lengthMenu: [5, 10, 25, 50],
      searching: true,
      ordering: true,
      responsive: true
  });
});
</script>
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tabList = document.querySelector('[data-tabs-toggle="#default-tab-content"]');
    if (!tabList) return;

    const tabButtons = tabList.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('#default-tab-content [role="tabpanel"]');

    const activeClasses = [
      'bg-gradient-to-r', 'from-[var(--theme-skky-500)]', 'to-[var(--theme-skky-600)]',
      'text-white',
      'shadow-[0_10px_25px_rgba(59,130,246,.35)]',
      'border', 'border-[var(--theme-skky-500)]'
    ];

    const inactiveClasses = [
      'text-slate-600', 'hover:text-slate-900',
      'border', 'border-slate-200',
      'bg-white', 'hover:bg-slate-200'
    ];

    function setActiveTab(btn) {
      const targetSelector = btn.getAttribute('data-tabs-target');
      const targetPanel = document.querySelector(targetSelector);
      if (!targetPanel) return;

      // Hide all panels
      tabPanels.forEach(panel => panel.classList.add('hidden'));
      // Show selected
      targetPanel.classList.remove('hidden');

      // Update tab button states
      tabButtons.forEach(b => {
        const isActive = b === btn;
        b.setAttribute('aria-selected', isActive ? 'true' : 'false');

        b.classList.remove(...activeClasses, ...inactiveClasses);

        b.classList.add(
          'group', 'relative', 'px-4', 'py-1.5',
          'rounded-full', 'text-xs', 'sm:text-sm',
          'font-semibold', 'transition', 'flex', 'items-center', 'gap-2'
        );

        if (isActive) {
          b.classList.add(...activeClasses);
        } else {
          b.classList.add(...inactiveClasses);
        }
      });
    }

    // initial
    tabButtons.forEach((btn) => {
      if (btn.getAttribute('aria-selected') === 'true') {
        setActiveTab(btn);
      }
    });

    // click
    tabButtons.forEach((btn) => {
      btn.addEventListener('click', () => setActiveTab(btn));
    });
  });
</script>
@endpush


@endsection
