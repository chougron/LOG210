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
    protected $_commandes = array();
    
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
        foreach($this->_restaurants as $key => $idRestaurant){
            if($id->__toString() == $idRestaurant->__toString()){
                unset($this->_restaurants[$key]);
                return;
            }
        }
    }
    
    /**
     * Return the restaurants associated to the Restaurateur
     * @return \App\Model\Restaurant[]
     */
    public function getRestaurants()
    {
        $restaurants = Restaurant::getBy(array('_id' => array('$in' => $this->_restaurants)));
        return $restaurants;
    }

    /**
     * Add a Commande to the list
     * @param Commande $commande
     */
    public function addCommande(Commande $commande)
    {
        $id = $commande->getId();
        //If the object doesn't have an id, return
        if(is_null($id)){
            return;
        }
        //If the Restaurant is already in the array, return
        foreach ($this->_commandes as $commande){
            if($id->__toString() == $commande->__toString()){
                return;
            }
        }

        $this->_commandes[] = $id;
    }

    /**
     * Remove a Commande from the list
     * @param Commande $commande
     */
    public function removeCommande(Commande $commande)
    {
        $id = $commande->getId();
        //If the object doesn't have an id, return
        if(is_null($id)){
            return;
        }
        //We search the $id and remove it if we find it
        foreach($this->_commandes as $key => $idCommande){
            if($id->__toString() == $idCommande->__toString()){
                unset($this->_commandes[$key]);
                return;
            }
        }
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

    /**
     * Return the first Restaurateur corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Restaurateur
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the Restaurateurs corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Restaurateur[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
}