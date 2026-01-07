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
        global $conn;
        $respondent = new \Responden($conn);
        $pertanyaan = new \Pertanyaan($conn);

        $allRespondent = $respondent->getAllRespondent(false);
        $recentResponden = $respondent->getAllRespondent(true);
        $totalPertanyaan = count($pertanyaan->getQuestion());
        $total = count($allRespondent);

        $dataRespondent = [
            'kelamin' => [
                'L' => 0,
                'P' => 0
            ],
            'pendidikan' => [
                'SD' => 0,
                'SMP' => 0,
                'SMA' => 0,
                'D1/D2/D3' => 0,
                'S1/D4' => 0,
                'S2' => 0,
                'S3' => 0,
            ],
            'umur' => [
                '<17' => 0,
                '>17' => 0,
                '>25<40' => 0,
                '>41<60' => 0,
                '>60' => 0,
            ]
        ];

        $filterPersen = function($value) use ($total){
            return $total > 0 ? number_format($value / $total * 100, 2, '.', ',') : 0;
        };

        $filterRespondent = array_reduce($allRespondent, function($carry, $item){
            $carry['kelamin'][$item['kelamin']]++;
            $carry['pendidikan'][$item['lulusan']]++;

            if($item['umur'] > 60){
                $carry['umur']['>60']++;
            }else if($item['umur'] > 41 && $item['umur'] < 60){
                $carry['umur']['>41<60']++;
            }else if($item['umur'] > 25 && $item['umur'] < 40){
                $carry['umur']['>25<40']++;
            }else if($item['umur'] > 17 ){
                $carry['umur']['>17']++;
            }else {
                $carry['umur']['<17']++;
            }

            return $carry;
        }, $dataRespondent);

        $filterPersenRespondent = [];

        foreach ($filterRespondent as $kategori => $values) {
            foreach ($values as $key => $value) {
                $filterPersenRespondent[$kategori][$key] = $filterPersen($value);
            }
        }

        return getView('admin.dashboard',[
            'totalPertanyaan' => $totalPertanyaan,
            'jumlahResponden' => $total,
            'filterRespondent' => $filterRespondent,
            'recentRespondent' => $recentResponden,
            'filterPersenRespondent' => $filterPersenRespondent,
        ]);
    }

    public function getUsersPage()
    {
        global $conn;

        $respondent = new \Responden($conn);
        $respondents = $respondent->getAllRespondent(false);

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
        require __DIR__ . '/../logic/ikm_result.php';

        return getView('admin.results-page', [
            'respondents' => $respondents,
            'chartData' => $respondentsChart,
            'jumlahPertanyaan' => $jumlahPertanyaan,
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
}
