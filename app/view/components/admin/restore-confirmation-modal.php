<div id="restoreModal"
  class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm transform transition-all">
    <div class="p-6 text-center">

      <!-- ICON -->
      <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v6h6
               M20 20v-6h-6
               M5.6 18.4a9 9 0 0014.8-3.4
               M18.4 5.6A9 9 0 003.6 9" />
        </svg>
      </div>

      <!-- TITLE -->
      <h3 class="text-lg font-bold text-gray-800 mb-2">
        Konfirmasi Restore
      </h3>

      <!-- DESC -->
      <p class="text-sm text-gray-600 mb-6">
        Apakah Anda yakin ingin mengembalikan
        <span id="restoreQuestionName" class="font-semibold"></span>?
      </p>

      <!-- FORM -->
      <form id="formRestore" method="post">
        <div class="flex gap-3">

          <button type="button"
            onclick="closeModal('restoreModal')"
            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg
                   font-medium text-gray-700 hover:bg-gray-50 transition">
            Batal
          </button>

          <button type="submit"
            onclick="restoreModal()"
            class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg
                   font-medium hover:bg-green-700 transition">
            Restore
          </button>

        </div>
      </form>

    </div>
  </div>
</div>
