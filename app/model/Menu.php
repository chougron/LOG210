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
    public function removeItem(MenuItem $menuItem)
    {
        $id = $menuItem->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //We search the $id and remove it if we find it
        foreach($this->_menuItems as $key => $menuItem){
            if($id->__toString() == $menuItem->__toString()){
                unset($this->_menuItems[$key]);
                return;
            }
        }
    }
    
    /**
     * Adds the item and its price to the array.
     * @param type $itemName
     * @param type $itemPrice
     */
    public function addItem(MenuItem $menuItem)
    {
        $id = $menuItem->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //If the MenuItem is already in the array, return
        foreach($this->_menuItems as $menuItem){
            if($id->__toString() == $menuItem->__toString()){
                return;
            }
        }

        $this->_menuItems[] = $menuItem;
    }
}