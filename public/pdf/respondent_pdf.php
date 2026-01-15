<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../app/configs/database.php';
require __DIR__ . '/../../app/logic/ikm_result.php';

use Dompdf\Dompdf;

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

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 9px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 9px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>DAFTAR RESPONDEN</h2>
    <div class="subtitle">
        Survei Kepuasan Masyarakat (IKM)
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th class="text-center">Umur</th>
                <th class="text-center">Kelamin</th>
                <th>Lulusan</th>
                <th>No HP</th>
                <th>Pekerjaan</th>
                <th>Jenis Pelayanan</th>
                <th class="text-center">Tanggal Terakhir Pelayanan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($respondents['data'] as $i => $r): ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($r['responden']) ?></td>
                    <td class="text-center"><?= $r['umur'] ?></td>
                    <td class="text-center"><?= $r['kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td><?= $r['lulusan'] ?></td>
                    <td><?= $r['no_hp'] ?></td>
                    <td><?= $r['pekerjaan'] ?></td>
                    <td><?= $r['jenis_pelayanan'] ?></td>
                    <td class="text-center">
                        <?= $r['tanggal'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <footer>
        TERIMA KASIH ATAS PARTISIPASI ANDA DALAM SURVEI KEPUASAN MASYARAKAT
    </footer>

</body>

</html>

<?php
$html = ob_get_clean();

/* ============================
   GENERATE PDF
============================ */

$pdf = new Dompdf();
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();
$pdf->stream('daftar-responden.pdf', ['Attachment' => true]);
