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
            $user = User::getBy('mail', Form::get('mail'));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == User::encryptPassword(Form::get('password'))){
                return View::render("login/complete.php", array('user'=>$user));
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("login/index.php", array('error'=>$error));
        }
        
        return View::render("login/index.php");
    }
}