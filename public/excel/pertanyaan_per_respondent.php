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
        'size' => 11,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'D9D9D9']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$noColumnStyle = [
    'font' => [
        'bold' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F2F2F2']
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

$dataStyle = [
    'font' => [
        'size' => 10,
        'name' => 'Arial'
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
        'size' => 10,
        'name' => 'Arial'
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'E8E8E8']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER,
        'indent' => 1
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$summaryDataStyle = [
    'font' => [
        'size' => 10,
        'name' => 'Arial'
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

$finalSummaryLabelStyle = [
    'font' => [
        'bold' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER,
        'indent' => 1
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$finalSummaryValueStyle = [
    'font' => [
        'bold' => true,
        'size' => 10,
        'name' => 'Arial'
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$highlightStyle = [
    'font' => [
        'bold' => true,
        'size' => 11,
        'name' => 'Arial'
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_LEFT,
        'vertical' => Alignment::VERTICAL_CENTER,
        'indent' => 1
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$highlightValueStyle = [
    'font' => [
        'bold' => true,
        'size' => 11,
        'name' => 'Arial'
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
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
$lastColumn = chr(65 + count($header) - 1);
$sheet->getStyle("A1:{$lastColumn}1")->applyFromArray($headerStyle);
$sheet->getRowDimension(1)->setRowHeight(28);

// Set column A width
$sheet->getColumnDimension('A')->setWidth(30);

$row = 2;

// Write data rows
foreach ($getRespondentsValue as $i => $item) {
    $sheet->fromArray([$i + 1], null, "A{$row}");
    $sheet->fromArray($getArr($item), null, "B{$row}");

    // Apply style to data rows
    $sheet->getStyle("A{$row}")->applyFromArray($noColumnStyle);
    $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->applyFromArray($dataStyle);
    $sheet->getRowDimension($row)->setRowHeight(20);

    $row++;
}

// Summary sections (first part)
$summaryRows = [
    ['Nilai per unsur', $getArr($getRespondentsTotalValue)],
    ['NRR per unsur', $getArr($getNRRPerUnsur)],
    ['NRR Tertimbang', $getArr($getNRRTertimbang)]
];

foreach ($summaryRows as $i => $summaryRow) {
    $sheet->fromArray([$summaryRow[0]], null, "A{$row}");
    $sheet->fromArray($summaryRow[1], null, "B{$row}");

    // Apply summary header style
    $sheet->getStyle("A{$row}")->applyFromArray($summaryHeaderStyle);
    $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->applyFromArray($summaryDataStyle);
    $sheet->getRowDimension($row)->setRowHeight(22);

    if ($i > 0) {
        // Number format
        $sheet->getStyle("B{$row}:{$lastColumn}{$row}")->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
    }

    $row++;
}

// Add spacing (2 empty rows)
$row += 2;

// Separated summary section with enhanced styling
$sheet->fromArray(['Jumlah Nilai per unsur'], null, "A{$row}");
$sheet->fromArray([$respondents['jumlahSemua']], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($finalSummaryLabelStyle);
$sheet->getStyle("B{$row}")->applyFromArray($finalSummaryValueStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$sheet->getRowDimension($row)->setRowHeight(24);
$row++;

$sheet->fromArray(['Jumlah NRR per unsur'], null, "A{$row}");
$sheet->fromArray([$totalNRRPerUnsur], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($finalSummaryLabelStyle);
$sheet->getStyle("B{$row}")->applyFromArray($finalSummaryValueStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$sheet->getRowDimension($row)->setRowHeight(24);
$row++;

$sheet->fromArray(['Jumlah NRR tertimbang'], null, "A{$row}");
$sheet->fromArray([$totalNRRTertimbang], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($finalSummaryLabelStyle);
$sheet->getStyle("B{$row}")->applyFromArray($finalSummaryValueStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$sheet->getRowDimension($row)->setRowHeight(24);
$row++;

// Nilai rata-rata with darkest highlight (most important)
$sheet->fromArray(['Nilai Rata-Rata'], null, "A{$row}");
$sheet->fromArray([$totalNRRTertimbang * 25], null, "B{$row}");
$sheet->getStyle("A{$row}")->applyFromArray($highlightStyle);
$sheet->getStyle("B{$row}")->applyFromArray($highlightValueStyle);
$sheet->getStyle("B{$row}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
$sheet->getRowDimension($row)->setRowHeight(26);

// Auto-size columns (except column A which is already set)
foreach (range('B', $lastColumn) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
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
header('Content-Disposition: attachment; filename="pertanyaan per responden.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
