<?php
namespace Validations\Rules;

use Validations\ValidationInterface;

class min implements ValidationInterface {

    private $name,$value;

    public function __construct($name,$value){

        $this->name = $name;
        $this->value = $value;
    }

    public function validate(){
        if(strlen($this->value)<3){
            
            return "$this->name must be at least 3 characters!";
        }

        return "";
    }
}

?>