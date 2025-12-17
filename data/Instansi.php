<?php

class Instansi {
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertInstansi($data)
    {
        $sql = "INSERT INTO tb_instansi (instansi, umur, kelamin, lulusan) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('siss',
            $data['instansi'],
            $data['umur'],
            $data['kelamin'],
            $data['lulusan'],
        );

        if($stmt->execute()){
            return $this->conn->insert_id;
        }

        $stmt->close();

        return False;
    }
}
