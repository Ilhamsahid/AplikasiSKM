<?php

class Jawaban
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function insertJawaban($idResponden, $idOpsi)
  {
    $sql = "INSERT INTO tb_jawaban (id_responden, opsi_jawaban_id) VALUES (?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('ii', $idResponden, $idOpsi);

    $success = $stmt->execute();

    $stmt->close();

    return $success;
  }
}
