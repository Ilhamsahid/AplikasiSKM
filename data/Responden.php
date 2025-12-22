<?php

class Responden {
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertResponden($data)
    {
        $sql = "INSERT INTO tb_responden (responden, umur, kelamin, lulusan) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('siss',
            $data['responden'],
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
