<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

$respondent = $respondents['data'];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Responden');


// ================= HEADER =================
$headers = [
    'No',
    'Nama',
    'Umur',
    'Jenis Kelamin',
    'Pendidikan',
    'No HP',
    'Pekerjaan',
    'Jenis Pelayanan terakhir kali',
    'tanggal terakhir kali',
    'tanggal',
];

$sheet->fromArray($headers, null, 'A1');

$lastColumn = 'J';

// Style header
$sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical'   => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
        ],
    ],
]);


// ================= DATA =================
$row = 2;
foreach ($respondent as $i => $item) {
    $sheet->setCellValue("A{$row}", $i + 1);
    $sheet->setCellValue("B{$row}", $item['responden']);
    $sheet->setCellValue("C{$row}", $item['umur']);
    $sheet->setCellValue("D{$row}", $item['kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan');
    $sheet->setCellValue("E{$row}", $item['lulusan']);

    // No HP harus TEXT (biar gak rusak)
    $sheet->setCellValueExplicit(
        "F{$row}",
        $item['no_hp'],
        DataType::TYPE_STRING
    );

    $sheet->setCellValue("G{$row}", $item['pekerjaan']);
    $sheet->setCellValue("H{$row}", $item['jenis_pelayanan']);
    $sheet->setCellValue("I{$row}", $item['tanggal']);
    $sheet->setCellValue("J{$row}", $item['tanggal']);

    $row++;
}

$lastRow = $row - 1;


// ================= STYLE DATA =================
$sheet->getStyle("A2:{$lastColumn}{$lastRow}")->applyFromArray([
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical'   => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
        ],
    ],
]);


// ================= COLUMN WIDTH =================
$widths = [
    'A' => 5,
    'B' => 20,
    'C' => 8,
    'D' => 15,
    'E' => 12,
    'F' => 18,
    'G' => 18,
    'H' => 43,
    'I' => 18,
    'J' => 18,
];

foreach ($widths as $col => $width) {
    $sheet->getColumnDimension($col)->setWidth($width);
}

// Tinggi header
$sheet->getRowDimension(1)->setRowHeight(25);


// ================= OUTPUT =================
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="responden.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
