<?php

namespace App\Model;

define('USER_RESTAURATEUR', "Restaurateur");

class Restaurateur extends User
{
    public function __construct()
    {
        parent::__construct(USER_RESTAURATEUR);
    }
}