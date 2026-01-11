<?php

class Pertanyaan {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getQuestion()
    {
        $data = [];

        $query = "SELECT * FROM tb_pertanyaan ORDER BY id DESC";
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function insertPertanyaan($data)
    {
        $sql = "INSERT INTO tb_pertanyaan (pertanyaan, jawaban) VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('ss',
            $data['pertanyaan'],
            $data['jawaban'],
        );

        if($stmt->execute()){
            return true;
        }

        return False;
    }

    public function updatePertanyaan($data, $id)
    {
        $sql = "UPDATE
        tb_pertanyaan SET pertanyaan = ?, jawaban = ? WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('ssi',
            $data['pertanyaan'],
            $data['jawaban'],
            $id
        );

        if($stmt->execute()){
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
