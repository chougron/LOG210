<?php

namespace App\Model;

use App\Component\Model;

class Commande extends Model
{
    const COMMAND_STATUS_TEMPORARY = 0;
    const COMMAND_STATUS_VALIDATED = 1;
    const COMMAND_STATUS_PAYED = 2;

    protected $_client;
    protected $_menuItems;
    protected $_address;
    protected $_confirmation;
    protected $_datetime;
    protected $_status;
    protected $_price;


    public function setClient(Client $client){
        $this->_client = $client->getId();
    }
    
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
     * @return Address
     */
    function getAddress() {
        return Address::getOneBy(array('_id' => $this->_address));
    }
    
    /**
     * Set an ItemMenu with its associated quantity
     * @param \App\Model\ItemMenu $itemMenu
     * @param type $quantity
     */
    public function setItem(ItemMenu $itemMenu, $quantity){
        $this->_menuItems[$itemMenu->getId()->__toString()] = $quantity;
    }
    
    /**
     * Return an array of ItemMenu, with an associated quantity (accessed by ->quantity)
     * @return ItemMenu[]
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
    
    function getConfirmation() {
        return $this->_confirmation;
    }

    function getDatetime() {
        return $this->_datetime;
    }

    function getStatus() {
        return $this->_status;
    }

    function createConfirmationCode() {
        $this->_confirmation = sha1(date('YmHis'));
    }

    function setDatetime($datetime) {
        $this->_datetime = $datetime;
    }

    function setStatus($status) {
        $this->_status = $status;
    }
    
    function setPrice($price){
        $this->_price = $price;
    }
    
    function getPrice(){
        return $this->_price;
    }


    
}
