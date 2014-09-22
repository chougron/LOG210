<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Form;
use App\Model\Test;
use App\Model\User;

class LoginController extends Controller{
    
    public function index(){
        
        //If the register form was sent
        if(Form::exists('login_form')){
            
            //Check if User exists
            
            
            //Confirm if PW matches

            
            $user = new User();
            $user->setMail("email@tempo.ca");
            $user->save();
            
            return View::render("login/complete.php", array('user'=>$user));
        }
        
        return View::render("login/index.php");
    }
}