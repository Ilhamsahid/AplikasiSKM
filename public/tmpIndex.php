<?php
session_start();
// Simulasi data - nanti bisa diganti dengan query database
$totalResponden = 1250;
$totalPertanyaan = 12;
$rataKepuasan = 4.2;
$respondenBulanIni = 87;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-SKM</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-bold text-lg">E-SKM</h1>
                            <p class="text-xs text-green-200">Admin Panel</p>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="lg:hidden text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-green-900 rounded-lg transition-all hover:bg-green-900">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all hover:bg-green-600">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium">Manajemen User</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all hover:bg-green-600">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Pertanyaan Survei</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all hover:bg-green-600">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto lg:ml-64">

            <!-- Top Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard</h2>
                            <p class="text-xs sm:text-sm text-gray-600">Selamat datang di panel admin E-SKM</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4">
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-8">

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">

                    <!-- Total Responden -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium bg-white bg-opacity-30 px-3 py-1 rounded-full">+12.5%</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= number_format($totalResponden) ?></h3>
                        <p class="text-green-100 text-sm">Total Responden</p>
                    </div>

                    <!-- Total Pertanyaan -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= $totalPertanyaan ?></h3>
                        <p class="text-blue-100 text-sm">Total Pertanyaan</p>
                    </div>

                    <!-- Rata-rata Kepuasan -->
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium bg-white bg-opacity-30 px-3 py-1 rounded-full">Sangat Baik</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= number_format($rataKepuasan, 1) ?>/5.0</h3>
                        <p class="text-purple-100 text-sm">Rata-rata Kepuasan</p>
                    </div>

                    <!-- Responden Bulan Ini -->
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium bg-white bg-opacity-30 px-3 py-1 rounded-full">Desember</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-1"><?= $respondenBulanIni ?></h3>
                        <p class="text-orange-100 text-sm">Responden Bulan Ini</p>
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
                                <h4 class="text-2xl font-bold text-gray-800">89.2%</h4>
                                <p class="text-sm text-gray-600">Tingkat Kepuasan</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Sangat Baik</span>
                                <span class="font-semibold text-green-600">456</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Baik</span>
                                <span class="font-semibold text-blue-600">342</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Cukup</span>
                                <span class="font-semibold text-yellow-600">168</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Buruk</span>
                                <span class="font-semibold text-red-600">45</span>
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
                                <h4 class="text-2xl font-bold text-gray-800">52%</h4>
                                <p class="text-sm text-gray-600">Laki-laki</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Usia 17-25</span>
                                <span class="font-semibold text-gray-800">23%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Usia 26-40</span>
                                <span class="font-semibold text-gray-800">45%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Usia 41-60</span>
                                <span class="font-semibold text-gray-800">28%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Usia 60+</span>
                                <span class="font-semibold text-gray-800">4%</span>
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
                                <h4 class="text-2xl font-bold text-gray-800">S1/D4</h4>
                                <p class="text-sm text-gray-600">Terbanyak</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">S1/D4</span>
                                <span class="font-semibold text-gray-800">42%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">SMA/SMK</span>
                                <span class="font-semibold text-gray-800">31%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">S2</span>
                                <span class="font-semibold text-gray-800">18%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Lainnya</span>
                                <span class="font-semibold text-gray-800">9%</span>
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
                        <button class="text-sm text-green-600 hover:text-green-700 font-medium flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
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
                                $recentData = [
                                    ['name' => 'SMKN 1 Probolinggo', 'age' => 35, 'edu' => 'S1', 'date' => '23 Des 2024', 'score' => 4.5],
                                    ['name' => 'Dinas Kesehatan', 'age' => 42, 'edu' => 'S2', 'date' => '23 Des 2024', 'score' => 4.8],
                                    ['name' => 'PT Maju Jaya', 'age' => 28, 'edu' => 'S1', 'date' => '22 Des 2024', 'score' => 4.2],
                                    ['name' => 'RSUD Kota', 'age' => 38, 'edu' => 'S1', 'date' => '22 Des 2024', 'score' => 4.6],
                                    ['name' => 'Bank BRI', 'age' => 31, 'edu' => 'D3', 'date' => '21 Des 2024', 'score' => 4.3],
                                ];
                                foreach ($recentData as $data):
                                ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-800 font-medium"><?= $data['name'] ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><?= $data['age'] ?> tahun</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full"><?= $data['edu'] ?></span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><?= $data['date'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-sm font-semibold text-gray-700"><?= $data['score'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center gap-1">
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
        </main>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
