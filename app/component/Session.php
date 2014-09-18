<?php

namespace App\Component;

session_start();
\App\Component\Session::checkSessionUser();

class Session {
    
    private static $user;
    
    public static function checkSessionUser(){
        if(isset($_SESSION['user'])){
            self::$user = $_SESSION['user'];
        }
    }
    
    public static function getUser(){
        //TODO: Return a real User object
        return self::$user;
    }
    
    public static function connect($user){
        //TODO: Check if the user exists
        //TODO: Store a real User object
        self::$user = $user;
        $_SESSION['user'] = $user;
    }
    
    public static function disconnect(){
        self::$user = NULL;
        $_SESSION['user'] = NULL;
    }
    
    public static function isConnected(){
        return !is_null(self::$user);
    }
    
    public static function set($name, $value){
        $_SESSION['vars'][$name] = $value;
    }
    
    public static function get($name){
        return isset($_SESSION['vars'][$name]) ? $_SESSION['vars'][$name] : null;
    }
}