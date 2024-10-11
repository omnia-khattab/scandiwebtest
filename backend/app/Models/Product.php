<?php 

namespace App\Models;
abstract class Product{
    protected $sku; 
    protected $name;
    protected $price;

    public function __construct($sku,$name, $price){
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
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

    abstract public function displaySpecificAttribute();
    
    abstract public function validate($validator);

}

?>