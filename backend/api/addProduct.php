<?php
require_once __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    exit(0);
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Utils/Connection.php';
require_once '../app/Controllers/Products/ProductController.php';

// Initialize DB connection
$conn = new \Utils\Connection();
$db = $conn->connect();

$productController = new \App\Controllers\Products\ProductController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input data from the request body 
    $data = json_decode(file_get_contents("php://input"), true);
    //print_r($data);

    if (isset($data['productType'],$data['sku'], $data['name'], $data['price'])) {

        $response = $productController->addProduct($data);
        echo $response; 
    } else {
        http_response_code(400);  // Bad Request
        echo json_encode([
            "message" => "Required fields are missing",
            "status" => false
        ]);
    }
} else {
    http_response_code(405);  // Method Not Allowed
    echo json_encode([
        "message" => "Unsupported request method",
        "status" => false
    ]);
}


?>