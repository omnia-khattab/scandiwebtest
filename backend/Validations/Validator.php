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

    // public function rules($name,$value,array $rules){

    //     foreach($rules as $rule){
    //         if($rule=='required'){
    //             $error=$this->checkValidation(new required($name,$value));
    //         }
            
    //         else if($rule=='string'){
    //             $error=$this->checkValidation(new IsString($name,$value));
    //         }
            
    //         else if($rule=='number'){
    //             $error=$this->checkValidation(new IsNumber($name,$value));
    //         }
    //         else if($rule=='max'){
    //             $error=$this->checkValidation(new max($name,$value));
    //         }
    //         else if($rule=='min'){
    //             $error=$this->checkValidation(new min($name,$value));
    //         }
    //         else {
    //             $error='';
    //         }
    //         if($error !==''){
    //             array_push($this->errors,$error);
    //         }
    //     }

    // }
}
?>
