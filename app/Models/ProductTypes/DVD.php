<?php
namespace App\Models\ProductTypes;

use App\Models\Product ;

class DVD extends Product{
    private $size;

    public function __construct($sku, $name, $price, $productType, $size){
        parent::__construct($sku, $name, $price, $productType);
        
        $this->size = htmlspecialchars($size, ENT_QUOTES, 'UTF-8'); 

       // $this->size = $size;
    }

    public function setSpecificAttribute() {
        return json_encode(['Size' => $this->size . ' MB']);
    }
    
    public function validate($validator) {
        $validator->rules('sku', $this->sku, ['required', 'string']);
        $validator->rules('name', $this->name, ['required', 'string']);
        $validator->rules('price', $this->price, ['required', 'number']);
        $validator->rules('size', $this->size, ['required', 'number']);
    }
}
