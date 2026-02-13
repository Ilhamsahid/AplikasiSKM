<?php

use Dom\ProcessingInstruction;

include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
require_once __DIR__ . '/../data/Responden.php';
require_once __DIR__ . '/../data/Jawaban.php';

$Question = new Pertanyaan($conn);
$Responden = new Responden($conn);
$Jawaban = new Jawaban($conn);

$respondenId = $Responden->insertResponden([
  'responden' => $_POST['responden'],
  'faskes_id' => $_POST['faskes_id'],
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

for ($i = 0; $i  < count($Question->getQuestion(false, true)); $i++) {
  $Jawaban->insertJawaban(
    $respondenId,
    $_POST['q' . $i],
  );
}

// Membuat flash message
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => 'Kuis selesai terimakasih sudah menyelesaikan survei kepuasan masyarakat',
];

header("Location: /");
