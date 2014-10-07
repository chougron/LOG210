<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Form;
use App\Model\Client;

class LoginController extends Controller{
    
    public function index(){
        
        //If the register form was sent
        if(Form::exists('login_form')){
            
            //Check if User exists
            $user = Client::getOneBy(array('_mail' => Form::get('mail')));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == Client::encryptPassword(Form::get('password'))){
                Session::connect($user);
                return View::render("login/complete.php", array('user'=>$user));
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("login/index.php", array('error'=>$error));
        }
        
        return View::render("index/index.php");
    }
    
    public function logout(){
        Session::disconnect();
        View::render("index/index.php");
    }
    
    

function curPageURL() {
    $pageURL = "";
 if ($_SERVER["SERVER_PORT"] != "80") {
     
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 $pageURL = str_replace("logout","",str_replace("localhost/","" , $pageURL));
 return $pageURL;
}
}