<?php
session_start();

// Simulasi data responden
$responden = [
    [
        'id' => 1,
        'nama' => 'SMKN 1 Probolinggo',
        'umur' => 35,
        'jk' => 'L',
        'pendidikan' => 'S1',
        'tanggal' => '2024-12-20',
        'jawaban' => ['Sangat Mudah', 'Sangat Sesuai', 'Mudah', 'Sangat Cepat', 'Tepat waktu', 'Sesuai', 'Sesuai', 'Ada tapi berfungsi', 'Kompeten', 'Sopan']
    ],
    [
        'id' => 2,
        'nama' => 'Dinas Kesehatan',
        'umur' => 42,
        'jk' => 'P',
        'pendidikan' => 'S2',
        'tanggal' => '2024-12-21',
        'jawaban' => ['Mudah', 'Sesuai', 'Mudah', 'Cepat', 'Tepat waktu', 'Sesuai', 'Sesuai', 'Ada tapi tidak berfungsi', 'Kompeten', 'Sopan']
    ],
    [
        'id' => 3,
        'nama' => 'PT Maju Jaya',
        'umur' => 28,
        'jk' => 'L',
        'pendidikan' => 'S1',
        'tanggal' => '2024-12-22',
        'jawaban' => ['Mudah', 'Sesuai', 'Kurang Mudah', 'Cepat', 'Tidak tepat waktu', 'Kurang Sesuai', 'Sesuai', 'Ada tapi berfungsi', 'Kurang Kompeten', 'Sopan']
    ],
    [
        'id' => 4,
        'nama' => 'RSUD Kota',
        'umur' => 38,
        'jk' => 'P',
        'pendidikan' => 'S1',
        'tanggal' => '2024-12-23',
        'jawaban' => ['Sangat Mudah', 'Sangat Sesuai', 'Mudah', 'Sangat Cepat', 'Tepat waktu', 'Sesuai', 'Sangat Sesuai', 'Ada tapi berfungsi', 'Sangat Kompeten', 'Sangat Sopan']
    ],
];

// Simulasi data grafik per pertanyaan
$chartData = [
    ['question' => 'Kemudahan akses informasi', 'labels' => ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'], 'values' => [5, 12, 45, 38]],
    ['question' => 'Kesesuaian persyaratan', 'labels' => ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai'], 'values' => [3, 8, 52, 37]],
    ['question' => 'Kemudahan prosedur', 'labels' => ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah'], 'values' => [7, 15, 48, 30]],
    ['question' => 'Kecepatan pelayanan', 'labels' => ['Tidak Cepat', 'Kurang Cepat', 'Cepat', 'Sangat Cepat'], 'values' => [4, 10, 50, 36]],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuisioner - E-SKM</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-green-800 to-green-700 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl">
            <div class="flex flex-col h-full">

                <!-- Logo -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-green-600">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg">E-SKM</h1>
                            <p class="text-xs text-green-200">Admin Panel</p>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="lg:hidden text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-green-900 rounded-lg transition-all">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">Hasil Kuisioner</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="px-4 py-4 border-t border-green-600">
                    <div class="flex items-center gap-3 px-4 py-3 bg-green-900 rounded-lg">
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">AD</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm truncate">Admin User</p>
                            <p class="text-xs text-green-200 truncate">Administrator</p>
                        </div>
                        <button class="hover:bg-green-800 p-2 rounded-lg transition flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto lg:ml-64">

            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Hasil Kuisioner</h2>
                            <p class="text-xs sm:text-sm text-gray-600">Rekap dan analisis hasil survei kepuasan masyarakat</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4">
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-4 sm:p-6 lg:p-8">

                <!-- Filter Section -->
                <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter Periode
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" value="2024-12-01">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                            <input type="date" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none" value="2024-12-31">
                        </div>
                        <div class="sm:col-span-2 flex items-end gap-2">
                            <button class="flex-1 sm:flex-none bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Tampilkan
                            </button>
                            <button class="flex-1 sm:flex-none border-2 border-gray-300 text-gray-700 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-md p-4 text-white">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-1">100</h3>
                        <p class="text-green-100 text-sm">Total Responden</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md p-4 text-white">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-1">4.2</h3>
                        <p class="text-blue-100 text-sm">Rata-rata Skor</p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-md p-4 text-white">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-1">87%</h3>
                        <p class="text-purple-100 text-sm">Tingkat Kepuasan</p>
                    </div>

                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-md p-4 text-white">
                        <div class="flex items-center justify-between mb-2">
                            <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-1">10</h3>
                        <p class="text-orange-100 text-sm">Total Pertanyaan</p>
                    </div>
                </div>

                <!-- Export Buttons -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <button class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-700 transition flex items-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Export PDF
                    </button>
                    <button class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Export Excel
                    </button>
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

                    <?php if (count($responden) === 0): ?>
                        <!-- Empty State -->
                        <div class="flex flex-col items-center justify-center py-16 px-4">
                            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                            <p class="text-gray-500 text-center mb-4">Tidak ada data responden pada periode yang dipilih</p>
                            <button class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset Filter
                            </button>
                        </div>
                    <?php else: ?>
                        <!-- Desktop Table -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama/Instansi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Umur</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">JK</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Pendidikan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($responden as $index => $r): ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3 text-sm text-gray-700"><?= $index + 1 ?></td>
                                            <td class="px-4 py-3 text-sm text-gray-800 font-medium"><?= $r['nama'] ?></td>
                                            <td class="px-4 py-3 text-sm text-gray-600"><?= $r['umur'] ?></td>
                                            <td class="px-4 py-3 text-sm text-gray-600"><?= $r['jk'] ?></td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full"><?= $r['pendidikan'] ?></span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600"><?= date('d M Y', strtotime($r['tanggal'])) ?></td>
                                            <td class="px-4 py-3 text-center">
                                                <button onclick="viewDetail(<?= $r['id'] ?>)" class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center gap-1 mx-auto">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="lg:hidden divide-y divide-gray-200">
                            <?php foreach ($responden as $index => $r): ?>
                                <div class="p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center gap-3 flex-1">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <span class="text-sm font-bold text-green-700"><?= $index + 1 ?></span>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-800 text-sm"><?= $r['nama'] ?></h4>
                                                <p class="text-xs text-gray-600"><?= date('d M Y', strtotime($r['tanggal'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-2 mb-3 text-xs">
                                        <div class="bg-gray-50 rounded p-2">
                                            <span class="text-gray-500 block">Umur</span>
                                            <span class="font-semibold text-gray-800"><?= $r['umur'] ?> th</span>
                                        </div>
                                        <div class="bg-gray-50 rounded p-2">
                                            <span class="text-gray-500 block">JK</span>
                                            <span class="font-semibold text-gray-800"><?= $r['jk'] ?></span>
                                        </div>
                                        <div class="bg-gray-50 rounded p-2">
                                            <span class="text-gray-500 block">Pendidikan</span>
                                            <span class="font-semibold text-gray-800"><?= $r['pendidikan'] ?></span>
                                        </div>
                                    </div>
                                    <button onclick="viewDetail(<?= $r['id'] ?>)" class="w-full bg-green-50 text-green-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-100 transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail Jawaban
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php endif; ?>
                </div>



                <!-- Grafik Per Indikator -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Grafik Per Indikator
                    </h3>

                    <?php if (count($chartData) === 0): ?>
                        <!-- Empty State Grafik -->
                        <div class="bg-white rounded-xl shadow-md p-12">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Grafik</h3>
                                <p class="text-gray-500 text-center">Silakan pilih periode terlebih dahulu untuk melihat grafik</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($chartData as $index => $chart): ?>
                            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                                <h4 class="font-semibold text-gray-800 mb-4"><?= ($index + 1) ?>. <?= $chart['question'] ?></h4>
                                <div class="relative" style="height: 300px;">
                                    <canvas id="chart<?= $index ?>"></canvas>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div> <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl my-8 transform transition-all">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-green-700 rounded-t-xl">
                <h3 class="text-lg font-bold text-white">Detail Jawaban Responden</h3>
                <button onclick="closeDetailModal()" class="text-white hover:bg-green-600 p-2 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 max-h-[70vh] overflow-y-auto">
                <!-- Responden Info -->
                <div class="bg-green-50 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600 block mb-1">Nama/Instansi</span>
                            <span class="font-semibold text-gray-800">SMKN 1 Probolinggo</span>
                        </div>
                        <div>
                            <span class="text-gray-600 block mb-1">Umur</span>
                            <span class="font-semibold text-gray-800">35 tahun</span>
                        </div>
                        <div>
                            <span class="text-gray-600 block mb-1">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-800">Laki-laki</span>
                        </div>
                        <div>
                            <span class="text-gray-600 block mb-1">Pendidikan</span>
                            <span class="font-semibold text-gray-800">S1</span>
                        </div>
                    </div>
                </div>

                <!-- Jawaban -->
                <div class="space-y-4">
                    <?php
                    $pertanyaanList = [
                        'Kemudahan akses informasi layanan',
                        'Kesesuaian persyaratan pelayanan',
                        'Kemudahan sistem dan prosedur',
                        'Kecepatan waktu pelayanan',
                        'Ketepatan waktu pelayanan',
                        'Tarif atau biaya pelayanan',
                        'Kesesuaian produk pelayanan',
                        'Penanganan pengaduan pengguna',
                        'Kompetensi petugas',
                        'Perilaku petugas'
                    ];
                    foreach ($pertanyaanList as $idx => $p):
                    ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition">
                            <p class="text-sm font-medium text-gray-700 mb-2"><?= ($idx + 1) ?>. <?= $p ?></p>
                            <div class="bg-green-100 text-green-700 px-3 py-2 rounded-lg text-sm font-semibold inline-block">
                                Sangat Mudah
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Ensure sidebar is closed on mobile when page loads
        window.addEventListener('load', function() {
            if (window.innerWidth < 1024) {
                document.getElementById('sidebar').classList.add('-translate-x-full');
                document.getElementById('overlay').classList.add('hidden');
            }
        });

        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // View Detail
        function viewDetail(id) {
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').classList.add('flex');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        }

        // Initialize Charts
        const chartData = <?= json_encode($chartData) ?>;
        const colors = ['#dc2626', '#f59e0b', '#3b82f6', '#16a34a'];

        chartData.forEach((data, index) => {
            const ctx = document.getElementById('chart' + index).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Responden',
                        data: data.values,
                        backgroundColor: colors,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' responden';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>