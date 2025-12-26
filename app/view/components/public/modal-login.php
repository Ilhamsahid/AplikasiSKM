<!-- LOGIN MODAL -->
<div
    id="loginModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
>
    <!-- Modal Box -->
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 relative animate-scaleIn">

        <!-- Close Button -->
        <button
            onclick="closeLoginModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
        >
            ✕
        </button>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="mx-auto w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center mb-3">
                🔐
            </div>
            <h2 class="text-xl font-bold text-gray-800">Login Admin</h2>
            <p class="text-sm text-gray-500">Masuk untuk mengelola data survei</p>
        </div>

        <!-- Form -->
        <form action="/admin/login" method="post" id="formLogin" class="space-y-4">

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                />
                <span id="errorUsername" class="text-red-500 text-sm"></span>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                           focus:border-green-500 focus:ring-2 focus:ring-green-500/30 outline-none"
                />
            </div>

            <div id="error" class="text-center text-red-500 text-sm"></div>

            <!-- Submit -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-green-600 to-green-500 text-white py-3 rounded-xl
                       font-semibold hover:from-green-700 hover:to-green-600 transition shadow-lg"
            >
                Login
            </button>
        </form>
    </div>
</div>
