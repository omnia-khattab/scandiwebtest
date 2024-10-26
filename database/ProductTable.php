<?php
namespace Database;

require __DIR__ . '/../vendor/autoload.php';

use utils\Connection;
use PDOException;
class ProductTable {

    // Create Product Table
    public function create(Connection $connection){
        $query = "CREATE TABLE products(
            id INT AUTO_INCREMENT PRIMARY KEY,
            sku VARCHAR(100) UNIQUE NOT NULL,
            name VARCHAR(100) NOT NULL,
            price VARCHAR(100) NOT NULL,
            productType VARCHAR(100) NOT NULL,
            specific_attribute JSON NOT NULL,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        try {
            $stmt = $connection->pDO->prepare($query);
            $stmt->execute();
            echo "Table created successfully.";
        } catch (PDOException $e) {
            echo "ERROR: Could not execute $query. " . $e->getMessage();
        }
    }
}

// Initialize connection and connect to the DB
$connection = new Connection();

// Create the table
$productTable = new ProductTable();
$productTable->create($connection);
?>
