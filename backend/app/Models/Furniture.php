<?php
namespace App\Models;

use App\Models\Product ;

class Furniture extends Product{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    // public function displaySpecificAttribute() {
    //     return json_encode([
    //         'height' => $this->height . ' H',
    //         'width' => $this->width . ' W',
    //         'length' => $this->length . ' L'
    //     ]);
    // }
    public function displaySpecificAttribute() {
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