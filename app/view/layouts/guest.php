<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title><?=  $title ?></title>
</head>
<body class="bg-gray-50">
    <header>
        <?= $nav ?>
    </header>

    <main class="max-w-7xl mx-auto px-3 sm:px-4 py-4 sm:py-8">
        <?= $content ?>
    </main>

    <footer>
        <?= $footer ?>
    </footer>

    <?php if (isset($_SESSION['flash'])): ?>
        <?= getView('components.public.modal-notification') ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?= getView('components.public.modal-login') ?>

    <script src="/scripts/guest.js"></script>
</body>
</html>
