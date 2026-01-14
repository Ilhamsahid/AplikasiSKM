<div
    id="flashModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 p-4 backdrop-blur-sm">

    <div class="w-full max-w-md rounded-2xl bg-white p-6 sm:p-8 text-center shadow-2xl transform transition-all">

        <!-- ICON -->
        <?php if ($_SESSION['flash']['type'] == 'error'): ?>
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 animate-pulse">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" stroke-width="3"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        <?php else: ?>
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 animate-pulse">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        <?php endif; ?>

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
            class="w-full rounded-lg <?= $_SESSION['flash']['type'] == 'error' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' ?> ?>  py-3 text-sm font-medium text-white transition shadow-md hover:shadow-lg">
            Konfirmasi
        </button>

    </div>
</div>