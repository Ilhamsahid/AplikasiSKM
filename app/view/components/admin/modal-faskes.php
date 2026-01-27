<div id="faskesModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
      <h3 id="modalTitleFaskes" class="text-lg font-bold text-gray-800">Tambah Faskes</h3>
      <button onclick="closeFaskesModal()" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <form method="post" id="formFaskes" class="p-6 space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Faskes</label>
        <input type="text" name="namaFaskes" id="namaFaskes" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" placeholder="Masukkan nama lengkap" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis faskes</label>
        <select name="jenisFaskes" id="jenisFaskes" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
          <option value="">Pilih Jenis Faskes</option>
          <option value="PUSKESMAS">Puskesmas</option>
          <option value="RUMAH_SAKIT">Rumahsakit</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis faskes</label>
        <select name="statusFaskes" id="statusFaskes" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
          <option value="">Pilih status</option>
          <option value="1">Aktif</option>
          <option value="0">Tidak Aktif</option>
        </select>
      </div>

      <div class="flex gap-3 pt-4">
        <button type="button" onclick="closeFaskesModal()" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition cursor-pointer">
          Batal
        </button>
        <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>