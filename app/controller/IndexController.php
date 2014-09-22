<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Model\Test;
use App\Component\Session;

class IndexController extends Controller{
    
    public function index(){
//        Session::set('name', 'camille'); //Launch one time with uncommented, then comment. The value should stay
        $test = Test::test();
        
        $myTest = new Test("Valeur de test");
        $value = $myTest->getValue();
        
        $name = Session::get('name');
        
        return View::render("index/index.php", array('test'=>$test, 'value'=>$value, 'name'=>$name));
    }
}