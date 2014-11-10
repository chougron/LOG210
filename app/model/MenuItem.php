<?php


namespace App\Model;

use App\Model\Model;

class MenuItem extends Model
{
    /**
     * The name of the item
     * @var String
     */
    protected $name;

    /**
     * The price of the item
     * @var Int
     */
    protected $price;

    /**
     * The id of the associated Menu
     * @var String
     */
    protected $menu;

    /**
     * Set the name of the MenuItem
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the MenuItem
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the MenuItem
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * Set the associated Menu
     * @param \App\Model\Menu $menu
     */
    public function setMenu(Menu $menu)
    {
        $this->menu = $menu->getId();
    }
} 