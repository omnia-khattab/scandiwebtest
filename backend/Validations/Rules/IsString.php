<?php
namespace Validations\Rules;

use Validations\ValidationInterface;

class IsString implements ValidationInterface{
    private $name,$value;

    public function __construct($name,$value){

        $this->name = $name;
        $this->value = $value;
    }
    public function validate(){
        if (!is_string($this->value)) {
            return "{$this->name} must be a string";
        }
        return "";
    }
}

?>