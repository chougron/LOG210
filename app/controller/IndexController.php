<?php

namespace App\Controller;

use App\Component\Controller;

class IndexController extends Controller{
    
    public function index(){
        return \App\Component\Redirect::to('/restaurant');
    }
}