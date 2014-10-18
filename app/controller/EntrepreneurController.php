<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Redirect;
use App\Model\Entrepreneur;
use App\Model\Restaurateur;
use App\Model\Restaurant;
use App\Component\Form;

class EntrepreneurController extends Controller{
    
    public function index()
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        return View::render("entrepreneur/index.php", array('user' => Session::getUser()));
    }
    
    public function login()
    {
        //If the register form was sent
        if(Form::exists('entrepreneur_login_form')){
            
            //Check if User exists
            $user = Entrepreneur::getOneBy(array('_mail' => Form::get('mail')));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == Entrepreneur::encryptPassword(Form::get('password'))){
                Session::connect($user);
                Redirect::to('/entrepreneur');
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("entrepreneur/login.php", array('error'=>$error));
        }
        
        return View::render("entrepreneur/login.php");
    }
    
    public function ajoutRestaurateur()
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        //We select all the Restaurants without restaurateur
        $restaurants = Restaurant::getBy(array('restaurateur' => null));
        
        if(Form::exists('restaurateur_add_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('firstName','mail','name','password','password_check'))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("entrepreneur/ajoutRestaurateur.php", array('error' => $error, 'restaurants' => $restaurants));
            }
            
            //We check if the mail address is not already taken
            if(Restaurateur::getOneBy(array('_mail' => Form::get('mail')))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Adresse e-mail non disponible.");
                $error = "Cette adresse e-mail est déjà associée à un compte. Veuillez en choisir une autre.";
                return View::render("entrepreneur/ajoutRestaurateur.php", array('error' => $error, 'restaurants' => $restaurants));
            }
            
            //We check if the password and the check are the same
            if(Form::get('password') != Form::get('password_check')){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Les mots de passe ne correspondent pas.");
                $error = "Les mots de passe ne correspondent pas.";
                return View::render("entrepreneur/ajoutRestaurateur.php", array('error' => $error, 'restaurants' => $restaurants));
            }
            
            //We create a new User, and associate the values
            $user = new Restaurateur();
            $user->setFirstName(Form::get('firstName'));
            $user->setMail(Form::get('mail'));
            $user->setName(Form::get('name'));
            $user->setPassword(Form::get('password'));
            //We save this User in the DB
            $user->save();
            
            //We add the restaurants to the Restaurateur
            $user = Restaurateur::getOneBy(array('_mail' => Form::get('mail')));
            $atLeastOneAdded = false;
            foreach(Form::get('restaurants') as $restaurantId){
                if($restaurantId != ""){
                    $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($restaurantId)));
                } else {
                    $restaurant = null;
                }
                if($restaurant){
                    $user->addRestaurant($restaurant);
                    $atLeastOneAdded = true;
                }
            }
            $user->save();
            
            if($atLeastOneAdded){
                Session::addFlashMessage("Restaurateur ajouté avec succès", 
                        'success', 
                        "Le restaurateur " . $user->getMail() . " a été ajouté avec succès.");
            } else {
                Session::addFlashMessage("Restaurateur ajouté sans restaurant", 
                        'warning', 
                        "Le restaurateur " . $user->getMail() . " a été ajouté sans restaurant associé.");
            }
            
            Redirect::to('/entrepreneur');
        }
        
        return View::render("entrepreneur/ajoutRestaurateur.php", array('restaurants' => $restaurants));
    }
    
    public function supprimeRestaurateur()
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        //We get all the restaurateurs
        $restaurateurs = Restaurateur::getBy(array());
        
        return View::render("entrepreneur/supprimeRestaurateur.php", array('restaurateurs' => $restaurateurs));
    }
    
    public function doSupprimeRestaurateur($id)
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId($id)));
        if(!$restaurateur){
            //If the restaurateur doesn't exist, we redirect to the list
            Session::addFlashMessage("Suppression impossible :", 
                    'error', 
                    "Ce restaurateur n'existe pas.");
            Redirect::to('/entrepreneur/supprimeRestaurateur');
        }
        //Then we delete the restaurateur
        $restaurateur->delete();
        Session::addFlashMessage("Restaurateur supprimé", 
                'success', 
                "Le restaurateur a été supprimé avec succès.");
        Redirect::to('/entrepreneur/supprimeRestaurateur');
    }
}