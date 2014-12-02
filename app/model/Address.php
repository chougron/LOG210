<?php

namespace App\Model;

use App\Component\Model;

class Address extends Model
{
    protected $address;
    protected $user;
    
    function getAddress() {
        return $this->address;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setUser(User $user) {
        $this->user = $user->getId();
    }

    /**
     * Return the first Address corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Address
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the Addresses corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Address[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
}