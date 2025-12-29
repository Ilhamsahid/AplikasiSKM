<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-50 hidden items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl my-8 transform transition-all">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-green-700 rounded-t-xl">
            <h3 class="text-lg font-bold text-white">Detail Jawaban Responden</h3>
            <button onclick="closeDetailModal()" class="text-white hover:bg-green-600 p-2 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-6 max-h-[70vh] overflow-y-auto">
            <!-- Responden Info -->
            <div class="bg-green-50 rounded-lg p-4 mb-6">
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600 block mb-1">Nama/Instansi</span>
                        <span class="font-semibold text-gray-800" id="namaResponden"></span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Umur</span>
                        <span class="font-semibold text-gray-800" id="umurResponden">35 tahun</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Jenis Kelamin</span>
                        <span class="font-semibold text-gray-800" id="kelaminResponden">Laki-laki</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Pendidikan</span>
                        <span class="font-semibold text-gray-800" id="pendidikanResponden">S1</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Jumlah Point</span>
                        <span class="font-semibold text-gray-800" id="poinResponden">S1</span>
                    </div>
                </div>
            </div>

            <!-- Jawaban -->
            <div class="space-y-4">
                <div id="listJawaban">
                </div>
            </div>
        </div>
    </div>
</div>
