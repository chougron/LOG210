<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Form;
use App\Model\Test;
use App\Model\User;

class ProfileController extends Controller{
    
    public function index(){
        
        //If the register form was sent
        if(Form::exists('profile_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('address','firstName','mail','name','password','password_check','phoneNumber', 'birthday'))){
                $error = "Veuillez remplir tous les champs";
                return View::render("register/index.php", array('error' => $error));
            }
            
            //We check if the mail address is not already taken
//            if(User::getOneBy(array('_mail' => Form::get('mail')))){
//                $error = "Cette adresse e-mail est déjà associée à un compte. Veuillez en choisir une autre.";
//                return View::render("register/index.php", array('error' => $error));
//            }
            
            //We check if the password and the check are the same
            if(Form::get('password') != Form::get('password_check')){
                $error = "Les mots de passe ne correspondent pas.";
                return View::render("register/index.php", array('error' => $error));
            }
            
            //We create a new User, and associate the values
            $user = Session::getUser();
            $user->setAdress(Form::get('address'));
            $user->setFirstName(Form::get('firstName'));
            $user->setName(Form::get('name'));
            $user->setPassword(Form::get('password'));
            $user->setPhoneNumber(Form::get('phoneNumber'));
            $user->setBirthday(Form::get('birthday'));
            //We save this User in the DB
            $user->save();
            
            Session::connect($user);
            
            return View::render("profile/complete.php", array('user'=>$user));
        }
        
        $user = Session::getUser();        
        
        return View::render("profile/index.php", array( 'user'=>$user ));
    }
}