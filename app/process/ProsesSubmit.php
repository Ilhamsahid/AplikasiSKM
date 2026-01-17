<?php
include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
require_once __DIR__ . '/../data/Responden.php';
require_once __DIR__ . '/../data/Jawaban.php';

// Membuat Object
$Question = new Pertanyaan($conn);
$Responden = new Responden($conn);
$Jawaban = new Jawaban($conn);

// Membuat variable
$questions = $Question->getQuestion(false);
$respondenId = $Responden->insertResponden([
    'responden' => $_POST['responden'],
    'umur' => $_POST['umur'],
    'kelamin' => $_POST['jenis_kelamin'],
    'lulusan' => $_POST['pendidikan'],
    'no_hp' => $_POST['no_hp'],
    'pekerjaan' => $_POST['pekerjaan'],
    'jenis_pelayanan' => $_POST['jenis_pelayanan'],
    'tanggal_terakhir_kali' => $_POST['tanggal_terakhir_kali'],
    'tanggal' => date('Y-m-d'),
]);

if ($_POST['umur'] < 1 || $_POST['umur'] > 120) {
    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'error',
        'title' => 'error',
        'message' => 'Kuis tidak valid, pastikan inputan anda benar',
    ];

    header("Location: /");
    return;
}

// Memproses Jawaban Ke database
foreach ($questions as $index => $question) {
    $answers = $_POST['q' . ($index + 1)];

    $ansExplode = explode(':', $answers);
    $ansWord = $ansExplode[0];
    $ansValue = $ansExplode[1] ?? null;

    $Jawaban->insertJawaban(
        $respondenId,
        $question['id'],
        $ansWord,
        $ansValue
    );
}

// Membuat flash message
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Kuis selesai terimakasih sudah menyelesaikan kuis ini',
];

header("Location: /");
