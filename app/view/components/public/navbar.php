<!-- NAVBAR -->
<nav class="bg-gradient-to-r from-green-700 to-green-600 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- KIRI: Logo + Judul -->
            <div class="flex items-center gap-3">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h1 class="text-white text-sm sm:text-lg font-semibold">
                    E-SKM Survei Kepuasan Masyarakat
                </h1>
            </div>

            <!-- KANAN: Hasil IKM + Login / Admin -->
            <div class="flex items-center gap-3">
                <!-- Tombol Hasil IKM -->
                <a href="/hasil-ikm"
                   class="bg-white/90 text-green-700 px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold hover:bg-green-50 transition shadow">
                    Hasil IKM
                </a>

                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <!-- Avatar Admin -->
                    <a href="/admin/dashboard"
                       class="w-10 h-10 bg-white rounded-full flex items-center justify-center cursor-pointer shadow">
                        <span class="text-green-700 text-sm font-bold">AD</span>
                    </a>
                <?php else: ?>
                    <!-- Tombol Login -->
                    <button
                        onclick="openLoginModal()"
                        class="bg-white text-green-700 px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium hover:bg-green-50 transition shadow">
                        Login
                    </button>
                <?php endif; ?>
            </div>

        </div>
    </div>
</nav>
