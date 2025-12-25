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

        $query = "SELECT * FROM tb_pertanyaan ORDER BY id ASC";
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
