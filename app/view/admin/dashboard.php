<!-- Dashboard Content -->
<div id="dashboardPage" class="page-content hidden p-4 sm:p-6 lg:p-8">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">

                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1"><?= $jumlahResponden ?></h3>
            <p class="text-green-100 text-sm">Total Responden</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-md p-4 text-white">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-1"><?= $totalPertanyaan ?></h3>
            <p class="text-orange-100 text-sm">Total Pertanyaan</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Tingkat Kepuasan -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-gray-800">Umur</h4>
                    <p class="text-sm text-gray-600">Pengelompokan umur</p>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-600">Usia <17</span>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
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
                    <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['S2'] ?>%<</span>
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-600">S3</span>
                    <span class="font-semibold text-gray-800"><?= $filterPersenRespondent['pendidikan']['S3'] ?>%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Responses -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Responden Terbaru
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama/Instansi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Umur</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pendidikan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Skor</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    foreach ($recentRespondent as $data):
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium"><?= $data['responden'] ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= $data['umur'] ?> tahun</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full"><?= $data['lulusan'] ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= $data['tanggal'] ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700"><?=
                                number_format(($data['nilai'] / (4 * $totalPertanyaan) / 20) * 100, 2, '.', ',')
                                ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center gap-1" onclick="viewDetailRespondent(<?= $data['id'] ?>)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    const recentRespondent = <?= json_encode($recentRespondent) ?>;
</script>
