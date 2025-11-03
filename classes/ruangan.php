<?php
require_once __DIR__ . "/../config/koneksi.php";

class ruangan {
    private $conn;

    public function __construct() {
        $db = new koneksi();
        $this->conn = $db->conn;
    }

    public function create($nama_ruangan, $kapasitas, $lokasi) {
        $sql = "INSERT INTO ruangan (nama_ruangan, kapasitas, lokasi) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sis", $nama_ruangan, $kapasitas, $lokasi);
        return $stmt->execute();
    }

    public function read() {
        $sql = "SELECT * FROM ruangan";
        $result = $this->conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getById($id) {
        $sql = "SELECT * FROM ruangan WHERE id_ruangan=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $nama_ruangan, $kapasitas, $lokasi) {
        $sql = "UPDATE ruangan SET nama_ruangan=?, kapasitas=?, lokasi=? WHERE id_ruangan=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisi", $nama_ruangan, $kapasitas, $lokasi, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM ruangan WHERE id_ruangan=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
