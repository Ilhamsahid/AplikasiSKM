<div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
    <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-green-600">Data Responden</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
        <!-- Instansi -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Instansi/Nama <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="responden"
                placeholder="Contoh: SMKN 1 Probolinggo"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                id="instansi"
                required />
        </div>

        <!-- Umur -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Umur <span class="text-red-500">*</span>
            </label>
            <input
                type="number"
                name="umur"
                placeholder="Contoh: 18"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                id="umur"
                required />
            <p id="umur-error" class="mt-1 text-xs text-red-500 hidden">
                Umur tidak boleh kurang dari 0
            </p>
        </div>

        <!-- Jenis Kelamin -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Jenis Kelamin <span class="text-red-500">*</span>
            </label>
            <div class="flex gap-2 sm:gap-4">
                <label class="flex items-center gap-2 cursor-pointer rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5
                                          hover:border-green-500 hover:bg-green-50 transition">
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="L"
                        class="w-4 h-4 text-green-600 focus:ring-green-500"
                        required />
                    <span class="text-xs sm:text-sm text-gray-700">Laki-laki</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5
                                          hover:border-green-500 hover:bg-green-50 transition">
                    <input
                        type="radio"
                        name="jenis_kelamin"
                        value="P"
                        class="w-4 h-4 text-green-600 focus:ring-green-500"
                        required />
                    <span class="text-xs sm:text-sm text-gray-700">Perempuan</span>
                </label>
            </div>
        </div>

        <!-- Pendidikan -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Pendidikan Terakhir <span class="text-red-500">*</span>
            </label>
            <select
                name="pendidikan"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                required>
                <option value="">-- Pilih Pendidikan --</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA / SMK</option>
                <option value="D1/D2/D3">D1 / D2 / D3</option>
                <option value="S1/D4">S1 / D4</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>


        <!-- No HP -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                No hp
            </label>
            <input
                type="text"
                name="no_hp"
                placeholder="Contoh: 08123456789"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                id="" />
        </div>

        <!-- Pekerjaan -->
        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Pekerjaan
            </label>
            <input
                type="text"
                name="pekerjaan"
                placeholder="Contoh: ANS"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                id="pekerjaan" />
        </div>

        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Apa Jenis pelayanan yang pernah Saudara urusi? <span class="text-red-500">*</span>
            </label>
            <select
                name="jenis_pelayanan"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                    focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                required>
                <option value="">-- Pilih Jawaban --</option>
                <option value="Pelayanan Rekomendasi Ijin Praktik/Kerja Tenaga Kesehatan">Pelayanan Rekomendasi Ijin Praktik/Kerja Tenaga Kesehatan</option>
                <option value="Pelayanan Rekomendasi Ijin Fasilitas Kesehatan">Pelayanan Rekomendasi Ijin Fasilitas Kesehatan</option>
                <option value="Pelayanan Konsultasi PIRT">Pelayanan Konsultasi PIRT</option>
                <option value="Pelayanan Fogging">Pelayanan Fogging</option>
                <option value="Pelayanan Lainnya">Pelayanan Lainnya</option>
            </select>
        </div>

        <div>
            <label class="block mb-2 text-xs sm:text-sm font-medium text-gray-700">
                Kapan Saudara terakhir mengurus ijin untuk organisasi Saudara <span class="text-red-500">*</span>
            </label>
            <input
                type="date"
                name="tanggal_terakhir_kali"
                class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                    focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                required
                max="<?= date('Y-m-d') ?>" />
        </div>

    </div>
</div>