<?php

namespace App\Model;

use App\Component\Model;

class User extends Model
{
    protected $_mail;
    protected $_password;
    protected $_firstName;
    protected $_name;
    protected $_mainAdress;
    protected $_secAdress;
    protected $_phoneNumber;
    protected $_birthday;
    
    /**
     * The type of user
     * @var String
     */
    protected $_type;

    public function __construct($type)
    {
        $this->_type = $type;
    }

    /******************************
          GETTERS AND SETTERS
    *******************************/
    /**
     * Get the Name of the User
     * @return String
     */
    public function getName() {
        return $this->_name;
    }
    
    /**
     * Get the Adress of the User
     * @return String
     */
    public function getAdress() {
        return $this->_mainAdress;
    }
    
    /**
     * Get the secondary Adress of the User
     * @return String
     */
    public function getSecAdress() {
        return $this->_secAdress;
    }
    
    /**
     * Get the Mail of the USer
     * @return String
     */
    public function getMail() {
        return $this->_mail;
    }
    
    /**
     * Get the Phone Number of the User
     * @return String
     */
    public function getPhoneNumber() {
        return $this->_phoneNumber;
    }
    
    /**
     * Get the Hashed password of the User
     * @return String
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Get the First Name of the User
     * @return String
     */
    public function getFirstName() {
        return $this->_firstName;
    }
    
    /**
     * Get the Birthday of the User
     * @return String
     */
    public function getBirthday() {
        return $this->_birthday;
    }
    
    /**
     * Get the Type of the User
     * @return String
     */
    public function getType() {
        return $this->_type;
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
            $this->_mainAdress = $adress;
        }
    }
    
    public function setSecAdress($adress){
        $this->_secAdress = $adress;
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
