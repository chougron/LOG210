<?php

namespace App\Model;

use App\Component\Model;
use App\Model\Address;
use App\Model\User;

class Address extends Model
{
    protected $address;
    protected $user;
    protected $defaultAddress; //bool
    
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
     * Takes all the Adresses linked to the
     */
    function setByDefault(){
        $addresses = Address::getBy(array('user' => $this->user));     //Need to get User
        foreach ($addresses as $address):
            $address->removeByDefault();
            $address->save();
        endforeach;
        $this->defaultAddress = TRUE;
    }
    
    function getByDefault(){
        return $this->defaultAddress;
    }
    
    private function removeByDefault(){
        $this->defaultAddress = FALSE;
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