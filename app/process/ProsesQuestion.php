<?php
include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Pertanyaan.php';

$Pertanyaan = new Pertanyaan($conn);

$explode = explode('/', $path);
$getId = $explode[4] ?? null;
$getMode = $explode[2];

if ($getMode !== 'delete') $jawaban = $_POST['jawabanA'] . ':' . $_POST['jawabanB'] . ':' . $_POST['jawabanC'] . ':' . $_POST['jawabanD'];

if($getMode === 'delete'){
    $Pertanyaan->deletePertanyaan($getId);

    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil menghapus data pertanyaan',
    ];
}else if($getMode === 'tambah') {
    $Pertanyaan->insertPertanyaan([
        'pertanyaan' => $_POST['pertanyaan'],
        'jawaban' => $jawaban,
    ]);

    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil menambah data pertanyaan',
    ];
}else{
    $Pertanyaan->updatePertanyaan([
        'pertanyaan' => $_POST['pertanyaan'],
        'jawaban' => $jawaban,
    ], $getId);

    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil menambah data pertanyaan',
    ];
}

header('Location: /admin/questions');
