<?php
namespace app\controllers;

class SurveyController {
    public static function index()
    {
        global $conn;

        $question = new \Pertanyaan($conn);
        $questions = $question->getQuestion();

        $title = 'E-SKM Survei Kepuasan Masyarakat';
        $nav = getView('components.public.navbar');
        $footer = getView('components.public.footer');
        $content = getView('public.index-main', [
            'questions' => $questions
        ]);

        include __DIR__ . '/../view/layouts/guest.php';
    }

    public static function submit()
    {
        require __DIR__ . '/../process/ProsesSubmit.php';
    }
}
