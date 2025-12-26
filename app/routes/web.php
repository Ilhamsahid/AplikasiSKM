<?php
require_once __DIR__ . '/../controllers/SurveyController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
use app\controllers\SurveyController;
use app\controllers\AdminController;

if($path === '/'){
    SurveyController::index();
}else if($path === '/submit-survey' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    SurveyController::submit();
}
