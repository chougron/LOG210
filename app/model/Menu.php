<?php


namespace App\Model;

use App\Component\Model;

define('ITEM_MENU', "Menu");

class Menu extends Model
{
    
    protected $_menuItems = array();

    /**
     * The id of the restaurant associated
     * @var String
     */
    protected $restaurant;
    
    /**
     * The array returned is multidimentionnal. [0][0] returns the name of the
     * first item and [0][1] returns its price.
     * @return type
     */
    public function getMenuItems(){
        return $this->_menuItems;
    }

    /**
     * @return Restaurateur
     */
    public function getRestaurant()
    {
        $restaurant = Restaurant::getOneBy(array('_id' => $this->restaurant));
        return $restaurant;
    }

    public function setRestaurant(Restaurant $restaurant)
    {
        $this->restaurateur = $restaurant->getId();
    }
    
    /**
     * Erases the item
     * @param ItemMenu $itemMenu
     */
    public function removeItem(ItemMenu $itemMenu)
    {
        $id = $itemMenu->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //We search the $id and remove it if we find it
        foreach($this->_menuItems as $key => $itemMenu){
            if($id->__toString() == $itemMenu->__toString()){
                unset($this->_menuItems[$key]);
                return;
            }
        }
    }
    
    /**
     * Adds the item and its price to the array.
     * @param ItemMenu $itemMenu
     */
    public function addItem(ItemMenu $menuItem)
    {
        $id = $menuItem->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //If the ItemMenu is already in the array, return
        foreach($this->_menuItems as $menuItem){
            if($id->__toString() == $menuItem->__toString()){
                return;
            }
        }

        $this->_menuItems[] = $menuItem;
    }

    public function delete()
    {
        //We get all the menuItems of the Menu, and remove the link
        $menuItem = $this->getMenuItems();
        if($menuItem){
            $menuItem->removeMenu($this);
            $menuItem->save();
        }
        parent::delete();
    }
}