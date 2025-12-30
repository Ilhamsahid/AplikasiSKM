<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-SKM</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">

        <?= $sidebar ?>
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 backdrop-blur-sm bg-black/20 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto lg:ml-64">
            <?= $header ?>
            <?= $content ?>
        </main>

        <?= $modal ?>
        <?php if (isset($_SESSION['flash'])): ?>
            <?= getView('components.public.modal-notification') ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
    </div>

    <script src="/scripts/admin.js"></script>
</body>
</html>
