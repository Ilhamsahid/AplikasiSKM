<?php

class Responden
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getAllRespondent($limit)
  {
    $data = [];

    $query = $limit == false ? 'SELECT * FROM tb_responden ORDER BY id DESC' :
      'SELECT * FROM tb_responden ORDER BY id DESC limit 5';
    $result = $this->conn->query($query);

    while ($row = $result->fetch_assoc()) {
      if ($limit == true) {
        $stmt = $this->conn->prepare(
          "SELECT o.nilai, o.label 
          FROM tb_jawaban j
          JOIN tb_opsi_jawaban o
          ON j.opsi_jawaban_id = o.id
          WHERE id_responden = ?"
        );
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();

        $jawaban = $stmt->get_result();

        $nilai = 0;
        $jawabanRespondent = [];
        while ($j = $jawaban->fetch_assoc()) {
          $nilai += $j['nilai'];
          $jawabanRespondent[] = $j['label'];
        }

        $row['nilai'] = $nilai;
        $row['jawaban'] = $jawabanRespondent;
      }

      $data[] = $row;
    }

    return $data;
  }

  public function getRespondentByDateFilter($start, $end, $filterJumlah, $faskesId)
  {
    $sql = $faskesId === "all"
      ?
      "SELECT
      r.id,
      r.responden,
      r.umur,
      r.kelamin,
      r.lulusan,
      r.no_hp,
      r.pekerjaan,
      r.jenis_pelayanan,
      r.tanggal_terakhir_kali,
      r.tanggal,
      f.nama_faskes,
      p.pertanyaan AS pertanyaan,
      o.label AS jawaban,
      o.nilai
    FROM tb_responden r
    LEFT JOIN tb_jawaban j ON j.id_responden = r.id
    LEFT JOIN tb_opsi_jawaban o ON o.id = j.opsi_jawaban_id
    LEFT JOIN tb_pertanyaan p ON p.id = o.pertanyaan_id
    LEFT JOIN tb_faskes f ON f.id = r.faskes_id
    WHERE r.tanggal BETWEEN ? AND ?
    ORDER BY r.tanggal DESC
    "
      :
      "SELECT
      r.id,
      r.responden,
      r.umur,
      r.kelamin,
      r.lulusan,
      r.no_hp,
      r.pekerjaan,
      r.jenis_pelayanan,
      r.tanggal,
      r.tanggal_terakhir_kali,
      f.nama_faskes,
      p.pertanyaan AS pertanyaan,
      o.label AS jawaban,
      o.nilai
    FROM tb_responden r
    LEFT JOIN tb_jawaban j ON j.id_responden = r.id
    LEFT JOIN tb_opsi_jawaban o ON o.id = j.opsi_jawaban_id
    LEFT JOIN tb_pertanyaan p ON p.id = o.pertanyaan_id
    LEFT JOIN tb_faskes f ON f.id = r.faskes_id
    WHERE r.tanggal BETWEEN ? AND ?
    AND r.faskes_id = ?
    ORDER BY r.tanggal DESC
    ";

    $stmt = $this->conn->prepare($sql);

    if ($faskesId === "all") {
      $stmt->bind_param("ss", $start, $end);
    } else {
      $stmt->bind_param("ssi", $start, $end, $faskesId);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $grouped = [];
    $jumlahSemua = 0;

    while ($row = $result->fetch_assoc()) {

      // Kalau tidak ada jawaban → skip
      if (empty($row['jawaban'])) {
        continue;
      }

      $id = $row['id'];

      if (!isset($grouped[$id])) {
        $grouped[$id] = [
          'id' => $row['id'],
          'responden' => $row['responden'],
          'nama_faskes' => $row['nama_faskes'],
          'umur' => $row['umur'],
          'kelamin' => $row['kelamin'],
          'lulusan' => $row['lulusan'],
          'no_hp' => $row['no_hp'],
          'pekerjaan' => $row['pekerjaan'],
          'jenis_pelayanan' => $row['jenis_pelayanan'],
          'tanggal_terakhir_kali' => $row['tanggal_terakhir_kali'],
          'tanggal' => $row['tanggal'],
          'pertanyaan' => [],
          'jawaban' => [],
          'nilaiSatuan' => [],
          'nilai' => $filterJumlah ? 0 : [],
        ];
      }

      $grouped[$id]['pertanyaan'][] = $row['pertanyaan'];
      $grouped[$id]['jawaban'][] = $row['jawaban'];
      $grouped[$id]['nilaiSatuan'][] = $row['nilai'];

      if ($filterJumlah) {
        $grouped[$id]['nilai'] += (int)$row['nilai'];
      } else {
        $grouped[$id]['nilai'][] = $row['nilai'];
      }

      $jumlahSemua += (int)$row['nilai'];
    }

    return [
      'data' => array_values($grouped),
      'jumlahSemua' => $jumlahSemua,
    ];
  }


  public function getRespondentChart($respondents)
  {
    $questionModel = new Pertanyaan($this->conn);

    $respondentData = $respondents['data'] ?? [];
    $questionsData  = $questionModel->getQuestion(false);

    $result = [];

    if (empty($respondentData)) {
      return $result;
    }

    foreach ($questionsData as $qIdx => $q) {

      $labels = [];
      foreach ($q['opsi'] as $opt) {
        $labels[] = $opt['label'];
      }

      $labelIndexMap = array_flip($labels);

      $nilaiMap = [];
      foreach ($q['opsi'] as $opt) {
        $nilaiMap[$opt['label']] = (int) $opt['nilai'];
      }

      $values = array_fill(0, count($labels), 0);
      $users  = array_fill(0, count($labels), 0);

      foreach ($respondentData as $res) {

        $answer = $res['jawaban'][$qIdx] ?? null;

        if ($answer === null) {
          continue;
        }

        if (!isset($labelIndexMap[$answer])) {
          continue; // jawaban tidak valid
        }

        $idx = $labelIndexMap[$answer];

        $values[$idx] += $nilaiMap[$answer];
        $users[$idx]  += 1;
      }

      $result[] = [
        'question' => $q['pertanyaan'],
        'labels'   => $labels,
        'values'   => $values,
        'users'    => $users,
      ];
    }

    return $result;
  }


  public function insertResponden($data)
  {
    $sql = "INSERT INTO tb_responden (responden, faskes_id, umur, kelamin, lulusan, no_hp, pekerjaan, jenis_pelayanan, tanggal_terakhir_kali, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param(
      'siisssssss',
      $data['responden'],
      $data['faskes_id'],
      $data['umur'],
      $data['kelamin'],
      $data['lulusan'],
      $data['no_hp'],
      $data['pekerjaan'],
      $data['jenis_pelayanan'],
      $data['tanggal_terakhir_kali'],
      $data['tanggal'],
    );

    if ($stmt->execute()) {
      return $this->conn->insert_id;
    }

    $stmt->close();

    return False;
  }

  public function updateResponden($data, $id)
  {
    $sql = "UPDATE tb_responden
                SET responden = ?,
                    umur = ?,
                    kelamin = ?,
                    lulusan = ?,
                    no_hp = ?,
                    pekerjaan = ?,
                    jenis_pelayanan = ?,
                    tanggal_terakhir_kali = ?,
                    tanggal = ?
                WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param(
      'sisssssssi',
      $data['responden'],
      $data['umur'],
      $data['kelamin'],
      $data['lulusan'],
      $data['no_hp'],
      $data['pekerjaan'],
      $data['jenis_pelayanan'],
      $data['tanggal_terakhir_kali'],
      $data['tanggal'],
      $id
    );

    if ($stmt->execute()) {
      return true;
    }

    $stmt->close();
    return false;
  }

  public function deleteResponden($id)
  {
    $sql = "DELETE FROM tb_responden WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      return true;
    }

    $stmt->close();
    return false;
  }
}
