<?php

namespace App\Model;

use App\Component\Model;
use App\Model\Restaurateur;
use App\Model\Menu;

class Restaurant extends Model
{
    /**
     * The name of the restaurant
     * @var String
     */
    protected $name;
    
    /**
     * The id of the associated Restaurateur
     * @var String
     */
    protected $restaurateur;

    /**
     * The id of the associated Menu
     * @var String
     */
    protected $_menu = array();

    /**
     * The description of the Restaurant
     * @var String
     */
    protected $description;
    
    /**
     * The picture of the Restaurant
     * @var String
     */
    protected $picture;

    /**
     * Get the name of the Restaurant
     * @return String
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the name of the Restaurant
     * @param String $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    
    /**
     * Return the associated Restaurateur
     * @return \App\Model\Restaurateur
     */
    public function getRestaurateur()
    {
        $restaurateur = Restaurateur::getOneBy(array('_id' => $this->restaurateur));
        return $restaurateur;
    }

    /**
     * Set the associated Restaurateur
     * Be Careful ! To register a link between a Restaurateur and a Restaurant,
     * you should use Restaurateur->addRestaurant instead ! Otherwise the
     * Restaurant will not be added to the Restaurateur.
     * @param \App\Model\Restaurateur $restaurateur
     */
    public function setRestaurateur(Restaurateur $restaurateur)
    {
        $this->restaurateur = $restaurateur->getId();
    }

    /**
     * Return the associated Menu
     * @return \App\Model\Menu
     */
    public function getMenu()
    {
        $menus = Menu::getBy(array('_id' => array('$in' => $this->_menu)));
        return $menus;
    }

    /**
     * Erases the menu
     * @param Menu $menu
     */
    public function removeMenu(Menu $menu)
    {
        $id = $menu->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //We search he $id and remove it if we find it
        foreach($this->_menu as $key => $idMenu){
            if($id->__toString() == $idMenu->__toString()){
                unset($this->_menu[$key]);
                return;
            }
        }
    }

    /**
     * Adds the menu to the array
     * @param Menu $menu
     */
    public function addMenu(Menu $menu)
    {
        $id = $menu->getId();
        //If the object doesn't have an id, return
        if(is_null($id)) return;

        //If the Menu is already in the array, return
        foreach($this->_menu as $idMenu){
            if($id->__toString() == $idMenu->__toString()){
                return;
            }
        }
        $this->_menu[] = $id;
    }

    public function hasMenu()
    {
        return $this->_menu != null;
    }
    
    /**
     * Remove the current Restaurateur of the Restaurant
     */
    public function removeRestaurateur()
    {
        $this->restaurateur = NULL;
    }
    
    /**
     * Return the description of the Restaurant
     * @return String
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Return the picture adress of the Restaurant
     * @return String
     */
    public function getPicture() {
        return $this->picture;
    }

    /**
     * Set the Restaurant description
     * @param String $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Set the picture adress of the Restaurant
     * @param String $picture
     */
    public function setPicture($picture) {
        $this->picture = $picture;
    }

        
    public function delete() {
        //We get all the restaurants of the Restaurateur, and remove the link
        $restaurateur = $this->getRestaurateur();
        if($restaurateur){
            $restaurateur->removeRestaurant($this);
            $restaurateur->save();
        }
        $menu = $this->getMenu();
        if($menu){
            $menu->delete();
        }
        parent::delete();
    }
}