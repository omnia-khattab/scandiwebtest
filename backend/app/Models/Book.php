<?php
namespace App\Models;

use App\Models\Product ;

class Book extends Product{
    private $weight;

    public function __construct( $sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function displaySpecificAttribute() {
        return json_encode(['Weight' => $this->weight . ' Kg']);
    }
    public function validate($validator) {
        $validator->rules('sku', $this->sku, ['required', 'string']);
        $validator->rules('name', $this->name, ['required', 'string']);
        $validator->rules('price', $this->price, ['required', 'number']);
        $validator->rules('weight', $this->weight, ['required', 'number']);
    }
}
?>