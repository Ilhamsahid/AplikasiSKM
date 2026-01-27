<?php

include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Faskes.php';

$faskes = new Faskes($conn);

$explode = explode('/', $path);
$getId = $explode[4] ?? null;
$getMode = $explode[2];

if ($getMode === "delete") {
  $faskes->deleteFaskes($getId);

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil menghapus data faskes',
  ];
} else if ($getMode === "tambah") {
  $faskes->insertFaskes([
    'nama_faskes' => $_POST['namaFaskes'],
    'jenis_faskes' => $_POST['jenisFaskes'],
    'is_active' => $_POST['statusFaskes'],
  ]);

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil menambahkan data faskes',
  ];
} else {
  $faskes->updateFaskes([
    'nama_faskes' => $_POST['namaFaskes'],
    'jenis_faskes' => $_POST['jenisFaskes'],
    'is_active' => $_POST['statusFaskes'],
  ], $getId);

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil memperbarui data faskes',
  ];
}

header('location: /admin/faskes');
