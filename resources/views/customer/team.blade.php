@extends('app')

@section('title', 'DApp Header (HTML)')

<style>
  /* 8th column hide (Rank) */
  #tabledata1 th:nth-child(8),
  #tabledata1 td:nth-child(8) {
    display: none !important;
  }
</style>

@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 bg-slate-50/50">

  <h2 class="text-lg font-semibold mb-3 text-slate-900">My Team</h2>

  <div
    class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.10)] relative overflow-hidden text-left">

    {{-- soft glow background (same style as My Directs) --}}
    <div class="absolute inset-0 opacity-70 pointer-events-none">
      <div class="absolute -top-24 -right-24 w-72 h-72 bg-sky-200/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-28 -left-24 w-72 h-72 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative overflow-x-auto">
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
                  placeholder="Search member / sponsor / rank" aria-controls="tabledata1">
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
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Sr.
              </th>
              <!-- <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Package
              </th> -->
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                All Package
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Member Code
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Sponsor
              </th>
              <!-- <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Registration Date
              </th> -->
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Activation Date
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px]">
                Rank
              </th>
              <th
                class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] !text-right">
                Level
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            {{-- DUMMY DATA: MY TEAM --}}
            @php
            $sr = 1;
            @endphp
            @foreach($customer->myTeamData as $tmkey => $myTeam)
            <tr class="hover:bg-slate-200 transition">
              <td class="px-4 sm:px-5 py-3 text-black">{{  $sr++ }}</td>
              <!-- <td class="px-4 sm:px-5 py-3">
                <span
                  class="inline-flex items-center rounded-full bg-sky-50 px-2 py-0.5 text-[11px] text-sky-700 border border-sky-200">
                   {{ $myTeam->id }}({{ $myTeam->package_id }})
                </span>
              </td> -->
              <td class="px-4 sm:px-5 py-3 text-emerald-600">{{ number_format($myTeam->totaldeposit, 2, '.', '') }}</td>
              <td class="px-4 sm:px-5 py-3 font-mono text-[11px] text-slate-500">{{ $myTeam->referral_code }}</td>
              <td class="px-4 sm:px-5 py-3 text-slate-800">{{ $myTeam->sponsor_code }} ({{ $myTeam->sponsor_id }})</td>
              <!-- <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myTeam->registration_date }}</td> -->
              <td class="px-4 sm:px-5 py-3 text-slate-700">{{ $myTeam->activation_date ? \Carbon\Carbon::parse($myTeam->activation_date)->format('d-m-Y'): '-' }}</td>
              <td class="px-4 sm:px-5 py-3">
                <span
                  class="inline-flex items-center rounded-full bg-amber-50 px-2 py-0.5 text-[11px] text-amber-700 border border-amber-300">
                  {{ $customer->leadershipIncome?->rank ?? '-' }} 
                   <!-- {{ $customer->leadershipChampionsIncome?->rank ?? '-' }} -->
                </span>
              </td>
              <td class="px-4 sm:px-5 py-3 text-right text-slate-900">{{ $myTeam->level_id }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
          {{-- <div class="dataTables_info mt-2 text-xs text-slate-500" id="tabledata1_info" role="status"
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
          </div> --}}
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
@endpush

@endsection
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
});
</script>