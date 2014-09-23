<?php

namespace App\Model;

use App\Component\Model;

class User extends Model
{
    protected $_mail;
    protected $_password;
    protected $_firstName;
    protected $_name;
    protected $_adress;
    protected $_phoneNumber;
    protected $_birthday;

<<<<<<< HEAD
<<<<<<< HEAD
    public __construct()
    {
    }    

    public function connect($name, $hashedPassword)
    {
        
    }
    public function openSession($name)
    {

    }
    public closeSession($session)
    {

    }


    /******************************
=======
        /******************************
>>>>>>> 60547bb5c139e3270c309460ff8e7048d492925a
=======
        /******************************
>>>>>>> 60547bb5c139e3270c309460ff8e7048d492925a
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
    
    public function getPassword() {
        return $this->_password;
    }

    public function getFirstName() {
        return $this->_firstName;
    }
    
    public function getBirthday() {
        return $this->_birthday;
    }

    public function setName($name) {
        if (!isset($name)) {
            trigger_error('The name must have a value', E_USER_WARNING);
        }
        else {
            $this->_name = $name;
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
    }
    
    public function setPhoneNumber($phoneNumber) {
        if (!isset($phoneNumber)) {
            trigger_error('The phone number must have a value', E_USER_WARNING);
        }
        else {
            $this->_phoneNumber = $phoneNumber;
        }
    }

    public function setPassword($password) {
        $this->_password = $this->encryptPassword($password);
    }

    public function setFirstName($firstName) {
        $this->_firstName = $firstName;
    }

    public function setBirthday($birthday) {
        $this->_birthday = $birthday;
    }

    /**
     * Encrypt a Password
     * @param String $password
     * @return String
     */
    public static function encryptPassword($password){
        return crypt($password, '$S*çresd)°°erd+&é"hJert34qsdfdsv3#œœSQER');
    }
}
?>
