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
}
