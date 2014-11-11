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


}