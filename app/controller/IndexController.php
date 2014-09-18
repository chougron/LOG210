<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Model\Test;

class IndexController extends Controller{
    
    public function index(){
        $test = Test::test();
        
        $myTest = new Test("Valeur de test");
        $value = $myTest->getValue();
        
        View::render("index/index.php", array('test'=>$test, 'value'=>$value));
    }
}