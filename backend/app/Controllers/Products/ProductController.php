<?php 

namespace App\Controllers\Products;

use App\Factories\ProductFactory;
use App\Models\Product;
use Utils\Connection;
use Validations\Validator;

class ProductController{
    private $db;
    private $validator;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
        $this->validator = new Validator();
    }

    public function addProduct($data) {
        try {
            $productType = $data['productType'];
            $sku = $data['sku'];
            $name = $data['name'];
            $price = $data['price'];
    
            // Extract specific attributes based on productType
            $specificAttributes = [];
            if ($productType === 'Book') {
                $specificAttributes[] = $data['weight'];
            } elseif ($productType === 'DVD') {
                $specificAttributes[] = $data['size'];
            } elseif ($productType === 'Furniture') {
                $specificAttributes[] = $data['height'];
                $specificAttributes[] = $data['width'];
                $specificAttributes[] = $data['length'];
            }

            // Create the product based on the productType using the factory 
            $product = ProductFactory::createProduct(
                $productType,
                $sku,
                $name,
                $price,
                ...$specificAttributes
            );
            $product->validate($this->validator);
            // $this->saveProduct($product);
            //return json_encode(["message" => "Product added successfully", "status" => true]);
            if (empty($this->validator->errors)) {
                $this->saveProduct($product);
                return json_encode(["message" => "Product added successfully", "status" => true]);
            } else {
                //return json_encode(["message" => "Validation errors", "errors" => $this->validator->errors, "status" => false]);
                http_response_code(400);  // add code response
                return json_encode([
                    "message" => "Validation errors",
                    "errors" => $this->validator->errors,
                    "status" => false
                ]);
            }
        } catch (\Exception $e) {
            http_response_code(500); // add code response
            return json_encode([
                "message" => "Server error: " . $e->getMessage(),
                "status" => false
            ]);
        }
    }
    

    private function saveProduct($product) {
        //var_dump($product);
        // Insert product into the database
        $query = $this->db->prepare("INSERT INTO products (sku, name, price, specific_attribute) VALUES (?, ?, ?, ?)");
        $query->execute([$product->getSku(),$product->getName(), $product->getPrice(), $product->displaySpecificAttribute()]);
    }


    public function getProducts() {
        try {
            $query = "Select * from products";
            $result=$this->db->query($query);
            $products = [];
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
            }
            echo json_encode($products);

        } catch (\Exception $e) {
            //error_log($e->getMessage());
            http_response_code(500);
            return json_encode(["message" => "Error fetching products", "status" => false]);
        }
    }

    public function deleteProducts($ids) {
        try {
            foreach ($ids as $id) {
                $query = "DELETE FROM products WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$id]);
            }
    
            return json_encode(["message" => "Products deleted successfully", "status" => true]);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(["message" => "Error deleting products: " . $e->getMessage(), "status" => false]);
        }
    }
    
}

?>