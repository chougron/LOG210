<?php
class User
{
    private $_name;
    private $_adress;
    private $_mail;
    private $_phoneNumber;

    public __construct()
    {
    }    

    public function connect($name, $hashedPassword)
    {
        
    }


    /******************************
          GETTERS AND SETTERS
    *******************************/
    public function getName() {
        return $this->_name;
    }
    public function getAdress() {
        return $this->_adress;
    }
    public function getMail() {
        return $this->_mail;
    }
    public function getPhoneNumber() {
        return $this->_phoneNumber;
    }

    public function setName($name) {
        if (!isset($name)) {
            trigger_error('The name must have a value', E_USER_WARNING);
        }
        else {
            $name = $this->_name;
        }
    }
    public function setAdress($adress) {
        if (!isset($adress)) {
            trigger_error('The adress must have a value', E_USER_WARNING);
        }
        else {
            $this->_adress = $adress;
        }
    }
    public function setMail($mail) {
        if (!isset($mail)) {
            trigger_error('The mail must have a value', E_USER_WARNING);
        }
        else {
            $this->_mail = $mail;
        }
    public function setPhoneNumber($phoneNumber) {
        if (!isset($phoneNumber)) {
            trigger_error('The phone number must have a value', E_USER_WARNING);
        }
        else {
            $this->_phoneNumber = $phoneNumber;
        }
    }
}
?>
