<?php

class Pertanyaan
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getQuestion($isDesc)
  {
    $data = [];

    $order = $isDesc ? 'DESC' : 'ASC';

    $query = "SELECT 
    p.id AS pertanyaan_id, p.pertanyaan, o.label as jawaban, o.nilai
    FROM tb_pertanyaan p
    JOIN tb_opsi_jawaban o ON o.pertanyaan_id = p.id
    ORDER BY p.id $order";
    $result = $this->conn->query($query);


    while ($row = $result->fetch_assoc()) {
      $pid = $row['pertanyaan_id'];

      if (!isset($data[$pid])) {
        $data[$pid] = [
          'pertanyaan' => $row['pertanyaan'],
          'opsi' => []
        ];
      }

      $data[$pid]['opsi'][] = [
        'label' => $row['jawaban'],
        'nilai' => (int)$row['nilai']
      ];
    }

    $data = array_values($data);

    return $data;
  }

  public function getAnswerAndQuestion()
  {
    $data = [];
    $query = "SELECT *
    FROM tb_pertanyaan AS p JOIN
    tb_opsi_jawaban o ON o.pertanyaan_id = p.id
    ORDER BY p.id, o.urutan";

    $result = $this->conn->query($query);

    while ($row = $result->fetch_assoc()) {
      $id = $row['pertanyaan_id'];

      if (!isset($data[$id])) {
        $data[$id] = [
          'pertanyaan' => $row['pertanyaan'],
          'opsi' => [],
        ];
      }

      $data[$id]['opsi']['id'][] = $row['id'];
      $data[$id]['opsi']['label'][] = $row['label'];
      $data[$id]['opsi']['nilai'][] = $row['nilai'];
    }


    $results = array_values($data);

    return $results;
  }

  public function insertPertanyaan($data)
  {
    $sql = "INSERT INTO tb_pertanyaan (pertanyaan, jawaban) VALUES (?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param(
      'ss',
      $data['pertanyaan'],
      $data['jawaban'],
    );

    if ($stmt->execute()) {
      return true;
    }

    return False;
  }

  public function updatePertanyaan($data, $id)
  {
    $sql = "UPDATE
        tb_pertanyaan SET pertanyaan = ?, jawaban = ? WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param(
      'ssi',
      $data['pertanyaan'],
      $data['jawaban'],
      $id
    );

    if ($stmt->execute()) {
      return true;
    }

    return False;
  }

  public function deletePertanyaan($id)
  {
    $sql = "DELETE FROM tb_pertanyaan WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
