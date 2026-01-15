<div id="usersPage" class="page-content hidden p-4 sm:p-6 lg:p-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex-1">
            <div class="relative">
                <input type="text" placeholder="Cari user..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                    oninput="searchUser(this.value)">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Umur</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Kelamin</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Lulusan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Jenis pelayanan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">No Hp</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Pekerjaan</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Tanggal Terakhir Pelayanan</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody id="usersTableBody" class="divide-y divide-gray-200"></tbody>
        </table>
    </div>

    <div id="mobileCardUsers"></div>

    <div id="notFoundusers"
        class="hidden flex flex-col items-center justify-center py-16 text-center">
        <svg class="w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>

        <h3 class="text-lg font-semibold text-gray-800">
            Data tidak tersedia
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Mohon maaf data belum tersedia
        </p>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div id="paginationUser" class="flex flex-wrap items-center gap-2"></div>
        <div id="paginationInfoUser" class="text-sm text-gray-600"></div>
    </div>
</div>


<script>
    let users = <?= json_encode($respondents) ?>;
</script>