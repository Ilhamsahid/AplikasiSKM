<?php
require_once __DIR__ . '/../data/Responden.php';
require_once __DIR__ . '/../data/Pertanyaan.php';
require_once __DIR__ . '/../data/Faskes.php';

global $conn;

$respondent = new Responden($conn);
$question = new Pertanyaan($conn);
$faskes = new Faskes($conn);

$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;
$faskes_id = $_GET['faskes_id'] ?? null;

$allFaskes = $faskes->getActiveFaskes();
$jumlahPertanyaan = count($question->getQuestion(false));
$respondents = $respondent->getRespondentByDateFilter($start, $end, true, $faskes_id);
$respondentsWithNoFilter = $respondent->getRespondentByDateFilter($start, $end, false, $faskes_id);
$respondentsChart = $respondent->getRespondentChart($respondentsWithNoFilter);
$total = count($respondents['data']);
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

$filterPersen = function ($value) use ($total) {
  return $total > 0 ? number_format($value / $total * 100, 2, '.', ',') : 0;
};

$filterRespondent = array_reduce($respondents['data'], function ($carry, $item) {
  $carry['kelamin'][$item['kelamin']]++;
  $carry['pendidikan'][$item['lulusan']]++;

  if ($item['umur'] > 60) {
    $carry['umur']['>60']++;
  } else if ($item['umur'] > 41 && $item['umur'] < 60) {
    $carry['umur']['>41<60']++;
  } else if ($item['umur'] > 25 && $item['umur'] < 40) {
    $carry['umur']['>25<40']++;
  } else if ($item['umur'] > 17) {
    $carry['umur']['>17']++;
  } else {
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
