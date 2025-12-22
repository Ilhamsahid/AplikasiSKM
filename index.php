<?php
session_start();
include 'configs/database.php';
require_once __DIR__.'/data/Pertanyaan.php';

$question = new Pertanyaan($conn);
$questions = $question->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>

    <form action="Process/ProsesSubmit.php" class="max-w-lg mx-auto" method="post">
        <h2 class="text-3xl text-center my-5">Survey Kepuasan</h2>
        <div class="space-y-6" id="step1">
            <?php
            include 'view/responden-view.php';
            ?>
        </div>
        <div class="space-y-6 hidden" id="step2">
            <?php
            include 'view/question-view.php';
            ?>
        </div>
    </form>

    <?php if (isset($_SESSION['flash'])): ?>
<div
    id="flashModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-slate-500/70">

    <div class="w-full max-w-md rounded-2xl bg-white p-8 text-center shadow-2xl">

        <!-- ICON -->
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" stroke-width="3"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- TITLE -->
        <h2 class="mb-2 text-xl font-semibold text-gray-900">
            <?= $_SESSION['flash']['title'] ?? 'Berhasil' ?>
        </h2>

        <!-- MESSAGE -->
        <p class="mb-6 text-sm text-gray-500">
            <?= $_SESSION['flash']['message'] ?>
        </p>

        <!-- BUTTON -->
        <button
            onclick="closeModal()"
            class="w-full rounded-lg bg-indigo-600 py-3 text-sm font-medium text-white hover:bg-indigo-700 transition">
            Konfirmasi
        </button>

    </div>
</div>

<?php unset($_SESSION['flash']); ?>
<?php endif; ?>


    <script>
        function clear(){
            document.getElementById('instansiMsg').textContent = '';
            instansi.classList.remove('border-red-500');
            document.getElementById('umurMsg').textContent = '';
            umur.classList.remove('border-red-500');
            document.getElementById('jkMsg').textContent = '';
            document.getElementById('pendidikanMsg').textContent = '';
        }

        function nextStep(){
            const instansi = document.getElementById('instansi');
            const umur = document.getElementById('umur');
            const jk = document.querySelector('input[name="jenis_kelamin"]:checked')
            const pendidikan = document.querySelector('input[name="pendidikan"]:checked')
            let flag = false;

            clear();

            // VALIDASI
            if (!instansi.value.trim()) {
                document.getElementById('instansiMsg').textContent = 'Wajib diisi';
                instansi.classList.add('border-red-500');
                flag = true;
            }

            if (!umur.value || umur.value <= 0) {
                document.getElementById('umurMsg').textContent = 'Wajib diisi';
                umur.classList.add('border-red-500');
                flag = true;
            }

            if(!jk){
                document.getElementById('jkMsg').textContent = 'Wajib diisi';
                flag = true;
            }

            if(!pendidikan){
                document.getElementById('pendidikanMsg').textContent = 'Wajib diisi';
                flag = true;
            }

            if(flag) return;

            document.getElementById('step1').classList.add('hidden')
            document.getElementById('step2').classList.remove('hidden')
        }

        function prevStep(){
            document.getElementById('step2').classList.add('hidden')
            document.getElementById('step1').classList.remove('hidden')
        }

        function closeModal() {
            const modal = document.getElementById('flashModal');
            if (modal) modal.remove();
        }
    </script>
</body>
</html>
