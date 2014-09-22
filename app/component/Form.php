<?php

namespace App\Component;

class Form {
    
    /**
     * Check if a post var exists or not
     * @param String $name The var to check
     * @return boolean
     */
    public static function exists($name)
    {
        return isset($_POST[$name]);
    }
    
    /**
     * Return the asked var, or an empty string if not set
     * @param String $name The var to get
     * @return mixed
     */
    public static function get($name)
    {
        return self::exists($name) ? $_POST[$name] : "";
    }
    
    /**
     * Check if one of the vars in the array is empty
     * @param mixed $array
     * @return boolean
     */
    public static function checkEmpty($array)
    {
        $empty = false;
        
        foreach($array as $var)
        {
            $empty = $empty && self::exists($var) && (self::get($var) != "");
        }
        
        return $empty;
    }
    
}