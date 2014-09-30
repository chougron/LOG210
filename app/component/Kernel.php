<?php

namespace App\Component;

use App\Component\Router;

class Kernel {
    public static function run(){
        self::_autoload();
        self::_boot();
        
        $request = isset($_GET['request']) ? $_GET['request'] : '';
        
        Router::analyze($request);
    }
    
    private static function _autoload(){
        //Load the components
        $components = array('Controller','Database','Model','Router','View', 'Session', 'Form');
        foreach($components as $component){
            $path = ROOT . '/app/component/' . $component . '.php';
            require_once $path;
        }
        //Load the models
        $models_path = ROOT . '/app/model';
        $models = scandir($models_path);
        foreach($models as $model){
            $path = $models_path . '/' . $model;
            if(!is_dir($path)){
                require_once $path;
            }
        }
        //Load the controllers
        $controllers_path = ROOT . '/app/controller';
        $controllers = scandir($controllers_path);
        foreach($controllers as $controller){
            $path = $controllers_path . '/' . $controller;
            if(!is_dir($path)){
                require_once $path;
            }
        }
    }
    
    private static function _boot(){
        session_start();
        \App\Component\Session::checkSessionUser();
    }
}