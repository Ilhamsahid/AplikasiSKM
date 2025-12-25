<?php

class Responden {
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertResponden($data)
    {
        $sql = "INSERT INTO tb_responden (responden, umur, kelamin, lulusan, jenis_pelayanan, tanggal_terakhir_kali, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param('sisssss',
            $data['responden'],
            $data['umur'],
            $data['kelamin'],
            $data['lulusan'],
            $data['jenis_pelayanan'],
            $data['tanggal_terakhir_kali'],
            $data['tanggal'],
        );

        if($stmt->execute()){
            return $this->conn->insert_id;
        }

        $stmt->close();

        return False;
    }
}
