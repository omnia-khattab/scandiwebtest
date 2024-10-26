<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Utils\Connection;
use Validations\Validator;
use App\Factories\ProductFactory;

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:5173 ");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    exit(0);
}

header("Access-Control-Allow-Origin: http://localhost:5173 ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    throw new Exception("Invalid JSON input");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $productControllerObj = new App\Controllers\ProductController;

    try {
        $sku = $data['sku'];
        $name = $data['name'];
        $price = $data['price'];
        $productType = $data['productType'];
        
        // Use the factory to create product depend on the productType
        $product = ProductFactory::createProduct($productType, $sku, $name, $price, ...array_slice($data, 4));
        // var_dump("Product object: " . print_r($product, true));
        // Log the entire $product object
        error_log("Product object: " . print_r($product, true));

        // Alternatively, you can use var_export for more detailed output
        error_log("Product object (var_export): " . var_export($product, true));
        // Instantiate the validator
        $validator = new Validator();

        // Validate the product data
        $product->validate($validator);
        error_log("beforeIF");
        // Check for validation errors
        if (empty($validator->getErrors())) {
            error_log("Before calling saveProduct()");

            $productControllerObj->saveProduct($product);

            error_log("After calling saveProduct()");
            
            echo json_encode(["message" => "Product added successfully", "status" => true]);
        } else {
            http_response_code(400);
            echo json_encode([
                "message" => "Validation errors",
                "errors" => $validator->getErrors(),
                "status" => false
            ]);
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
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



