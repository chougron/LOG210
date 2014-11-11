<?php

namespace App\Model;

use App\Component\Model;

class Commande extends Model
{
    protected $_client;
    protected $_menuItems;
    protected $_adress;
    
    public function setClient($client){
        $this->_client = $client;
    }
    
    public function setAdress($adress){
        $this->_adress = $adress;
    }
    
    public function addMenuItems($MenuItemsArray){
        $this->_menuItems = $MenuItemsArray;
    }
    
    
}
