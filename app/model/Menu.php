<?php


namespace App\Model;

use App\Component\Model;

class Menu extends Model
{
    
    protected $_menuItems = array();

    /**
     * The id of the restaurant associated
     * @var String
     */
    protected $restaurant;

    /**
     * The name of the menu
     * @var String
     */
    protected $name;
    
    /**
     * Returns the Items of the menu
     * @return MenuItems[]
     */
    public function getMenuItems(){
        $items = ItemMenu::getBy(array('_id' => array('$in' => $this->_menuItems)));
        return $items;
    }

    /**
     * Return the restaurant associated
     * @return Restaurant
     */
    public function getRestaurant()
    {
        $restaurant = Restaurant::getOneBy(array('_id' => $this->restaurant));
        return $restaurant;
    }

    /**
     * Set the id of the Restaurant associated
     * @param Restaurant $restaurant
     */
    public function setRestaurant(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant->getId();
    }

    /**
     * Get the name of the menu
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the menu
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
        foreach($this->_menuItems as $key => $idItemMenu){
            if($id->__toString() == $idItemMenu->__toString()){
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
        foreach($this->_menuItems as $idMenuItem){
            if($id->__toString() == $idMenuItem->__toString()){
                return;
            }
        }

        $this->_menuItems[] = $id;
    }

    /**
     * Delete a Menu
     */
    public function delete()
    {
        //We get all the menuItems of the Menu, and remove them (an item doesn't exist without menu)
        $menuItems = $this->getMenuItems();
        foreach($menuItems as $menuItem){
            $menuItem->delete();
        }
        parent::delete();
    }
}