<?php
require_once __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:  GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../Utils/Connection.php';
require_once '../app/Controllers/Products/ProductController.php';


// Initialize DB connection
$conn = new \Utils\Connection();
$db = $conn->connect();

$productController = new \App\Controllers\Products\ProductController($db);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
        $response = $productController->getProducts();
        echo $response; 
    
} else {
    // Return an error response for unsupported request methods
    echo json_encode([
        "message" => "Unsupported request method",
        "status" => false
    ]);
}

?>