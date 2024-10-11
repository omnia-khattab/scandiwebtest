<?php
namespace Database;

require __DIR__ . '/../vendor/autoload.php';

use Utils\Connection;

class ProductTable {

    // Create Product Table
    public function create($conn){
        $query = "CREATE TABLE products(
            id INT AUTO_INCREMENT PRIMARY KEY,
            sku VARCHAR(100) UNIQUE NOT NULL,
            name VARCHAR(100) NOT NULL,
            price VARCHAR(100) NOT NULL,
            specific_attribute JSON NOT NULL,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if (mysqli_query($conn, $query)) {
            echo "Table created successfully.";
        } else {
            echo "ERROR: Could not execute $query. " . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}

// Initialize connection and connect to the DB
$connection = new Connection();
$connect = $connection->connect();

// Create the table
$productTable = new ProductTable();
$productTable->create($connect);
?>
