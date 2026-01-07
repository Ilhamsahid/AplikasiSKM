<?php
require_once __DIR__ . '/../controllers/SurveyController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
use app\controllers\SurveyController;

$surveyController = new SurveyController();

if($path === '/'){
    $surveyController->index();
}else if($path === '/submit-survey' && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $surveyController->submit();
}else if($path === '/hasil-ikm'){
    $surveyController->hasilIkm();
}
