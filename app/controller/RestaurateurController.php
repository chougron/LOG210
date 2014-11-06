<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Redirect;
use App\Model\Restaurateur;
use App\Component\Form;

class RestaurateurController extends Controller{
    
    public function index()
    {
        //If we are not connected as a restaurateur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR){
            return Redirect::to('/restaurateur/login');
        }
        
        return View::render("restaurateur/index.php", array('user' => Session::getUser()));
    }
    
    public function login()
    {
        //If the register form was sent
        if(Form::exists('restaurateur_login_form')){
            
            //Check if User exists
            $user = Restaurateur::getOneBy(array('_mail' => Form::get('mail')));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == Restaurateur::encryptPassword(Form::get('password'))){
                Session::connect($user);
                return Redirect::to('/restaurateur');
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("restaurateur/login.php", array('error'=>$error));
        }
        
        return View::render("restaurateur/login.php");
    }
}