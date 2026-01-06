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
        'S1/D4' => 0,
        'S2' => 0,
        'S3' => 0,
    ];

    $jumlahKelamin = array_reduce($respondents['data'], function($carry, $item){
        if($item['kelamin'] == 'L'){
            $carry['L']++;
        }else{
            $carry['P']++;
        }
        return $carry;
    }, $kelamin);

    $jumlahLulusan = array_reduce($respondents['data'], function($carry, $item){
        if(isset($carry[$item['lulusan']])){
            $carry[$item['lulusan']]++;
        }

        return $carry;
    }, $lulusan);

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
            font-size: 10px;
            margin: 30px;
        }
        .container {
            border: 3px solid #000;
            padding: 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            padding: 15px 20px;
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
            width: 38%;
            vertical-align: top;
            padding: 12px;
        }
        .right-col {
            display: table-cell;
            width: 62%;
            vertical-align: top;
            padding: 12px 12px 12px 8px;
        }
        /* CARD 1 - NILAI IKM */
        .card-nilai {
            border: 2px solid #000;
            padding: 20px 15px;
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .nilai-title {
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }
        .ikm-value {
            font-size: 120px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
        }
        /* CARD 2 - RESPONDEN */
        .card-responden {
            border: 2px solid #000;
            padding: 20px 15px;
            height: 220px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 10px;
        }
        .section-title-underline {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 10px;
            padding-bottom: 3px;
            border-bottom: 2px solid #000;
        }
        .section-responden {
            text-align: center;
            font-weight: bold;
            margin: 10px 0 8px 0;
            font-size: 10px;
        }
        .data-line {
            margin: 2px 0;
            font-size: 10px;
            line-height: 1.3;
        }
        .footer {
            text-align: center;
            padding: 15px 20px;
            font-size: 9px;
            line-height: 1.5;
            font-weight: bold;
        }
        .dots {
            display: inline-block;
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
        <!-- CARD 1: NILAI IKM -->
        <div class="left-col">
            <div class="card-nilai">
                <div class="nilai-title">NILAI IKM</div>
                <div class="ikm-value"><?= $nilaiRataRata ?></div>
            </div>
        </div>

        <!-- CARD 2: RESPONDEN -->
        <div class="right-col">
            <div class="card-responden">
                <div class="section-title-underline">NAMA LAYANAN Survei Kepuasan Masyarakat</div>
                <div class="section-responden">RESPONDEN</div>
                <div class="data-line"><strong>JUMLAH</strong> <span style="margin-left: 42px;">: <?= count($respondents['data']) ?> orang</span> </div>
                <div class="data-line"><strong>JENIS KELAMIN </strong><span style="margin-left: 6px;">: <strong>L</strong></span> = <?= $jumlahKelamin['L'] ?> orang / <strong>P</strong> = <?= $jumlahKelamin['P'] ?> orang</div>
                <div class="data-line"><strong>PENDIDIKAN</strong><span style="margin-left: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <strong>SD</strong></span> &nbsp;&nbsp; = <?= $jumlahLulusan['SD'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>SMP</strong> = <?= $jumlahLulusan['SMP'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>SMA</strong> = <?= $jumlahLulusan['SMA'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>DIII</strong> &nbsp;&nbsp;&nbsp; = <?= $jumlahLulusan['D1/D2/D3'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>S1</strong> &nbsp;&nbsp;&nbsp;&nbsp; = <?= $jumlahLulusan['S1/D4'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>S2</strong> &nbsp;&nbsp;&nbsp;&nbsp; = <?= $jumlahLulusan['S2'] ?> orang</div>
                <div class="data-line" style="margin-left: 90px;"><strong>S3</strong> &nbsp;&nbsp;&nbsp;&nbsp; = <?= $jumlahLulusan['S3'] ?> orang</div>
                <div class="data-line" style="margin-top: 5px;"><strong>Periode Survei = (<?= $start ?>) s/d (<?= $end ?>)</strong></div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div>TERIMA KASIH ATAS PENILAIAN YANG TELAH ANDA BERIKAN</div>
        <div>MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMALUAN UNIT KAMI AGAR TERUS MEMPERBAIKI</div>
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
