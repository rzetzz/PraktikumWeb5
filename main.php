<?php

header("Content-Type: application/json; charset=UTF-8");

include "Routes/BarangRoutes.php";

use Routes\BarangRoutes;

// Tangkap Request method
$method = $_SERVER["REQUEST_METHOD"];
// Tangkap request path
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Panggil routes
$barangRoute = new BarangRoutes();
$barangRoute->handle($method, $path);