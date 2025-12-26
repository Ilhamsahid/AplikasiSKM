<?php
require_once __DIR__ . '/../controllers/AdminController.php';
use app\controllers\AdminController;

if($path === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    AdminController::login();
}

if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
    if($path === '/admin'){
        AdminController::dashboard();
    }else if($path === '/admin/logout'){
        AdminController::logout();
    }
}
