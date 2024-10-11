<?php
namespace App\Models;

use App\Models\Product ;

class Dvd extends Product{
    private $size;

    public function __construct($sku, $name, $price, $size){
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function displaySpecificAttribute() {
        return json_encode(['Size' => $this->size . ' MB']);
    }
    
    public function validate($validator) {
        $validator->rules('sku', $this->sku, ['required', 'string']);
        $validator->rules('name', $this->name, ['required', 'string']);
        $validator->rules('price', $this->price, ['required', 'number']);
        $validator->rules('size', $this->size, ['required', 'number']);
    }
}

?>