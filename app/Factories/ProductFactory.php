<?php

namespace App\Factories;

use App\Models\ProductTypes\Book;
use App\Models\ProductTypes\DVD;
use App\Models\ProductTypes\Furniture;
use Exception;

class ProductFactory
{
    public static function createProduct($productType, $sku, $name, $price, ...$specificAttributes)
    {
        // Define an array mapping product types to their corresponding classes
        $productTypes = [
            'Book' => Book::class,
            'DVD' => DVD::class,
            'Furniture' => Furniture::class,
        ];

        // Check if the product type exists in the mapping
        if (!isset($productTypes[$productType])) {
            throw new Exception("Invalid product type: $productType");
        }

        // Dynamically instantiate the correct product type
        $productClass = $productTypes[$productType];
        return new $productClass($sku, $name, $price, $productType, ...$specificAttributes);
    }
}
