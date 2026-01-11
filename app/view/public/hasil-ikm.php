        <!-- Judul -->
        <a href="/" class="inline-flex items-center text-green-700 hover:text-green-800 font-semibold transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
        <div class="mt-3">
            <h2 class="text-3xl font-bold text-gray-800">Hasil Indeks Kepuasan Masyarakat</h2>
            <p class="text-gray-600 mt-2">Lihat hasil survei kepuasan masyarakat berdasarkan periode tertentu</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Filter Periode</h3>
            <form method="get" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Filter Awal -->
                <div>
                    <label for="tanggal-awal" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Awal
                    </label>
                    <input
                        type="date"
                        id="tanggal-awal"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        value="<?= $_GET['start'] ?? null ?> "
                        name="start"
                        max="<?= date('Y-m-d') ?>"
                    >
                </div>

                <div>
                    <label for="tanggal-akhir" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Akhir
                    </label>
                    <input
                        type="date"
                        id="tanggal-akhir"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        value="<?= $_GET['end'] ?? null ?>  "
                        name="end"
                        max="<?= date('Y-m-d') ?>"
                    >
                </div>

                <div class="flex items-end">
                    <button
                        class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg" type="submit"
                    >
                        Tampilkan Hasil
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 flex justify-center">
            <?php if($nilaiRataRata == 0): ?>
            <div class="w-full max-w-3xl bg-green-50 border border-green-600 rounded-xl shadow-sm">
                <div class="bg-green-700 text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-lg font-semibold tracking-wide">
                        Rata-rata Indeks Kepuasan Masyarakat (IKM)
                    </h2>
                </div>
                <div class="px-6 py-8 text-center">
                    <div class="mb-6">
                        <svg class="w-24 h-24 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                        Data Tidak Ditemukan
                    </h3>

                    <p class="text-gray-600 mb-6">
                        Maaf, data IKM tidak tersedia untuk periode yang Anda pilih.
                    </p>

                    <div class="mt-8 pt-6 border-t border-green-200">
                        <p class="text-sm font-semibold text-gray-700 mb-4">Saran untuk Anda:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-left">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-gray-700">Ubah Rentang Tanggal</p>
                                        <p class="text-gray-600 text-xs mt-1">Coba pilih periode yang berbeda</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-gray-700">Periksa Data Input</p>
                                        <p class="text-gray-600 text-xs mt-1">Pastikan sudah ada data survei</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($nilaiRataRata != 0): ?>
            <div class="w-full max-w-3xl bg-green-50 border border-green-600 rounded-xl shadow-sm">
                <div class="bg-green-700 text-white px-6 py-4 rounded-t-xl">
                    <h2 class="text-lg font-semibold tracking-wide">
                        Rata-rata Indeks Kepuasan Masyarakat (IKM)
                    </h2>
                </div>

                <div class="px-6 py-8 text-center">
                    <p class="text-sm text-gray-600 mb-2">
                        Nilai diperoleh dari perhitungan:
                    </p>
                    <p class="text-base text-gray-800 mb-6">
                        <span class="font-semibold">Jumlah NRR Tertimbang × 25</span><br>
                        <span class="text-sm text-gray-500" id="perhitungan">(<?= $nnrPerUnsur ?> × 25)</span>
                    </p>
                    <div class="inline-flex items-center justify-center
                                w-40 h-40 rounded-full
                                bg-green-700 text-white shadow-md">
                        <span class="text-5xl font-bold" id="nilai-ikm"><?= $nilaiRataRata ?></span>
                    </div>
                    <p class="mt-6 text-sm text-gray-700">
                        Nilai ini merupakan <span class="font-semibold">rata-rata keseluruhan</span>
                        dari <span id="jumlah-pertanyaan">9</span> unsur pelayanan yang dinilai oleh responden.
                    </p>

                    <div class="mt-6 pt-6 border-t border-green-200">
                        <div class="grid gap-4 text-sm">
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-gray-600">Jumlah Responden</p>
                                <p class="text-2xl font-bold text-green-700" id="jumlah-responden"><?= $totalResponden ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif; ?>
        </div>
