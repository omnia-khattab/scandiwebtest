<?php
namespace App\Factories;

use App\Models\Book;
use App\Models\Dvd;
use App\Models\Furniture;

class ProductFactory{

    public static function createProduct($type,$sku, $name, $price, ...$specificAttributes) {
        switch ($type) {
            case 'Book':
                //print_r($specificAttributes[0]);
                return new Book($sku, $name, $price, $specificAttributes[0]); 
            case 'DVD':
                //print_r($specificAttributes[0]);
                return new Dvd($sku, $name, $price, $specificAttributes[0]); 
            case 'Furniture':
                //print_r($specificAttributes);
                return new Furniture($sku, $name, $price, ...$specificAttributes);
            default:
                throw new \Exception("Invalid product type: $type");
        }
    }
}

?>