<?php
namespace App\Controllers;

use Exception;
use PDO;
use Utils\Connection;

class ProductController{

    function getProducts() {
        // Database connection
        $db = new Connection();
    
        $query = $db->pDO->prepare("SELECT * FROM products");
        $query->execute();
        
        $products = $query->fetchAll(PDO::FETCH_ASSOC);
    
        // Log the result of the query
        if ($products) {
            error_log("Products fetched successfully: " . json_encode($products)); // Log success message
            return $products;
        } else {
            error_log("No products found or query failed."); // Log error message
            return [];
        }
    
        
    }
    function saveProduct($product) {
        // Database connection
        try {
            $db = new Connection();
            $query = $db->pDO->prepare("INSERT INTO products (sku, name, price, productType, specific_attribute) VALUES (?, ?, ?, ?, ?)");
            $result = $query->execute([$product->getSku(), $product->getName(), $product->getPrice(), $product->getProductType(), $product->setSpecificAttribute()]);
    
            if ($result) {
                error_log("Product saved successfully.");
            } else {
                error_log("Failed to save product: " . print_r($query->errorInfo(), true));
            }
        } catch (\PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to save product: " . $e->getMessage());
        }
    }
    
    function deleteProduct($sku) {
        // Database connection
        $db = new Connection();
    
        $query = $db->pDO->prepare("DELETE FROM products WHERE sku = ?");
        $query->execute([$sku]);
    }
}

