<?php

namespace App\Model;

define('USER_CLIENT', "Client");

class Client extends User
{
    public function __construct()
    {
        parent::__construct(USER_CLIENT);
    }

    /**
     * Return the first Client corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Client
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the Clients corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Client[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
}