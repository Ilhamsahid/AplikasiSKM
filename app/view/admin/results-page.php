<?php
$jumlahNnrPerUnsur = 0;
$jumlahNnrPerTimbang = 0;

foreach ($chartData as $value) {
    $nilaiPerUnsur = array_sum($value['values']);
    $nnrPerUnsur = number_format(array_sum($value['values']) / count($respondents['data']), 2, '.', ',');
    $nnrPerTimbang = number_format($nnrPerUnsur  / $jumlahPertanyaan, 2, '.', ',');

    $jumlahNnrPerUnsur += $nnrPerUnsur;
    $jumlahNnrPerTimbang += $nnrPerTimbang;
}
?>
<div id="resultsPage" class="page-content hidden p-4 sm:p-6 lg:p-8">

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filter Periode
        </h3>

        <form method="get" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" name="start" value="<?= $_GET['start'] ?? null ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" name="end" value="<?= $_GET['end'] ?? null ?>">
            </div>
            <div class="sm:col-span-2 flex items-end gap-2">
                <button class="flex-1 sm:flex-none bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2" type="submit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Tampilkan
                </button>
                <a href="/admin/reset/results" class="flex-1 sm:flex-none border-2 border-gray-300 text-gray-700 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </a>
            </div>
    </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1">100</h3>
            <p class="text-green-100 text-sm">Total Responden</p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1">4.2</h3>
            <p class="text-blue-100 text-sm">Rata-rata Skor</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1">87%</h3>
            <p class="text-purple-100 text-sm">Tingkat Kepuasan</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1">10</h3>
            <p class="text-orange-100 text-sm">Total Pertanyaan</p>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="flex flex-wrap justify-between gap-3 mb-6">
        <button onclick="window.open(
        '/pdf/result_pdf.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&nilaiRataRata=<?= $jumlahNnrPerTimbang * 25 ?>',
        '_blank')"
        class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Export Hasil IKM PDF
        </button>
        <button onclick=""
        class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Export Responden PDF
        </button>
    </div>

    <!-- Data Responden Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 bg-green-700">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Data Responden & Jawaban
            </h3>
        </div>

        <div id="respondenContainer"></div>
        <div id="mobileCardResults"></div>
    </div>
    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div id="paginationResults" class="flex flex-wrap items-center gap-2"></div>
        <div id="paginationInfoResults" class="text-sm text-gray-600"></div>
    </div>

    <!-- Grafik Per Indikator -->
    <div class="mt-5 space-y-6">
        <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Grafik Per Indikator
        </h3>

        <div id="chartResult">
        </div>

        <?php if(count($chartData) != 0): ?>
        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm bg-white">
            <table class="w-full border-collapse">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Pertanyaan</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Nilai per unsur</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">NRR per unsur</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">NRR tertimbang</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($chartData as $key => $value): ?>
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="px-6 py-4 text-sm"><?= $key + 1 ?></td>
                            <td class="px-6 py-4 text-sm"><?= $value['question'] ?></td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <?= $nilaiPerUnsur ?>
                            </td>
                            <td
                                class="px-6 py-4 font-bold font-medium">
                                <?= $nnrPerUnsur ?>
                            </td>
                            <td
                                class="px-6 py-4 font-bold font-medium">
                                <?= $nnrPerTimbang ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr class="bg-green-50 border-t-2 border-green-600">
                        <td colspan="2"
                            class="px-6 py-4 font-semibold text-green-800">
                            Total Keseluruhan
                        </td>
                        <td
                            class="px-6 py-4 font-bold text-green-900 text-lg">
                            <?= $respondents['jumlahSemua'] ?>
                        </td>
                        <td
                            class="px-6 py-4 font-bold text-green-900 text-lg">
                            <?= $jumlahNnrPerUnsur ?>
                        </td>
                        <td
                            class="px-6 py-4 font-bold text-green-900 text-lg">
                            <?= $jumlahNnrPerTimbang ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="mt-8 flex justify-center">
                <div class="w-full max-w-3xl bg-green-50 border border-green-600 rounded-xl shadow-sm">
                    <!-- Header -->
                    <div class="bg-green-700 text-white px-6 py-4 rounded-t-xl">
                        <h2 class="text-lg font-semibold tracking-wide">
                            Rata-rata Indeks Kepuasan Masyarakat (IKM)
                        </h2>
                    </div>

                    <!-- Content -->
                    <div class="px-6 py-8 text-center">
                        <p class="text-sm text-gray-600 mb-2">
                            Nilai diperoleh dari perhitungan:
                        </p>

                        <p class="text-base text-gray-800 mb-6">
                            <span class="font-semibold">Jumlah NRR Tertimbang × 25</span><br>
                            <span class="text-sm text-gray-500">(<?= $jumlahNnrPerTimbang ?> × 25)</span>
                        </p>

                        <div class="inline-flex items-center justify-center
                                    w-40 h-40 rounded-full
                                    bg-green-700 text-white shadow-md">
                            <span class="text-5xl font-bold"><?= $jumlahNnrPerTimbang * 25 ?></span>
                        </div>

                        <p class="mt-6 text-sm text-gray-700">
                            Nilai ini merupakan <span class="font-semibold">rata-rata keseluruhan</span>
                            dari <?= $jumlahPertanyaan ?> unsur pelayanan yang dinilai oleh responden.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>
</div>

<script>
    userResults = <?= json_encode($respondents) ?>;
    chartResults = <?= json_encode($chartData) ?>;
</script>
