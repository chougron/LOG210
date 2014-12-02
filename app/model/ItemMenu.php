<?php

namespace App\Model;

use App\Component\Model;
use App\Model\Menu;

class ItemMenu extends Model
{
    /**
     * The name of the item
     * @var String
     */
    protected $name;

    /**
     * The price of the item
     * The price is save in cents
     * @var Int
     */
    protected $price;

    /**
     * The description of the item
     * @var String
     */
    protected $description;

    /**
     * The id of the associated Menu
     * @var String
     */
    protected $menu;

    /**
     * Set the name of the ItemMenu
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the ItemMenu
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the ItemMenu
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Return the price of the item
     * @return Int
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the associated Menu
     * @param \App\Model\Menu $menu
     */
    public function setMenu(Menu $menu)
    {
        $this->menu = $menu->getId();
    }

    /**
     * Return the associated Menu
     * @return \App\Model\Menu
     */
    public function getMenu()
    {
        $menu = Menu::getOneBy(array('_id' => $this->menu));
        return $menu;
    }

    /**
     * Return the first ItemMenu corresponding to the query array
     * @param mixed $array
     * @return \App\Model\ItemMenu
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the ItemMenus corresponding to the query array
     * @param mixed $array
     * @return \App\Model\ItemMenu[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
} 