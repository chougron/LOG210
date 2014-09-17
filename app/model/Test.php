<?php

namespace App\Model;

use App\Component\Model;

class Test extends Model {
    protected static $name = "camille";
    
    protected $value;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public static function test(){
        return self::$name;
    }
    
    public function getValue(){
        return $this->value;
    }
}