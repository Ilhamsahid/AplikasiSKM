<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

use Dompdf\Dompdf;

$kelamin = ['L' => 0, 'P' => 0];
$lulusan = [
    'SD' => 0,
    'SMP' => 0,
    'SMA' => 0,
    'D1/D2/D3' => 0,
    'S1/D4' => 2,
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

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 20px;
        }

        .container {
            border: 3px solid #000;
            padding: 0;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            padding: 12px 20px;
            line-height: 1.5;
        }

        .content-row {
            display: table;
            width: 100%;
            border-collapse: collapse;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }

        .left-col {
            display: table-cell;
            width: 32%;
            vertical-align: top;
            padding: 10px;
            border-right: 2px solid #000;
        }

        .right-col {
            display: table-cell;
            width: 68%;
            vertical-align: top;
            padding: 10px;
        }

        /* CARD NILAI IKM */
        .card-nilai {
            border: 2px solid #000;
            padding: 15px 10px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .nilai-title {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }

        .ikm-value {
            font-size: 90px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            color: #2c3e50;
        }

        /* SECTION TITLES */
        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 10px;
            padding: 5px 8px;
            background-color: #34495e;
            color: white;
            border-radius: 3px;
        }

        /* DATA TABLES */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 9px;
        }

        .data-table td {
            padding: 3px 5px;
            border-bottom: 1px solid #ddd;
        }

        .data-table td:first-child {
            font-weight: bold;
            width: 35%;
        }

        .data-table td:nth-child(2) {
            width: 35%;
            text-align: right;
        }

        .data-table td:nth-child(3) {
            width: 30%;
            text-align: right;
            color: #2980b9;
            font-weight: bold;
        }

        /* LAYOUT COLUMNS */
        .two-columns {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .column-50 {
            display: table-cell;
            width: 48%;
            vertical-align: top;
            padding-right: 2%;
        }

        .column-50:last-child {
            padding-right: 0;
            padding-left: 2%;
        }

        .info-box {
            border: 1px solid #bdc3c7;
            padding: 8px;
            margin-bottom: 8px;
            background-color: #ecf0f1;
            border-radius: 3px;
        }

        .info-label {
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 10px;
            color: #2c3e50;
        }

        .footer {
            text-align: center;
            padding: 12px 20px;
            font-size: 9px;
            line-height: 1.5;
            font-weight: bold;
            background-color: #ecf0f1;
        }

        .footer-error {
            color: #c0392b;
            font-size: 8px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="title">
            <div><strong>INDEKS KEPUASAN MASYARAKAT (IKM)</strong></div>
            <div><strong>DINAS/ KANTOR/ UNIT/ UPT<span class="dots">...........................</span></strong></div>
            <div><strong>KEMENTERIAN/LEMBAGA/PEMERINTAH PROV/ KAB/KOTA<span class="dots">.........</span></strong></div>
            <div><strong>BULAN/TRIWULAN/ SEMESTER/<span class="dots">.....</span> TAHUN<span class="dots">......</span></strong></div>
        </div>

        <div class="content-row">
            <!-- LEFT COLUMN: NILAI IKM -->
            <div class="left-col">
                <div class="card-nilai">
                    <div class="nilai-title">NILAI IKM</div>
                    <div class="ikm-value"><?= number_format($nilaiRataRata, 2) ?></div>
                </div>
            </div>

            <!-- RIGHT COLUMN: DATA RESPONDEN -->
            <div class="right-col">

                <!-- Info Dasar -->
                <div class="info-box">
                    <div class="info-label">NAMA LAYANAN</div>
                    <div class="info-value">Survei Kepuasan Masyarakat</div>
                </div>

                <div class="two-columns">
                    <div class="column-50">
                        <div class="info-box">
                            <div class="info-label">JUMLAH RESPONDEN</div>
                            <div class="info-value" style="font-size: 16px; font-weight: bold;"><?= $totalResponden ?> orang</div>
                        </div>
                    </div>
                    <div class="column-50">
                        <div class="info-box">
                            <div class="info-label">PERIODE SURVEI</div>
                            <div class="info-value"><?= $start ?> s/d <?= $end ?></div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="section-title">JENIS KELAMIN</div>
                <table class="data-table">
                    <tr>
                        <td>Laki-laki</td>
                        <td><?= $jumlahKelamin['L'] ?> orang</td>
                        <td><?= hitungPersen($jumlahKelamin['L'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>Perempuan</td>
                        <td><?= $jumlahKelamin['P'] ?> orang</td>
                        <td><?= hitungPersen($jumlahKelamin['P'], $totalResponden) ?>%</td>
                    </tr>
                </table>

                <!-- Pendidikan -->
                <div class="section-title">PENDIDIKAN</div>
                <table class="data-table">
                    <tr>
                        <td>SD</td>
                        <td><?= $jumlahLulusan['SD'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['SD'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>SMP</td>
                        <td><?= $jumlahLulusan['SMP'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['SMP'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>SMA</td>
                        <td><?= $jumlahLulusan['SMA'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['SMA'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>D1/D2/D3</td>
                        <td><?= $jumlahLulusan['D1/D2/D3'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['D1/D2/D3'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>S1/D4</td>
                        <td><?= $jumlahLulusan['S1/D4'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['S1/D4'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>S2</td>
                        <td><?= $jumlahLulusan['S2'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['S2'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>S3</td>
                        <td><?= $jumlahLulusan['S3'] ?> orang</td>
                        <td><?= hitungPersen($jumlahLulusan['S3'], $totalResponden) ?>%</td>
                    </tr>
                </table>

                <!-- Kategori Usia -->
                <div class="section-title">KATEGORI USIA</div>
                <table class="data-table">
                    <tr>
                        <td>Kurang dari 17 tahun</td>
                        <td><?= $jumlahUsia['<17'] ?> orang</td>
                        <td><?= hitungPersen($jumlahUsia['<17'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>17 - 25 tahun</td>
                        <td><?= $jumlahUsia['17-25'] ?> orang</td>
                        <td><?= hitungPersen($jumlahUsia['17-25'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>26 - 40 tahun</td>
                        <td><?= $jumlahUsia['26-40'] ?> orang</td>
                        <td><?= hitungPersen($jumlahUsia['26-40'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>41 - 60 tahun</td>
                        <td><?= $jumlahUsia['41-60'] ?> orang</td>
                        <td><?= hitungPersen($jumlahUsia['41-60'], $totalResponden) ?>%</td>
                    </tr>
                    <tr>
                        <td>Lebih dari 60 tahun</td>
                        <td><?= $jumlahUsia['60+'] ?> orang</td>
                        <td><?= hitungPersen($jumlahUsia['60+'], $totalResponden) ?>%</td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="footer">
            <div>TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN</div>
            <div>MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN UNIT KAMI AGAR TERUS MEMPERBAIKI</div>
            <div>DAN MENINGKATKAN KUALITAS PELAYANAN BAGI MASYARAKAT</div>
        </div>

    </div>

</body>

</html>

<?php
$html = ob_get_clean();

$pdf = new Dompdf();
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();
$pdf->stream('laporan-ikm.pdf', ['Attachment' => true]);
?>