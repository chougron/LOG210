<?php

namespace App\Model;

define('USER_CLIENT', "Client");

class Client extends User
{
    public function __construct()
    {
        parent::__construct(USER_CLIENT);
    }
}