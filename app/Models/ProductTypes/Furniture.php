<?php
namespace App\Models\ProductTypes;

use App\Models\Product ;

class Furniture extends Product{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price,$productType, $height, $width, $length) {
        parent::__construct($sku, $name, $price, $productType);
        // $this->height = $height;
        // $this->width = $width;
        // $this->length = $length;
        $this->height = htmlspecialchars($height, ENT_QUOTES, 'UTF-8'); 
        $this->width = htmlspecialchars($width, ENT_QUOTES, 'UTF-8'); 
        $this->length = htmlspecialchars($length, ENT_QUOTES, 'UTF-8'); 

        
    }
    public function setSpecificAttribute() {
        return json_encode([
            'Dimension' => $this->height . 'x'.$this->width . 'x'.$this->length
        ]);
    }
    public function validate($validator) {
        $validator->rules('sku', $this->sku, ['required', 'string']);
        $validator->rules('name', $this->name, ['required', 'string']);
        $validator->rules('price', $this->price, ['required', 'number']);
        $validator->rules('height', $this->height, ['required', 'number']);
        $validator->rules('width', $this->width, ['required', 'number']);
        $validator->rules('length', $this->length, ['required', 'number']);
    }
}

?>