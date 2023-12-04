<?php

namespace Routes;

include "Controller/BarangController.php";

use Controller\BarangController;

class BarangRoutes {
    public function handle($method, $path) {
       
        if ($method === "GET" && $path === "/api/barang") {
            $controller = new BarangController();
            echo $controller->index();
        }
        if ($method === "GET" && strpos($path, "/api/barang/kategori/") === 0) {
            // Extract id dari path
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BarangController();
            echo $controller->filter($id);
        }

       
        if ($method === "GET" && strpos($path, "/api/barang/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BarangController();
            echo $controller->getById($id);
        }

        
        if ($method === "POST" && $path === "/api/barang") {
            $controller = new BarangController();
            echo $controller->insert();
        }
        
        if ($method === "POST" && $path === "/api/kategori") {
            $controller = new BarangController();
            echo $controller->insertCategory();
        }

        
        if ($method === "PUT" && strpos($path, "/api/barang/") === 0) {
            // Extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BarangController;
            echo $controller->update($id);
        }

        
        if ($method === "DELETE" && strpos($path, "/api/barang/") === 0) {
            // Extract id dari path
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BarangController();
            echo $controller->delete($id);
        }
    }
}