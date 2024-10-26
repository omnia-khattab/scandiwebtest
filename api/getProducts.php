<?php
require_once __DIR__ . '/../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:5173");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    exit(0);
}

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $productControllerObj = new App\Controllers\ProductController;

    try {
        $products = $productControllerObj->getProducts();
        
        if ($products) {
            echo json_encode(["products" => $products]);
        } else {
            http_response_code(404);
            echo json_encode([
                "message" => "No products found",
                "status" => false
            ]);
        }
        //var_dump($products);

    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode([
            "message" => "Server error: " . $e->getMessage(),
            "status" => false
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        "message" => "Method not allowed",
        "status" => false
    ]);
}



