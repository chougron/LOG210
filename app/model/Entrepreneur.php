<?php

namespace App\Model;

define('USER_ENTREPRENEUR', "Entrepreneur");

class Entrepreneur extends User
{
    public function __construct()
    {
        parent::__construct(USER_ENTREPRENEUR);
    }

    /**
     * Return the first Entrepreneur corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Entrepreneur
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the Entrepreneurs corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Entrepreneur[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
}