<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$data = [
    ['Pelayanan', 3.5, 87.5],
    ['Kecepatan', 3.2, 80.0],
    ['Sikap Petugas', 3.8, 95.0],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Hasil IKM');

$sheet->fromArray([
    ['No', 'Unsur Pelayanan', 'Nilai', 'Skor IKM']
], null, 'A1');

$row = 2;
foreach ($data as $i => $item) {
    $sheet->fromArray([
        $i + 1,
        $item[0],
        $item[1],
        $item[2],
    ], null, "A{$row}");
    $row++;
}


$sheet->getStyle('A1:D1')->getFont()->setBold(true);

foreach (range('A', 'D') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="hasil-ikm.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
