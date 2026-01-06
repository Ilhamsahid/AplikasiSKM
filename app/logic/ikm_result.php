<?php
require_once __DIR__ . '/../data/Responden.php';
require_once __DIR__ . '/../data/Pertanyaan.php';

global $conn;

$respondent = new Responden($conn);
$question = new Pertanyaan($conn);

$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;

$jumlahPertanyaan = count($question->getQuestion());
$respondents = $respondent->getRespondentByDateFilter($start, $end, true);
$respondentsWithNoFilter = $respondent->getRespondentByDateFilter($start, $end, false);
$respondentsChart = $respondent->getRespondentChart($respondentsWithNoFilter);
