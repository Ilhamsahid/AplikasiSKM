<?php
session_start();
include '../configs/database.php';
require_once '../data/Pertanyaan.php';
require_once '../data/Instansi.php';
require_once '../data/Jawaban.php';

// Membuat Object
$Question = new Pertanyaan($conn);
$Instantion = new Instansi($conn);
$Jawaban = new Jawaban($conn);

// Membuat variable
$questions = $Question->getAll();
$instantionId = $Instantion->insertInstansi([
    'instansi' => $_POST['instansi'],
    'umur' => $_POST['umur'],
    'kelamin' => $_POST['jenis_kelamin'],
    'lulusan' => $_POST['pendidikan'],
]);

// Memproses Jawaban Ke database
foreach ($questions as $index => $question) {
    $answers = $_POST['q'. ($index + 1)];

    $ansExplode = explode(':', $answers);
    $ansWord = $ansExplode[0];
    $ansValue = $ansExplode[1] ?? null;

    $Jawaban->insertJawaban(
        $instantionId,
        $question['id'],
        $ansWord,
        $ansValue
    );
}

// Membuat flash message
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Kuis selesai terimakasih sudah menggunakan kuis ini',
];

header("Location: ../index.php");
