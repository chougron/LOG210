<?php

namespace App\Model;

use App\Component\Model;

class AccountCreationModel extends Model{
    protected $value;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public function setUsername($value){
        
    }
    public function setPassword($password, $passwordConfirm){
        if($password == $passwordConfirm){
            
        }else{
            return false;
        }
    }
    
}
