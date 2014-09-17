<?php

namespace App\Component;

class View {
    
    public static function render($file, $vars = array()){
        $path = ROOT . '/app/view/' . $file;
        
        if(!file_exists($path)){
            throw new Exception('View file not found');
        }
        
        require_once ROOT . '/app/view/template/header.php';
        
        extract($vars);
        require_once $path;
        
        require_once ROOT . '/app/view/template/footer.php';
    }
}