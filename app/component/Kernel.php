<?php

namespace App\Component;

use App\Component\Router;

class Kernel {
    
    public static $base_site = "http://localhost/log210";
    
    public static function run(){
        self::_autoload();
        self::_boot();
        
        $request = isset($_GET['request']) ? $_GET['request'] : '';
        
        Router::analyze($request);
    }
    
    private static function _autoload(){
        //Load the components
        $components = array('Controller','Database','Model','Router','View', 'Session', 'Form', 'Redirect', 'DatabaseSeeder');
        foreach($components as $component){
            $path = ROOT . '/app/component/' . $component . '.php';
            require_once $path;
        }
        //Load the models
        $models = array('User', 'Client', 'Entrepreneur', 'Restaurant', 'Restaurateur', 'Test');
        foreach($models as $model){
            $path = ROOT . '/app/model/' . $model . '.php';
            require_once $path;
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
        //Seed the Database with values
        $databaseSeeder = new DatabaseSeeder();
        $databaseSeeder->seed();
    }
    
    private static function _boot(){
        session_start();
        \App\Component\Session::checkSessionUser();
    }
}