<?php
namespace app\controllers;

class AdminController {
    public static function dashboard()
    {
        include __DIR__ . '/../view/layouts/admin.php';
    }

    public static function login()
    {
        require_once __DIR__ . '/../process/ProsesLogin.php';
    }

    public static function logout()
    {
        require_once __DIR__ . '/../process/ProsesLogout.php';
    }
}
