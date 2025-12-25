<?php
require_once __DIR__ . '/../controllers/SurveyController.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
use app\controllers\SurveyController;

if($path === '/'){
    SurveyController::index();
}else if($path === '/submit-survey'){
    SurveyController::submit();
}
