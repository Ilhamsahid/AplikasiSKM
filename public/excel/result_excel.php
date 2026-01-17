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

// Inisialisasi data
$kelamin = ['L' => 0, 'P' => 0];
$lulusan = [
    'SD' => 0,
    'SMP' => 0,
    'SMA' => 0,
    'D1/D2/D3' => 0,
    'S1/D4' => 0,
    'S2' => 0,
    'S3' => 0,
];
$usia = [
    '<17' => 0,
    '17-25' => 0,
    '26-40' => 0,
    '41-60' => 0,
    '60+' => 0,
];

$totalResponden = count($respondents['data']);

// Hitung jumlah berdasarkan jenis kelamin
$jumlahKelamin = array_reduce($respondents['data'], function ($carry, $item) {
    if ($item['kelamin'] == 'L') {
        $carry['L']++;
    } else {
        $carry['P']++;
    }
    return $carry;
}, $kelamin);

// Hitung jumlah berdasarkan pendidikan
$jumlahLulusan = array_reduce($respondents['data'], function ($carry, $item) {
    if (isset($carry[$item['lulusan']])) {
        $carry[$item['lulusan']]++;
    }
    return $carry;
}, $lulusan);

// Hitung jumlah berdasarkan kategori usia
$jumlahUsia = array_reduce($respondents['data'], function ($carry, $item) {
    $umur = isset($item['umur']) ? (int)$item['umur'] : (isset($item['usia']) ? (int)$item['usia'] : 0);

    if ($umur < 17) {
        $carry['<17']++;
    } elseif ($umur >= 17 && $umur <= 25) {
        $carry['17-25']++;
    } elseif ($umur >= 26 && $umur <= 40) {
        $carry['26-40']++;
    } elseif ($umur >= 41 && $umur <= 60) {
        $carry['41-60']++;
    } elseif ($umur > 60) {
        $carry['60+']++;
    }

    return $carry;
}, $usia);

// Fungsi untuk menghitung persentase
function hitungPersen($jumlah, $total): float|string
{
    if ($total == 0) return '0.00';
    return number_format(($jumlah / $total) * 100, 2);
}

$nilaiRataRata = $_GET['nilaiRataRata'];

// Buat spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Laporan IKM');

// ==================== CONTENT ====================

$row = 1;

// TITLE - Row 1
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "INDEKS KEPUASAN MASYARAKAT (IKM)");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(25);
$row++;

// Row 2
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "DINAS/KANTOR/UNIT/UPT ........................");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(20);
$row++;

// Row 3
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "KEMENTERIAN/LEMBAGA/PEMERINTAH PROV/KAB/KOTA .........");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(20);
$row++;

// Row 4
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "BULAN/TRIWULAN/SEMESTER/..... TAHUN......");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(14);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getRowDimension($row)->setRowHeight(20);
$row += 2;

// NILAI IKM HEADER
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "NILAI IKM");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(11);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');
$sheet->getRowDimension($row)->setRowHeight(22);
$row++;

// NILAI IKM VALUE
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", number_format($nilaiRataRata, 2));
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(28);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
$sheet->getRowDimension($row)->setRowHeight(50);
$row += 2;

// INFO DASAR - Nama Layanan
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Nama Layanan");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

$sheet->mergeCells("C{$row}:F{$row}");
$sheet->setCellValue("C{$row}", "Survei Kepuasan Masyarakat");
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
$sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("C{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

// Jumlah Responden
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Jumlah Responden");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

$sheet->mergeCells("C{$row}:F{$row}");
$sheet->setCellValue("C{$row}", "{$totalResponden} orang");
$sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("C{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

// Periode Survei
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Periode Survei");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

$sheet->mergeCells("C{$row}:F{$row}");
$sheet->setCellValue("C{$row}", "{$start} s/d {$end}");
$sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("C{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row += 2;

// JENIS KELAMIN SECTION
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "JENIS KELAMIN");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(11);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');
$sheet->getStyle("A{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

// Table header
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Kategori");
$sheet->mergeCells("C{$row}:D{$row}");
$sheet->setCellValue("C{$row}", "Jumlah");
$sheet->mergeCells("E{$row}:F{$row}");
$sheet->setCellValue("E{$row}", "Persentase");

$sheet->getStyle("A{$row}:F{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}:F{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}:F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('BFBFBF');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

$genderData = [
    ['Laki-laki', $jumlahKelamin['L'], hitungPersen($jumlahKelamin['L'], $totalResponden)],
    ['Perempuan', $jumlahKelamin['P'], hitungPersen($jumlahKelamin['P'], $totalResponden)]
];

foreach ($genderData as $data) {
    $sheet->mergeCells("A{$row}:B{$row}");
    $sheet->setCellValue("A{$row}", $data[0]);
    $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("C{$row}:D{$row}");
    $sheet->setCellValue("C{$row}", $data[1]);
    $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("E{$row}:F{$row}");
    $sheet->setCellValue("E{$row}", $data[2] . "%");
    $sheet->getStyle("E{$row}")->getFont()->setBold(true);
    $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}
$row += 2;

// PENDIDIKAN SECTION
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "PENDIDIKAN");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(11);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');
$sheet->getStyle("A{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

// Table header
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Kategori");
$sheet->mergeCells("C{$row}:D{$row}");
$sheet->setCellValue("C{$row}", "Jumlah");
$sheet->mergeCells("E{$row}:F{$row}");
$sheet->setCellValue("E{$row}", "Persentase");

$sheet->getStyle("A{$row}:F{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}:F{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}:F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('BFBFBF');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

$educationData = [
    ['SD', $jumlahLulusan['SD']],
    ['SMP', $jumlahLulusan['SMP']],
    ['SMA', $jumlahLulusan['SMA']],
    ['D1/D2/D3', $jumlahLulusan['D1/D2/D3']],
    ['S1/D4', $jumlahLulusan['S1/D4']],
    ['S2', $jumlahLulusan['S2']],
    ['S3', $jumlahLulusan['S3']]
];

foreach ($educationData as $data) {
    $sheet->mergeCells("A{$row}:B{$row}");
    $sheet->setCellValue("A{$row}", $data[0]);
    $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("C{$row}:D{$row}");
    $sheet->setCellValue("C{$row}", $data[1]);
    $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("E{$row}:F{$row}");
    $sheet->setCellValue("E{$row}", hitungPersen($data[1], $totalResponden) . "%");
    $sheet->getStyle("E{$row}")->getFont()->setBold(true);
    $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}
$row += 2;

// KATEGORI USIA SECTION
$sheet->mergeCells("A{$row}:F{$row}");
$sheet->setCellValue("A{$row}", "KATEGORI USIA");
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(11);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');
$sheet->getStyle("A{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

// Table header
$sheet->mergeCells("A{$row}:B{$row}");
$sheet->setCellValue("A{$row}", "Kategori");
$sheet->mergeCells("C{$row}:D{$row}");
$sheet->setCellValue("C{$row}", "Jumlah");
$sheet->mergeCells("E{$row}:F{$row}");
$sheet->setCellValue("E{$row}", "Persentase");

$sheet->getStyle("A{$row}:F{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}:F{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle("A{$row}:F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('BFBFBF');
$sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$row++;

$ageData = [
    ['Kurang dari 17 tahun', $jumlahUsia['<17']],
    ['17 - 25 tahun', $jumlahUsia['17-25']],
    ['26 - 40 tahun', $jumlahUsia['26-40']],
    ['41 - 60 tahun', $jumlahUsia['41-60']],
    ['Lebih dari 60 tahun', $jumlahUsia['60+']]
];

foreach ($ageData as $data) {
    $sheet->mergeCells("A{$row}:B{$row}");
    $sheet->setCellValue("A{$row}", $data[0]);
    $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("A{$row}:B{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("C{$row}:D{$row}");
    $sheet->setCellValue("C{$row}", $data[1]);
    $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("C{$row}:D{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $sheet->mergeCells("E{$row}:F{$row}");
    $sheet->setCellValue("E{$row}", hitungPersen($data[1], $totalResponden) . "%");
    $sheet->getStyle("E{$row}")->getFont()->setBold(true);
    $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    $sheet->getStyle("E{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $row++;
}
$row += 2;

// FOOTER
$footerStartRow = $row;
$sheet->mergeCells("A{$row}:F" . ($row + 2));
$footerText = "TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN\n";
$footerText .= "MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN UNIT KAMI AGAR TERUS MEMPERBAIKI\n";
$footerText .= "DAN MENINGKATKAN KUALITAS PELAYANAN BAGI MASYARAKAT";
$sheet->setCellValue("A{$row}", $footerText);
$sheet->getStyle("A{$row}")->getFont()->setBold(true)->setSize(10);
$sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
$sheet->getStyle("A{$row}:F" . ($row + 2))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM);
$sheet->getRowDimension($row)->setRowHeight(50);

// Set column widths
$sheet->getColumnDimension('A')->setWidth(25);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);

// Output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="laporan-ikm.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
