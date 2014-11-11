<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Model\Restaurant;
use App\Component\Redirect;
use App\Model\Commande;
use App\Component\Form;
use App\Component\Session;

class RestaurantController extends Controller{
    
    public function index(){
        //Get all the restaurants
        $restaurants = Restaurant::getBy(array());
        
        return View::render("restaurant/index.php", array('restaurants'=>$restaurants));
    }
    
    public function see($idRestaurant){
        //Get the restaurant by its id
        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($idRestaurant)));
        
        //If User is not logged in
        if(!Session::isConnected()){
            Session::addFlashMessage("Non connecté", "error", "Veuillez vous connecter avant de continuer.");
            Redirect::to('/restaurant');
        }
        //If it doesn't exist, return to the list
        if(!$restaurant){
            Redirect::to('/restaurant');
        }
        
        if(Form::exists('order_form')){
            $commande = new Commande();
            $menuItems = $restaurant->getMenu()->getMenuItems();
            
            foreach ($menuItems as $menuItem):
                //if(Form::get($name))
            endforeach;
            
//            $commande->setClient(Session::getUser());
//            if(strcmp(Form::get('adress'), "Adresse alternative") = 0){
//                $commande->setAdress(Form::get('altAdress'));
//            }else{
//                $commande->setAdress(Form::get('adress'));
//            }
            
            
            
            return View::render("restaurant/orderComplete.php", array('commande'=>$commande));
        }
        
        return View::render("restaurant/see.php", array('restaurant'=>$restaurant, 'client'=> Session::getUser()));
    }
}