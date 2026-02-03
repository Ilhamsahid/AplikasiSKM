<?php

class Pertanyaan
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getQuestion($isDesc, $isActive)
  {
    $data = [];

    $order = $isDesc ? 'DESC' : 'ASC';

    $query = "SELECT 
    p.id AS pertanyaan_id, p.pertanyaan, o.id as opsi_id, o.label as jawaban, o.nilai, p.is_active
    FROM tb_pertanyaan p
    JOIN tb_opsi_jawaban o ON o.pertanyaan_id = p.id";

    if ($isActive) {
      $query .= " WHERE p.is_active = 1 ";
    }

    $query .= " ORDER BY p.id $order";

    $result = $this->conn->query($query);


    while ($row = $result->fetch_assoc()) {
      $pid = $row['pertanyaan_id'];

      if (!isset($data[$pid])) {
        $data[$pid] = [
          'id' => $row['pertanyaan_id'],
          'pertanyaan' => $row['pertanyaan'],
          'is_active' => $row['is_active'],
          'opsi' => []
        ];
      }

      $data[$pid]['opsi'][] = [
        'id' => $row['opsi_id'],
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
    WHERE p.is_active = 1 
    ORDER BY p.id, o.urutan";

    $result = $this->conn->query($query);

    while ($row = $result->fetch_assoc()) {
      $id = $row['pertanyaan_id'];

      if (!isset($data[$id])) {
        $data[$id] = [
          'id' => $row['pertanyaan_id'],
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
    $sql = "INSERT INTO tb_pertanyaan (pertanyaan) VALUES (?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param(
      's',
      $data['pertanyaan'],
    );

    if ($stmt->execute()) {
      return $this->conn->insert_id;
    }

    $stmt->close();

    return False;
  }

  public function changePertanyaan($data, $idPertanyaan)
  {
    $sql = "UPDATE tb_pertanyaan SET pertanyaan = ? WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param('si', $data['pertanyaan'], $idPertanyaan);

    if ($stmt->execute()) {
      return True;
    }

    $stmt->close();

    return False;
  }

  public function insertOpsiJawaban($data, $pertanyaan_id)
  {
    $sql = "INSERT INTO tb_opsi_jawaban (pertanyaan_id, label, nilai, urutan) VALUES (?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param(
      'isss',
      $pertanyaan_id,
      $data['label'],
      $data['nilai'],
      $data['urutan'],
    );

    if ($stmt->execute()) {
      return true;
    }

    $stmt->close();

    return False;
  }

  public function changeOpsiJawaban($data, $id)
  {
    $sql = "UPDATE tb_opsi_jawaban SET label = ?, nilai = ?, urutan = ? WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param('siii', $data['label'], $data['nilai'], $data['urutan'], $id);

    if ($stmt->execute()) {
      return True;
    }

    $stmt->close();

    return False;
  }

  public function restorePertanyaan($id)
  {
    $sql = "UPDATE tb_pertanyaan SET is_active = 1 WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      return True;
    }

    $stmt->close();

    return False;
  }

  public function softDeletePertanyaan($id)
  {
    $sql = "UPDATE tb_pertanyaan SET is_active = 0 WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      return True;
    }

    $stmt->close();

    return False;
  }
}
