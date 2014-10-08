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
    
    /**
     * Add a message that will be displayed in next page
     * @param String $title The title of the message
     * @param String $type (success, info, warning, danger)
     * @param String $message The message
     */
    public static function addFlashMessage($title, $type, $message){
        $array = array('title'=>$title, 'type'=>$type, 'message'=>$message);
        $_SESSION['flash'][] = $array;
    }
    
    public static function getFlashMessages(){
        $messages = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;
        $_SESSION['flash'] = array();
        return $messages;
    }
}