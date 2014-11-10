<?php

namespace App\Model;

use App\Component\Model;

class Commande extends Model
{
    protected $_client;
    protected $_menuItems;
    
    public function addClient($client){
        $this->_client = $client;
    }
    
    public function addMenuItems($MenuItemsArray){
        $this->_menuItems = $MenuItemsArray;
    }
    
    
}
