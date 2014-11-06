<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Model\Restaurant;
use App\Component\Redirect;

class RestaurantController extends Controller{
    
    public function index(){
        //Get all the restaurants
        $restaurants = Restaurant::getBy(array());
        
        return View::render("restaurant/index.php", array('restaurants'=>$restaurants));
    }
    
    public function see($idRestaurant){
        //Get the restaurant by its id
        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($idRestaurant)));
        
        //If it doesn't exist, return to the list
        if(!$restaurant){
            Redirect::to('/restaurant');
        }
        
        return View::render("restaurant/see.php", array('restaurant'=>$restaurant));
    }
}