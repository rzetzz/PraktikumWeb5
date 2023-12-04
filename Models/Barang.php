<?php

namespace Models;

include "Config/DatabaseConfig.php";

use Config\DatabaseConfig;
use mysqli;

class Barang extends DatabaseConfig{
    public $conn;
    public function __construct() {
        
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function findAll() {
        $sql = "SELECT * FROM barang";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function findById($id) {
        $sql = "SELECT * FROM barang WHERE barang_ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function create($data) {
        $productName = $data["nama_barang"];
        $quantity = $data["jumlah"];
        $categoryId = $data["kategori_id"];
        $query = "INSERT INTO barang (nama_barang, jumlah, kategori_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $productName, $quantity, $categoryId);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    public function update($data, $id) {
        $productName = $data["nama_barang"];
        $quantity = $data["jumlah"];
        $categoryId = $data["kategori_id"];   
        $query = "UPDATE barang SET nama_barang = ?, jumlah = ?, kategori_id = ? WHERE barang_ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssii", $productName, $quantity, $categoryId, $id);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    public function destroy($id) {
        $query = "DELETE FROM barang WHERE barang_ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }

    public function categoryFilter($id) {
        $sql = "SELECT kategori.kategori_id, kategori.nama_kategori, barang.nama_barang, barang.jumlah FROM kategori INNER JOIN barang ON kategori.kategori_id = barang.kategori_id WHERE barang.kategori_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    
    }
    public function addCategory($data) {
        
        $categoryId = $data["kategori_id"];
        $categoryName = $data["nama_kategori"];
        $query = "INSERT INTO kategori (kategori_id, nama_kategori) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $categoryId, $categoryName );
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

}