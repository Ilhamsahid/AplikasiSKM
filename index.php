<?php
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
            include 'view/instantion-view.php';
            ?>
        </div>
        <div class="space-y-6 hidden" id="step2">
            <?php
            include 'view/question-view.php';
            ?>
        </div>
    </form>
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
    </script>
</body>
</html>
