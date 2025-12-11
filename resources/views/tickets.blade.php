@extends('app')

@section('title', 'Support Tickets')

@section('content')
<section class="w-full py-10 md:py-12 mx-auto max-w-[1400px] px-4 ">

  {{-- CREATE TICKET CARD --}}
  <div
    class="mb-8 relative p-4 md:p-6 rounded-2xl max-w-2xl w-full mx-auto group overflow-hidden 
           border border-slate-200 bg-white backdrop-blur-2xl 
           shadow-[0_15px_40px_rgba(15,23,42,.10)] transition-all duration-300 
           hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(59,130,246,0.20)]">

    {{-- soft glow background --}}
    <div class="pointer-events-none absolute inset-0 opacity-70">
      <div class="absolute -top-24 -left-24 w-64 h-64 bg-sky-300/20 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-indigo-200/40 rounded-full blur-3xl"></div>
    </div>

    <div class="relative">
      <h3 class="text-2xl font-semibold mb-4 text-slate-900 text-center">
        Create a Support Ticket
      </h3>

      <form class="relative w-full" action="https://dapp.OpAi.farm/process-support-tickets"
            enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="_method" value="POST">

        <div class="space-y-4">

          {{-- Subject --}}
          <div class="text-left">
            <label for="subject"
                   class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
              Subject
            </label>
            <div
              class="relative flex items-center p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">
              <svg class="w-5 h-5 min-w-5 min-h-5 text-sky-400" viewBox="0 0 38 32"
                   xmlns="http://www.w3.org/2000/svg">
                <g>
                  <path fill="currentColor"
                        d="M36.5,0h-35C0.673,0,0,0.673,0,1.5v29C0,31.327,0.673,32,1.5,32h35c0.827,0,1.5-0.673,1.5-1.5v-29
                          C38,0.673,37.327,0,36.5,0z M37,30.5c0,0.275-0.225,0.5-0.5,0.5h-35C1.225,31,1,30.775,1,30.5v-29C1,1.225,1.225,1,1.5,1h35
                          C36.775,1,37,1.225,37,1.5V30.5z" />
                  <path fill="currentColor"
                        d="M17.5,16h-11C5.673,16,5,16.673,5,17.5v8C5,26.327,5.673,27,6.5,27h11c0.827,0,1.5-0.673,1.5-1.5v-8
                          C19,16.673,18.327,16,17.5,16z M18,25.5c0,0.275-0.225,0.5-0.5,0.5h-11C6.225,26,6,25.775,6,25.5v-8C6,17.225,6.225,17,6.5,17h11
                          c0.275,0,0.5,0.225,0.5,0.5V25.5z" />
                  <path fill="currentColor"
                        d="M31.5,5h-25C5.673,5,5,5.673,5,6.5v5C5,12.327,5.673,13,6.5,13h25c0.827,0,1.5-0.673,1.5-1.5v-5
                          C33,5.673,32.327,5,31.5,5z M32,11.5c0,0.275-0.225,0.5-0.5,0.5h-25C6.225,12,6,11.775,6,11.5v-5C6,6.225,6.225,6,6.5,6h25
                          C31.775,6,32,6.225,32,6.5V11.5z" />
                  <path fill="currentColor" d="M32,17H22c-0.276,0-0.5,0.224-0.5,0.5S21.724,18,22,18h10c0.276,0,0.5-0.224,0.5-0.5S32.276,17,32,17z" />
                  <path fill="currentColor" d="M32,21H22c-0.276,0-0.5,0.224-0.5,0.5S21.724,22,22,22h10c0.276,0,0.5-0.224,0.5-0.5S32.276,21,32,21z" />
                  <path fill="currentColor" d="M32,25H22c-0.276,0-0.5,0.224-0.5,0.5S21.724,26,22,26h10c0.276,0,0.5-0.224,0.5-0.5S32.276,25,32,25z" />
                </g>
              </svg>
              <input
                type="text"
                name="subject"
                id="subject"
                placeholder="Enter subject here"
                required
                class="border-l pl-4 border-slate-200 outline-none shadow-none bg-transparent 
                       w-full block text-base text-slate-900 placeholder:text-slate-400 [caret-color:#60a5fa]">
            </div>
          </div>

          {{-- File --}}
          <div class="text-left">
            <label for="file"
                   class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
              Attachment (optional)
            </label>

            <div
              class="relative flex items-center p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">

              <svg xmlns="http://www.w3.org/2000/svg"
                   class="w-6 h-6 min-w-6 min-h-6 text-sky-400/80"
                   fill="none" viewBox="0 0 24 24" stroke-width="1.7">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      d="M12 16V4m0 0l4 4m-4-4L8 8" />
                <rect x="4" y="16" width="16" height="4" rx="1" stroke="currentColor"/>
              </svg>

              <input
                type="file"
                name="file"
                id="file"
                class="block w-full text-sm text-slate-800
                       file:mr-4 file:rounded-md file:border-0
                       file:bg-sky-500 file:text-white file:px-4 file:py-1 file:font-semibold cursor-pointer
                       hover:file:bg-sky-600 transition-colors
                       focus:outline-none">
            </div>
          </div>

          {{-- Message --}}
          <div class="text-left">
            <label for="message"
                   class="block text-[11px] uppercase tracking-wide text-sky-600 font-medium mb-2">
              Message
            </label>
            <div
              class="relative flex items-start p-3 rounded-lg gap-3 
                     border border-slate-200 bg-white 
                     focus-within:border-sky-400 focus-within:ring-1 focus-within:ring-sky-100 
                     focus-within:bg-sky-50/60 transition-colors">
              <textarea
                rows="4"
                name="message"
                id="message"
                placeholder="Enter message here"
                required
                class="outline-none shadow-none bg-transparent w-full block text-base 
                       text-slate-900 placeholder:text-slate-400 [caret-color:#60a5fa] resize-y"></textarea>
            </div>
          </div>

          {{-- Button --}}
          <div class="pt-2">
            <button type="submit"
              class="px-5 py-2.5 mx-auto flex items-center justify-center gap-2 
                     text-sm sm:text-base tracking-wide mt-4 
                     rounded-full border border-sky-500 
                     bg-gradient-to-r from-sky-500 to-sky-600 
                     text-white font-semibold 
                     shadow-[0_8px_20px_rgba(56,189,248,.35)] 
                     hover:shadow-[0_14px_28px_rgba(56,189,248,.45)] 
                     active:scale-95 transition-all duration-300 ease-out group">
              <span>Create Ticket</span>
              <svg
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
    </div>
  </div>

  {{-- ALL TICKETS TABLE --}}
  <h2 class="text-lg font-semibold mb-3 text-slate-900">All Tickets</h2>

  <div
    class="p-4 md:p-6 text-slate-900 rounded-2xl w-full mx-auto border border-slate-200 bg-white 
           backdrop-blur-2xl shadow-[0_15px_40px_rgba(15,23,42,.08)] relative overflow-hidden text-left">

    {{-- soft glow background --}}
    <div class="pointer-events-none absolute inset-0 opacity-70">
      <div class="absolute -top-24 -right-24 w-64 h-64 bg-sky-200/60 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-200/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative overflow-x-auto">
      <div id="withdrawalsTable_wrapper" class="dataTables_wrapper no-footer">

        {{-- TOP BAR: SHOW + SEARCH --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
          <div class="dataTables_length" id="withdrawalsTable_length">
            <label class="text-xs text-slate-600 flex items-center gap-2">
              <span>Show</span>
              <select name="withdrawalsTable_length" aria-controls="withdrawalsTable"
                      class="bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
              <span>entries</span>
            </label>
          </div>

          <div id="withdrawalsTable_filter" class="dataTables_filter w-full sm:w-auto">
            <label class="text-xs text-slate-600 w-full">
              <span class="sr-only">Search</span>
              <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-2 inline-flex items-center">
                  {{-- search icon --}}
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
                       placeholder="Search ticket / subject / status" aria-controls="withdrawalsTable">
              </div>
            </label>
          </div>
        </div>

        <table id="withdrawalsTable"
               class="w-full text-left border-collapse pb-7 dataTable no-footer text-xs sm:text-sm"
               style="padding-top: 15px;" aria-describedby="withdrawalsTable_info">
          <thead>
          <tr class="bg-slate-100 text-slate-900">
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting sorting_asc"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-sort="ascending" aria-label="Ticket Id.: activate to sort column descending">
              Ticket Id.
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Subject: activate to sort column ascending">
              Subject
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Message: activate to sort column ascending">
              Message
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Attachment: activate to sort column ascending">
              Attachment
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Status: activate to sort column ascending">
              Status
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Reply: activate to sort column ascending">
              Reply
            </th>
            <th
              class="px-4 sm:px-5 py-3 font-semibold tracking-wide text-nowrap text-sky-700 text-xs sm:text-[13px] !text-right sorting"
              tabindex="0" aria-controls="withdrawalsTable" rowspan="1" colspan="1"
              aria-label="Date: activate to sort column ascending">
              Date
            </th>
          </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
          {{-- default empty state, DataTables will replace when data exists --}}
          <tr class="odd hover:bg-slate-100 transition">
            <td valign="top" colspan="7"
                class="dataTables_empty px-4 sm:px-5 py-4 text-center text-slate-500">
              No data available in table
            </td>
          </tr>
          </tbody>
        </table>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
          <div class="dataTables_info mt-2 text-xs text-slate-500"
               id="withdrawalsTable_info" role="status" aria-live="polite">
            Showing 0 to 0 of 0 entries
          </div>
          <div class="dataTables_paginate paging_simple_numbers mt-2 flex items-center gap-2"
               id="withdrawalsTable_paginate">
            <a class="paginate_button previous px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white disabled"
               aria-controls="withdrawalsTable" aria-disabled="true" aria-role="link"
               data-dt-idx="previous" tabindex="-1" id="withdrawalsTable_previous">Previous</a>
            <span class="text-xs text-slate-700">0</span>
            <a class="paginate_button next px-3 py-1.5 rounded-lg border border-slate-200 text-xs text-slate-600 bg-white disabled"
               aria-controls="withdrawalsTable" aria-disabled="true" aria-role="link"
               data-dt-idx="next" tabindex="-1" id="withdrawalsTable_next">Next</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    $('#withdrawalsTable').DataTable({
      responsive: true,
      paging: true,
      searching: true,
      ordering: true,
      lengthMenu: [5, 10, 25, 50],
      language: {
        search: "",
        searchPlaceholder: "Search ticket / subject / status",
        lengthMenu: "Show _MENU_ entries",
        paginate: {
          previous: "Previous",
          next: "Next"
        },
        info: "Showing _START_ to _END_ of _TOTAL_ entries"
      },
      dom: "<'top'f>rt<'bottom'lp><'clear'>"
    });

    // Light theme overrides for DataTables controls
    $("#withdrawalsTable_filter input").addClass(
      "bg-white border border-slate-200 text-xs rounded-lg pl-7 pr-3 py-1.5 " +
      "text-slate-900 placeholder:text-slate-400 focus:outline-none " +
      "focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80 w-full sm:w-auto"
    );

    $("select[name='withdrawalsTable_length']").addClass(
      "bg-white border border-slate-200 text-xs rounded-lg px-2 py-1.5 text-slate-700 " +
      "focus:outline-none focus:ring-1 focus:ring-sky-400/80 focus:border-sky-400/80"
    );
  });
</script>
@endpush

@endsection
