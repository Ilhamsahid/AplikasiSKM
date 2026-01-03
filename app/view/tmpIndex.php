<?php
session_start();

// Simulasi data pertanyaan
$questions = [
    [
        'id' => 1,
        'question' => 'Kemudahan akses informasi layanan Dinas Kesehatan Pengendalian Penduduk dan KB Kota Probolinggo. (informasi layanan tersedia di berbagai media elektronik dan nonelektronik)',
        'answers' => ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah']
    ],
    [
        'id' => 2,
        'question' => 'Kesesuaian persyaratan pelayanan dengan jenis pelayanannya',
        'answers' => ['Tidak Sesuai', 'Kurang Sesuai', 'Sesuai', 'Sangat Sesuai']
    ],
    [
        'id' => 3,
        'question' => 'Bagaimana pendapat Saudara tentang kemudahan Sistem, mekanisme dan prosedur pelayanan',
        'answers' => ['Tidak Mudah', 'Kurang Mudah', 'Mudah', 'Sangat Mudah']
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanyaan Survey - E-SKM</title>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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
                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-green-900 rounded-lg transition-all">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Pertanyaan Survei</span>
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
        <div id="overlay" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

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
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Pertanyaan Survei</h2>
                            <p class="text-xs sm:text-sm text-gray-600">Kelola pertanyaan kuisioner kepuasan masyarakat</p>
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

            <!-- Content -->
            <div class="p-4 sm:p-6 lg:p-8">

                <!-- Action Bar -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" placeholder="Cari pertanyaan..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <button onclick="openQuestionModal('add')" class="bg-green-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center gap-2 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Pertanyaan
                    </button>
                </div>

                <!-- Desktop Table -->
                <div class="hidden lg:block bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-green-700 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold w-16">No</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Pertanyaan</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban A</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban B</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban C</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold">Jawaban D</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($questions as $index => $q): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700 font-medium"><?= $index + 1 ?></td>
                                <td class="px-6 py-4 text-sm text-gray-800"><?= $q['question'] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= $q['answers'][0] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= $q['answers'][1] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= $q['answers'][2] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= $q['answers'][3] ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openQuestionModal('edit', <?= $q['id'] ?>)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button onclick="confirmDelete(<?= $q['id'] ?>, '<?= addslashes(substr($q['question'], 0, 50)) ?>...')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
               <div class="lg:hidden space-y-4">
                    <?php foreach ($questions as $index => $q): ?>
                    <div class="bg-white rounded-xl shadow-md p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">
                                    <?= $index + 1 ?>
                                </div>
                                <p class="text-sm text-gray-800 font-medium leading-relaxed"><?= $q['question'] ?></p>
                            </div>
                        </div>

                        <div class="space-y-2 mb-3 pl-11">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-2">
                                    <p class="text-xs font-semibold text-green-700 mb-1">A</p>
                                    <p class="text-xs text-gray-700"><?= $q['answers'][0] ?></p>
                                </div>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-2">
                                    <p class="text-xs font-semibold text-blue-700 mb-1">B</p>
                                    <p class="text-xs text-gray-700"><?= $q['answers'][1] ?></p>
                                </div>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-2">
                                    <p class="text-xs font-semibold text-yellow-700 mb-1">C</p>
                                    <p class="text-xs text-gray-700"><?= $q['answers'][2] ?></p>
                                </div>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-2">
                                    <p class="text-xs font-semibold text-red-700 mb-1">D</p>
                                    <p class="text-xs text-gray-700"><?= $q['answers'][3] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2 pt-3 border-t border-gray-200">
                            <button onclick="openQuestionModal('edit', <?= $q['id'] ?>)" class="flex-1 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <button onclick="confirmDelete(<?= $q['id'] ?>, '<?= addslashes(substr($q['question'], 0, 30)) ?>...')" class="flex-1 bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </main>
    </div>

    <!-- Question Modal (Add/Edit) - Google Form Style -->
    <div id="questionModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl my-8 transform transition-all">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-green-700 rounded-t-xl">
                <h3 id="modalTitle" class="text-lg font-bold text-white">Tambah Pertanyaan</h3>
                <button onclick="closeQuestionModal()" class="text-white hover:bg-green-600 p-2 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form class="p-6 space-y-6">
                <!-- Question Input - Google Form Style -->
                <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-green-500 transition">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Pertanyaan
                        </span>
                    </label>
                    <textarea
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none resize-none"
                        placeholder="Masukkan pertanyaan survei..."
                    ></textarea>
                </div>

                <!-- Answers Section - Google Form Style -->
                <div class="bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-green-500 transition">
                    <label class="block text-sm font-medium text-gray-700 mb-4">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Pilihan Jawaban
                        </span>
                    </label>

                    <div class="space-y-4">
                        <!-- Answer A -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-green-100 text-green-700 rounded-lg font-bold flex-shrink-0">
                                A
                            </div>
                            <input
                                type="text"
                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                                placeholder="Contoh: Tidak Mudah"
                            >
                        </div>

                        <!-- Answer B -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-700 rounded-lg font-bold flex-shrink-0">
                                B
                            </div>
                            <input
                                type="text"
                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                                placeholder="Contoh: Kurang Mudah"
                            >
                        </div>

                        <!-- Answer C -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 text-yellow-700 rounded-lg font-bold flex-shrink-0">
                                C
                            </div>
                            <input
                                type="text"
                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                                placeholder="Contoh: Mudah"
                            >
                        </div>

                        <!-- Answer D -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-red-100 text-red-700 rounded-lg font-bold flex-shrink-0">
                                D
                            </div>
                            <input
                                type="text"
                                class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                                placeholder="Contoh: Sangat Mudah"
                            >
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeQuestionModal()" class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition shadow-md">
                        Simpan Pertanyaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus pertanyaan: <br><span id="deleteQuestionText" class="font-semibold mt-2 block"></span></p>

                <div class="flex gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button onclick="deleteQuestion()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteQuestionId = null;

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

        // Question Modal Functions
        function openQuestionModal(mode, questionId = null) {
            const modal = document.getElementById('questionModal');
            const modalTitle = document.getElementById('modalTitle');

            if (mode === 'add') {
                modalTitle.textContent = 'Tambah Pertanyaan';
            } else {
                modalTitle.textContent = 'Edit Pertanyaan';
                // Load question data here
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeQuestionModal() {
            const modal = document.getElementById('questionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Delete Functions
        function confirmDelete(questionId, questionText) {
            deleteQuestionId = questionId;
            document.getElementById('deleteQuestionText').textContent = questionText;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteQuestionId = null;
        }

        function deleteQuestion() {
            // Delete logic here
            console.log('Deleting question:', deleteQuestionId);
            closeDeleteModal();
            // Show success notification
            alert('Pertanyaan berhasil dihapus!');
        }
    </script>
</body>
</html>
