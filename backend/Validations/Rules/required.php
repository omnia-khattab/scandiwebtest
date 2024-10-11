<?php
namespace Validations\Rules;

use Validations\ValidationInterface;

class required implements ValidationInterface{
    private $name,$value;

    public function __construct($name,$value){

        $this->name = $name;
        $this->value = $value;
    }

    public function validate(){
        if (empty($this->value)) {
            return "{$this->name} is required";
        }
        return "";
    }
}

?>