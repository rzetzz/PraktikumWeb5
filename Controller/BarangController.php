<?php

namespace Controller;

include "Models/Barang.php";
include "Traits/Response.php";

use Traits\Response;
use Models\Barang;

class BarangController {

    use Response;
    public function index(){
        $barang = new Barang;
        $response = $barang->findAll();
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id) {
        $barang = new Barang();
        $response = $barang->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert() {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }
        $barang = new Barang();
        $response = $barang->create([
            "nama_barang" => $inputData["nama_barang"],
            "jumlah" => $inputData["jumlah"],
            "kategori_id" => $inputData["kategori_id"]
        ]);
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id) {

        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }

        $barang = new Barang();
        $response = $barang->update([
            "nama_barang" => $inputData["nama_barang"],
            "jumlah" => $inputData["jumlah"],
            "kategori_id" => $inputData["kategori_id"]
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id) {
        $barang = new Barang();
        $response = $barang->destroy($id);

        return $this->apiResponse(200, "success", $response);
    }

    public function filter($id) {
        $barang = new Barang();
        $response = $barang->categoryFilter($id);
        return $this->apiResponse(200, "success", $response);
    }
    public function insertCategory() {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }
        $barang = new Barang();
        $response = $barang->addCategory([
            "kategori_id" => $inputData["kategori_id"],
            "nama_kategori" => $inputData["nama_kategori"]
            
        ]);
        return $this->apiResponse(200, "success", $response);
    }
}