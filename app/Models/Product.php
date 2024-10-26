<?php 
namespace App\Models;

abstract class Product{
    protected $sku; 
    protected $name;
    protected $price;
    protected $productType;
    protected $specificAttributes;

    public function __construct(string $sku, string $name, float $price, string $productType) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
        $this->specificAttributes = [];
    }

    public function getSku(){
        return $this->sku;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }
    public function getProductType(){
        return $this->productType;
    }

    abstract public function setSpecificAttribute();
    
    abstract public function validate($validator);

}

