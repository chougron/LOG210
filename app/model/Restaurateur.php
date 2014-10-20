<?php

namespace App\Model;

define('USER_RESTAURATEUR', "Restaurateur");

class Restaurateur extends User
{
    public function __construct()
    {
        parent::__construct(USER_RESTAURATEUR);
    }
    
    protected $_restaurants = array();
    
    /**
     * Add a Restaurant to the list
     * @param \App\Model\Restaurant $restaurant
     */
    public function addRestaurant(Restaurant $restaurant)
    {
        $id = $restaurant->getId();
        //If the object doesn't have an id, return
        if(is_null($id)){
            return;
        }
        //If the Restaurant is already in the array, return
        foreach ($this->_restaurants as $restaurant){
            if($id->__toString() == $restaurant->__toString()){
                return;
            }
        }
        
        $this->_restaurants[] = $id;
    }
    
    /**
     * Remove a Restaurant from the list
     * @param \App\Model\Restaurant $restaurant
     */
    public function removeRestaurant(Restaurant $restaurant)
    {
        $id = $restaurant->getId();
        //If the object doesn't have an id, return
        if(is_null($id)){
            return;
        }
       //We search the $id and remove it if we find it
        foreach($this->_restaurants as $key => $restaurant){
            if($id->__toString() == $restaurant->__toString()){
                unset($this->_restaurants[$key]);
                return;
            }
        }
    }
    
    /**
     * Return the restaurants associated to the Restaurateur
     * @return Array
     */
    public function getRestaurants()
    {
        $restaurants = Restaurant::getBy(array('_id' => array('$in' => $this->_restaurants)));
        return $restaurants;
    }
    
    /**
     * Save a Restaurateur
     */
    public function save() {
        foreach($this->getRestaurants() as $restaurant){
            $restaurant->setRestaurateur($this);
            $restaurant->save();
        }
        parent::save();
    }
    
    /**
     * Delete a Restaurateur
     */
    public function delete() {
        //We get all the restaurants of the Restaurateur, and remove the link
        $restaurants = $this->getRestaurants();
        foreach($restaurants as $restaurant){
            $restaurant->removeRestaurateur();
            $restaurant->save();
        }
        parent::delete();
    }
}