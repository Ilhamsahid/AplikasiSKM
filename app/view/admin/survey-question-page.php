<div id="questionsPage" class="page-content hidden p-4 sm:p-6 lg:p-8">
  <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex-1">
      <div class="relative">
        <input type="text" placeholder="Cari pertanyaan..."
          class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
          oninput="searchQuestions(this.value)">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>
    <button onclick="openQuestionModal('add')"
      class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2 shadow-md">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Tambah Pertanyaan
    </button>
  </div>

  <!-- Desktop Table -->
  <div class="hidden lg:block bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
      <thead class="bg-green-700 text-white">
        <tr>
          <th class="px-6 py-4 text-left text-sm font-semibold w-16">No</th>
          <th class="px-6 py-4 text-left text-sm font-semibold">Pertanyaan</th>
          <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban A</th>
          <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban B</th>
          <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban C</th>
          <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban D</th>
          <th class="px-6 py-4 text-center text-sm font-semibold w-32">Aksi</th>
        </tr>
      </thead>
      <tbody id="questionsTableBody" class="divide-y divide-gray-200">
      </tbody>
    </table>
  </div>

  <div id="mobileCardQuestions"></div>

  <div id="notFoundquestions" class="hidden flex flex-col items-center justify-center py-16 text-center">
    <svg class="w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>

    <h3 class="text-lg font-semibold text-gray-800">
      Data tidak tersedia
    </h3>
    <p class="text-sm text-gray-500 mt-1">
      Mohon maaf data belum tersedia </p>
  </div>

  <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div id="paginationQuestion" class="flex flex-wrap items-center gap-2"></div>
    <div id="paginationInfoQuestion" class="text-sm text-gray-600"></div>
  </div>

</div>

<script>
  let pertanyaan = <?= json_encode($pertanyaan) ?>
</script>
