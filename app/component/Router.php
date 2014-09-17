<?php

namespace App\Component;

class Router {
    
    public static function analyze($request){
        $result = array(
            "controller"    => "Index",
            "action"        => "index",
            "params"        => array()
        );
        
        //We get the different parts of the URL request
        $parts = explode("/", $request);
        //We count the number of parts
        $number = count($parts);
        //First part is the controller
        if($number >= 1 && $parts[0] != '')
            $result['controller'] = $parts[0];
        //Second part is the action
        if($number >= 2)
            $result['action'] = $parts[1];
        //The remaining parts are the params
        for($i=2; $i<$number; $i++){
            $result['params'][] = $parts[$i];
        }
        
        self::executeController($result);
    }
    
    private static function executeController($result){
        //The Class name is the name of the controller with Controller added
        $className = 'App\\Controller\\'.ucfirst($result['controller']) . 'Controller';
        //Check if the controller exists
        if(!class_exists($className)){
            return self::executeController(self::error404());
        }
        //Check if the action exists
        $actionName = $result['action'];
        if(!method_exists($className, $actionName)){
            return self::executeController(self::error404());
        }
        
        //Call the Controller action
        forward_static_call_array ( array($className, $actionName) , $result['params'] );
    }
    
    
    public static function error404(){
        $result = array(
            "controller"    => "Error",
            "action"        => "error404",
            "params"        => array()
        );
        
        return $result;
    }
}