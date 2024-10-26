<?php
require_once __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin:  http://localhost:5173");
    header("Access-Control-Allow-Methods: DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    exit(0);
}
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $productControllerObj = new App\Controllers\ProductController;

    try {
        if (isset($data['SKUs']) && is_array($data['SKUs'])) {
            // Delete the product
            foreach($data['SKUs'] as $sku){
                $productControllerObj->deleteProduct($sku);
            }
            echo json_encode(["message" => "Products deleted successfully", "status" => true]);

        } else {
            http_response_code(400); //Bad Request
            echo json_encode([
                "message" => "Required fields are missing",
                "status" => false
            ]);
        }

        
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



