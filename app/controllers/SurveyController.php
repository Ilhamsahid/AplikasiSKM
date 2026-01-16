<?php

namespace app\controllers;

class SurveyController
{
    public function index()
    {
        global $conn;

        $question = new \Pertanyaan($conn);
        $questions = $question->getQuestion(false);

        $title = 'E-SKM Survei Kepuasan Masyarakat';
        $nav = getView('components.public.navbar');
        $footer = getView('components.public.footer');
        $content = getView('public.index-main', [
            'questions' => $questions
        ]);

        include __DIR__ . '/../view/layouts/guest.php';
    }


    public function hasilIkm()
    {
        require __DIR__ . '/../logic/ikm_result.php';
        $jumlahNnrPerUnsur = 0;
        $jumlahNnrPerTimbang = 0;

        foreach ($respondentsChart as $res) {
            $nilaiPerUnsur = array_sum($res['values']);
            $nnrPerUnsur = $nilaiPerUnsur / count($respondents['data']);
            $nnrPerTimbang = $nnrPerUnsur  / $jumlahPertanyaan;

            $jumlahNnrPerUnsur += $nnrPerUnsur;
            $jumlahNnrPerTimbang += $nnrPerTimbang;
        }

        $title = 'E-SKM Hasil IKM';
        $nav = getView('components.public.navbar');
        $footer = getView('components.public.footer');
        $content = getView('public.hasil-ikm', [
            'nilaiRataRata' => $jumlahNnrPerTimbang * 25,
            'nnrPerUnsur' => $jumlahNnrPerTimbang,
            'totalResponden' => count($respondents['data']),
            'jumlahPertanyaan' => $jumlahPertanyaan,
        ]);

        include __DIR__ . '/../view/layouts/guest.php';
    }

    public function submit()
    {
        require __DIR__ . '/../process/ProsesSubmit.php';
    }
}
