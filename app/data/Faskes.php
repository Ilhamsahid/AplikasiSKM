<?php

class Faskes
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getAllFaskes()
  {
    $data = [];

    $query = "SELECT * FROM tb_faskes ORDER BY id DESC";
    $result = $this->conn->query($query);

    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }

    return $data;
  }

  public function insertFaskes($data)
  {
    $sql = "INSERT INTO tb_faskes (nama_faskes, jenis) VALUES (?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('ss', $data['nama_faskes'], $data['jenis_faskes']);

    if ($stmt->execute()) {
      return true;
    }

    $stmt->close();

    return False;
  }

  public function updateFaskes($data, $id)
  {
    $sql = "UPDATE tb_faskes
    SET
    nama_faskes = ?,
    jenis = ?
    WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return False;
    }

    $stmt->bind_param('ssi', $data['nama_faskes'], $data['jenis_faskes'], $id);

    if ($stmt->execute()) {
      return True;
    }

    $stmt->close();
    return False;
  }

  public function deleteFaskes($id)
  {
    $sql = "DELETE FROM tb_faskes WHERE id = ?";

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
