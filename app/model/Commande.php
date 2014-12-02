<?php

namespace App\Model;

use App\Component\Model;

class Commande extends Model
{
    const COMMAND_STATUS_TEMPORARY = 0;
    const COMMAND_STATUS_VALIDATED = 1;
    const COMMAND_STATUS_PAYED = 2;
    const COMMAND_STATUS_PREPARING = 3;
    const COMMAND_STATUS_READY = 4;

    protected $_client;
    protected $_menuItems;
    protected $_address;
    protected $_confirmation;
    protected $_datetime;
    protected $_status;
    protected $_price;
    protected $_restaurateur;

    /**
     * Set the Client associated to the Commande
     * @param \App\Model\Client $client
     */
    public function setClient(Client $client){
        $this->_client = $client->getId();
    }
    
    /**
     * Return the Client associated to the Commande
     * @return \App\Model\Client
     */
    function getClient() {
        return Client::getOneBy(array('_id' => $this->_client));
    }

    /**
     * Set the address of the command
     * @param \App\Model\Address $adress
     */
    public function setAddress(Address $adress){
        $this->_address = $adress->getId();
    }

    /**
     * Return the address of the command
     * @return \App\Model\Address
     */
    function getAddress() {
        return Address::getOneBy(array('_id' => $this->_address));
    }
    
    /**
     * Set an ItemMenu with its associated quantity
     * @param \App\Model\ItemMenu $itemMenu
     * @param int $quantity
     */
    public function setItem(ItemMenu $itemMenu, $quantity){
        $this->_menuItems[$itemMenu->getId()->__toString()] = $quantity;
    }
    
    /**
     * Return an array of ItemMenu, with an associated quantity (accessed by ->quantity)
     * @return \App\Model\ItemMenu[]
     */
    public function getItems(){
        $items = array();
        
        foreach($this->_menuItems as $key => $value){
            $item = ItemMenu::getOneBy(array('_id' => new \MongoId($key)));
            $item->quantity = $value;
            $items[] = $item;
        }
        
        return $items;
    }
    
    public function getConfirmation() {
        return $this->_confirmation;
    }

     public function getDatetime() {
        return $this->_datetime;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function createConfirmationCode() {
        $this->_confirmation = sha1(date('YmHis'));
    }

    public function setDatetime($datetime) {
        $this->_datetime = $datetime;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }
    
    public function setPrice($price){
        $this->_price = $price;
    }
    
    public function getPrice(){
        return $this->_price;
    }

    /**
     * Return the first Commande corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Commande
     */
    public static function getOneBy($array) {
        return parent::getOneBy($array);
    }
    
    /**
     * Return all the Commandes corresponding to the query array
     * @param mixed $array
     * @return \App\Model\Commande[]
     */
    public static function getBy($array) {
        return parent::getBy($array);
    }
    
    public function setRestaurateur(Restaurateur $restaurateur)
    {
        $this->_restaurateur = $restaurateur->getId();
    }

    public function getRestaurateur()
    {
        return Restaurateur::getOneBy(array('_id' => $this->_restaurateur));
    }
    
    /**
     * Get all the Commande from the corresponding Restaurateur
     * @param \App\Model\Restaurateur $restaurateur
     * @return Commande[]
     */
    public static function getByRestaurateur(Restaurateur $restaurateur){
        $commandes = self::getBy(array());
        
        $foundCommandes = array();
        foreach($commandes as $commande){
            $items = $commande->getItems();
            if($items[0]->getMenu()->getRestaurant()->getRestaurateur() &&
                    $items[0]->getMenu()->getRestaurant()->getRestaurateur()->getId() == $restaurateur->getId()){
                $foundCommandes[] = $commande;
            }
        }
        
        return $foundCommandes;
    }
}
