<?php


namespace App\Model;

use App\Component\Model;

define('ITEM_MENU', "Menu");

class Menu extends Model{
    
    protected $_menuItems = array();
    
    /**
     * The array returned is multidimentionnal. [0][0] returns the name of the
     * first item and [0][1] returns its price.
     * @return type
     */
    public function getMenuItems(){
        return $this->_menuItems;
    }
    
    /**
     * Erases the item
     * @param type $itemName
     */
    public function removeItem($itemName){   
        $success = FALSE;
        foreach($this->_menuItems as $menuItem):
            if(in_array($itemName,$menuItem)){
                    array_splice($menuItems,$i,1);
                    $success = TRUE;
            }
            $i++;
        endforeach;
        return success;
    }
    
    /**
     * Adds the item and its price to the array.
     * @param type $itemName
     * @param type $itemPrice
     */
    public function addItem($itemName, $itemPrice){
        $this->_menuItems[] = array($itemName,$itemPrice);
    }
}