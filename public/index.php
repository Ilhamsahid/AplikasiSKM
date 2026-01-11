<?php
session_start();
include __DIR__ . '/../app/configs/database.php';
require_once __DIR__ . '/../app/helpers/app_helpers.php';
require_once __DIR__ . '/../app/data/Pertanyaan.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);;

if (str_starts_with($path, '/admin')) {
    require __DIR__ . '/../app/routes/admin.php';
} else {
    require __DIR__ . '/../app/routes/web.php';
}
