<?php
require_once "../config/koneksi.php";

class lab {
    private $conn;

    public function __construct() {
        $db = new koneksi();
        $this->conn = $db->conn;
    }

    public function create($nama_lab, $kapasitas, $lokasi) {
        $sql = "INSERT INTO lab (nama_lab, kapasitas, lokasi) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sis", $nama_lab, $kapasitas, $lokasi);
        return $stmt->execute();
    }

    public function read() {
        $sql = "SELECT * FROM lab";
        $result = $this->conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getById($id) {
        $sql = "SELECT * FROM lab WHERE id_lab=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $nama_lab, $kapasitas, $lokasi) {
        $sql = "UPDATE lab SET nama_lab=?, kapasitas=?, lokasi=? WHERE id_lab=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisi", $nama_lab, $kapasitas, $lokasi, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM lab WHERE id_lab=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
