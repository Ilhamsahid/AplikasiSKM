<?php

class Responden {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRespondent()
    {
        $data = [];

        $query = 'SELECT * FROM tb_responden ORDER BY id DESC';
        $result = $this->conn->query($query);

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    public function getRespondentByDateFilter($start, $end, $filterJumlah)
    {
        $sql = " SELECT
        r.id,
        r.responden,
        r.umur,
        r.kelamin,
        r.lulusan,
        r.tanggal,
        j.jawaban,
        j.nilai
        FROM tb_responden r LEFT JOIN tb_jawaban j
        ON j.id_responden = r.id
        WHERE r.tanggal BETWEEN ? AND ?
        ORDER BY r.tanggal DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $start, $end);
        $stmt->execute();

        $result = $stmt->get_result();

        $grouped = [];
        $jumlahSemua = 0;


        while ($row = $result->fetch_assoc()) {
            // Kalau baris ini TIDAK punya jawaban → skip
            if (empty($row['jawaban'])) {
                continue;
            }

            $id = $row['id'];

            // Kalau responden belum ada, buat dulu
            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'id' => $row['id'],
                    'responden' => $row['responden'],
                    'umur' => $row['umur'],
                    'kelamin' => $row['kelamin'],
                    'lulusan' => $row['lulusan'],
                    'tanggal' => $row['tanggal'],
                    'jawaban' => [],
                    'nilai' => $filterJumlah == true ? 0 : [],
                ];
            }

            // Masukkan jawaban (kalau ada)
            $grouped[$id]['jawaban'][] = $row['jawaban'];
            if($filterJumlah){
                $grouped[$id]['nilai'] += (int)$row['nilai'];
            }else{
                $grouped[$id]['nilai'][] = $row['nilai'];
            }

            $jumlahSemua += $row['nilai'];
        }

        // Reset index biar jadi array normal
        $data = array_values($grouped);

        return [
            'data' => $data,
            'jumlahSemua' => $jumlahSemua,
        ];
    }

    public function getRespondentChart($respondents)
    {
        $question = new Pertanyaan($this->conn);
        $respondent = $respondents['data'];
        $getQuestion = $question->getQuestion();

        $result = [];
        $questions = '';
        $labels = [];

        if($respondent === []){
            return $result;
        }

        foreach ($getQuestion as $qIdx => $q) {
            $questions = $q['pertanyaan'];
            $labels = explode(':', $q['jawaban']);
            $labelIndexMap = array_flip($labels);
            $values = [0, 0, 0, 0];

            foreach ($respondent as $idx => $res) {
                $answer = $res['jawaban'][$qIdx];
                $score = (int)$res['nilai'][$qIdx];

                if(isset($labelIndexMap[$answer])){
                    $values[$labelIndexMap[$answer]] += $score;
                }
            }

            $result[] = [
                'question' => $questions,
                'labels' => $labels,
                'values' => $values,
            ];
        }

        return $result;
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

    public function updateResponden($data, $id)
    {
        $sql = "UPDATE tb_responden
                SET responden = ?,
                    umur = ?,
                    kelamin = ?,
                    lulusan = ?,
                    jenis_pelayanan = ?,
                    tanggal_terakhir_kali = ?,
                    tanggal = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param(
            'sisssssi',
            $data['responden'],
            $data['umur'],
            $data['kelamin'],
            $data['lulusan'],
            $data['jenis_pelayanan'],
            $data['tanggal_terakhir_kali'],
            $data['tanggal'],
            $id
        );

        if($stmt->execute()){
            return true;
        }

        $stmt->close();
        return false;
    }

    public function deleteResponden($id)
    {
        $sql = "DELETE FROM tb_responden WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        }

        $stmt->close();
        return false;
    }

}
