
    <div
        id="flashModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-500/70 p-4 backdrop-blur-sm">

        <div class="w-full max-w-md rounded-2xl bg-white p-6 sm:p-8 text-center shadow-2xl transform transition-all">

            <!-- ICON -->
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 animate-pulse">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" stroke-width="3"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- TITLE -->
            <h2 class="mb-2 text-lg sm:text-xl font-semibold text-gray-900">
                <?= $_SESSION['flash']['title'] ?? 'Berhasil' ?>
            </h2>

            <!-- MESSAGE -->
            <p class="mb-6 text-xs sm:text-sm text-gray-500">
                <?= $_SESSION['flash']['message'] ?>
            </p>

            <!-- BUTTON -->
            <button
                onclick="closeModal('flashModal')"
                class="w-full rounded-lg bg-green-600 py-3 text-sm font-medium text-white hover:bg-green-700 transition shadow-md hover:shadow-lg">
                Konfirmasi
            </button>

        </div>
    </div>
