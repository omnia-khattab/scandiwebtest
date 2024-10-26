<?php
namespace Validations;

use Validations\Rules\IsNumber;
use Validations\Rules\IsString;
use Validations\Rules\max;
use Validations\Rules\min;
use Validations\Rules\required;

class Validator {

    public $errors = [];
    private $ruleClasses = [
        'required' => required::class,
        'string'   => IsString::class,
        'number'   => IsNumber::class,
        'max'      => max::class,
        'min'      => min::class,
    ];

    public function checkValidation(ValidationInterface $valid) {
        return $valid->validate();
    }

    public function rules($name, $value, array $rules) {
        foreach ($rules as $rule) {
            if (isset($this->ruleClasses[$rule])) {
                $ruleClass = $this->ruleClasses[$rule];
                $validator = new $ruleClass($name, $value);
                $error = $this->checkValidation($validator);

                if (!empty($error)) {
                    $this->errors[] = "$name: $error"; 
                }
            } else {
               
                throw new \Exception("Validation rule '$rule' does not exist.");
            }
        }
    }
   
    public function getErrors() {
        return $this->errors;
    }
}