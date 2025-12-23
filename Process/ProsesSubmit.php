<?php
session_start();
include '../configs/database.php';
require_once '../data/Pertanyaan.php';
require_once '../data/Responden.php';
require_once '../data/Jawaban.php';

// Membuat Object
$Question = new Pertanyaan($conn);
$Responden = new Responden($conn);
$Jawaban = new Jawaban($conn);

// Membuat variable
$questions = $Question->getQuestion();
$respondenId = $Responden->insertResponden([
    'responden' => $_POST['responden'],
    'umur' => $_POST['umur'],
    'kelamin' => $_POST['jenis_kelamin'],
    'lulusan' => $_POST['pendidikan'],
    'jenis_pelayanan' => $_POST['jenis_pelayanan'],
    'tanggal_terakhir_kali' => $_POST['tanggal_terakhir_kali'],
    'tanggal' => date('Y-m-d'),
]);

// Memproses Jawaban Ke database
foreach ($questions as $index => $question) {
    $answers = $_POST['q'. ($index + 1)];

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

header("Location: ../index.php");
