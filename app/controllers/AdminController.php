<?php
namespace app\controllers;

class AdminController {

    private $perPage = 10;

    public function index()
    {
        $page = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $initialPage = $page[1] ?? 'dashboard';

        $nav = getView('components.admin.navbar');
        $header = getView('components.admin.header');
        $sidebar = getView('components.admin.sidebar');
        $content = $this->getDashboard() . $this->getUsersPage() . $this->getQuestionsPage() . $this->getResultsPage();
        $modal = getView('components.admin.modal-user') . getView('components.admin.delete-confirmation-modal') . getView('components.admin.modal-question') . getView('components.admin.modal-detail-responden');

        include __DIR__ . '/../view/layouts/admin.php';
    }

    public function getDashboard()
    {
        return getView('admin.dashboard');
    }

    public function getUsersPage()
    {
        global $conn;

        $respondent = new \Responden($conn);
        $respondents = $respondent->getAllRespondent();

        return getView('admin.users-page', [
            'respondents' => $respondents
        ]);
    }

    public function getQuestionsPage()
    {
        global $conn;

        $question = new \Pertanyaan($conn);
        $questions = $question->getQuestion();

        return getView('admin.survey-question-page',[
            'pertanyaan' => $questions
        ]);
    }

    public function getResultsPage()
    {
        global $conn;

        $respondent = new \Responden($conn);

        $start = $_GET['start'] ?? null;
        $end = $_GET['end'] ?? null;

        $respondents = $respondent->getRespondentByDateFilter($start, $end);

        return getView('admin.results-page', [
            'respondents' => $respondents
        ]);
    }

    public function login()
    {
        require_once __DIR__ . '/../process/ProsesLogin.php';
    }

    public function logout()
    {
        require_once __DIR__ . '/../process/ProsesLogout.php';
    }

    public function processUser($path)
    {
        require_once __DIR__ . '/../process/ProsesUser.php';
    }

    public function processQuestion($path)
    {
        require_once __DIR__ . '/../process/ProsesQuestion.php';
    }

    public function processResults($path)
    {
        require_once __DIR__ . '/../process/ProsesResults.php';
    }
}
