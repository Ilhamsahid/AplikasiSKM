<div id="deleteModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm transform transition-all">
    <div class="p-6 text-center">
      <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
      </div>
      <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
      <p class="text-sm text-gray-600 ">Apakah Anda yakin ingin menghapus <span id="deleteUserName" class="font-semibold"></span>?</p>
      <p class="text-sm text-gray-600 mt-2 mb-6" id="questionWarning"></p>


      <form id="formDelete" method="post">
        <div class="flex gap-3">
          <button onclick="closeModal('deleteModal')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition" type="button">
            Batal
          </button>

          <button onclick="deleteModal()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition" type="submit">
            Hapus
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
