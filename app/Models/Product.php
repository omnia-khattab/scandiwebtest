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
        return htmlspecialchars($this->sku, ENT_QUOTES, 'UTF-8'); 
        //return $this->sku;

    }

    public function getName(){

        return htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8'); 
        //return $this->name;
    }

    public function getPrice(){

        //return $this->price;
        return htmlspecialchars($this->price, ENT_QUOTES, 'UTF-8'); 

        
    }
    public function getProductType(){
        //return $this->productType;
        return htmlspecialchars($this->productType, ENT_QUOTES, 'UTF-8'); 

    }

    abstract public function setSpecificAttribute();
    
    abstract public function validate($validator);

}

