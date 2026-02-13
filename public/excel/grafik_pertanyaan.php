<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Grafik Pertanyaan');

// Header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Pertanyaan');
$sheet->setCellValue('C1', 'Jawaban');

// Style untuk header (abu-abu gelap dengan border tebal)
$headerStyle = [
    'font' => [
        'bold' => true,
        'size' => 11,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'D9D9D9']
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

// Style untuk nomor urut
$numberStyle = [
    'font' => [
        'bold' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F2F2F2']
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

// Style untuk pertanyaan
$questionStyle = [
    'font' => [
        'size' => 10,
        'name' => 'Arial'
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
        'indent' => 1
    ]
];

// Style untuk label jawaban
$labelStyle = [
    'font' => [
        'bold' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F2F2F2']
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true
    ]
];

// Style untuk data responden
$dataStyle = [
    'font' => [
        'size' => 10,
        'name' => 'Arial'
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

// Style untuk label "Jumlah Responden"
$labelResStyle = [
    'font' => [
        'italic' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER,
        'indent' => 1
    ]
];

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(6);
$sheet->getColumnDimension('B')->setWidth(70);

// Set tinggi baris header
$sheet->getRowDimension(1)->setRowHeight(25);

$row = 2;
$maxCols = 0;

// Hitung max kolom
foreach ($respondentsChart as $item) {
    $maxCols = max($maxCols, count($item['labels']));
}

// Set lebar kolom jawaban
for ($i = 0; $i < $maxCols; $i++) {
    $colLetter = chr(67 + $i);
    $sheet->getColumnDimension($colLetter)->setWidth(18);
}

// Apply header style
$lastCol = chr(67 + $maxCols - 1);
$sheet->getStyle("A1:{$lastCol}1")->applyFromArray($headerStyle);

// Isi data
foreach ($respondentsChart as $i => $item) {
    // Set tinggi baris pertanyaan
    $sheet->getRowDimension($row)->setRowHeight(30);

    // Baris pertanyaan
    $sheet->setCellValue("A{$row}", $i + 1);
    $sheet->setCellValue("B{$row}", $item['question']);

    // Labels jawaban
    $labelCount = count($item['labels']);
    for ($j = 0; $j < $labelCount; $j++) {
        $colLetter = chr(67 + $j);
        $sheet->setCellValue("{$colLetter}{$row}", $item['labels'][$j]);
    }

    $endCol = chr(67 + $labelCount - 1);
    $sheet->getStyle("A{$row}")->applyFromArray($numberStyle);
    $sheet->getStyle("B{$row}")->applyFromArray($questionStyle);
    $sheet->getStyle("C{$row}:{$endCol}{$row}")->applyFromArray($labelStyle);

    $row++;

    // Set tinggi baris data
    $sheet->getRowDimension($row)->setRowHeight(20);

    // Baris data
    $sheet->setCellValue("B{$row}", 'Jumlah Responden');

    for ($j = 0; $j < $labelCount; $j++) {
        $colLetter = chr(67 + $j);
        $sheet->setCellValue("{$colLetter}{$row}", $item['users'][$j]);
    }

    $sheet->getStyle("A{$row}")->applyFromArray($numberStyle);
    $sheet->getStyle("B{$row}")->applyFromArray($labelResStyle);
    $sheet->getStyle("C{$row}:{$endCol}{$row}")->applyFromArray($dataStyle);

    $row++;
}

// Set margin untuk print
$sheet->getPageMargins()->setTop(0.75);
$sheet->getPageMargins()->setRight(0.5);
$sheet->getPageMargins()->setLeft(0.5);
$sheet->getPageMargins()->setBottom(0.75);

// Set orientasi landscape
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

// Set print area
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);

// Output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="grafik pertanyaan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
