<?php

class Jawaban{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertJawaban($idResponden, $idPertanyaan, $jawaban, $nilai)
    {
        $sql = "INSERT INTO tb_jawaban (id_pertanyaan, id_responden, jawaban, nilai) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('iisi', $idPertanyaan, $idResponden, $jawaban, $nilai);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
}
