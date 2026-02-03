<?php
include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Pertanyaan.php';

$Pertanyaan = new Pertanyaan($conn);

$explode = explode('/', $path);
$getId = $explode[4] ?? null;
$getMode = $explode[2];

$input = [
  'pertanyaan' => $_POST['pertanyaan'],
  'opsi' => [
    'id' => [
      $_POST['opsiIdA'],
      $_POST['opsiIdB'],
      $_POST['opsiIdC'],
      $_POST['opsiIdD'],
    ],
    'label' => [
      $_POST['jawabanA'],
      $_POST['jawabanB'],
      $_POST['jawabanC'],
      $_POST['jawabanD'],
    ],
    'value' => [
      1,
      2,
      3,
      4,
    ],
  ],
];


if ($getMode === 'delete') {
  $Pertanyaan->softDeletePertanyaan($getId);

  // Membuat flash message
  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil menghapus data pertanyaan',
  ];
} else if ($getMode === 'tambah') {
  $idPertanyaan = $Pertanyaan->insertPertanyaan([
    'pertanyaan' => $input['pertanyaan'],
  ]);

  for ($i = 0; $i  < count($input['opsi']['label']); $i++) {
    $Pertanyaan->insertOpsiJawaban([
      'label' => $input['opsi']['label'][$i],
      'nilai' => $input['opsi']['value'][$i],
      'urutan' => $input['opsi']['value'][$i]
    ], $idPertanyaan);
  }

  // Membuat flash message
  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil menambah data pertanyaan',
  ];
} else {
  $pertanyaan = $Pertanyaan->changePertanyaan([
    'pertanyaan' => $input['pertanyaan'],
  ], $getId);

  for ($i = 0; $i < count($input['opsi']['label']); $i++) {
    $Pertanyaan->changeOpsiJawaban([
      'label' => $input['opsi']['label'][$i],
      'nilai' => $input['opsi']['value'][$i],
      'urutan' => $input['opsi']['value'][$i],
    ], $input['opsi']['id'][$i]);
  }

  // Membuat flash message
  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Berhasil mengupdate data pertanyaan',
  ];
}

header('Location: /admin/questions');
