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
            Session::disconnect();
            return Redirect::to('/entrepreneur/login');
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
                return Redirect::to('/entrepreneur');
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
            return Redirect::to('/entrepreneur/login');
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
            
            return Redirect::to('/entrepreneur');
        }
        
        return View::render("entrepreneur/ajoutRestaurateur.php", array('restaurants' => $restaurants));
    }
    
    public function editeRestaurateur($id = 0)
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            return Redirect::to('/entrepreneur/login');
        }
        
        //If no restaurateur is specified, display the list
        if($id == 0){
            $restaurateurs = Restaurateur::getBy(array());
            return View::render("entrepreneur/listeEditeRestaurateur.php", array('restaurateurs' => $restaurateurs));
        }
        
        $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId($id)));
        if(!$restaurateur){
            return Redirect::to('/entrepreneur/editeRestaurateur');
        }
        
        //We select all the Restaurants without Restaurateur
        $restaurants = Restaurant::getBy(array('restaurateur' => null));
        
        $owned_restaurants = array();
        
        //We add to them the restaurants from the current Restaurateur
        foreach($restaurateur->getRestaurants() as $restaurant){
            $restaurants[] = $restaurant;
            $owned_restaurants[] = $restaurant->getId();
        }
        
        if(Form::exists('restaurateur_edit_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('firstName','mail','name'))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("entrepreneur/editeRestaurateur.php", array('error' => $error, 'restaurants' => $restaurants, 'owned_restaurants' => $owned_restaurants, 'restaurateur' => $restaurateur));
            }
            
            //We check if the mail address is not already taken
            $found = Restaurateur::getOneBy(array('_mail' => Form::get('mail')));
            if($found && $found->getId() != $restaurateur->getId()){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Adresse e-mail non disponible.");
                $error = "Cette adresse e-mail est déjà associée à un compte. Veuillez en choisir une autre.";
                return View::render("entrepreneur/editeRestaurateur.php", array('error' => $error, 'restaurants' => $restaurants, 'owned_restaurants' => $owned_restaurants, 'restaurateur' => $restaurateur));
            }
            
            //We associate the values
            $restaurateur->setFirstName(Form::get('firstName'));
            $restaurateur->setMail(Form::get('mail'));
            $restaurateur->setName(Form::get('name'));
            //We save this User in the DB
            $restaurateur->save();
            
            //We delete the old restaurants
            foreach($restaurateur->getRestaurants() as $restaurant){
                $restaurateur->removeRestaurant($restaurant);
                $restaurant->removeRestaurateur();
                $restaurant->save();
            }
            
            //We add the restaurants to the Restaurateur
            foreach(Form::get('restaurants') as $restaurantId){
                if($restaurantId != ""){
                    $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($restaurantId)));
                } else {
                    $restaurant = null;
                }
                if($restaurant){
                    $restaurateur->addRestaurant($restaurant);
                }
            }
            $restaurateur->save();
            
            
            Session::addFlashMessage("Restaurateur edité avec succès", 
                    'success', 
                    "Le restaurateur " . $restaurateur->getMail() . " a été  édité avec succès.");
            Redirect::to('/entrepreneur');
        }
        
        return View::render("entrepreneur/editeRestaurateur.php", array('restaurants' => $restaurants, 'owned_restaurants' => $owned_restaurants, 'restaurateur' => $restaurateur));
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
    
    
    public function ajoutRestaurant()
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        //We select all the Restaurateur
        $restaurateurs = Restaurateur::getBy(array());
        
        if(Form::exists('restaurant_add_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('name')) || Form::checkEmpty(array('description'))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("entrepreneur/ajoutRestaurant.php", array('error' => $error, 'restaurateurs' => $restaurateurs));
            }
            
            //We check if the name is not already taken
            if(Restaurant::getOneBy(array('name' => Form::get('name')))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Ce nom de restaurant est non disponible.");
                $error = "Ce nom de restaurant existe déjà. Veuillez en choisir une autre.";
                return View::render("entrepreneur/ajoutRestaurant.php", array('error' => $error, 'restaurateurs' => $restaurateurs));
            }
            
            //We create a new Restaurant, and associate the values
            $restaurant = new Restaurant();
            $restaurant->setName(Form::get('name'));
            $restaurant->setDescription(Form::get('description'));
            $restaurant->setPicture('img/generic.jpg');
            
            //We save this Restaurant in the DB
            $restaurant->save();
            
            //We add the Restaurateur to the Restaurant
            $restaurateurAdded = false;
            $restaurateurId = Form::get('restaurateur');
            if($restaurateurId != ""){
                $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId($restaurateurId)));
                //If the Restaurateur exist, we add the Restaurant to it
                if($restaurateur){
                    $restaurateur->addRestaurant($restaurant);
                    $restaurateur->save();
                    $restaurateurAdded = true;
                }
            }
            
            if($restaurateurAdded){
                Session::addFlashMessage("Restaurant ajouté avec succès", 
                        'success', 
                        "Le restaurant " . $restaurant->getName() . " a été ajouté avec succès.");
            } else {
                Session::addFlashMessage("Restaurant ajouté sans restaurateur", 
                        'warning', 
                        "Le restaurant " . $restaurant->getName() . " a été ajouté sans restaurateur associé.");
            }
            
            Redirect::to('/entrepreneur');
        }
        
        return View::render("entrepreneur/ajoutRestaurant.php", array('restaurateurs' => $restaurateurs));
    }
    
    
    public function editeRestaurant($id = 0)
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        //If id is not set, we display the list of restaurants
        if($id == 0){
            $restaurants = Restaurant::getBy(array());
            return View::render("entrepreneur/listeEditeRestaurant.php", array('restaurants' => $restaurants));
        }
        
        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($id)));
        if(!$restaurant){
            return Redirect::to('/entrepreneur/editeRestaurant');
        }
        
        //We select all the Restaurateurs
        $restaurateurs = Restaurateur::getBy(array());
        
        if(Form::exists('restaurant_edit_form')){
            
            //We check if all the input are filled
            if(Form::checkEmpty(array('name')) || Form::checkEmpty(array('description'))){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("entrepreneur/editeRestaurant.php", array('error' => $error, 'restaurateurs' => $restaurateurs, 'restaurant' => $restaurant));
            }
            
            //We check if the name is not already taken
            $found = Restaurant::getOneBy(array('name' => Form::get('name')));
            if($found && $found->getId() != $restaurant->getId()){
                Session::addFlashMessage("Erreur :", 
                        'error', 
                        "Ce nom de restaurant est non disponible.");
                $error = "Ce nom de restaurant existe déjà. Veuillez en choisir une autre.";
                return View::render("entrepreneur/editeRestaurant.php", array('error' => $error, 'restaurateurs' => $restaurateurs, 'restaurant' => $restaurant));
            }
            
            //We create a new Restaurant, and associate the values
            $restaurant->setName(Form::get('name'));
            $restaurant->setDescription(Form::get('description'));
            //TODO: Set the picture from the form
            
            //We save this Restaurant in the DB
            $restaurant->save();
            
            //We remove the current Restaurateur
            $restaurateur = $restaurant->getRestaurateur();
            if($restaurateur){
                $restaurateur->removeRestaurant($restaurant);
                $restaurateur->save();
                $restaurant->removeRestaurateur();
                $restaurant->save();
            }
            
            //We add the Restaurateur to the Restaurant
            $restaurateurId = Form::get('restaurateur');
            if($restaurateurId != ""){
                $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId($restaurateurId)));
                //If the Restaurateur exist, we add the Restaurant to it
                if($restaurateur){
                    $restaurateur->addRestaurant($restaurant);
                    $restaurateur->save();
                    $restaurateurAdded = true;
                }
            }
            
            Session::addFlashMessage("Restaurant édité avec succès", 
                    'success', 
                    "Le restaurant " . $restaurant->getName() . " a été édité avec succès.");
            
            Redirect::to('/entrepreneur');
        }
        
        return View::render("entrepreneur/editeRestaurant.php", array('restaurateurs' => $restaurateurs, 'restaurant' => $restaurant));
    }
    
    public function supprimeRestaurant()
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        //We get all the restaurateurs
        $restaurants = Restaurant::getBy(array());
        
        return View::render("entrepreneur/supprimeRestaurant.php", array('restaurants' => $restaurants));
    }
    
    public function doSupprimeRestaurant($id)
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_ENTREPRENEUR){
            Redirect::to('/entrepreneur/login');
        }
        
        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($id)));
        if(!$restaurant){
            //If the restaurateur doesn't exist, we redirect to the list
            Session::addFlashMessage("Suppression impossible :", 
                    'error', 
                    "Ce restaurant n'existe pas.");
            Redirect::to('/entrepreneur/supprimeRestaurant');
        }
        //Then we delete the restaurateur
        $restaurant->delete();
        Session::addFlashMessage("Restaurant supprimé", 
                'success', 
                "Le restaurant a été supprimé avec succès.");
        Redirect::to('/entrepreneur/supprimeRestaurant');
    }
}