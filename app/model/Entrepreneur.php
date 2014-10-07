<?php

namespace App\Model;

define('USER_ENTREPRENEUR', "Entrepreneur");

class Entrepreneur extends User
{
    public function __construct()
    {
        parent::__construct(USER_ENTREPRENEUR);
    }
}