<?php
$totalResponden = count($respondents['data']);
$jumlahNnrPerUnsur = 0;
$jumlahNnrPerTimbang = 0;

foreach ($chartData as $index => $item) {

  // 1. Nilai per unsur (total nilai jawaban)
  $nilaiPerUnsur = array_sum($item['values']);

  // 2. NRR per unsur
  $nnrPerUnsur = $totalResponden > 0
    ? $nilaiPerUnsur / $totalResponden
    : 0;

  // 3. NRR tertimbang
  $nnrPerTimbang = $jumlahPertanyaan > 0
    ? $nnrPerUnsur / $jumlahPertanyaan
    : 0;

  // Simpan kembali ke chartData
  $chartData[$index]['nilai_per_unsur'] = $nilaiPerUnsur;
  $chartData[$index]['nnr_per_unsur'] = $nnrPerUnsur;
  $chartData[$index]['nnr_tertimbang'] = $nnrPerTimbang;

  // Akumulasi total
  $jumlahNnrPerUnsur += $nnrPerUnsur;
  $jumlahNnrPerTimbang += $nnrPerTimbang;
}

// Nilai IKM final
$nilaiIKM = $jumlahNnrPerTimbang * 25;
?>

<div id="resultsPage" class="page-content hidden p-4 sm:p-6 lg:p-8">

  <!-- Filter Section -->
  <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
      </svg>
      Filter Periode
    </h3>

    <form method="get" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
        <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" name="start" value="<?= $_GET['start'] ?? null ?>" max="<?= date('Y-m-d') ?>" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
        <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" name="end" value="<?= $_GET['end'] ?? null ?>"
          max="<?= date('Y-m-d') ?>" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Faskes</label>
        <select name="faskes_id" id="" class="w-full rounded-lg border border-gray-300 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" required>
          <option value="">Pilih Faskes</option>
          <option value="all" <?= (string)($_GET['faskes_id'] ?? '') === 'all' ? 'selected' : '' ?>>Semua Faskes</option>
          <?php foreach ($allFaskes as $fk): ?>
            <option value="<?= $fk['id'] ?>"
              <?= (string)($_GET['faskes_id'] ?? '') === (string)$fk['id'] ? 'selected' : ''; ?>><?= $fk['nama_faskes'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="sm:col-span-2 flex items-end gap-2">
        <button class="flex-1 sm:flex-none bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2" type="submit">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          Tampilkan
        </button>
        <a href="/admin/reset/results" class="flex-1 sm:flex-none border-2 border-gray-300 text-gray-700 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          Reset
        </a>
      </div>
    </form>
  </div>

  <div class="relative inline-block mb-6" id="EksportDropdown">
    <button
      onclick="toggleExportDropdown()"
      class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-700 transition
            flex items-center gap-2 shadow-md"
      id="eksportButton">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 4v16h16M8 12l4 4m0 0l4-4m-4 4V4" />
      </svg>
      Export Data
      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <!-- Dropdown Menu -->
    <div
      id="exportMenu"
      class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200
            hidden z-50 overflow-hidden">

      <!-- PDF -->
      <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase bg-gray-50">
        PDF
      </div>

      <a
        href="/pdf/result_pdf.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&nilaiRataRata=<?= $jumlahNnrPerTimbang * 25 ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition">
        Export Hasil IKM (PDF)
      </a>

      <a
        href="/pdf/respondent_pdf.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition">
        Export Responden (PDF)
      </a>


      <!-- Excel -->
      <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase bg-gray-50">
        Excel
      </div>

      <a
        href="/excel/result_excel.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&nilaiRataRata=<?= $jumlahNnrPerTimbang * 25 ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition">
        Export Hasil IKM (Excel)
      </a>

      <a
        href="/excel/respondent_excel.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition">
        Export Responden (Excel)
      </a>

      <a
        href="/excel/pertanyaan_per_respondent.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition">
        Export Pertanyaan Per Responden (Excel)
      </a>

      <a
        href="/excel/grafik_pertanyaan.php?start=<?= $_GET['start'] ?? '' ?>&end=<?= $_GET['end'] ?? '' ?>&faskes_id=<?= $_GET['faskes_id'] ?? '' ?>"
        class="export-link block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition">
        Export Grafik Responden (Excel)
      </a>
    </div>
  </div>

  <!-- Data Responden Table -->
  <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200 bg-green-700">
      <h3 class="text-lg font-bold text-white flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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

  <?php if (count($respondents['data']) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

      <!-- Tingkat Kepuasan -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex item-center gap-4 mb-4">
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
            </svg>
          </div>
          <div>
            <h4 class="text-2xl font-bold text-gray-800">Jenis Kelamin<h4>
                <p class="text-sm text-gray-600">Pengelompokan Jenis Kelamin</p>
          </div>
        </div>
        <div class="space-y-2">
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Laki laki</span>
            <span class="font-semibold text-green-600"><?= $filterRespondent['kelamin']['L'] ?></span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Perempuan</span>
            <span class="font-semibold text-blue-600"><?= $filterRespondent['kelamin']['P'] ?></span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Presentase Laki-laki</span>
            <span class="font-semibold text-blue-600"><?= $filterPersenRespondent['kelamin']['L'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Presentase perempuan</span>
            <span class="font-semibold text-blue-600"><?= $filterPersenRespondent['kelamin']['P'] ?>%</span>
          </div>
        </div>
      </div>

      <!-- Demografi -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div>
            <h4 class="text-2xl font-bold text-gray-800">Umur</h4>
            <p class="text-sm text-gray-600">Pengelompokan umur</p>
          </div>
        </div>
        <div class="space-y-2">
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Usia kurang dari 17</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['umur']['<17'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Usia 18-24</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['umur']['>17'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Usia 25-40</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['umur']['>25<40'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Usia 41-60</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['umur']['>41<60'] ?>%<span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">Usia 60+</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['umur']['>60'] ?>%</span>
          </div>
        </div>
      </div>

      <!-- Pendidikan -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <div>
            <h4 class="text-2xl font-bold text-gray-800">Pendidikan</h4>
            <p class="text-sm text-gray-600">Pengelompokan pendidikan</p>
          </div>
        </div>
        <div class="space-y-2">
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">SD</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['SD'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">SMP</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['SMP'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">SMA/SMK</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['SMA'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">D1/D2/D3</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['D1/D2/D3'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">S1/D4</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['S1/D4'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">S2</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['S2'] ?>%</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-gray-600">S3</span>
            <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['S3'] ?>%</span>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <!-- Grafik Per Indikator -->
  <div class="mt-5 space-y-6">
    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
      <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
      </svg>
      Grafik Per Indikator
    </h3>

    <div id="chartResult">
    </div>

    <?php if (count($chartData) != 0): ?>
      <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
        Table Pertanyaan
      </h3>
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

                <td class="px-6 py-4 text-sm">
                  <?= htmlspecialchars($value['question']) ?>
                </td>

                <td class="px-6 py-4 text-sm font-medium">
                  <?= number_format($value['nilai_per_unsur'], 2) ?>
                </td>

                <td class="px-6 py-4 text-sm font-bold">
                  <?= number_format($value['nnr_per_unsur'], 2) ?>
                </td>

                <td class="px-6 py-4 text-sm font-bold">
                  <?= number_format($value['nnr_tertimbang'], 2) ?>
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
                <?= number_format($jumlahNnrPerUnsur, 2) ?>
              </td>
              <td
                class="px-6 py-4 font-bold text-green-900 text-lg">
                <?= number_format($jumlahNnrPerTimbang) ?>
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
                <span class="text-5xl font-bold"><?= number_format($jumlahNnrPerTimbang * 25, 2) ?></span>
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
