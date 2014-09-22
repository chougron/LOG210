<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Form;
use App\Model\Test;
use App\Model\User;

class RegisterController extends Controller{
    
    public function index(){
        
        //If the register form was sent
        if(Form::exists('register_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('address','firstName','mail','name','password','password_check','phoneNumber', 'birthday'))){
                $error = "Veuillez remplir tous les champs";
                return View::render("register/index.php", array('error' => $error));
            }
            
            //We check if the mail address is not already taken
            if(User::getBy('email', Form::get('email'))){
                $error = "Cette adresse e-mail est déjà associée à un compte. Veuillez en choisir une autre.";
                return View::render("register/index.php", array('error' => $error));
            }
            
            //We check if the password and the check are the same
            if(Form::get('password') != Form::get('password_check')){
                $error = "Les mots de passe ne correspondent pas.";
                return View::render("register/index.php", array('error' => $error));
            }
            
            $user = new User();
            $user->setAdress(Form::get('address'));
            $user->setFirstName(Form::get('firstName'));
            $user->setMail(Form::get('mail'));
            $user->setName(Form::get('name'));
            $user->setPassword(Form::get('password'));
            $user->setPhoneNumber(Form::get('phoneNumber'));
            $user->setBirthday(Form::get('birthday'));
            $user->save();
            
            return View::render("register/complete.php", array('user'=>$user));
        }
        
        return View::render("register/index.php");
    }
}