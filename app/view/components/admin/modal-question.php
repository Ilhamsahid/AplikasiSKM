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

        <form class="p-6 space-y-6" id="formQuestion" method="post">
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
                    id="pertanyaanSurvei"
                    name="pertanyaan"
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
                            id="jawabanA"
                            name="jawabanA"
                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                            placeholder="Contoh: Tidak Mudah - 1 point"
                        >
                    </div>

                    <!-- Answer B -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-700 rounded-lg font-bold flex-shrink-0">
                            B
                        </div>
                        <input
                            type="text"
                            id="jawabanB"
                            name="jawabanB"
                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                            placeholder="Contoh: Kurang Mudah - 2 point"
                        >
                    </div>

                    <!-- Answer C -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-yellow-100 text-yellow-700 rounded-lg font-bold flex-shrink-0">
                            C
                        </div>
                        <input
                            type="text"
                            id="jawabanC"
                            name="jawabanC"
                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                            placeholder="Contoh: Mudah - 3 point"
                        >
                    </div>

                    <!-- Answer D -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 bg-red-100 text-red-700 rounded-lg font-bold flex-shrink-0">
                            D
                        </div>
                        <input
                            type="text"
                            id="jawabanD"
                            name="jawabanD"
                            class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                            placeholder="Contoh: Sangat Mudah - 4 point"
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
