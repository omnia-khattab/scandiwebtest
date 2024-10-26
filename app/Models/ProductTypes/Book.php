<?php
namespace App\Models\ProductTypes;

use App\Models\Product ;

class Book extends Product{
    private $weight;

    public function __construct( $sku, $name, $price,$productType, $weight) {
        parent::__construct($sku, $name, $price, $productType);
        $this->weight = $weight;
    }

    public function setSpecificAttribute() {
        return json_encode(['Weight' => $this->weight . ' Kg']);
    }
    public function validate($validator) {
        $validator->rules('sku', $this->sku, ['required', 'string']);
        $validator->rules('name', $this->name, ['required', 'string']);
        $validator->rules('price', $this->price, ['required', 'number']);
        $validator->rules('weight', $this->weight, ['required', 'number']);
    }
}
