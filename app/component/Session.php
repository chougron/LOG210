<?php

namespace App\Component;

class Session {
    
    private static $user = null;
    
    public static function checkSessionUser(){
        if(isset($_SESSION['user'])){
            self::$user = unserialize($_SESSION['user']);
        }
    }
    
    /**
     * Return the current User
     * @return \App\Model\User
     */
    public static function getUser(){
        return self::$user;
    }
    
    public static function connect($user){
        self::$user = $user;
        $_SESSION['user'] = serialize($user);
    }
    
    public static function disconnect(){
        self::$user = NULL;
        $_SESSION['user'] = NULL;
    }
    
    public static function isConnected(){
        return !is_null(self::$user);
    }
    
    public static function set($name, $value){
        $_SESSION['vars'][$name] = serialize($value);
    }
    
    public static function get($name){
        return isset($_SESSION['vars'][$name]) ? unserialize($_SESSION['vars'][$name]) : null;
    }
}