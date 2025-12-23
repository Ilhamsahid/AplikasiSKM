<?php
session_start();
include 'configs/database.php';
require_once __DIR__.'/data/Pertanyaan.php';

$question = new Pertanyaan($conn);
$questions = $question->getQuestion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SKM - Survei Kepuasan Masyarakat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
    <?php include('Components/navbar-public.php') ?>

    <!-- MAIN CONTENT -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 py-4 sm:py-8">

        <!-- HEADER -->
         <?php include('Components/header.php') ?>

        <form action="Process/ProsesSubmit.php" method="post">

            <!-- DATA RESPONDEN -->
            <?php include('view/responden-view.php') ?>
            <?php include('view/question-view.php') ?>

            <!-- Mobile View -->
            <?php include('view/mobile/question-view.php') ?>

            <!-- SUBMIT BUTTON -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="w-full sm:w-auto bg-gradient-to-r from-green-600 to-green-500 text-white px-8 py-3.5 rounded-xl text-sm font-semibold
                           hover:from-green-700 hover:to-green-600 shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 transform hover:scale-105"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kirim Survey
                </button>
            </div>
        </form>
    </div>

    <!-- FLASH MESSAGE MODAL -->
    <?php if (isset($_SESSION['flash'])): ?>
    <?php
    include('Components/modal-notification.php');
    ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php include('Components/modal-login.php') ?>

    <?php include('Components/footer.php') ?>

    <script>
        function closeModal(nameModal) {
            const modal = document.getElementById(nameModal);
            if (modal) modal.remove();
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.getElementById('loginModal').classList.remove('flex');
        }


        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.getElementById('loginModal').classList.add('flex');
        }

    </script>
</body>
</html>
