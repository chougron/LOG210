<?php

namespace App\Model;

define('USER_LIVREUR', "Livreur");

class Livreur extends User
{
    public function __construct()
    {
        parent::__construct(USER_LIVREUR);
    }
}

