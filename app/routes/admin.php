<?php
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../data/Responden.php';
require_once __DIR__ . '/../data/Faskes.php';

use app\controllers\AdminController;

$admin = new AdminController();
$method = $_SERVER['REQUEST_METHOD'];
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if ($path === '/admin/login' && $method === 'POST') {
  $admin->login();
  exit;
}

if (!$isAdmin) return;

if (
  $method === 'POST' &&
  preg_match('#^/admin/(tambah|edit|delete)/user#', $path)
) {
  $admin->processUser($path);
  exit;
}

if (
  $method === 'POST' &&
  preg_match('#^/admin/(tambah|edit|delete|restore)/question#', $path)
) {
  $admin->processQuestion($path);
  exit;
}

if (
  $method === 'POST' &&
  preg_match('#^/admin/(tambah|edit|delete)/faskes#', $path)
) {
  $admin->processFaskes($path);
  exit;
}

if (
  preg_match('#^/admin/reset/results#', $path)
) {
  header('Location: /admin/results');
  exit;
}

if ($path === '/admin/logout') {
  $admin->logout();
  exit;
}

if (str_starts_with($path, '/admin/') && $path !== '/admin/') {
  $admin->index();
  exit;
}
