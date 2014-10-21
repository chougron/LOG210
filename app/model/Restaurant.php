<?php

namespace App\Model;

use App\Component\Model;
use App\Model\Restaurateur;

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
     * Remove the current Restaurateur of the Restaurant
     */
    public function removeRestaurateur()
    {
        $this->restaurateur = NULL;
    }
    
    public function delete() {
        //We get all the restaurants of the Restaurateur, and remove the link
        $restaurateur = $this->getRestaurateur();
        if($restaurateur){
            $restaurateur->removeRestaurant($this);
            $restaurateur->save();
        }
        parent::delete();
    }
}