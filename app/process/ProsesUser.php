<?php
include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Responden.php';

$Responden = new Responden($conn);

$explode = explode('/', $path);
$getId = $explode[4] ?? null;
$getMode = $explode[2];

$nama = $_POST['nama'] ?? null;
$umur = $_POST['umur'] ?? null;
$kelamin = $_POST['kelamin'] ?? null;
$lulusan = $_POST['lulusan'] ?? null;
$layanan = $_POST['jenis_layanan'] ?? null;
$tanggal_terakhir = $_POST['tanggal_terakhir'] ?? null;

if($getMode === 'delete'){
    $Responden->deleteResponden($getId);

    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil menghapus data responden',
    ];
}else if(!isset($getId)){
    $Responden->insertResponden([
        'responden' => $nama,
        'umur' => $umur,
        'kelamin' => $kelamin,
        'lulusan' => $lulusan,
        'jenis_pelayanan' => $layanan,
        'tanggal_terakhir_kali' => $tanggal_terakhir,
        'tanggal' => Date('Y-m-d'),
    ]);

    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil menambahkan data responden',
    ];
}else{
    $Responden->updateResponden([
        'responden' => $nama,
        'umur' => $umur,
        'kelamin' => $kelamin,
        'lulusan' => $lulusan,
        'jenis_pelayanan' => $layanan,
        'tanggal_terakhir_kali' => $tanggal_terakhir,
        'tanggal' => Date('Y-m-d'),
    ], $getId);


    // Membuat flash message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Berhasil memperbarui data responden',
    ];
}

header('Location: /admin/users');
