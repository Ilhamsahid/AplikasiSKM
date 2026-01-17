<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

$getArr = function ($values) use ($respondentsChart) {
    $arr = [];
    for ($i = 0; $i < count($respondentsChart); $i++) {
        $arr[] = $values[$i];
    }
    return $arr;
};

$respondent = $respondents['data'];
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Poin pertanyaan per responden');

// Header setup
$header = ['No'];
for ($i = 0; $i < count($respondentsChart); $i++) {
    $idx = $i + 1;
    $header[] = "U$idx";
}

// Style definitions
$headerStyle = [
    'font' => [
        'bold' => true,
        'size' => 11
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$summaryHeaderStyle = [
    'font' => [
        'bold' => true,
        'size' => 10
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'E7E6E6']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$dataStyle = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => 'D0D0D0']
        ]
    ]
];

$highlightStyle = [
    'font' => [
        'bold' => true,
        'size' => 11,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '70AD47']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ]
];

// Calculations
$getRespondentsValue = array_map(fn($item) => $item['nilaiSatuan'], $respondents['data']);
$getRespondentsTotalValue = array_map(fn($item) => array_sum($item['values']), $respondentsChart);
$getNRRPerUnsur = array_map(fn($item) => $item / count($respondent), $getRespondentsTotalValue);
$getNRRTertimbang = array_map(fn($item) => $item / count($respondentsChart), $getNRRPerUnsur);
$totalNRRPerUnsur = array_sum($getNRRPerUnsur);
$totalNRRTertimbang = array_sum($getNRRTertimbang);

// Write header
$sheet->fromArray($header, null, 'A1');
$lastColumn = chr(65 + count($header) - 1); // Get last column letter
$sheet->getStyle("A1:{$lastColumn}1")->applyFromArray($headerStyle);
$sheet->getRowDimension(1)->setRowHeight(25);

$row = 2;

// Write data rows
foreach ($getRespondentsValue as $i => $item) {
    $sheet->fromArray([$i + 1], null, "A{$row}");
    $sheet->fromArray($getArr($item), null, "B{$row}");

    // Apply style to data rows
    $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray($dataStyle);

    // Number format for numeric columns
    $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

    $row++;
}

// Summary sections (first part)
$summaryRows = [
    ['Nilai per unsur', $getArr($getRespondentsTotalValue)],
    ['NRR per unsur', $getArr($getNRRPerUnsur)],
    ['NRR Tertimbang', $getArr($getNRRTertimbang)]
];

foreach ($summaryRows as $summaryRow) {
    $sheet->fromArray([$summaryRow[0]], null, "A{$row}");
    $sheet->fromArray($summaryRow[1], null, "B{$row}");

    // Apply summary header style
    $sheet->getStyle("A{$row}")->applyFromArray($summaryHeaderStyle);
    $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->applyFromArray($dataStyle);

    // Number format
    $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

    $row++;
}

// Add spacing (2 empty rows)
$row += 2;

// Style for separated summary (clean, no background color)
$cleanSummaryStyle = [
    'font' => [
        'bold' => true,
        'size' => 10
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$cleanDataStyle = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

// Separated summary section
$sheet->fromArray(['Jumlah Nilai per unsur'], null, "A{$row}");
$sheet->fromArray([$respondents['jumlahSemua']], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($cleanSummaryStyle);
$sheet->getStyle("B{$row}")->applyFromArray($cleanDataStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$row++;

$sheet->fromArray(['Jumlah NRR per unsur'], null, "A{$row}");
$sheet->fromArray([$totalNRRPerUnsur], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($cleanSummaryStyle);
$sheet->getStyle("B{$row}")->applyFromArray($cleanDataStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$row++;

$sheet->fromArray(['Jumlah NRR tertimbang'], null, "A{$row}");
$sheet->fromArray([$totalNRRTertimbang], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($cleanSummaryStyle);
$sheet->getStyle("B{$row}")->applyFromArray($cleanDataStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$row++;

$sheet->fromArray(['Nilai rata-rata'], null, "A{$row}");
$sheet->fromArray([$totalNRRTertimbang * 25], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($cleanSummaryStyle);
$sheet->getStyle("B{$row}")->applyFromArray($cleanDataStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$sheet->getRowDimension($row)->setRowHeight(20);

// Auto-size columns
foreach (range('A', $lastColumn) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="hasil-ikm.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
