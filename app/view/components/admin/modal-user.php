<div id="userModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h3 id="modalTitle" class="text-lg font-bold text-gray-800">Tambah User</h3>
            <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="post" id="formUser" class="p-6 space-y-4" >
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" placeholder="Masukkan nama lengkap" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                <input type="number" name="umur" id="umur" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" placeholder="Masukkan Umur" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelamin</label>
                <select name="kelamin" id="kelamin"class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
                    <option value="">Pilih Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Lulusan</label>
                <select name="lulusan" id='lulusan' class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
                    <option value="">Pilih Lulusan</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA / SMK</option>
                    <option value="D1/D2/D3">D1 / D2 / D3</option>
                    <option value="S1/D4">S1 / D4</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                <select name="jenis_layanan" id="layanan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
                    <option value="">Pilih Jenis Layanan</option>
                    <option value="Pelayanan Rekomendasi Ijin Praktik/Kerja Tenaga Kesehatan">Pelayanan Rekomendasi Ijin Praktik/Kerja Tenaga Kesehatan</option>
                    <option value="Pelayanan Rekomendasi Ijin Fasilitas Kesehatan">Pelayanan Rekomendasi Ijin Fasilitas Kesehatan</option>
                    <option value="Pelayanan Konsultasi PIRT">Pelayanan Konsultasi PIRT</option>
                    <option value="Pelayanan Fogging">Pelayanan Fogging</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Terakhir Pelayanan</label>
                <input name="tanggal_terakhir" id="tanggal_terakhir" type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required max="<?= date('Y-m-d') ?>">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeUserModal()" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
